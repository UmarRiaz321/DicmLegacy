<?php

declare(strict_types=1);

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Fuse extends BaseConfig
{
    public string $tokenEndpointToken;
    public string $manageUsersToken;

    public function __construct()
    {
        parent::__construct();

        $this->tokenEndpointToken = (string) env('FUSE_TOKEN_ENDPOINT_TOKEN', '');
        $this->manageUsersToken   = (string) env('FUSE_MANAGE_USERS_TOKEN', '');
    }
}
