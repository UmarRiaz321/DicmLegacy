<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;
    private bool $isProtected = false;
	private bool $isAdmin = false;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    protected $session;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        $this->session = \Config\Services::session();

        if (! is_cli() && $request->getMethod() !== 'get') {
            $tokenName   = csrf_token();
            $hasBodyTok  = $request->getPost($tokenName) !== null;
            $hasHeader   = (bool) $request->getHeaderLine('X-CSRF-TOKEN');

            log_message(
                'debug',
                'CSRF check active | method=' . strtoupper($request->getMethod()) .
                ' | token_name=' . $tokenName .
                ' | body_token_present=' . ($hasBodyTok ? 'yes' : 'no') .
                ' | header_token_present=' . ($hasHeader ? 'yes' : 'no')
            );
        }
    }
    protected function setProtected(bool $protected)
	{
		$this->isProtected = $protected;
	}
    protected function setIsAdmin(bool $isAdmin)
	{
		$this->isAdmin = $isAdmin;
	}
}
