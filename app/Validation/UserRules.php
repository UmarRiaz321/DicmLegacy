<?php
namespace App\Validation;

use Config\Services;

class UserRules
{
    protected $client;

    public function __construct()
    {
        $this->client = Services::curlrequest();
    }

    public function validateUser(string $str, string $fields, array $data)
    {
        $email = $data['email'] ?? null;
        $password = $data['password'] ?? null;

        if (!$email || !$password) {
            return false;
        }

        $issuer       = getenv('oidc.issuer')        ?: '';
        $clientId     = getenv('oidc.client_id')     ?: '';
        $clientSecret = getenv('oidc.client_secret') ?: '';
        $scope        = getenv('oidc.scope')         ?: 'openid email profile';
        $tokenUrl     = getenv('oidc.token_url')     ?: ($issuer ? rtrim($issuer, '/') . '/token' : '');

        if (!$tokenUrl || !$clientId || !$clientSecret) {
            log_message('error', 'OIDC credentials are not configured for user validation.');
            return false;
        }

        try {
            $response = $this->client->post($tokenUrl, [
                'headers'     => [
                    'Accept'        => 'application/json',
                    'Authorization' => 'Basic ' . base64_encode($clientId . ':' . $clientSecret),
                    'Connection'    => 'close',
                    'Expect'        => '',
                ],
                'form_params' => [
                    'grant_type' => 'password',
                    'username'   => $email,
                    'password'   => $password,
                    'scope'      => $scope,
                ],
                'http_errors'    => false,
                'timeout'        => 15,
                'connect_timeout'=> 5,
                'version'        => CURL_HTTP_VERSION_1_1,
            ]);
        } catch (\Throwable $e) {
            log_message('error', '[UserRules] OIDC token request failed: ' . $e->getMessage());
            return false;
        }

        if ($response->getStatusCode() !== 200) {
            return false;
        }

        $decoded = json_decode((string) $response->getBody(), true);
        return is_array($decoded) && !empty($decoded['access_token']);
    }
}
