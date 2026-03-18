<?php

namespace App\Controllers;

use App\Libraries\OIDCClient;
use CodeIgniter\Controller;

class Oidc extends Controller
{
    // Step 1: kick off SSO
    public function login()
    {
        (new OIDCClient())->authenticate(); // redirects to your OIDC server
    }

    // Step 2: callback registered in oauth_clients.redirect_uris
    public function callback()
    {
        $oidc   = new OIDCClient();
        $idTok  = $oidc->getIdToken();
        $accTok = $oidc->getAccessToken();
        $claims = $oidc->getUserInfo();

        // Expect at least these (your OP issues them)
        if (empty($claims['sub']) || empty($claims['email'])) {
            log_message('error', 'SSO: Incomplete claims: ' . json_encode($claims));
            return redirect()->to('/login')->with('validation', 'Could not sign in via SSO.');
        }

        // Map to your current session shape
        // Your app expects: isAdmin, loggedIn, auth-token, user_type
        $isAdmin  = !empty($claims['is_admin']) ? (bool)$claims['is_admin'] : false;
        $fullName = $claims['name'] ?? $claims['preferred_username'] ?? $claims['email'];

        $session = session();
        $session->regenerate(true);

        $session->set([
            'isAdmin'     => $isAdmin,
            'loggedIn'    => true,
            'auth-token'  => $accTok ?? $idTok, // keep key name used by your app
            'user_type'   => $isAdmin ? 'admin' : 'user', // adjust if you carry roles in claims
            'oidc_sub'    => $claims['sub'],
            'oidc_email'  => $claims['email'],
            'oidc_name'   => $fullName,
            'id_token'    => $idTok,
            'access_token'=> $accTok,
            'oidc_claims' => $claims,
            'session_started_at' => time(),
            'last_activity'      => time(),
        ]);

        return redirect()->to('/'); // or your dashboard route
    }

    // Optional: single logout (local only, or call OP /logout if desired)
    public function logout()
    {
        session()->destroy();
        // If your OP supports post_logout_redirect_uri:
        // return redirect()->to('https://www169.lamp.le.ac.uk/api/logout?post_logout_redirect_uri=' . urlencode(base_url('/')));
        return redirect()->to('/login');
    }
}
