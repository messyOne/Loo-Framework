<?php

namespace Loo\Helper;

use PHPUnit_Framework_TestCase;

/**
 * Test Param functionality.
 */
class ParamTest extends PHPUnit_Framework_TestCase
{
    /**
     * Integer casts
     */
    public function testInt()
    {
        $valuesInt = ['test' => 3];
        $valuesNonInt = ['test' => 3.3];
        $valuesNonExists = ['test123' => 3.3];

        $this->assertSame(3, (new Param($valuesInt))->getInt('test'));
        $this->assertSame(3, (new Param($valuesNonInt))->getInt('test'));
        $this->assertSame(0, (new Param($valuesNonExists))->getInt('test'));
    }

    /**
     * String casts
     */
    public function testString()
    {
        $valuesStr = ['test' => 'foo'];
        $valuesNonStr = ['test' => 3];
        $valuesNonExists = ['test123' => 'foo'];
        $valuesHTMl = ['test' => '<h1>'];


        $this->assertSame('foo', (new Param($valuesStr))->getStr('test'));
        $this->assertSame('3', (new Param($valuesNonStr))->getStr('test'));
        $this->assertSame('', (new Param($valuesNonExists))->getStr('test'));
        $this->assertSame('<h1>', (new Param($valuesHTMl))->getStr('test', '', false));
        $this->assertSame('&lt;h1&gt;', (new Param($valuesHTMl))->getStr('test'));
    }

    /**
     * Float casts
     */
    public function testFloat()
    {
        $valuesFloat = ['test' => 3.3];
        $valuesNonFloat = ['test' => 3];
        $valuesNonExists = ['test123' => 3.3];


        $this->assertSame(3.3, (new Param($valuesFloat))->getFloat('test'));
        $this->assertSame(3.0, (new Param($valuesNonFloat))->getFloat('test'));
        $this->assertSame(.0, (new Param($valuesNonExists))->getFloat('test'));
    }

    /**
     * Bool casts
     */
    public function testBool()
    {
        $valuesBool = ['test' => true];
        $valuesNonBool = ['test' => 'false'];
        $valuesNonExists = ['test123' => 3.3];


        $this->assertSame(true, (new Param($valuesBool))->getBool('test'));
        $this->assertSame(true, (new Param($valuesNonBool))->getBool('test'));
        $this->assertSame(false, (new Param($valuesNonExists))->getBool('test'));
    }

    /**
     * Array casts
     */
    public function testArray()
    {
        $valuesArray = ['test' => [1, 2, 'test']];
        $valuesNonArray = ['test' => 'NotAnArray'];
        $valuesNonExists = ['test123' => 3.3];


        $this->assertSame([1, 2, 'test'], (new Param($valuesArray))->getArray('test'));
        $this->assertSame(['NotAnArray'], (new Param($valuesNonArray))->getArray('test'));
        $this->assertSame([], (new Param($valuesNonExists))->getArray('test'));
    }
}
