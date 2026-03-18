<?php

if (!function_exists('redirectAfterLogin')) {
    function redirectAfterLogin()
    {
        $session = session();
        $redirectUrl = $session->get('redirect_url');

        if ($redirectUrl) {
            $session->remove('redirect_url');
            return redirect()->to($redirectUrl);
        }

        // Fallback to default by role
        $user = $session->get('user');
        $role = $user->role ?? '';

        if ($role === 'admin') {
            return redirect()->to('/admin');
        }

        return redirect()->to('/catalogue');
    }
}
