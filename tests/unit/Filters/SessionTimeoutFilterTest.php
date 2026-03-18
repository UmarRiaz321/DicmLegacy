<?php

namespace Tests\Unit\Filters;

use App\Filters\SessionTimeoutFilter;
use CodeIgniter\Test\CIUnitTestCase;

class SessionTimeoutFilterTest extends CIUnitTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $session = session();
        $session->destroy();
        $session->start();
    }

    public function testAllowsActiveSession(): void
    {
        $filter  = new SessionTimeoutFilter();
        $session = session();
        $session->set([
            'loggedIn'          => true,
            'last_activity'     => time(),
            'session_started_at'=> time(),
        ]);

        $this->assertNull($filter->before(service('request')));
    }

    public function testBlocksIdleSession(): void
    {
        $filter  = new SessionTimeoutFilter();
        $session = session();
        $session->set([
            'loggedIn'          => true,
            'last_activity'     => time() - 5000,
            'session_started_at'=> time() - 5000,
        ]);

        $result = $filter->before(service('request'));
        $this->assertNotNull($result);
    }
}
