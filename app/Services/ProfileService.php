<?php

namespace App\Services;

use App\Models\PluginModel;
use App\Models\UserDelegateModel;
use App\Models\UserProfileModel;
use App\Models\UserProfileUpdateModel;
use App\Libraries\Evaluate;
use CodeIgniter\Database\BaseConnection;
use CodeIgniter\Database\Exceptions\DatabaseException;

class ProfileService
{
    protected BaseConnection $db;
    protected PluginModel $pluginModel;
    protected UserProfileModel $profileModel;
    protected UserDelegateModel $delegateModel;
    protected UserProfileUpdateModel $updateModel;
    protected Evaluate $evaluate;
    protected ?bool $hasProfileTable = null;
    protected ?bool $hasDelegateTable = null;
    protected ?bool $hasUpdateTable = null;

    public function __construct()
    {
        $this->db            = db_connect();
        $this->pluginModel   = new PluginModel($this->db);
        $this->profileModel  = new UserProfileModel($this->db);
        $this->delegateModel = new UserDelegateModel($this->db);
        $this->updateModel   = new UserProfileUpdateModel($this->db);
        $this->evaluate      = new Evaluate();
    }

    public function buildProfileData(string $uniqueId): array
    {
        try {
            $identifier = $this->pluginModel->getItem('Unique_Identifiers', ['unique_id' => $uniqueId]);
            $viewerIsDelegate = false;
            if ($identifier) {
                $viewerUserId = (int) $identifier->user_id;
                [$ownerUserId, $viewerIsDelegate] = $this->resolveOwnerUserId($viewerUserId);
            } else {
                if (!$this->delegateTableAvailable()) {
                    return ['success' => false, 'error' => 'identifier_not_found'];
                }

                $delegate = $this->delegateModel
                    ->where('invite_token', $uniqueId)
                    ->where('invite_status', 'active')
                    ->first();

                if (!$delegate || empty($delegate['parent_user_id'])) {
                    return ['success' => false, 'error' => 'identifier_not_found'];
                }

                $viewerIsDelegate = true;
                $ownerUserId = (int) $delegate['parent_user_id'];
                $viewerUserId = $ownerUserId;
            }

            $user = $this->pluginModel->getItem('Users', ['user_id' => $ownerUserId]);
            if (!$user) {
                return ['success' => false, 'error' => 'user_not_found'];
            }

            $type = $user->user_type;
            $payload = $this->hydrateOrganisationData($ownerUserId, $type);
            if (!$payload) {
                return ['success' => false, 'error' => 'detail_missing'];
            }

            $profile = $this->firstOrCreateProfile(
                $ownerUserId,
                $payload['contact']['email'] ?? null,
                $payload['contact']['name'] ?? null,
                $payload['contact']['phone'] ?? null
            );

            $delegates = [];
            if ($this->delegateTableAvailable()) {
                $delegates = $this->delegateModel
                    ->where('parent_user_id', $ownerUserId)
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
            }

            $updateRequests = [];
            if ($this->updateTableAvailable()) {
                $updateRequests = $this->updateModel
                    ->where('user_id', $ownerUserId)
                    ->orderBy('created_at', 'DESC')
                    ->findAll(5);
            }

            return [
                'success' => true,
                'data'    => [
                    'userId'        => $ownerUserId,
                    'viewerUserId'  => $viewerUserId,
                    'u_id'          => $uniqueId,
                    'isDelegate'    => $viewerIsDelegate,
                    'userType'      => $type,
                    'profile'       => $profile,
                    'organisation'  => $payload['organisation'],
                    'contactBlocks' => $payload['contactCards'],
                    'contactTitle'  => $payload['contactTitle'] ?? 'CSE Details',
                    'impactBlocks'  => $payload['impactCards'],
                    'impactTitle'   => $payload['impactTitle'] ?? 'Organisation Impact',
                    'delegates'     => $delegates,
                    'updateRequests'=> $updateRequests,
                    'raw'           => $payload['raw'],
                ],
            ];
        } catch (\Throwable $e) {
            log_message('error', '[ProfileService] buildProfileData failed for {uid}: {error}', [
                'uid' => $uniqueId,
                'error' => $e->getMessage(),
            ]);

            return ['success' => false, 'error' => 'profile_load_failed'];
        }
    }

