<?php

namespace Loo\Error;

use PHPUnit_Framework_TestCase;

class ErrorTest extends PHPUnit_Framework_TestCase
{
    public function testBasic()
    {
        $error = new Error('error', 1);

        $this->assertSame('error', (string) $error);
        $this->assertSame('error', $error->getMessage());
        $this->assertSame(1, $error->getCode());
    }
}
