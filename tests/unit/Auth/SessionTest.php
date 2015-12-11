<?php

namespace Loo\Auth;

/**
 * Test the Session handler functionality
 */
class SessionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests the getter and setter functionality
     */
    public function testGetterAndSetter()
    {
        $session = new Session();

        $session->set('foo', 'bar');

        $this->assertEquals('bar', $session->get('foo'));
    }
}
