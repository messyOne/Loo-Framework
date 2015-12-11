<?php

namespace Loo\Auth;

use Loo\Database\LooEntityManager;
use PHPUnit_Framework_TestCase;

/**
 * Testing role management functionality.
 */
class UserRoleManagementTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test hasAccess method. Only roles with the same or higher role should be have access.
     */
    public function testHasAccess()
    {
        $mock = $this->getMockBuilder(LooEntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        /** @var LooEntityManager $mock */
        $management = new Roles(
            $mock,
            [
                'admin' => 'user',
                'user' => 'guest',
                'guest' => 'guest',
            ]
        );

        $this->assertTrue($management->hasAccess('admin', 'guest'));
        $this->assertTrue($management->hasAccess('admin', 'user'));
        $this->assertTrue($management->hasAccess('admin', 'admin'));

        $this->assertTrue($management->hasAccess('user', 'guest'));
        $this->assertTrue($management->hasAccess('user', 'user'));
        $this->assertFalse($management->hasAccess('user', 'admin'));

        $this->assertTrue($management->hasAccess('guest', 'guest'));
        $this->assertFalse($management->hasAccess('guest', 'user'));
        $this->assertFalse($management->hasAccess('guest', 'admin'));

        $this->assertFalse($management->hasAccess(null, 'guest'));
        $this->assertFalse($management->hasAccess(null, 'user'));
        $this->assertFalse($management->hasAccess(null, 'admin'));
    }
}
