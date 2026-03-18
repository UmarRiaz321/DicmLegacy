<?php

namespace App\Models;

use CodeIgniter\Model;

class FaqModel extends Model
{
    protected $table = 'FAQs'; // Database Table Name
    protected $primaryKey = 'faq_id'; // Primary Key

    protected $allowedFields = [
        'faq_type', 
        'faq_question', 
        'faq_answer', 
        'created_at', 
        'updated_at'
    ];

    // Enable Timestamps
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    /**
     * Get all FAQs or filter by type
     *
     * @param string|null $type ('Charities', 'Businesses', 'Buyers')
     * @return array
     */
    public function getFaqs($type = null)
    {
        if ($type) {
            return $this->where('faq_type', $type)->findAll();
        }
        return $this->findAll();
    }

    /**
     * Get a single FAQ by ID
     *
     * @param int $id
     * @return array|null
     */
    public function getFaqById($id)
    {
        return $this->find($id);
    }

    /**
     * Insert a new FAQ
     *
     * @param array $data
     * @return bool|int
     */
    public function createFaq($data)
    {
        return $this->insert($data);
    }

    /**
     * Update an existing FAQ
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function updateFaq($id, $data)
    {
        return $this->update($id, $data);
    }

    /**
     * Delete an FAQ
     *
     * @param int $id
     * @return bool
     */
    public function deleteFaq($id)
    {
        return $this->delete($id);
    }
}
