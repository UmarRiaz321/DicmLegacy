<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\FaqModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Config\Services;


class FaqController extends BaseController
{
    use ResponseTrait;

    protected $faqModel;

    public function __construct()
    {
        $this->faqModel = new FaqModel();
    }

    public function index()
    {
        $type = $this->request->getGet('type'); // Get type filter from query parameter
        $faqs = $this->faqModel->getFaqs($type);
        
        return $this->respond($faqs, 200);
    }

    public function show($id = null)
    {
        $faq = $this->faqModel->getFaqById($id);

        if ($faq) {
            return $this->respond($faq, 200);
        }
        return $this->failNotFound("FAQ with ID $id not found");
    }

    /**
     * Create a new FAQ
     */
    public function create()
    {
        $data = [
            'faq_type'     => $this->request->getPost('faq_type'),
            'faq_question' => $this->request->getPost('faq_question'),
            'faq_answer'   => $this->request->getPost('faq_answer'),
        ];

        if ($this->faqModel->insert($data)) {
            return $this->respondCreated(['message' => 'FAQ Created Successfully', 'data' => $data]);
        }
        return $this->failValidationErrors("FAQ creation failed.");
    }

    /**
     * Update an FAQ by ID
    */
    public function update()
    {
        $data = [
            'faq_type'     => $this->request->getPost('ftype'),
            'faq_question' => $this->request->getPost('question'),
            'faq_answer'   => $this->request->getPost('answer'),
        ];

        $id = $this->request->getPost('fid');

        if ($this->faqModel->update($id, $data)) {
            return $this->respondUpdated(['message' => 'FAQ Updated Successfully', 'data' => $data]);
        }
        return $this->failNotFound("FAQ with ID $id not found or update failed.");
    }

    /**
     * Delete an FAQ by ID
     */
    public function delete($id = null)
    {
        if ($this->faqModel->deleteFaq($id)) {
            return $this->respondDeleted(['message' => 'FAQ Deleted Successfully']);
        }
        return $this->failNotFound("FAQ with ID $id not found.");
    }




}