    protected function resolveOwnerUserId(int $viewerUserId): array
    {
        if (!$this->delegateTableAvailable()) {
            return [$viewerUserId, false];
        }

        $delegate = $this->delegateModel
            ->where('child_user_id', $viewerUserId)
            ->where('invite_status', 'active')
            ->first();

        if ($delegate && !empty($delegate['parent_user_id'])) {
            return [(int) $delegate['parent_user_id'], true];
        }

        return [$viewerUserId, false];
    }

    protected function hydrateOrganisationData(int $userId, string $type): ?array
    {
        switch ($type) {
            case 'charity':
                $raw = json_decode($this->pluginModel->getCDetail(['user_id' => $userId]), true);
                return $this->mapCharityRecord($raw);
            case 'sponsor':
                $raw = json_decode($this->pluginModel->getSDetail(['user_id' => $userId]), true);
                return $this->mapSponsorRecord($raw);
            case 'enabler':
                $raw = json_decode($this->pluginModel->getEDetail(['user_id' => $userId]), true);
                return $this->mapEnablerRecord($raw);
            default:
                return null;
        }
    }

    protected function mapCharityRecord(?array $decoded): ?array
    {
        if (empty($decoded) || !isset($decoded[0])) {
            return null;
        }
        $record  = $decoded[0];
        $project = $record['pro'] ?? [];
        $contact = $record['mc'] ?? [];
        $socials = $record['socials'] ?? [];

        $organisation = [
            'name'        => $record['Organisation Name'] ?? 'Not Available',
            'regions'     => $record['Regions'] ?? 'Not Available',
            'address'     => $contact['Organisation Address'] ?? 'Not Available',
            'registration'=> $record['Charity Registration Number'] ?? $record['Social Enterprise Registration Number'] ?? 'Not Available',
            'logo'        => $socials['Logo'] ?? null,
        ];

        $contactCards = [
            ['label' => 'Contact Name', 'value' => $contact['Name'] ?? 'Not Available'],
            ['label' => 'Job Title', 'value' => $contact['Job Title'] ?? 'Not Available'],
            ['label' => 'Phone', 'value' => $contact['Phone'] ?? 'Not Available'],
            ['label' => 'Email', 'value' => $contact['Email'] ?? 'Not Available'],
            ['label' => 'Website', 'value' => $socials['Website'] ?? 'Not Available', 'isLink' => !empty($socials['Website'])],
            ['label' => 'Facebook', 'value' => $socials['Facebook'] ?? 'Not Available', 'isLink' => !empty($socials['Facebook'])],
            ['label' => 'LinkedIn', 'value' => $socials['Instagram'] ?? 'Not Available', 'isLink' => !empty($socials['Instagram'])],
            ['label' => 'Average Income', 'value' => $record['Annual Income'] ?? 'Not Available'],
            ['label' => 'Opening Date', 'value' => $project['Start Year'] ?? $record['Organisation Founded Year'] ?? 'Not Available'],
            ['label' => 'Charity Link', 'value' => $record['Charity Registration Number'] ?? 'Not Registered'],
            ['label' => 'Registration', 'value' => $record['Social Enterprise Registration Number'] ?? 'Not Available'],
        ];

        $impactCards = [
            ['label' => 'Project Name', 'value' => $project['Name'] ?? 'Not Available'],
            ['label' => 'Provision Purpose', 'value' => $project['Purpose'] ?? 'Not Available'],
            ['label' => 'DICM Objectives', 'value' => $project['Key Objectives'] ?? 'Not Available'],
            ['label' => 'Support Required', 'value' => $project['Addition Resources Needed'] ?? 'Not Available'],
            ['label' => 'Impact', 'value' => $project['Collected Impact Data'] ?? 'Not Available'],
            ['label' => 'Current Sponsors', 'value' => $record['Current Sponsors'] ?? 'Not Available'],
        ];

        return [
            'organisation' => $organisation,
            'contactCards' => $contactCards,
            'contactTitle' => 'CSE Details',
            'impactCards'  => $impactCards,
            'impactTitle'  => 'Project Snapshot',
            'contact'      => [
                'name'  => $contact['Name'] ?? null,
                'email' => $contact['Email'] ?? null,
                'phone' => $contact['Phone'] ?? null,
            ],
            'raw'          => [
                'organisation_name' => $organisation['name'] ?? null,
                'registration'      => $organisation['registration'] ?? null,
                'address'           => $organisation['address'] ?? null,
                'regions'           => $organisation['regions'] ?? null,
                'website'           => $socials['Website'] ?? null,
                'contact_name'      => $contact['Name'] ?? null,
                'contact_email'     => $contact['Email'] ?? null,
                'contact_phone'     => $contact['Phone'] ?? null,
                'average_income'    => $record['Annual Income'] ?? null,
                'type'              => 'charity',
            ],
        ];
    }

