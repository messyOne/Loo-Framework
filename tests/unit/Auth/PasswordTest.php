<?php

namespace Loo\Auth;

use PHPUnit_Framework_TestCase;

class PasswordTest extends PHPUnit_Framework_TestCase
{
    public function testPassword()
    {
        $password = 'test';
        $passwordMaker = new Password();

        $hash = $passwordMaker->getHash($password);

        $this->assertTrue($passwordMaker->verify($password, $hash));
    }
}
