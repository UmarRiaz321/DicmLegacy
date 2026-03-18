<?php

namespace App\Models;

use CodeIgniter\Model;

class UserProfileModel extends Model
{
    protected $table            = 'UserProfiles';
    protected $primaryKey       = 'profile_id';
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'user_id',
        'display_name',
        'display_email',
        'phone_number',
        'theme_pref',
        'created_by',
    ];
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
}
