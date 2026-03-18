<?php

namespace App\Models;

use CodeIgniter\Model;

class UserDelegateModel extends Model
{
    protected $table            = 'UserDelegates';
    protected $primaryKey       = 'delegate_id';
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'parent_user_id',
        'child_user_id',
        'invite_email',
        'invite_name',
        'invite_status',
        'invite_token',
        'expires_at',
        'created_by',
    ];
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
}
