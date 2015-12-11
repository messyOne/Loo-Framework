<?php

namespace Loo\Helper;

use PHPUnit_Framework_TestCase;

/**
 * Test array helper methods.
 */
class ArrayHelperTest extends PHPUnit_Framework_TestCase
{
    /**
     * Check if given array is an associative array
     */
    public function testIsAssoc()
    {
        $array = ['test' => 'test'];

        $this->assertTrue(ArrayHelper::isAssoc($array));
    }

    /**
     * Check if given array is not an associative array
     */
    public function testIsNotAssoc()
    {
        $array = ['test', 'test'];

        $this->assertFalse(ArrayHelper::isAssoc($array));
    }
}
