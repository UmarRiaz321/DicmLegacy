<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\SponsorshipModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Config\Services;
use CodeIgniter\HTTP\ResponseInterface;
use App\Libraries\Email;
use App\Libraries\SponsorshipContractPdf;


class AdminSponsorshipsController extends BaseController
{
    use ResponseTrait;

    protected $session;
    protected $db;
    protected $sponsorshipModel;
    protected $emailService;
    protected $contractPdf;

    public function __construct()
    {
        parent::setProtected(true);

        $this->session = Services::session();
        $this->db = db_connect();
        $this->sponsorshipModel = new SponsorshipModel($this->db);
        $this->emailService = new Email();
        $this->contractPdf = new SponsorshipContractPdf();
    }

    /**
     * Load the sponsorships view with status tabs.
     */
    public function index()
    {
        return view('admin/sponsorships');
    }

    /**
     * Fetch sponsorships based on status for DataTables.
     */
    public function fetchSponsorships($status)
    {
        if ($response = $this->denyIfUnauthorized()) {
            return $response;
        }
        $sponsorships = $this->sponsorshipModel->getSponsorshipsByStatus($status);

        return $this->response->setJSON([
            "data" => $sponsorships
        ]);
    }

    /**
     * Fetch sponsorship details for modal.
     */
    public function getSponsorshipDetails($id)
    {
        if ($response = $this->denyIfUnauthorized()) {
            return $response;
        }
        $sponsorship = $this->sponsorshipModel->getSponsorshipPdfById($id);

        return $sponsorship ? $this->response->setJSON(['status' => 'success', 'data' => $sponsorship]) : $this->response->setJSON(['status' => 'error', 'message' => 'Sponsorship not found.']);
    }

    /**
     * Update sponsorship status.
     */
    public function updateStatus($sponsorshipId)
    {
        if ($response = $this->denyIfUnauthorized()) {
            return $response;
        }
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Invalid request.']);
        }

        // $sponsorshipId = $this->request->getPost('sponsorship_id');
        $newStatus = $this->request->getPost('status');

        if (!$sponsorshipId || !$newStatus) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Invalid parameters provided.']);
        }

        $updated = $this->sponsorshipModel->updateStatus($sponsorshipId, $newStatus);

        return $updated
            ? $this->response->setJSON(['status' => 'success', 'message' => 'Status updated successfully!'])
            : $this->response->setJSON(['status' => 'error', 'message' => 'Failed to update status.']);
    }

    /**
     * Send an email to the sponsor.
     */
    public function emailSponsor($sponsorshipId)
    {
        if ($response = $this->denyIfUnauthorized()) {
            return $response;
        }
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Invalid request.']);
        }

        $sponsorship = $this->sponsorshipModel->getSponsorshipPdfById($sponsorshipId);
        if (!$sponsorship) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Sponsorship not found.']);
        }

        $s_email = $sponsorship['sponsor_email'] ?? null;
        $s_name = $sponsorship['sponsor_name'] ?? 'Sponsor';

        if (!$s_email) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Sponsor email not available.']);
        }

        $message = $this->request->getPost('message') ?? '';
        $attachment = $this->request->getPost('attachment');
        $filename = $this->request->getPost('filename');
        $pdfContent = null;

        if ($attachment && $filename) {
            $pdfContent = base64_decode($attachment, true);
            if ($pdfContent === false) {
                return $this->response->setJSON(['status' => 'error', 'message' => 'Invalid PDF content.']);
            }
        } else {
            $pdfArtifact = $this->contractPdf->render($sponsorship);
            $pdfContent = $pdfArtifact['content'];
            $filename = $pdfArtifact['filename'];
        }

        $email = $this->emailService->sendEmailToSponsor($s_email, $s_name, "Sponsorship Details", $message, $pdfContent, $filename);

        return $this->response->setJSON($email);
    }

    public function fetchPdfforEmail($id)
    {
        if ($response = $this->denyIfUnauthorized()) {
            return $response;
        }
        $sponsorship = $this->sponsorshipModel->getSponsorshipPdfById($id);

        return $sponsorship ? $this->response->setJSON(['status' => 'success', 'data' => $sponsorship]) : $this->response->setJSON(['status' => 'error', 'message' => 'Sponsorship not found.']);
    }



    // pdf maker 

    public function downloadSponsorshipPDF($id)
    {
        if ($response = $this->denyIfUnauthorized()) {
            return $response;
        }
        try {
            // Fetch sponsorship details by ID
            $sponsorship = $this->sponsorshipModel->getSponsorshipPdfById($id);

        } catch (\Exception $e) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'An error occurred while generating the PDF: ' . $e->getMessage()]);
        }

        if($sponsorship){

            return $this->response->setJSON(['status' => 'success', 'data' => $sponsorship]);

        }
    }

    private function denyIfUnauthorized(): ?ResponseInterface
    {
        if (!$this->session->get('loggedIn')) {
            return $this->response->setStatusCode(401)->setJSON(['status' => 'error', 'message' => 'Authentication required.']);
        }

        $userType = $this->session->get('user_type');
        if ($userType !== 'admin') {
            return $this->response->setStatusCode(403)->setJSON(['status' => 'error', 'message' => 'Access denied.']);
        }

        return null;
    }
}
