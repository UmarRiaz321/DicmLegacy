<?php
declare(strict_types=1);

namespace App\Libraries;

use App\Models\PluginModel;

/**
 * Evaluate: Approve users and provision them in OIDC.
 *
 * Notes:
 * - Expects env vars:
 *   - oidc.issuer (e.g. https://oidc.example.com)
 *   - oidc.admin_token
 *   - email.SMTPHost, email.SMTPUser, email.SMTPPass, email.SMTPPort (optional, defaults to 465), email.SMTPCrypto (ssl|tls, optional)
 */
class Evaluate
{
    /** @var \CodeIgniter\Database\BaseConnection */
    protected $db;

    /** @var PluginModel */
    protected $model;

    /** @var \CodeIgniter\Email\Email */
    protected $email;

    /** @var \CodeIgniter\HTTP\CURLRequest */
    protected $http;

    /** @var \App\Libraries\Email|null */
    protected $emailService; // if you have custom templated emails (e.g., userUpdateEmail)

    public function __construct()
    {
        $this->db          = db_connect();
        $this->model       = new PluginModel($this->db);
        $this->email       = \Config\Services::email();
        $this->http        = \Config\Services::curlrequest();
        // Optional app-level email helper (kept from original code if you use it elsewhere)
        $this->emailService = class_exists(\App\Libraries\Email::class) ? new \App\Libraries\Email() : null;
    }

    /**
     * Approve a user and provision them in OIDC.
     */
    public function approve_user(int $id): bool
    {
        // Admin check
        $session = session();
        if (!$session->get('isAdmin')) {
            log_message('error', '[Evaluate] Unauthorized attempt to approve user.');
            return false;
        }

        // Fetch user
        $where = ['user_id' => $id];
        $user  = $this->model->getItem('Users', $where);
        if (!$user) {
            log_message('error', "[Evaluate] User with ID {$id} not found.");
            return false;
        }

        $type               = $user->user_type; // 'charity' | 'sponsor' | 'enabler'
        $mType              = '';
        $name               = '';
        $email              = '';
        $userName           = '';
        $marketingContacts  = [];
        $organisationName   = '';
        $sponsorId          = null;

        // Fill details by type
        switch ($type) {
            case 'charity':
                $c = $this->model->getItem('Charities', $where);
                if (!$c) return false;
                $userName = $this->createUserName('CSE');
                $MSC = $this->model->getItem('CSE_MainContactdetails', ['cse_id' => $c->cse_id]);
                if (!$MSC) return false;
                $name  = (string) $c->cse_OrgName;
                $email = (string) $MSC->cmcd_email;
                $mType = 'CSE';
                break;

            case 'sponsor':
                $c = $this->model->getItem('Sponsors', $where);
                if (!$c) return false;
                $userName = $this->createUserName('BUS');
                $MSC = $this->model->getItem('SPO_MainContactdetails', ['spo_id' => $c->spo_id]);
                if (!$MSC) return false;
                $name  = (string) $MSC->smcd_Name;
                $email = (string) $MSC->smcd_Email;
                $mType = 'BUS';
                $organisationName = (string) $c->spo_OrgName;
                $sponsorId = (int) $c->spo_id;
                $marketingContacts = $this->model->getItemMul('SPO_Accounts', ['spo_id' => $c->spo_id]) ?? [];
                break;

            case 'enabler':
                $c = $this->model->getItem('Enablers', $where);
                if (!$c) return false;
                $userName = $this->createUserName('BUY');
                $MSC = $this->model->getItem('ENA_MainContactdetails', ['ena_id' => $c->ena_id]);
                if (!$MSC) return false;
                $name  = (string) $c->ena_OrgName;
                $email = (string) $MSC->emcd_Email;
                $mType = 'BUY';
                break;

            default:
                log_message('error', "[Evaluate] Unknown user_type '{$type}' for user {$id}");
                return false;
        }

        if ($email === '') {
            log_message('error', "[Evaluate] No email found for user {$id}");
            return false;
        }

        // Check if user exists on OIDC server
        $isUser = $this->checkifUserExist($email);

        if ($isUser['success'] === true) {
            // Update username on existing OIDC user
            $userID     = $isUser['response']; // numeric/string ID
            $userUpdate = $this->updateUsername((string) $userID, $mType, $userName);

            if ($userUpdate['success'] !== true) {
                log_message('error', '[Evaluate] Failed to update OIDC username: ' . ($userUpdate['message'] ?? 'unknown'));
                return false;
            }

            // Notify user their username changed (if your app email helper exists)
            if ($this->emailService && method_exists($this->emailService, 'userUpdateEmail')) {
                try {
                    $this->emailService->userUpdateEmail($email, $userName);
                } catch (\Throwable $e) {
                    log_message('error', '[Evaluate] userUpdateEmail failed: ' . $e->getMessage());
                }
            }
        } else {
            // Create new account in OIDC
            $newUser = $this->createUserAccount($name, $email, $userName, $mType);
            if ($newUser['success'] !== true) {
                log_message('error', '[Evaluate] User creation failed: ' . json_encode($newUser));
                return false;
            }

            // Send credentials to user
            $password = (string) $newUser['password'];

            $this->deliverCredentials($email, $userName, $password);

        }

        // Save UUID in DB
        $data = [
            'user_id'   => $id,
            'unique_id' => $userName,
        ];
        $uniqueSaved = $this->model->insertItem('Unique_Identifiers', $data);

        if ($uniqueSaved) {
            $this->changeStatus($type, $id);

            if ($type === 'sponsor' && $sponsorId !== null) {
                $this->notifySponsorMarketingContacts($marketingContacts, $organisationName);
            }

            return true;
        }

        log_message('error', "[Evaluate] Failed to persist unique_id for user {$id}");
        return false;
    }

