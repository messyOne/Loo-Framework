<?php

namespace Loo\Validation;

use PHPUnit_Framework_TestCase;

/**
 * Tests length validation
 */
class ValidationLengthTest extends PHPUnit_Framework_TestCase
{
    /**
     * Should be true since given string is longer than 1 and smaller than 5.
     */
    public function testLengthShouldBeCorrect()
    {
        $string = 'test';
        $validation = new Length(1, 5);

        $this->assertTrue($validation->validate($string));
    }

    /**
     * Should be false because given string is longer than max length.
     */
    public function testLengthShouldBeTooLong()
    {
        $string = 'test';
        $validation = new Length(1, 2);

        $this->assertFalse($validation->validate($string));
    }

    /**
     * False since string is smaller than min length.
     */
    public function testLengthShouldBeTooShort()
    {
        $string = 'test';
        $validation = new Length(5, 10);

        $this->assertFalse($validation->validate($string));
    }
}
