<?php

namespace Loo\Helper;

/**
 * Test Random class
 */
class RandomTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Random strings should be different
     */
    public function testUniqueString()
    {
        $value1 = Random::getUniqueString();
        $value2 = Random::getUniqueString();

        $this->assertInternalType('string', $value1);
        $this->assertInternalType('string', $value2);
        $this->assertNotEquals($value1, $value2);
    }
}