    /**
     * Create OIDC user + return generated password.
     */
    protected function createUserAccount(string $name, string $email, string $uuid, string $type): array
    {
        $password = $this->generateRandomPassword(12);

        $created = $this->createOidcUser($uuid, $email, $name, $type, $password);

        if (($created['success'] ?? false) === true) {
            return [
                'success'  => true,
                'uuid'     => $uuid,
                'password' => $password,
            ];
        }

        return [
            'success' => false,
            'message' => $created['message'] ?? 'Failed to create user in OIDC',
        ];
    }

    /**
     * Provision an additional delegate account that shares the parent organisation context.
     */
    public function provisionDelegateAccount(string $name, string $email, string $userType, ?string $preferredUserName = null): array
    {
        $prefix = $this->mapUserTypeToPrefix($userType);
        $userName = $preferredUserName ?: $this->createUserName($prefix);
        $existing = $this->checkifUserExist($email);

        if ($existing['success'] === true) {
            $oidcId = (string) ($existing['response'] ?? '');
            if ($oidcId === '') {
                return [
                    'success' => false,
                    'message' => 'Unable to refresh existing account credentials.',
                ];
            }

            $usernameUpdate = $this->updateUsername($oidcId, $prefix, $userName);
            if (($usernameUpdate['success'] ?? false) !== true) {
                return [
                    'success' => false,
                    'message' => $usernameUpdate['message'] ?? 'Unable to refresh existing account credentials.',
                ];
            }

            $password = $this->generateRandomPassword(12);
            if (!$this->updateOidcPassword($oidcId, $password)) {
                return [
                    'success' => false,
                    'message' => 'Unable to reset the existing account password.',
                ];
            }

            $this->deliverCredentials($email, $userName, $password);

            return [
                'success'  => true,
                'username' => $userName,
                'password' => $password,
                'existing' => true,
            ];
        }

        $result   = $this->createUserAccount($name, $email, $userName, $prefix);

        if (($result['success'] ?? false) !== true) {
            return $result;
        }

        $password = (string) ($result['password'] ?? '');
        $this->deliverCredentials($email, $userName, $password);

        return [
            'success'  => true,
            'username' => $userName,
            'password' => $password,
        ];
    }

