<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Password extends Controller
{
    /** Show the “enter your email” reset request form on the existing login page (tab 3). */
    public function requestForm()
    {
        // Reuse login view, open the "Forgot Password?" tab.
        return view('login/login', [
            'reset' => 'checked',
            // no token present -> email request mode
        ]);
    }

    /** Handle POST /forgot -> call IdP /password/request */
public function request()
{
    helper(['form','url']);

    if ($this->request->getMethod() !== 'post') {
        return redirect()->to('/forgot');
    }

    $throttler = service('throttler');
    $ipKey     = 'forgot-' . ($this->request->getIPAddress() ?? 'unknown');
    if (! $throttler->check($ipKey, 5, 300)) {
        log_message('warning', '[Forgot] rate limit hit for ' . $ipKey);
        return view('login/login', ['reset' => 'checked', 'status' => 'If that email exists, you will receive a reset link shortly.']);
    }

    $email = trim((string)$this->request->getVar('email'));

    if (! $this->validate(['email' => 'required|valid_email'])) {
        return view('login/login', ['reset' => 'checked', 'errors' => 'Please enter a valid email.']);
    }

    $issuer      = getenv('oidc.issuer') ?: 'https://auth-plugginecosystem.co.uk/api';
    $requestUrl  = rtrim($issuer, '/') . '/password/request';

    $http = \Config\Services::curlrequest();

    try {
        $res = $http->post($requestUrl, [
            'headers'     => ['Accept' => 'application/json'],
            'json'        => ['email' => $email],
            'http_errors' => false,
            'timeout'     => 15,
        ]);
    } catch (\Throwable $e) {
        log_message('error', '[Forgot] request error: {m}', ['m' => $e->getMessage()]);
        return view('login/login', ['reset' => 'checked', 'errors' => 'Could not reach reset service. Try again.']);
    }

    $status = $res->getStatusCode();
    $body   = (string)$res->getBody();
    $data   = @json_decode($body, true) ?: [];

    // Always show neutral message to user
    $userMsg = 'If that email exists, you will receive a reset link shortly.';

    if ($status === 200 && !empty($data['issued']) && !empty($data['reset_token'])) {
        // Build link to CI /reset with token
        $resetLink = base_url('reset') . '?token=' . rawurlencode($data['reset_token']);

        // after a successful 200 from /password/request and you have:
        $resetLink = base_url('reset') . '?token=' . rawurlencode($data['reset_token']);

        // Derive a friendly name from the email if you don’t have a real name yet
        $name = strstr($email, '@', true) ?: 'there';

        // Send via CI Email service using your dev config
        try {
            $emailer = new \App\Libraries\Email();
            $sent = $emailer->sendAccessLink($email, $name, $resetLink);
            if (! $sent) {
                log_message('error', '[Forgot] sendAccessLink() returned false for ' . $email);
            }
        } catch (\Throwable $e) {
            log_message('error', '[Forgot] sendAccessLink() threw: ' . $e->getMessage());
        }
    }

    return view('login/login', ['reset' => 'checked', 'status' => $userMsg]);
}


    /** Show password reset form if token present/valid-ish */
    public function resetForm()
    {
        $token = (string)($this->request->getGet('token') ?? '');

        if ($token === '') {
            // No token — send back to request form
            return redirect()->to('/forgot')->with('error', 'Invalid or missing reset link.');
        }

        // We render the same login view, tab 3, but now with token present -> show new password fields.
        return view('login/login', [
            'reset'      => 'checked',
            'resetToken' => $token,
        ]);
    }

    /** Handle POST /reset -> call IdP /password/change */
    public function resetSubmit()
    {
        helper(['form','url']);

        if ($this->request->getMethod() !== 'post') {
            return redirect()->to('/forgot');
        }

        $throttler = service('throttler');
        $ipKey     = 'reset-' . ($this->request->getIPAddress() ?? 'unknown');
        if (! $throttler->check($ipKey, 5, 300)) {
            log_message('warning', '[Reset] rate limit hit for ' . $ipKey);
            return view('login/login', [
                'reset'      => 'checked',
                'resetToken' => $this->request->getVar('token'),
                'errors'     => 'Please wait a moment before retrying.',
            ]);
        }

        $token    = trim((string)$this->request->getVar('token'));
        $pass     = trim((string)$this->request->getVar('password'));
        $passConf = trim((string)$this->request->getVar('password_confirm'));

        if ($token === '') {
            return redirect()->to('/forgot')->with('error', 'Invalid or missing reset link.');
        }

        // Local validation (mirror your UI rules)
        $rules = [
            'password'         => 'required|min_length[8]|max_length[255]',
            'password_confirm' => 'required|matches[password]',
        ];
        if (! $this->validate($rules)) {
            return view('login/login', [
                'reset'      => 'checked',
                'resetToken' => $token,
                'errors'     => 'Password requirements not met or confirmation mismatch.',
            ]);
        }

        $changeUrl = 'https://auth-plugginecosystem.co.uk/password/change';
        if (! $changeUrl) {
            $issuer    = getenv('oidc.issuer') ?: '';
            $changeUrl = rtrim($issuer, '/') . '/password/change';
        }

        $http    = \Config\Services::curlrequest();
        $payload = [
            'token'                 => $token,
            'new_password'          => $pass,
            'confirm_password'      => $passConf,
        ];

        try {
            $res = $http->post($changeUrl, [
                'headers' => [
                    'Accept'       => 'application/json',
                    'Content-Type' => 'application/json',
                ],
                'body'        => json_encode($payload),
                'http_errors' => false,
                'timeout'     => 15,
            ]);
        } catch (\Throwable $e) {
            log_message('error', '[Reset] change request error: {m}', ['m' => $e->getMessage()]);
            return view('login/login', [
                'reset'      => 'checked',
                'resetToken' => $token,
                'errors'     => 'Could not reach reset service. Please try again.',
            ]);
        }

        $status = $res->getStatusCode();
        $body   = (string) $res->getBody();
        $data   = json_decode($body, true) ?: [];

        if ($status !== 200 || (isset($data['success']) && $data['success'] !== true)) {
            $message = $data['message'] ?? $data['error'] ?? 'Reset link is invalid or expired.';
            log_message('error', '[Reset] server responded {status}', ['status' => $status]);
            return view('login/login', [
                'reset'      => 'checked',
                'resetToken' => $token,
                'errors'     => $message,
            ]);
        }

        return redirect()->to('/login')->with('success', 'Password updated successfully. Please sign in.');
    }
}
