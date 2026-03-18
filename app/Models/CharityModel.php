<?php

namespace App\Models;

use CodeIgniter\Model;

class CharityModel extends Model
{
    protected $table = 'Charities'; // Table name
    protected $primaryKey = 'cse_id'; // Primary key
    protected $allowedFields = [
        'user_id',
        'cse_OrgName',
        'cse_SpoNeeded',
        'cse_Type',
        'cse_YearFounded',
        'cse_RegisteredNo',
        'cse_SERNo',
        'cse_Regions',
        'cse_Theme',
        'cse_CurrentSupporters',
        'cse_AIncome',
        'cse_referer',
    ]; // Fields allowed for mass assignment

    /**
     * Get charity details by ID.
     *
     * @param int $charityId
     * @return array|null
     */
    public function getCharityById($charityId)
    {
        return $this->find($charityId); // Fetch single charity by ID
    }

    /**
     * Get all charities.
     *
     * @return array
     */
    public function getAllCharities()
    {
        return $this->findAll(); // Fetch all charities
    }

    /**
     * Get charities by user ID (fetch charities owned by a user).
     *
     * @param int $userId
     * @return array
     */
    public function getCharitiesByUser($userId)
    {
        return $this->where('user_id', $userId)->findAll();
    }
}
