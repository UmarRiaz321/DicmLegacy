<?php

namespace App\Controllers;
use App\Models\PluginModel;
use App\Models\Password_model;
use App\Libraries\Email;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Login extends BaseController
{
    protected $session;

    function __construct()
	{
		$this->db = db_connect();
		$this->model = new PluginModel($this->db);
		$this->passmodel = new Password_model();
		$this->s_email = new Email();
        $this->client =  \Config\Services::curlrequest();
	}

    public function login()
    {
        $data = [
            'passwordToken' => session()->get('password_token'),
        ];

        // if SSO asked for password change
        if ($this->request->getGet('update') || session()->get('must_change_password')) {
            $data['update'] = 'checked';
        } else {
            $data['login']  = 'checked';
        }

        return view('login/login', $data);
    }
    public function updatePass(){
        $data['update'] = 'checked';
        $data['passwordToken'] = session()->get('password_token');
        return view('login/login',$data); 
    }
    public function ResetPass(){
        $data['reset'] = 'checked';
        return view('login/login',$data); 
    }
    public function logout(){
		session()->destroy();
		return redirect()->to('/login');
	}
    private function setUserSession($user){
        $isAdmin = ($user->role == 'admin') ? TRUE : FALSE;
        $newdata = [
            'isAdmin'   => $isAdmin,
            'loggedIn' => true,
            'auth-token' => $user->auth_token ?? null,
            'user_type' => $user->role,
            'session_started_at' => time(),
            'last_activity' => time(),
        ];
        $session = session();
        $session->regenerate(true);
        $session->set($newdata);
		return true;
	}

    protected function flash($key, $value)
	{
        $session = session();
		$session->setFlashdata($key, $value);
        $session->keepFlashdata($key); 
		return true;
	}

    public function auththenticate()
    {
        return redirect()->to('/SignIn');
    }


public function updatePassword()
{
    helper(['form', 'url']);
    $data = [];

    if ($this->request->getMethod() !== 'post') {
        return redirect()->to('/login');
    }

    $currentPassword     = (string) $this->request->getVar('cpass');
    $newPassword         = (string) $this->request->getVar('Npass');
    $confirmNewPassword  = (string) $this->request->getVar('CNpass');
    $formToken           = trim((string) $this->request->getVar('password_token'));

    // Local checks (you already have a model; keep using it)
    $validationResult = $this->passmodel->validatePassword($newPassword, $confirmNewPassword);
    if (!$validationResult['valid']) {
        $data['update'] = 'checked';
        $data['errors'] = $validationResult['error'];
        $data['passwordToken'] = $formToken ?: session()->get('password_token');
        return view('login/login', $data);
    }

    // Call IdP /password/change with Bearer access token
    $tokenForChange = $formToken ?: session()->get('password_token') ?? session()->get('access_token');
    if (!$tokenForChange) {
        $data['update'] = 'checked';
        $data['errors'] = 'We could not verify your session token. Please log in again.';
        $data['passwordToken'] = null;
        return view('login/login', $data);
    }

    $http = \Config\Services::curlrequest();
    $issuer = getenv('oidc.issuer') ?: 'https://www169.lamp.le.ac.uk/api';
    $url = rtrim($issuer, '/') . '/password/change';

    try {
        $headers = [
            'Accept'       => 'application/json',
            'Content-Type' => 'application/json',
        ];
        if ($accessToken = session()->get('access_token')) {
            $headers['Authorization'] = 'Bearer ' . $accessToken;
        }

        $res = $http->post($url, [
            'headers' => $headers,
            'body' => json_encode([
                'token'               => $tokenForChange,
                'current_password'    => $currentPassword,
                'new_password'        => $newPassword,
                'confirm_password'    => $confirmNewPassword,
            ]),
            'http_errors' => false,
            'timeout'     => 20,
        ]);
    } catch (\Throwable $e) {
        $data['update'] = 'checked';
        $data['errors'] = 'Request error: ' . $e->getMessage();
        $data['passwordToken'] = $tokenForChange;
        return view('login/login', $data);
    }

    $status = $res->getStatusCode();
    $body   = json_decode((string)$res->getBody(), true);

    if ($status !== 200 || empty($body['success'])) {
        $msg = $body['message'] ?? $body['error'] ?? 'Password update failed.';
        $data['update'] = 'checked';
        $data['errors'] = $msg;
        $data['passwordToken'] = $tokenForChange;
        return view('login/login', $data);
    }

    // Success: mark as logged in and clear flag
    session()->set([
        'loggedIn'             => true,
        'must_change_password' => false,
    ]);
    session()->remove('password_token');
    session()->setFlashdata('success', 'Password updated successfully.');

    return redirect()->to( base_url('catalogue') );
}

    
    // Helper function to format API errors clearly
    private function formatApiErrors($errors) {
        $errorMessages = [];
        foreach ($errors as $key => $value) {
            $errorMessages[] = ucfirst(str_replace('_', ' ', $key)) . ': ' . implode(', ', (array)$value);
        }
        return implode('<br>', $errorMessages);
    }
    

}
