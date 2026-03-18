<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Proxy extends BaseConfig
{
    /**
     * Trusted proxy IP addresses.
     *
     * @var list<string>
     */
    public array $proxyIPs = [
        // TODO: populate with load-balancer proxies (e.g. '10.0.0.0/8').
    ];

    /**
     * Proxy header map used to detect original protocol/host/client IP.
     */
    public array $headers = [
        'protocol' => 'X-Forwarded-Proto',
        'host'     => 'X-Forwarded-Host',
        'port'     => 'X-Forwarded-Port',
        'client'   => 'X-Forwarded-For',
    ];
}
