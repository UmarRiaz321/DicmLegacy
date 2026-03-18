<?php

namespace App\Libraries;

use Jumbojett\OpenIDConnectClient;

class OIDCClient
{
    private OpenIDConnectClient $oidc;

// app/Libraries/OIDCClient.php
    public function __construct()
    {
        $issuer       = 'https://www169.lamp.le.ac.uk/api';
        $clientId     = 'cli_97a21de910ae71a5';
        $clientSecret = '3672160fcb2069ced9aa034779ba1ac5a6fe1f15e3acf2b68df94d5bc45e97f6';
        $redirectUri  = base_url('sso/callback');

        $this->oidc = new \Jumbojett\OpenIDConnectClient($issuer, $clientId, $clientSecret);
        $this->oidc->providerConfigParam([
            'authorization_endpoint' => $issuer . '/authorize',
            'token_endpoint'         => $issuer . '/token',
            'userinfo_endpoint'      => $issuer . '/userinfo',
        ]);
        $this->oidc->addScope(['openid','email','profile']);
        $this->oidc->setRedirectURL($redirectUri);
        $this->oidc->setResponseTypes(['code']);
        $this->oidc->setAllowUnsafeSSL(false);
    }
    /** Starts/continues the OIDC flow (handles redirects & code exchange). */
    public function authenticate(): void
    {
        $this->oidc->authenticate(); // throws on failure
    }

    public function getIdToken(): ?string
    {
        return $this->oidc->getIdToken();
    }

    public function getAccessToken(): ?string
    {
        return $this->oidc->getAccessToken();
    }

    /** Returns /userinfo as an associative array. */
    public function getUserInfo(): array
    {
        return (array) $this->oidc->requestUserInfo();
    }

    /** Optional RP-initiated logout (if your IdP supports it). */
    public function signOut(?string $postLogoutRedirectUri = null): void
    {
        if ($postLogoutRedirectUri && method_exists($this->oidc, 'signOut')) {
            $this->oidc->signOut($postLogoutRedirectUri);
        }
    }
}
