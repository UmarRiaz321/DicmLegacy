<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        $uri     = $request->uri;

        // Raw path e.g. "/Sir/allc" or "/Sir/sso/login"
        $rawPath = $uri->getPath();                 // keeps leading slash (or not, depending)
        $rawPath = '/' . ltrim($rawPath, '/');      // force single leading slash

        // Detect app base path from base_url() -> e.g. "/Sir/"
        $basePath = parse_url(base_url(), PHP_URL_PATH) ?? '/';
        $basePath = '/' . trim($basePath, '/') . '/';   // "/Sir/" or "/"

        // Convert to app-relative path (strip base prefix if present)
        $appPath = $rawPath;
        if ($basePath !== '//' && stripos($rawPath, $basePath) === 0) {
            $appPath = substr($rawPath, strlen($basePath) - 1); // keep leading "/"
        }

        // Normalize to no leading slash for comparisons and storage
        $appPathNoSlash = ltrim($appPath, '/');   // e.g. "allc" or "sso/login"

        // Routes that bypass auth (app-relative)
        $exclusions = [
            'login',
            'auth',
            'logout',
            'cpass',
            'sso/login',
            'sso/callback',
            'forgot',
            'reset', 
        ];

        // allow exclusions (exact or "starts with")
        foreach ($exclusions as $ex) {
            if ($appPathNoSlash === $ex || stripos($appPathNoSlash, $ex . '/') === 0) {
                return; // let through
            }
        }

        if ($session->get('loggedIn')) {
            return;
        }

        if ($request->isAJAX() || str_contains(strtolower($request->getHeaderLine('Accept')), 'application/json')) {
            return service('response')
                ->setStatusCode(401)
                ->setJSON([
                    'status'  => 'error',
                    'message' => 'Your session has ended. Please sign in again to continue.',
                ]);
        }

        // Use base_url() to build correct login URL under /Sir
        return redirect()->to(base_url('login'));
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // no-op
    }
}