    /**
     * Send initial credentials to user.
     */
    public function passEmail(string $to, string $login, string $password): bool
    {
        $subject = 'Your SIR Login Details';
        $message = view('email/passemail', [
            'login'    => $login,
            'password' => $password,
        ]);

        // SMTP config from env (recommended for production)
        $config = [
            'protocol'   => 'smtp',
            'SMTPHost'   => (string) (env('email.SMTPHost') ?? ''),
            'SMTPUser'   => (string) (env('email.SMTPUser') ?? ''),
            'SMTPPass'   => (string) (env('email.SMTPPass') ?? ''),
            'SMTPPort'   => (int)    (env('email.SMTPPort') ?? 465),
            'SMTPCrypto' => (string) (env('email.SMTPCrypto') ?? 'ssl'), // 'ssl' or 'tls'
            'mailType'   => 'html',
            'charset'    => 'utf-8',
            'wordWrap'   => true,
        ];

        try {
            $this->email->initialize($config);
            $this->email->setTo($to);
            $this->email->setFrom((string) (env('email.FromAddress') ?? 'no-reply@example.com'), (string) (env('email.FromName') ?? 'SIR'));
            $this->email->setSubject($subject);
            $this->email->setMessage($message);

            if ($this->email->send()) {
                return true;
            }

            log_message('error', '[Evaluate] Email send failed: ' . $this->email->printDebugger(['headers']));
        } catch (\Throwable $e) {
            log_message('error', '[Evaluate] Email exception: ' . $e->getMessage());
        }

        return false;
    }

    protected function deliverCredentials(string $email, string $username, string $password): void
    {
        if ($this->emailService && method_exists($this->emailService, 'passEmail')) {
            try {
                $this->emailService->passEmail($email, $email, $password);
                return;
            } catch (\Throwable $e) {
                log_message('error', '[Evaluate] Email service passEmail failed: ' . $e->getMessage());
            }
        }

        $this->passEmail($email, $email, $password);
    }

    public function provisionPlatformUser(string $name, string $email, string $userType, ?string $preferredUserName = null): array
    {
        $this->requireAdmin();

        $name = trim($name);
        $email = strtolower(trim($email));
        $userType = strtolower(trim($userType));

        if ($name === '' || $email === '') {
            return ['success' => false, 'message' => 'Name and email are required.'];
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return ['success' => false, 'message' => 'Invalid email address.'];
        }

        $allowedTypes = ['admin', 'sponsor', 'charity', 'enabler'];
        if (!in_array($userType, $allowedTypes, true)) {
            return ['success' => false, 'message' => 'Unsupported user type.'];
        }

        $prefix = $this->mapUserTypeToPrefix($userType);
        $userName = $preferredUserName ? strtoupper($preferredUserName) : $this->createUserName($prefix);

        if (!preg_match('/^[A-Z0-9\\-_]{3,32}$/', $userName)) {
            return ['success' => false, 'message' => 'Preferred identifier must be 3-32 characters (A-Z, 0-9, hyphen, underscore).'];
        }

        $existing = $this->checkifUserExist($email);

        if ($existing['success'] === true) {
            $oidcId = (string) ($existing['response'] ?? '');
            if ($oidcId === '') {
                return ['success' => false, 'message' => 'Unable to refresh existing account credentials.'];
            }

            $updated = $this->updateUsername($oidcId, $prefix, $userName);
            if (($updated['success'] ?? false) !== true) {
                return ['success' => false, 'message' => $updated['message'] ?? 'Unable to refresh existing account credentials.'];
            }

            $password = $this->generateRandomPassword(12);
            if (!$this->updateOidcPassword($oidcId, $password)) {
                return ['success' => false, 'message' => 'Unable to reset the existing account password.'];
            }

            return [
                'success'  => true,
                'username' => $userName,
                'password' => $password,
                'existing' => true,
            ];
        }

        $result = $this->createUserAccount($name, $email, $userName, $prefix);

        if (($result['success'] ?? false) !== true) {
            return $result;
        }

        return [
            'success'  => true,
            'username' => $userName,
            'password' => (string) $result['password'],
            'existing' => false,
        ];
    }

    protected function mapUserTypeToPrefix(string $type): string
    {
        return match (strtolower($type)) {
            'sponsor', 'bus' => 'BUS',
            'enabler', 'buy' => 'BUY',
            'admin', 'adm'   => 'ADM',
            default          => 'CSE',
        };
    }

