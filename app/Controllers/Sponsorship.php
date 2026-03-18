<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\SponsorshipModel;
use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Config\Services;
use App\Libraries\Email as EmailLibrary;
use App\Libraries\SponsorshipContractPdf;

class Sponsorship extends BaseController
{
    use ResponseTrait;

    protected $session;
    protected $db;
    protected $sponsorshipModel;
    protected $client;
    protected $userModel;
    protected $emailLibrary;
    protected $contractPdf;
    protected array $adminRecipients = [
        ['name' => 'Jay Baughan', 'email' => 'jay.baughan@pluggin.org'],
        ['name' => 'Umar Riaz', 'email' => 'umar.riaz@pluggin.org'],
    ];

    public function __construct()
    {
        parent::setProtected(true);
        $this->session = Services::session();
        $this->db = db_connect();
        $this->client = \Config\Services::curlrequest();

        // Ensure the user is logged in
        if (!$this->session->get('loggedIn')) {
            $this->session->setFlashdata('error', 'You need to be logged in before sponsoring a charity.');
            return redirect()->back();
        }

        $this->sponsorshipModel = new SponsorshipModel($this->db);
        $this->userModel = new UserModel($this->db);
        $this->emailLibrary = new EmailLibrary();
        $this->contractPdf = new SponsorshipContractPdf();
    }

    /**
     * Display the sponsorship form with necessary data.
     */
    public function index()
    {
        $projectParam = $this->request->getGet('project');
        $legacyParam = $this->request->getGet('id');

        $projectId = $this->decodeIdentifier($projectParam);
        $charityId = $this->decodeIdentifier($legacyParam);

        if ($projectId !== null) {
            $charityDetails = $this->sponsorshipModel->getCharityAndProjectDetails(0, $projectId);
        } elseif ($charityId !== null) {
            $charityDetails = $this->sponsorshipModel->getCharityAndProjectDetails($charityId);
            $projectId = $charityDetails['project_id'] ?? null;
        } else {
            $this->session->setFlashdata('error', 'Invalid project selected.');
            return redirect()->back();
        }

        if (!$charityDetails || !$projectId) {
            $this->session->setFlashdata('error', 'Unable to locate the requested project.');
            return redirect()->back();
        }
    
        //Fetch sponsor details
        $sponsorUsername = $this->session->get('user_sub');
        $name = $this->session->get('user_name');
        $email = $this->session->get('user_email');

        $organisationName = null;
        if (!empty($sponsorUsername)) {
            $sponsorUserId = $this->userModel->getUserIdByUniqueId($sponsorUsername);
            if ($sponsorUserId) {
                $organisationName = $this->sponsorshipModel->getSponsorOrganisationNameByUserId($sponsorUserId);
            }
        }

        // Prepare data for the view
        $data = [
            'charity_id' => $charityDetails['charity_id'],
            'project_token' => base64_encode((string) $projectId),
            'charity_name' => $charityDetails['charity_name'], 
            'charity_username' => $charityDetails['charity_unique_id'],
            'registered_no' => $charityDetails['registered_no'],
            'project_name' => $charityDetails['project_name'],
            'project_purpose' => $charityDetails['project_purpose'],
            'key_objectives' => $charityDetails['key_objectives'],
            'required_sponsorship' => $charityDetails['required_sponsorship'],
            'additional_resources' => $charityDetails['additional_resources'],
            'sponsor_username' => $sponsorUsername,
            'sponsor_name' => $organisationName ?? $name,
            'sponsor_email' => $email,
        ];

        return view('sponsorship/sponsorme', $data);
    }
    