    protected function mapSponsorRecord(?array $decoded): ?array
    {
        if (empty($decoded) || !isset($decoded[0])) {
            return null;
        }

        $record  = $decoded[0];
        $contact = $record['mc'] ?? [];
        $socials = $record['socials'] ?? [];

        $organisation = [
            'name'        => $record['Organisation Name'] ?? 'Sponsor',
            'regions'     => $record['Regions'] ?? 'Not Available',
            'address'     => $record['Address'] ?? 'Not Available',
            'registration'=> $record['Registration Number'] ?? 'Not Available',
            'logo'        => $socials['Logo'] ?? null,
        ];

        $contactCards = [
            ['label' => 'Contact Name', 'value' => $contact['Name'] ?? 'Not Available'],
            ['label' => 'Job Title', 'value' => $contact['Job Title'] ?? 'Not Available'],
            ['label' => 'Phone', 'value' => $contact['Phone'] ?? 'Not Available'],
            ['label' => 'Email', 'value' => $contact['Email'] ?? 'Not Available'],
            ['label' => 'Website', 'value' => $socials['Website'] ?? 'Not Available', 'isLink' => !empty($socials['Website'])],
            ['label' => 'Facebook', 'value' => $socials['Facebook'] ?? 'Not Available', 'isLink' => !empty($socials['Facebook'])],
            ['label' => 'Instagram', 'value' => $socials['Instagram'] ?? 'Not Available', 'isLink' => !empty($socials['Instagram'])],
            ['label' => 'LinkedIn', 'value' => $socials['LinkenIn'] ?? 'Not Available', 'isLink' => !empty($socials['LinkenIn'])],
            ['label' => 'VAT Number', 'value' => $record['Vat Number'] ?? 'Not Available'],
            ['label' => 'Referer', 'value' => $record['Referer'] ?? 'Not Available'],
        ];

        $impactCards = [
            ['label' => 'Regions', 'value' => $record['Regions'] ?? 'Not Available'],
            ['label' => 'Address', 'value' => $record['Address'] ?? 'Not Available'],
            ['label' => 'Registration', 'value' => $record['Registration Number'] ?? 'Not Available'],
            ['label' => 'Other Accounts', 'value' => $record['Other Accounts'] ?? 'Not Available'],
        ];

        return [
            'organisation' => $organisation,
            'contactCards' => $contactCards,
            'contactTitle' => 'Business Details',
            'impactCards'  => $impactCards,
            'impactTitle'  => 'Commercial Overview',
            'contact'      => [
                'name'  => $contact['Name'] ?? null,
                'email' => $contact['Email'] ?? null,
                'phone' => $contact['Phone'] ?? null,
            ],
            'raw'          => [
                'organisation_name' => $organisation['name'] ?? null,
                'registration'      => $organisation['registration'] ?? null,
                'address'           => $organisation['address'] ?? null,
                'regions'           => $organisation['regions'] ?? null,
                'website'           => $socials['Website'] ?? null,
                'contact_name'      => $contact['Name'] ?? null,
                'contact_email'     => $contact['Email'] ?? null,
                'contact_phone'     => $contact['Phone'] ?? null,
                'average_income'    => null,
                'vat_number'        => $record['Vat Number'] ?? null,
                'referer'           => $record['Referer'] ?? null,
                'type'              => 'sponsor',
            ],
        ];
    }

