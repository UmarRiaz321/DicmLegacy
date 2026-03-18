<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Sso extends Controller
{
    public function authenticate()
    {
        helper(['form','url']);

        if ($this->request->getMethod() !== 'post') {
            return redirect()->to('/login');
        }

        $throttler = service('throttler');
        $ipKey     = 'login-' . ($this->request->getIPAddress() ?? 'unknown');
        if (! $throttler->check($ipKey, 8, 60)) {
            log_message('warning', '[SSO] Login rate limit hit for ' . $ipKey);
            return $this->failLogin('Please wait a moment before retrying your login.');
        }

        $email = trim((string) $this->request->getVar('email'));
        $pass  = (string) $this->request->getVar('password');

        $rules = [
            'email'    => 'required|min_length[6]|max_length[100]|valid_email',
            'password' => 'required|min_length[8]|max_length[255]',
        ];
        if (! $this->validate($rules)) {
            return view('login/login', [
                'login'      => 'checked',
                'validation' => $this->validator,
            ]);
        }

        // ---- OIDC endpoints from .env (with sane defaults) ----
        $issuer       = getenv('oidc.issuer')        ?: 'https://auth-plugginecosystem.co.uk/';
        $clientId     = getenv('oidc.client_id')     ?: '';
        $clientSecret = getenv('oidc.client_secret') ?: '';
        $scope        = getenv('oidc.scope')         ?: 'openid email profile';
        $debug        = filter_var(getenv('oidc.debug') ?: false, FILTER_VALIDATE_BOOL);

        $tokenUrl    = getenv('oidc.token_url')    ?: rtrim($issuer, '/') . '/token';
        $userinfoUrl = getenv('oidc.userinfo_url') ?: rtrim($issuer, '/') . '/userinfo';

        $http  = \Config\Services::curlrequest();
        $basic = 'Basic ' . base64_encode($clientId . ':' . $clientSecret);

        // ---- 1) Password grant ----
        try {
            $tokenRes = $http->post($tokenUrl, [
                'headers'     => [
                    'Accept'        => 'application/json',
                    'Authorization' => $basic,          // client auth via Basic
                    'Connection'    => 'close',
                    'Expect'        => '',              // avoid 100-continue
                ],
                'form_params' => [
                    'grant_type' => 'password',
                    'username'   => $email,
                    'password'   => $pass,
                    'scope'      => $scope,
                ],
                'http_errors'    => false,
                'timeout'        => 20,
                'connect_timeout'=> 5,
                'version'        => CURL_HTTP_VERSION_1_1, // avoid h2 quirks
            ]);
        } catch (\Throwable $e) {
            log_message('error', '[SSO] token request failed: {m}', ['m' => $e->getMessage()]);
            return $this->failLogin('Login failed. Please try again.');
        }

        $status = $tokenRes->getStatusCode();
        $body   = (string) $tokenRes->getBody();
        if ($debug) {
            log_message('debug', '[SSO] token status={status} length={len}', [
                'status' => $status,
                'len'    => strlen($body),
            ]);
        }

        if ($status !== 200) {
            $err = @json_decode($body, true);
            $msg = $err['message'] ?? $err['error_description'] ?? $err['error'] ?? 'unknown';
            log_message('error', '[SSO] token error: {m}', ['m' => $msg]);
            return $this->failLogin('Invalid email or password.');
        }

        $tokens = json_decode($body, true);
        if (!is_array($tokens) || empty($tokens['access_token'])) {
            log_message('error', '[SSO] token parse error (bytes={len})', ['len' => strlen($body)]);
            return $this->failLogin('Authentication failed (invalid token).');
        }

        // ---- 2) /userinfo: try GET first ----
        $claims = null;
        try {
            $userRes = $http->get($userinfoUrl, [
                'headers'        => [
                    'Authorization' => 'Bearer '.$tokens['access_token'],
                    'Accept'        => 'application/json',
                    'Connection'    => 'close',
                    'Expect'        => '',
                ],
                'http_errors'    => false,
                'timeout'        => 20,
                'connect_timeout'=> 5,
                'version'        => CURL_HTTP_VERSION_1_1,
            ]);

            if ($userRes->getStatusCode() === 200) {
                $uBody = (string) $userRes->getBody();
                if (strlen($uBody) > 0) {
                    $claims = json_decode($uBody, true);
                }
            }
        } catch (\Throwable $e) {
            // swallow; we’ll retry with POST
            if ($debug) log_message('error', '[SSO] userinfo GET failed: {m}', ['m' => $e->getMessage()]);
        }

        // ---- 2b) Retry with POST if GET failed/empty ----
        if (!$claims || !is_array($claims)) {
            try {
                $userRes = $http->post($userinfoUrl, [
                    'headers'        => [
                        'Authorization' => 'Bearer '.$tokens['access_token'],
                        'Accept'        => 'application/json',
                        'Connection'    => 'close',
                        'Expect'        => '',
                        'Content-Length'=> '0', // explicit empty body
                    ],
                    'body'           => '',   // no form params; truly empty POST
                    'http_errors'    => false,
                    'timeout'        => 20,
                    'connect_timeout'=> 5,
                    'version'        => CURL_HTTP_VERSION_1_1,
                ]);

                if ($userRes->getStatusCode() === 200) {
                    $uBody = (string) $userRes->getBody();
                    if (strlen($uBody) > 0) {
                        $claims = json_decode($uBody, true);
                    }
                } else {
                    if ($debug) {
                        log_message('debug', '[SSO] userinfo POST status={status}', [
                            'status' => $userRes->getStatusCode(),
                        ]);
                    }
                }
            } catch (\Throwable $e) {
                // This is where you’re seeing “Empty reply from server” (CURLE_RECV_ERROR 52)
                log_message('error', '[SSO] userinfo POST failed: {m}', ['m' => $e->getMessage()]);
            }
        }

        // ---- 2c) FINAL fallback: decode ID Token if available ----
        if ((!$claims || !is_array($claims)) && !empty($tokens['id_token'])) {
            $claims = $this->decodeIdTokenClaims($tokens['id_token']); // no signature verify here
            if ($claims) {
                log_message('warning', '[SSO] using ID Token claims as fallback (userinfo unreachable).');
            }
        }

        if (!$claims || empty($claims['sub']) || empty($claims['email'])) {
            return $this->failLogin('Authentication failed (userinfo).');
        }

        // ---- 3) Normalize role/admin for your nav ----
        $userType = $claims['user_type'] ?? ($claims['role'] ?? null);
        if (is_string($userType)) $userType = strtolower($userType);

        $isAdmin = false;
        if (array_key_exists('is_admin', $claims)) {
            $raw = $claims['is_admin'];
            $isAdmin = is_bool($raw) ? $raw
                   : (is_numeric($raw) ? ((int)$raw === 1)
                   : in_array(strtolower((string)$raw), ['1','true','yes'], true));
        } elseif ($userType) {
            $isAdmin = ($userType === 'admin');
        }

        $mustChange = !empty($claims['must_change_password']);

        // ---- 4) Set session ----
        $passwordToken = $claims['password_token'] ?? $tokens['password_token'] ?? null;
        if ($mustChange && !$passwordToken && !empty($claims['email'])) {
            $passwordToken = $this->requestPasswordToken($claims['email']);
        }

        $session = session();
        $session->regenerate(true);

        $session->set([
            'loggedIn'      => true,
            'isAdmin'       => (bool) $isAdmin,
            'user_type'     => $userType,
            'user_email'    => $claims['email'] ?? null,
            'user_name'     => $claims['name']  ?? null,
            'user_sub'      => $claims['sub']   ?? null,
            'must_change_password' => (bool)$mustChange,
            'auth-token'    => $tokens['access_token'] ?? null,
            'access_token'  => $tokens['access_token'],
            'id_token'      => $tokens['id_token']      ?? null,
            'refresh_token' => $tokens['refresh_token'] ?? null,
            'password_token'=> $passwordToken,
            'token_expires' => isset($tokens['expires_in']) ? (time() + (int)$tokens['expires_in']) : null,
            'session_started_at' => time(),
            'last_activity'      => time(),
        ]);

        if ($mustChange) {
            // Don’t mark as fully logged-in yet; show update tab
            return redirect()->to('/login?update=1');
        }   

        // ---- 5) Always start fresh after login ----
        $redirectTo = 'catalogue';

        // IMPORTANT: build an app-absolute URL (respects /Sir baseURL)
        session()->setFlashdata('success', 'Login Successfully');

        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'status'   => 'success',
                'redirect' => base_url($redirectTo),
            ]);
        }

        return redirect()->to(base_url($redirectTo));

    }

    protected function requestPasswordToken(string $email): ?string
    {
        $issuer = getenv('oidc.issuer') ?: 'https://auth-plugginecosystem.co.uk/';
        $url    = rtrim($issuer, '/') . '/password/request';
        $http   = \Config\Services::curlrequest();

        try {
            $res = $http->post($url, [
                'headers'     => ['Accept' => 'application/json'],
                'json'        => ['email' => $email],
                'timeout'     => 15,
                'http_errors' => false,
            ]);
        } catch (\Throwable $e) {
            log_message('error', '[SSO] password token request failed: {m}', ['m' => $e->getMessage()]);
            return null;
        }

        $status = $res->getStatusCode();
        if ($status !== 200) {
            log_message('error', '[SSO] password token request HTTP {status}', ['status' => $status]);
            return null;
        }

        $body = json_decode((string) $res->getBody(), true);
        return $body['reset_token'] ?? null;
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }

    private function failLogin(string $message)
    {
        if ($this->request->isAJAX()) {
            return $this->response->setStatusCode(400)->setJSON([
                'status'  => 'error',
                'message' => $message,
            ]);
        }

        return view('login/login', [
            'login'      => 'checked',
            'validation' => $message,
        ]);
    }