    /**
     * PATCH the OIDC username (uuid) and type.
     */
    protected function updateUsername(string $id, string $mType, string $uuid): array
    {
        try {
            $res = $this->http->patch($this->oidcUrl("/admin/users/{$id}"), [
                'headers'     => $this->oidcHeaders(),
                'json'        => [
                    'uuid'      => $uuid,
                    'user_type' => strtolower($mType),
                ],
                'http_errors' => false,
            ]);

            $status = $res->getStatusCode();
            if (in_array($status, [200, 204], true)) {
                return ['success' => true];
            }

            return [
                'success' => false,
                'message' => "OIDC update failed with HTTP {$status}",
            ];
        } catch (\Throwable $e) {
            log_message('error', '[Evaluate] updateUsername failed: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Exception: ' . $e->getMessage(),
            ];
        }
    }


    /**
     * Require admin (throwing variant, retained for reuse).
     */
    protected function requireAdmin(): void
    {
        $session = session();
        if (!$session->get('isAdmin')) {
            throw new \RuntimeException('Admin privileges required.');
        }
    }

    /**
     * Generate username like CSE######### with cryptographically secure RNG.
     */
    protected function createUserName(string $prefix): string
    {
        return $prefix . (string) random_int(100000000, 999999999);
    }

    /**
     * Generate a strong password of given length that includes
     * at least one lower, upper, digit, and special.
     */
    protected function generateRandomPassword(int $length = 12): string
    {
        $lower   = 'abcdefghijklmnopqrstuvwxyz';
        $upper   = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $digits  = '0123456789';
        $special = '!@#$%^&*()_-+=<>?';
        $all     = $lower . $upper . $digits . $special;

        if ($length < 8) {
            $length = 8;
        }

        // Ensure at least one of each class
        $password = [
            $lower[random_int(0, strlen($lower) - 1)],
            $upper[random_int(0, strlen($upper) - 1)],
            $digits[random_int(0, strlen($digits) - 1)],
            $special[random_int(0, strlen($special) - 1)],
        ];

        // Fill the rest
        for ($i = 4; $i < $length; $i++) {
            $password[] = $all[random_int(0, strlen($all) - 1)];
        }

        // Secure shuffle
        for ($i = count($password) - 1; $i > 0; $i--) {
            $j = random_int(0, $i);
            [$password[$i], $password[$j]] = [$password[$j], $password[$i]];
        }

        return implode('', $password);
    }



    /**
     * Create an OIDC user. Returns true on success.
     */
    protected function createOidcUser(string $uuid, string $email, string $name, string $type, string $password): array
    {
        try {
            $res = $this->http->post($this->oidcUrl('/admin/users'), [
                'headers'     => array_merge($this->oidcHeaders(), ['Content-Type' => 'application/json']),
                'json'        => [
                    'uuid'                  => $uuid,
                    'email'                 => $email,
                    'full_name'             => $name,
                    'user_type'             => strtolower($type),
                    'password'              => $password,
                    'must_change_password'  => true,
                ],
                'http_errors' => false,
            ]);

            $status = $res->getStatusCode(); // 201 Created is typical
            if (in_array($status, [200, 201, 204], true)) {
                return ['success' => true];
            }

            $body = (string) $res->getBody();
            $message = "OIDC responded with HTTP {$status}";
            if ($body !== '') {
                $message .= ': ' . $body;
            }

            return [
                'success' => false,
                'message' => $message,
            ];
        } catch (\Throwable $e) {
            log_message('error', '[Evaluate] createOidcUser exception: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Exception creating OIDC user: ' . $e->getMessage(),
            ];
        }
    }

    /**
     * (Unused in approve flow but kept for completeness)
     */
    protected function findOidcUser(string $email): ?array
    {
        try {
            $res = $this->http->get($this->oidcUrl('/admin/users?email=' . urlencode($email)), [
                'headers'     => $this->oidcHeaders(),
                'http_errors' => false,
            ]);

            if ($res->getStatusCode() === 200) {
                $data = json_decode($res->getBody(), true);
                $users = $this->extractUsersFromOidcPayload($data);
                return $users[0] ?? null;
            }
        } catch (\Throwable $e) {
            log_message('error', '[Evaluate] findOidcUser exception: ' . $e->getMessage());
        }
        return null;
    }