    protected function mapEnablerRecord(?array $decoded): ?array
    {
        if (empty($decoded) || !isset($decoded[0])) {
            return null;
        }

        $record   = $decoded[0];
        $contact  = $record['mc'] ?? [];
        $hmar     = $record['hmar'] ?? [];
        $hprm     = $record['hprm'] ?? [];

        $organisation = [
            'name'        => $record['Organisation Name'] ?? 'Enabler',
            'regions'     => $record['Regions'] ?? 'Not Available',
            'address'     => $contact['Organisation Address'] ?? 'Not Available',
            'registration'=> $record['Service Type'] ?? 'Not Available',
            'logo'        => null,
        ];

        $contactCards = [
            ['label' => 'Main Contact', 'value' => $contact['Name'] ?? 'Not Available'],
            ['label' => 'Job Title', 'value' => $contact['Job Title'] ?? 'Not Available'],
            ['label' => 'Phone', 'value' => $contact['Phone'] ?? 'Not Available'],
            ['label' => 'Email', 'value' => $contact['Email'] ?? 'Not Available'],
            ['label' => 'Service Type', 'value' => $record['Service Type'] ?? 'Not Available'],
            ['label' => 'Regions', 'value' => $record['Regions'] ?? 'Not Available'],
        ];

        $impactCards = [
            ['label' => 'HMAR Contact', 'value' => trim(($hmar['Name'] ?? '') . ' ' . ($hmar['Email'] ?? '')) ?: 'Not Available'],
            ['label' => 'HPRM Contact', 'value' => trim(($hprm['Name'] ?? '') . ' ' . ($hprm['Email'] ?? '')) ?: 'Not Available'],
            ['label' => 'Confirmation', 'value' => $contact['Confirmation'] ?? 'Not Available'],
        ];

        return [
            'organisation' => $organisation,
            'contactCards' => $contactCards,
            'contactTitle' => 'Enabler Details',
            'impactCards'  => $impactCards,
            'impactTitle'  => 'Engagement Overview',
            'contact'      => [
                'name'  => $contact['Name'] ?? null,
                'email' => $contact['Email'] ?? null,
                'phone' => $contact['Phone'] ?? null,
            ],
            'raw'          => [
                'organisation_name' => $organisation['name'] ?? null,
                'registration'      => $organisation['registration'] ?? null,
                'address'           => $organisation['address'] ?? null,
                'regions'           => $organisation['regions'] ?? null,
                'website'           => null,
                'contact_name'      => $contact['Name'] ?? null,
                'contact_email'     => $contact['Email'] ?? null,
                'contact_phone'     => $contact['Phone'] ?? null,
                'average_income'    => null,
                'service_type'      => $record['Service Type'] ?? null,
                'type'              => 'enabler',
            ],
        ];
    }

    protected function firstOrCreateProfile(int $userId, ?string $email, ?string $name, ?string $phone): array
    {
        if (!$this->profileTableAvailable()) {
            return [
                'user_id' => $userId,
                'display_name' => $name,
                'display_email' => $email,
                'phone_number' => $phone,
                'theme_pref' => 'light',
            ];
        }

        $existing = $this->profileModel->where('user_id', $userId)->first();
        if ($existing) {
            return $existing;
        }

        $profileId = $this->profileModel->insert([
            'user_id'       => $userId,
            'display_name'  => $name,
            'display_email' => $email,
            'phone_number'  => $phone,
            'theme_pref'    => 'light',
            'created_by'    => $userId,
        ]);

        return $this->profileModel->find($profileId);
    }

