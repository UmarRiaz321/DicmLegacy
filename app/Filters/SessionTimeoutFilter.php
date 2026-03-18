<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class SessionTimeoutFilter implements FilterInterface
{
    protected int $idleLimit;
    protected int $absoluteLimit;

    public function __construct()
    {
        $config = config('App');
        $idle   = (int) ($config->sessionIdleTimeout ?? 1200);
        $abs    = (int) ($config->sessionAbsoluteTimeout ?? 28800);

        // Minimums to avoid misconfiguration
        $this->idleLimit     = max(300, $idle);
        $this->absoluteLimit = max($this->idleLimit, $abs);
    }

    public function before(RequestInterface $request, $arguments = null)
    {
        if (is_cli()) {
            return;
        }

        $session = session();

        if (! $session->get('loggedIn')) {
            return;
        }

        $now          = time();
        $lastActivity = (int) ($session->get('last_activity') ?? 0);
        $startedAt    = (int) ($session->get('session_started_at') ?? 0);

        if ($startedAt === 0) {
            $session->set('session_started_at', $now);
            $startedAt = $now;
        }

        if ($lastActivity === 0) {
            $session->set('last_activity', $now);
            return;
        }

        if (($now - $lastActivity) > $this->idleLimit) {
            return $this->expireSession($request, 'For security, your session ended after 24 hours of inactivity.');
        }

        if (($now - $startedAt) > $this->absoluteLimit) {
            return $this->expireSession($request, 'For security, your session exceeded the maximum allowed duration. Please sign in again.');
        }

        $session->set('last_activity', $now);
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // no-op
    }

    protected function expireSession(RequestInterface $request, string $message)
    {
        $session = session();
        $session->regenerate(true);
        $session->set([
            'loggedIn'  => false,
            'isAdmin'   => false,
        ]);
        $session->setFlashdata('error', $message);

        log_message('info', '[SessionTimeout] ' . $message . ' ip=' . $request->getIPAddress());

        if ($request->isAJAX() || str_contains(strtolower($request->getHeaderLine('Accept')), 'application/json')) {
            return service('response')
                ->setStatusCode(440)
                ->setJSON([
                    'status'  => 'error',
                    'message' => $message,
                ]);
        }

        return redirect()->to(base_url('login'));
    }
}