    /**
     * Handle sponsorship form submission.
     */
    public function create()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Invalid request method.']);
        }

        if (!$this->session->get('loggedIn')) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'You must be logged in to submit a sponsorship proposal.']);
        }

        // Validate input fields
        $validation = \Config\Services::validation();
        $validation->setRules([
            'charity_id' => 'required|integer',
            'project_id' => 'required',
            'charity_name' => 'required|string|max_length[500]',
            'sponsor_username' => 'required|string|max_length[500]',
            'sponsor_name' => 'required|string|max_length[500]',
            'project_name' => 'required|string|max_length[500]',
            'project_purpose' => 'required|string',
            'key_objectives' => 'required|string',
            'required_sponsorship' => 'required|decimal',
            'sponsorship_offer' => 'required|decimal',
            'monitory_value' => 'required|decimal',
            'goods_value' => 'required|decimal',
            'volunteering_value' => 'required|decimal',
            'sponsor_email' => 'required|valid_email',
            'additional_resources' => 'required|string',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Validation failed.', 'errors' => $validation->getErrors()]);
        }

        // Prepare and validate sponsorship breakdown
        $monetary = number_format((float) $this->request->getPost('monitory_value'), 2, '.', '');
        $goods = number_format((float) $this->request->getPost('goods_value'), 2, '.', '');
        $volunteering = number_format((float) $this->request->getPost('volunteering_value'), 2, '.', '');
        $totalOffer = number_format((float) $this->request->getPost('sponsorship_offer'), 2, '.', '');

        if ($monetary + $goods + $volunteering != $totalOffer) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'The sponsorship offer must equal the sum of monetary, goods, and volunteering values.']);
        }

        $projectId = $this->decodeIdentifier($this->request->getPost('project_id'));
        $charityId = (int) $this->request->getPost('charity_id');

        if ($projectId === null || empty($charityId)) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Invalid project reference.']);
        }

        $charityDetails = $this->sponsorshipModel->getCharityAndProjectDetails($charityId, $projectId);
        if (!$charityDetails) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Unable to verify the selected project.']);
        }

        // Prepare data for insertion additional_resources
        $data = [
            'additional_resources' => $charityDetails['additional_resources'],
            'charity_id' => $charityDetails['charity_id'],
            'charity_name' => $charityDetails['charity_name'],
            'sponsor_username' => $this->request->getPost('sponsor_username'),
            'sponsor_name' => $this->request->getPost('sponsor_name'),
            'sponsor_email' => $this->request->getPost('sponsor_email'),
            'project_name' => $charityDetails['project_name'],
            'project_purpose' => $charityDetails['project_purpose'],
            'key_objectives' => $charityDetails['key_objectives'],
            'required_sponsorship' => number_format((float) $charityDetails['required_sponsorship'], 2, '.', ''),
            'sponsorship_offer' => $totalOffer,
            'monetary_value' => $monetary,
            'monetary_details' => $this->request->getPost('sponsorship_details'),
            'goods_value' => $goods,
            'goods_details' => $this->request->getPost('goods_details'),
            'volunteering_value' => $volunteering,
            'volunteering_details' => $this->request->getPost('volunteering_details'),
            'sponsorship_summary' => $this->request->getPost('sumsvp') ?? 'N/A',
            'sponsorship_breference' => $this->request->getPost('buyerref') ?? 'N/A',
        ];

        $insertedId = $this->sponsorshipModel->insertSponsorship($data);

        if ($insertedId) {
            $record = $this->sponsorshipModel->getSponsorshipPdfById((int) $insertedId);
            $receipt = $record ? $this->formatReceiptRecord($record) : null;
            if ($record) {
                $this->notifyAdminsOfNewSponsorship($record);
            }

            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Thank you for your sponsorship! Our team will review your proposal and contact you soon.',
                'receipt' => $receipt,
            ]);
        }

        return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to submit sponsorship. Please try again later.']);
    }

    public function sendReceipt()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(405)->setJSON(['status' => 'error', 'message' => 'Invalid request method.']);
        }

        if (!$this->session->get('loggedIn')) {
            return $this->response->setStatusCode(401)->setJSON(['status' => 'error', 'message' => 'Authentication required.']);
        }

        $validation = \Config\Services::validation();
        $validation->setRules([
            'sponsorship_id' => 'required|integer',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setStatusCode(422)->setJSON([
                'status'  => 'error',
                'message' => 'Validation failed.',
                'errors'  => $validation->getErrors(),
            ]);
        }

        $sponsorshipId = (int) $this->request->getPost('sponsorship_id');
        $record = $this->sponsorshipModel->getSponsorshipPdfById($sponsorshipId);
        if (!$record) {
            return $this->response->setStatusCode(404)->setJSON(['status' => 'error', 'message' => 'Sponsorship not found.']);
        }

        $currentUser = $this->session->get('user_sub');
        if (!$currentUser || $record['sponsor_username'] !== $currentUser) {
            return $this->response->setStatusCode(403)->setJSON(['status' => 'error', 'message' => 'Access denied.']);
        }

        $receipt = $this->formatReceiptRecord($record);
        $pdfArtifact = $this->contractPdf->render($receipt);
        $emailPayload = $this->buildReceiptEmailPayload($receipt);

        $sent = $this->emailLibrary->sendSponsorshipReceipt(
            $receipt['sponsor_email'],
            $emailPayload,
            $pdfArtifact['content'],
            $pdfArtifact['filename']
        );

        if ($sent) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Receipt emailed successfully.',
                'download_url' => base_url('/sponsorships/contract/' . $sponsorshipId . '?download=1'),
            ]);
        }

        return $this->response->setStatusCode(500)->setJSON([
            'status'  => 'error',
            'message' => 'Failed to email your receipt. Please contact support.',
        ]);
    }

    private function decodeIdentifier(?string $value): ?int
    {
        if ($value === null || $value === '') {
            return null;
        }

        $decoded = base64_decode($value, true);
        if ($decoded !== false && ctype_digit($decoded)) {
            return (int) $decoded;
        }

        return ctype_digit($value) ? (int) $value : null;
    }

    public function downloadContract(int $sponsorshipId)
    {
        if (!$this->session->get('loggedIn')) {
            return redirect()->to('/login');
        }

        $record = $this->sponsorshipModel->getSponsorshipPdfById($sponsorshipId);
        if (!$record) {
            return $this->response->setStatusCode(404)->setBody('Sponsorship not found.');
        }

        $currentUser = (string) $this->session->get('user_sub');
        $currentType = (string) $this->session->get('user_type');
        $isOwner = $currentUser !== '' && $record['sponsor_username'] === $currentUser;
        $isAdmin = $currentType === 'admin';
        if (!$isOwner && !$isAdmin) {
            return $this->response->setStatusCode(403)->setBody('Access denied.');
        }

        $receipt = $this->formatReceiptRecord($record);
        $pdfArtifact = $this->contractPdf->render($receipt);
        $disposition = $this->request->getGet('download') === '1' ? 'attachment' : 'inline';

        return $this->response
            ->setHeader('Content-Type', 'application/pdf')
            ->setHeader('Content-Disposition', $disposition . '; filename="' . $pdfArtifact['filename'] . '"')
            ->setBody($pdfArtifact['content']);
    }

    private function formatReceiptRecord(array $record): array
    {
        return [
            'id'                   => (int) ($record['id'] ?? 0),
            'spo_ref'              => $record['spo_ref'] ?? '',
            'status'               => $record['status'] ?? 'PROP',
            'charity_name'         => $record['charity_name'] ?? '',
            'charity_unique_id'    => $record['charity_unique_id'] ?? '',
            'sponsor_name'         => $record['sponsor_name'] ?? '',
            'sponsor_username'     => $record['sponsor_username'] ?? '',
            'sponsor_email'        => $record['sponsor_email'] ?? '',
            'project_name'         => $record['project_name'] ?? '',
            'project_purpose'      => $record['project_purpose'] ?? '',
            'key_objectives'       => $record['key_objectives'] ?? '',
            'additional_resources' => $record['additional_resources'] ?? '',
            'required_sponsorship' => $record['required_sponsorship'] ?? 0,
            'sponsorship_offer'    => $record['sponsorship_offer'] ?? 0,
            'monetary_value'       => $record['monetary_value'] ?? 0,
            'monetary_details'     => $record['monetary_details'] ?? '',
            'goods_value'          => $record['goods_value'] ?? 0,
            'goods_details'        => $record['goods_details'] ?? '',
            'volunteering_value'   => $record['volunteering_value'] ?? 0,
            'volunteering_details' => $record['volunteering_details'] ?? '',
            'sponsorship_breference' => $record['sponsorship_breference'] ?? '',
            'sponsorship_summary'  => $record['sponsorship_summary'] ?? '',
            'created_at'           => $record['created_at'] ?? date('Y-m-d H:i:s'),
        ];
    }

    private function buildReceiptEmailPayload(array $receipt): array
    {
        $createdAt = $receipt['created_at'] ?? date('Y-m-d H:i:s');

        return [
            'sponsorName'         => $receipt['sponsor_name'],
            'charityName'         => $receipt['charity_name'],
            'projectName'         => $receipt['project_name'],
            'projectPurpose'      => $receipt['project_purpose'],
            'offerAmount'         => $receipt['sponsorship_offer'],
            'requiredSponsorship' => $receipt['required_sponsorship'],
            'monetaryValue'       => $receipt['monetary_value'],
            'goodsValue'          => $receipt['goods_value'],
            'volunteeringValue'   => $receipt['volunteering_value'],
            'sponsorshipRef'      => $receipt['spo_ref'],
            'submittedAt'         => date('j M Y, H:i', strtotime($createdAt)),
            'dashboardUrl'        => base_url('/profile'),
            'supportEmail'        => 'membership_team@pluggin.org',
        ];
    }

    protected function notifyAdminsOfNewSponsorship(array $record): void
    {
        if (empty($this->adminRecipients)) {
            return;
        }

        $submittedAt = $record['created_at'] ?? date('Y-m-d H:i:s');
        $payload = [
            'type'             => 'Sponsorship Proposal',
            'spo_ref'          => $record['spo_ref'] ?? 'N/A',
            'charity_name'     => $record['charity_name'] ?? 'N/A',
            'charity_unique'   => $record['charity_unique_id'] ?? 'N/A',
            'project_name'     => $record['project_name'] ?? 'N/A',
            'sponsor_name'     => $record['sponsor_name'] ?? 'N/A',
            'sponsor_email'    => $record['sponsor_email'] ?? 'N/A',
            'offer_amount'     => number_format((float) ($record['sponsorship_offer'] ?? 0), 2, '.', ','),
            'required_amount'  => number_format((float) ($record['required_sponsorship'] ?? 0), 2, '.', ','),
            'status'           => strtoupper($record['status'] ?? 'PROP'),
            'submitted_at'     => date('j M Y, H:i T', strtotime($submittedAt)),
            'admin_link'       => base_url('admin#sponsorship'),
        ];

        foreach ($this->adminRecipients as $recipient) {
            try {
                $payload['admin_name'] = $recipient['name'];
                $this->emailLibrary->sendSponsorshipAdminAlert($recipient['email'], $payload);
            } catch (\Throwable $e) {
                log_message('error', '[Sponsorship] Failed to notify admin {email}: {error}', [
                    'email' => $recipient['email'],
                    'error' => $e->getMessage(),
                ]);
            }
        }
    }
}