    public function createDelegate(int $parentUserId, string $parentType, string $parentEmail, string $inviteName, string $inviteEmail, int $createdBy): array
    {
        if (!$this->delegateTableAvailable()) {
            return ['success' => false, 'message' => 'Delegated access is not available yet.'];
        }

        $parentDomain = $this->extractDomain($parentEmail);
        $inviteDomain = $this->extractDomain($inviteEmail);

        if (!$parentDomain || $parentDomain !== $inviteDomain) {
            return ['success' => false, 'message' => 'Email domain must match the primary contact domain.'];
        }

        $existingActive = $this->delegateModel
            ->where('parent_user_id', $parentUserId)
            ->groupStart()
                ->where('invite_email', strtolower($inviteEmail))
                ->orWhere('invite_name', $inviteName)
            ->groupEnd()
            ->where('invite_status', 'active')
            ->first();

        if ($existingActive) {
            return ['success' => false, 'message' => 'This team member already has access.'];
        }

        $invite = $this->delegateModel
            ->where('parent_user_id', $parentUserId)
            ->where('invite_email', strtolower($inviteEmail))
            ->where('invite_status', 'pending')
            ->first();

        $username = $this->generateUniqueDelegateUsername($parentType);
        $expires  = date('Y-m-d H:i:s', strtotime('+30 days'));

        $this->db->transBegin();

        try {
            $childUserId = isset($invite['child_user_id']) ? (int) $invite['child_user_id'] : 0;
            if ($childUserId <= 0) {
                $childUserId = $this->createDelegateUserRecord($parentType);
            }

            if ($invite) {
                $delegateId = (int) $invite['delegate_id'];
                $this->delegateModel->update($delegateId, [
                    'invite_name'   => $inviteName,
                    'invite_status' => 'pending',
                    'invite_token'  => $username,
                    'expires_at'    => $expires,
                    'child_user_id' => $childUserId,
                ]);
            } else {
                $delegateId = $this->delegateModel->insert([
                    'parent_user_id' => $parentUserId,
                    'child_user_id'  => $childUserId,
                    'invite_email'   => strtolower($inviteEmail),
                    'invite_name'    => $inviteName,
                    'invite_status'  => 'pending',
                    'invite_token'   => $username,
                    'expires_at'     => $expires,
                    'created_by'     => $createdBy,
                ]);
            }

            $provision = $this->evaluate->provisionDelegateAccount($inviteName, $inviteEmail, $parentType, $username);
            if (($provision['success'] ?? false) !== true) {
                $this->db->transRollback();
                return ['success' => false, 'message' => $provision['message'] ?? 'Unable to create the delegate account.'];
            }

            $issuedUsername = (string) ($provision['username'] ?? '');
            $this->delegateModel->update($delegateId, [
                'invite_status' => 'active',
                'invite_token'  => $issuedUsername,
                'child_user_id' => $childUserId,
            ]);

            $this->db->transCommit();

            $successMessage = !empty($provision['existing'])
                ? 'Credentials refreshed and sent to the team member.'
                : 'Access granted successfully.';

            return [
                'success'  => true,
                'delegate' => [
                    'delegate_id' => $delegateId,
                    'invite_name' => $inviteName,
                    'invite_email'=> $inviteEmail,
                    'invite_status'=> 'active',
                    'created_at'  => date('c'),
                ],
                'message' => $successMessage,
            ];
        } catch (\Throwable $e) {
            $this->db->transRollback();
            log_message('error', '[ProfileService] Delegate creation failed: ' . $e->getMessage());
            return ['success' => false, 'message' => 'Unexpected error while creating delegate.'];
        }
    }