private function normalizeRedirect(?string $path): string
{
    // Default landing inside the app
    $fallback = 'catalogue';

    if (!$path || !is_string($path)) {
        return $fallback;
    }

    // If a full URL was stored, keep only the path
    $p = parse_url($path, PHP_URL_PATH) ?? '';
    if ($p === '' || $p === '/') {
        return $fallback;
    }

    // Strip the app's base path (/Sir/) if it sneaked in
    $basePath = parse_url(base_url(), PHP_URL_PATH) ?? '/';
    $basePath = '/' . trim($basePath, '/') . '/';       // "/Sir/" or "/"
    if ($basePath !== '//' && stripos($p, $basePath) === 0) {
        $p = '/' . ltrim(substr($p, strlen($basePath)), '/'); // "/allc"
    }

    // Collapse /allc to home
    if (preg_match('#^/allc(?:$|/|\?)#i', $p)) {
        return ''; // base_url('') => https://…/Sir/
    }

    // Block redirects into the IdP/API namespace
    if (preg_match('#^/api(?:/|$)#i', $p)) {
        return $fallback;
    }

    // Return app-relative path (no leading slash for base_url())
    return ltrim($p, '/');
}



    /** Minimal, no-verify ID Token decoder (fallback only) */
    private function decodeIdTokenClaims(?string $jwt): ?array
    {
        if (!$jwt || strpos($jwt, '.') === false) return null;
        $parts = explode('.', $jwt);
        if (count($parts) < 2) return null;
        $payload = $parts[1];
        $payload .= str_repeat('=', (4 - strlen($payload) % 4) % 4); // pad
        $json = base64_decode(strtr($payload, '-_', '+/'));
        $arr = json_decode($json, true);
        return is_array($arr) ? $arr : null;
    }
}
