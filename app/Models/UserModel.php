<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'Users'; // Table name
    protected $primaryKey = 'user_id'; // Primary key
    protected $allowedFields = [
        'user_type',
        'u_status',
        'date_submitted'
    ]; // Allowed mass assignment fields

    /**
     * Get user details by ID.
     *
     * @param int $userId
     * @return array|null
     */
    public function getUserById($userId)
    {
        return $this->find($userId);
    }

    /**
     * Get user_id from unique_identifier table using username.
     *
     * @param string $username
     * @return int|null
     */
    public function getUserIdByUsername($username)
    {
        $db = db_connect();
        $query = $db->table('Unique_Identifiers')
                    ->select('user_id')
                    ->where('unique_id', $username)
                    ->get();

        $result = $query->getRow();
        return $result ? (int) $result->user_id : null;
    }

    /**
     * Backwards compatible alias when the identifier is provided.
     */
    public function getUserIdByUniqueId($uniqueId)
    {
        return $this->getUserIdByUsername($uniqueId);
    }
}