    protected function createDelegateUserRecord(string $parentType): int
    {
        $type = in_array($parentType, ['charity', 'sponsor', 'enabler'], true) ? $parentType : 'charity';
        $builder = $this->db->table('Users');
        $builder->insert([
            'user_type'      => $type,
            'u_status'       => 'approved',
            'date_submitted' => date('Y-m-d H:i:s'),
            'transferred'    => 0,
        ]);

        $insertId = (int) $this->db->insertID();
        if ($insertId <= 0) {
            throw new DatabaseException('Failed to create delegate user record.');
        }

        return $insertId;
    }

    protected function extractDomain(?string $email): ?string
    {
        if (!$email || strpos($email, '@') === false) {
            return null;
        }
        return strtolower(substr(strrchr($email, '@'), 1));
    }

    protected function generateUniqueDelegateUsername(string $type): string
    {
        $prefix = match ($type) {
            'sponsor' => 'BUS',
            'enabler' => 'BUY',
            default   => 'CSE',
        };

        $attempts = 0;
        do {
            $candidate = $prefix . random_int(100000000, 999999999);
            $exists = $this->pluginModel->getItem('Unique_Identifiers', ['unique_id' => $candidate]);
            if (!$exists) {
                return $candidate;
            }
            $attempts++;
        } while ($attempts < 5);

        return $prefix . time() . random_int(100, 999);
    }

    public function revokeDelegate(int $parentUserId, int $delegateId): array
    {
        if (!$this->delegateTableAvailable()) {
            return ['success' => false, 'message' => 'Delegated access is not available yet.'];
        }

        $delegate = $this->delegateModel->where('parent_user_id', $parentUserId)->find($delegateId);
        if (!$delegate) {
            return ['success' => false, 'message' => 'Delegate not found.'];
        }

        $this->delegateModel->update($delegateId, [
            'invite_status' => 'revoked',
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);

        return ['success' => true];
    }

    public function resendDelegate(int $parentUserId, int $delegateId): array
    {
        if (!$this->delegateTableAvailable()) {
            return ['success' => false, 'message' => 'Delegated access is not available yet.'];
        }

        $delegate = $this->delegateModel->where('parent_user_id', $parentUserId)->find($delegateId);
        if (!$delegate || ($delegate['invite_status'] ?? '') === 'revoked') {
            return ['success' => false, 'message' => 'Delegate not active.'];
        }

        $provision = $this->evaluate->provisionDelegateAccount(
            $delegate['invite_name'],
            $delegate['invite_email'],
            $this->pluginModel->getItem('Users', ['user_id' => $parentUserId])->user_type ?? 'charity'
        );

        if (($provision['success'] ?? false) !== true) {
            return ['success' => false, 'message' => 'Unable to resend credentials.'];
        }

        return ['success' => true];
    }

    public function submitUpdateRequest(int $userId, array $payload, int $createdBy): array
    {
        if (!$this->updateTableAvailable()) {
            return ['success' => false, 'message' => 'Profile update requests are not available yet.'];
        }

        $requestId = $this->updateModel->insert([
            'user_id'   => $userId,
            'payload'   => json_encode($payload),
            'status'    => 'pending',
            'created_by'=> $createdBy,
        ]);

        return [
            'success' => true,
            'request' => $this->updateModel->find($requestId),
        ];
    }

    protected function profileTableAvailable(): bool
    {
        if ($this->hasProfileTable === null) {
            $this->hasProfileTable = $this->db->tableExists('UserProfiles');
        }
        return $this->hasProfileTable;
    }

    protected function delegateTableAvailable(): bool
    {
        if ($this->hasDelegateTable === null) {
            $this->hasDelegateTable = $this->db->tableExists('UserDelegates');
        }
        return $this->hasDelegateTable;
    }

    protected function updateTableAvailable(): bool
    {
        if ($this->hasUpdateTable === null) {
            $this->hasUpdateTable = $this->db->tableExists('UserProfileUpdates');
        }
        return $this->hasUpdateTable;
    }
}
