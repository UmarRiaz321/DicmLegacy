<?php

namespace App\Models;

use CodeIgniter\Model;

class UserProfileUpdateModel extends Model
{
    protected $table            = 'UserProfileUpdates';
    protected $primaryKey       = 'request_id';
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'user_id',
        'payload',
        'status',
        'notes',
        'reviewed_by',
        'reviewed_at',
        'created_by',
    ];
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
}