    /**
     * Update OIDC password and require change on next login.
     */
    protected function updateOidcPassword(string $id, string $password): bool
    {
        try {
            $res = $this->http->post($this->oidcUrl("/admin/users/{$id}/password"), [
                'headers'     => $this->oidcHeaders(),
                'json'        => [
                    'password'              => $password,
                    'must_change_password'  => true,
                ],
                'http_errors' => false,
            ]);

            return $res->getStatusCode() === 204;
        } catch (\Throwable $e) {
            log_message('error', '[Evaluate] updateOidcPassword exception: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Build full OIDC URL.
     */
    protected function oidcUrl(string $path): string
    {
        $issuer = (string) (env('oidc.issuer') ?: getenv('oidc.issuer') ?: '');
        return rtrim($issuer, '/') . $path;
    }

    /**
     * Headers for OIDC admin endpoints.
     */
    protected function oidcHeaders(): array
    {
        return [
            'X-Admin-Token' => (string) (env('oidc.admin_token') ?: getenv('oidc.admin_token') ?: ''),
            'Accept'        => 'application/json',
        ];
    }

    /**
     * Mark status approved across related tables.
     */
    protected function changeStatus(string $type, int $id): void
    {
        $this->model->updateItem('Users', ['user_id' => $id], ['u_status' => 'approved']);

        switch ($type) {
            case 'charity':
                $this->model->updateItem('Charities', ['user_id' => $id], ['approved' => 1]);
                break;
            case 'sponsor':
                $this->model->updateItem('Sponsors', ['user_id' => $id], ['approved' => 1]);
                break;
            case 'enabler':
                $this->model->updateItem('Enablers', ['user_id' => $id], ['approved' => 1]);
                break;
        }
    }

    /**
     * Notify marketing contacts for approved sponsors.
     *
     * @param array<int,object> $contacts
     */
    protected function notifySponsorMarketingContacts(array $contacts, string $organisationName): void
    {
        if (!$this->emailService || !method_exists($this->emailService, 'sendSponsorMarketingWelcome')) {
            return;
        }

        foreach ($contacts as $contact) {
            $email = isset($contact->sa_Email) ? trim((string) $contact->sa_Email) : '';
            if ($email === '') {
                continue;
            }

            $fullName = trim(
                ((string) ($contact->sa_fName ?? '')) . ' ' . ((string) ($contact->sa_lName ?? ''))
            );

            try {
                $this->emailService->sendSponsorMarketingWelcome($email, $fullName, $organisationName);
            } catch (\Throwable $e) {
                log_message('error', '[Evaluate] Failed to send sponsor marketing welcome: ' . $e->getMessage());
            }
        }
    }

    /**
     * Check if OIDC user exists by email.
     * @return array{success:bool, response?:mixed, message?:string}
     */
    public function checkifUserExist(string $email): array
    {
        try {
            $response = $this->http->get($this->oidcUrl('/admin/users?email=' . urlencode($email)), [
                'headers'     => $this->oidcHeaders(),
                'http_errors' => false,
            ]);

            $status = $response->getStatusCode();

            if ($status === 200) {
                $data = json_decode($response->getBody(), true);
                $users = $this->extractUsersFromOidcPayload($data);
                if (!empty($users)) {
                    $first = $users[0];
                    $userId = $first['id'] ?? $first['user_id'] ?? $first['sub'] ?? null;
                    return [
                        'success'  => true,
                        'response' => $userId ?: 'exists',
                    ];
                }
                // 200 with empty list -> not found
                return [
                    'success' => false,
                    'message' => 'User not found',
                ];
            }

            if ($status === 404) {
                return [
                    'success' => false,
                    'message' => 'User not found',
                ];
            }

            return [
                'success' => false,
                'message' => 'OIDC lookup failed with HTTP ' . $status,
            ];
        } catch (\Throwable $e) {
            log_message('error', '[Evaluate] checkifUserExist failed: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Exception: ' . $e->getMessage(),
            ];
        }
    }

    /**
     * Normalize OIDC /admin/users payload into a flat users array.
     *
     * Accepts common response shapes:
     * - [ {id: ...}, ... ]
     * - { data: [ ... ] }
     * - { users: [ ... ] }
     * - { user: { ... } }
     * - { id: ... }
     */
    protected function extractUsersFromOidcPayload($payload): array
    {
        if (!is_array($payload)) {
            return [];
        }

        if (isset($payload[0]) && is_array($payload[0])) {
            return $payload;
        }

        if (isset($payload['data']) && is_array($payload['data'])) {
            return $payload['data'];
        }

        if (isset($payload['users']) && is_array($payload['users'])) {
            return $payload['users'];
        }

        if (isset($payload['user']) && is_array($payload['user'])) {
            return [$payload['user']];
        }

        if (isset($payload['id']) || isset($payload['user_id']) || isset($payload['sub'])) {
            return [$payload];
        }

        return [];
    }

     public function transfer_user(int $id, string $uniq): bool
    {
        // Admin check
        $session = session();
        if (!$session->get('isAdmin')) {
            log_message('error', '[Evaluate] Unauthorized attempt to approve user.');
            return false;
        }

        // Fetch user
        $where = ['user_id' => $id];
        $user  = $this->model->getItem('Users', $where);
        if (!$user) {
            log_message('error', "[Evaluate] User with ID {$id} not found.");
            return false;
        }

        $type     = $user->user_type; // 'charity' | 'sponsor' | 'enabler'
        $mType    = '';
        $name     = '';
        $email    = '';
        $userName = $uniq;

        // Fill details by type
        switch ($type) {
            case 'charity':
                $c = $this->model->getItem('Charities', $where);
                if (!$c) return false;
                // $userName = $this->createUserName('CSE');
                $MSC = $this->model->getItem('CSE_MainContactdetails', ['cse_id' => $c->cse_id]);
                if (!$MSC) return false;
                $name  = (string) $c->cse_OrgName;
                $email = (string) $MSC->cmcd_email;
                $mType = 'CSE';
                break;

            case 'sponsor':
                $c = $this->model->getItem('Sponsors', $where);
                if (!$c) return false;
                // $userName = $this->createUserName('BUS');
                $MSC = $this->model->getItem('SPO_MainContactdetails', ['spo_id' => $c->spo_id]);
                if (!$MSC) return false;
                $name  = (string) $MSC->smcd_Name;
                $email = (string) $MSC->smcd_Email;
                $mType = 'BUS';
                break;

            case 'enabler':
                $c = $this->model->getItem('Enablers', $where);
                if (!$c) return false;
                // $userName = $this->createUserName('BUY');
                $MSC = $this->model->getItem('ENA_MainContactdetails', ['ena_id' => $c->ena_id]);
                if (!$MSC) return false;
                $name  = (string) $c->ena_OrgName;
                $email = (string) $MSC->emcd_Email;
                $mType = 'BUY';
                break;

            default:
                log_message('error', "[Evaluate] Unknown user_type '{$type}' for user {$id}");
                return false;
        }

        if ($email === '') {
            log_message('error', "[Evaluate] No email found for user {$id}");
            return false;
        }

        // Check if user exists on OIDC server
        $isUser = $this->checkifUserExist($email);

        if ($isUser['success'] === true) {
            // Update username on existing OIDC user
            $userID     = $isUser['response']; // numeric/string ID
            $userUpdate = $this->updateUsername((string) $userID, $mType, $userName);

            if ($userUpdate['success'] !== true) {
                log_message('error', '[Evaluate] Failed to update OIDC username: ' . ($userUpdate['message'] ?? 'unknown'));
                return false;
            }

            // Notify user their username changed (if your app email helper exists)
            if ($this->emailService && method_exists($this->emailService, 'userUpdateEmail')) {
                try {
                    $this->emailService->userUpdateEmail($email, $userName);
                } catch (\Throwable $e) {
                    log_message('error', '[Evaluate] userUpdateEmail failed: ' . $e->getMessage());
                }
            }
        } else {
            // Create new account in OIDC
            $newUser = $this->createUserAccount($name, $email, $userName, $mType);
            if ($newUser['success'] !== true) {
                log_message('error', '[Evaluate] User creation failed: ' . json_encode($newUser));
                return false;
            }
            else{
                // Send credentials to user
                $password = (string) $newUser['password'];
                $this->emailService->passEmail($email, $email, $password);
                return true;
            }
        }

        // Save UUID in DB
        // $data = [
        //     'user_id'   => $id,
        //     'unique_id' => $userName,
        // ];
        // $uniqueSaved = $this->model->insertItem('Unique_Identifiers', $data);

        if ($uniqueSaved) {
            $this->changeStatus($type, $id);
            return true;
        }

        log_message('error', "[Evaluate] Failed to persist unique_id for user {$id}");
        return false;
    }

}
