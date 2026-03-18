<?php

namespace App\Controllers;

use App\Services\ProfileService;
use CodeIgniter\HTTP\ResponseInterface;

class Profile extends BaseController
{
    protected ProfileService $profileService;

    public function __construct()
    {
        parent::setProtected(true);
        $this->profileService = new ProfileService();
    }

    public function index()
    {
        $uniqueId = session()->get('user_sub');
        if (!$uniqueId) {
            session()->setFlashdata('error', 'Unable to determine your profile. Please sign in again.');
            return redirect()->route('/');
        }

        $payload = $this->profileService->buildProfileData($uniqueId);
        if (($payload['success'] ?? false) !== true) {
            session()->setFlashdata('error', 'We could not load your profile details.');
            return redirect()->route('/');
        }

        $viewData = $payload['data'];
        $viewData['primaryEmail'] = session()->get('user_email') ?? session()->get('email');

        return view('profile/dashboard', $viewData);
    }

    public function createDelegate(): ResponseInterface
    {
        if ($this->request->getMethod() !== 'post') {
            return $this->response->setStatusCode(405);
        }

        $validation = service('validation');
        $validation->setRules([
            'delegate_name'  => 'required|min_length[3]|max_length[190]',
            'delegate_email' => 'required|valid_email|max_length[190]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON([
                'success' => false,
                'status'  => 422,
                'message' => 'Please check the form for errors.',
                'errors'  => $validation->getErrors(),
            ]);
        }

        $uniqueId = session()->get('user_sub');
        $context  = $this->profileService->buildProfileData($uniqueId);
        if (($context['success'] ?? false) !== true) {
            return $this->response->setJSON([
                'success' => false,
                'status'  => 400,
                'message' => 'Unable to load profile context.',
            ]);
        }

        $data = $context['data'];
        $result = $this->profileService->createDelegate(
            (int) $data['userId'],
            (string) $data['userType'],
            (string) ($data['profile']['display_email'] ?? session()->get('email') ?? ''),
            (string) $this->request->getPost('delegate_name'),
            (string) $this->request->getPost('delegate_email'),
            (int) $data['userId']
        );

        if (($result['success'] ?? false) !== true) {
            return $this->response->setJSON([
                'success' => false,
                'status'  => 400,
                'message' => $result['message'] ?? 'Unable to create delegate.',
            ]);
        }

        return $this->response->setJSON([
            'success'  => true,
            'delegate' => $result['delegate'],
            'message'  => 'Access granted successfully.',
        ]);
    }

    public function revokeDelegate(): ResponseInterface
    {
        if ($this->request->getMethod() !== 'post') {
            return $this->response->setStatusCode(405);
        }

        $delegateId = (int) $this->request->getPost('delegate_id');
        if ($delegateId <= 0) {
            return $this->response->setJSON(['success' => false, 'message' => 'Invalid delegate.'])
                ->setStatusCode(422);
        }

        $context = $this->profileService->buildProfileData(session()->get('user_sub'));
        if (($context['success'] ?? false) !== true) {
            return $this->response->setJSON(['success' => false, 'message' => 'Unable to load profile context.'])
                ->setStatusCode(400);
        }

        $result = $this->profileService->revokeDelegate((int) $context['data']['userId'], $delegateId);
        $status = ($result['success'] ?? false) ? 200 : 400;

        return $this->response->setJSON($result)->setStatusCode($status);
    }

    public function resendDelegate(): ResponseInterface
    {
        if ($this->request->getMethod() !== 'post') {
            return $this->response->setStatusCode(405);
        }

        $delegateId = (int) $this->request->getPost('delegate_id');
        if ($delegateId <= 0) {
            return $this->response->setJSON(['success' => false, 'message' => 'Invalid delegate.'])
                ->setStatusCode(422);
        }

        $context = $this->profileService->buildProfileData(session()->get('user_sub'));
        if (($context['success'] ?? false) !== true) {
            return $this->response->setJSON(['success' => false, 'message' => 'Unable to load profile context.'])
                ->setStatusCode(400);
        }

        $result = $this->profileService->resendDelegate((int) $context['data']['userId'], $delegateId);
        $status = ($result['success'] ?? false) ? 200 : 400;

        return $this->response->setJSON($result)->setStatusCode($status);
    }

    public function submitUpdateRequest(): ResponseInterface
    {
        if ($this->request->getMethod() !== 'post') {
            return $this->response->setStatusCode(405);
        }

        $validation = service('validation');
        $validation->setRules([
            'organisation_name' => 'required|min_length[3]|max_length[255]',
            'contact_email'     => 'required|valid_email|max_length[255]',
            'contact_phone'     => 'permit_empty|max_length[80]',
            'regions'           => 'permit_empty|max_length[500]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Please check the form for errors.',
                'errors'  => $validation->getErrors(),
            ])->setStatusCode(422);
        }

        $payload = $this->request->getPost();
        $context = $this->profileService->buildProfileData(session()->get('user_sub'));
        if (($context['success'] ?? false) !== true) {
            return $this->response->setJSON(['success' => false, 'message' => 'Unable to load profile context.'])
                ->setStatusCode(400);
        }

        $result = $this->profileService->submitUpdateRequest(
            (int) $context['data']['userId'],
            $payload,
            (int) $context['data']['userId']
        );

        return $this->response->setJSON($result);
    }
}
