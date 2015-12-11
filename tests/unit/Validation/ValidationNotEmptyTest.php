<?php

namespace Loo\Validation;

use PHPUnit_Framework_TestCase;

/**
 * Tests the ValidationNotEmpty behaviour
 */
class ValidationNotEmptyTest extends PHPUnit_Framework_TestCase
{
    /**
     * Value is set. Should be true.
     */
    public function testNotEmptyShouldBeCorrect()
    {
        $string = 'test';
        $validation = new NotEmpty();

        $this->assertTrue($validation->validate($string));
    }

    /**
     * Empty value. Should be false.
     */
    public function testNotEmptyShouldBeIncorrectWithEmptyString()
    {
        $string = '';
        $validation = new NotEmpty();

        $this->assertFalse($validation->validate($string));
    }

    /**
     * Test whether a white space string is still false.
     */
    public function testNotEmptyShouldBeIncorrectWithSpace()
    {
        $string = ' ';
        $validation = new NotEmpty();

        $this->assertFalse($validation->validate($string));
    }

    /**
     * Null value should be false.
     */
    public function testNotEmptyShouldBeIncorrectWithNull()
    {
        $string = null;
        $validation = new NotEmpty();

        $this->assertFalse($validation->validate($string));
    }
}
