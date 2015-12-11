<?php

namespace Loo\Helper;

/**
 * Test type casting and checking
 */
class TypeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Int tests
     */
    public function testInt()
    {
        $this->assertSame(1, Type::int(1));
        $this->assertSame(1, Type::int(1.2));
        $this->assertSame(0, Type::int(0.2));
        $this->assertSame(1, Type::int('1'));
        $this->assertSame(0, Type::int('test1'));
        $this->assertSame(1, Type::int('1test2'));
        $this->assertSame(0, Type::int([]));
        $this->assertSame(1, Type::int(['test']));
        $this->assertTrue(Type::isInt(1));
        $this->assertFalse(Type::isInt('1'));
        $this->assertFalse(Type::isInt(1.2));
        $this->assertFalse(Type::isInt([]));
    }

    /**
     * Float tests
     */
    public function testFloat()
    {
        $this->assertSame(1., Type::float(1));
        $this->assertSame(1.2, Type::float(1.2));
        $this->assertSame(0.2, Type::float(0.2));
        $this->assertSame(1., Type::float('1'));
        $this->assertSame(0., Type::float('test1'));
        $this->assertSame(1., Type::float('1test2'));
        $this->assertSame(0., Type::float([]));
        $this->assertSame(1., Type::float(['test']));
        $this->assertFalse(Type::isFloat(1));
        $this->assertFalse(Type::isFloat('1'));
        $this->assertTrue(Type::isFloat(1.2));
        $this->assertFalse(Type::isFloat([]));
    }

    /**
     * Bool tests
     */
    public function testBool()
    {
        $this->assertTrue(Type::bool(1));
        $this->assertTrue(Type::bool(1.2));
        $this->assertTrue(Type::bool(0.2));
        $this->assertTrue(Type::bool('false'));
        $this->assertTrue(Type::bool('1test2'));
        $this->assertTrue(Type::bool('test1'));
        $this->assertFalse(Type::bool([]));
        $this->assertTrue(Type::bool(['test']));
        $this->assertFalse(Type::isBool(1));
        $this->assertFalse(Type::isBool('1'));
        $this->assertFalse(Type::isBool(1.2));
        $this->assertFalse(Type::isBool([]));
        $this->assertTrue(Type::isBool(false));
    }

    /**
     * String tests
     */
    public function testString()
    {
        $this->assertSame('1', Type::string(1));
        $this->assertSame('1.2', Type::string(1.2));
        $this->assertSame('0.2', Type::string(0.2));
        $this->assertSame('1', Type::string('1'));
        $this->assertSame('rstrst1', Type::string('rstrst1'));
        $this->assertFalse(Type::isString(1));
        $this->assertTrue(Type::isString('1'));
        $this->assertFalse(Type::isString(1.2));
        $this->assertFalse(Type::isString([]));
    }

    /**
     * Array tests
     */
    public function testArray()
    {
        $this->assertSame([1], Type::arr(1));
        $this->assertSame([1.2], Type::arr(1.2));
        $this->assertSame([0.2], Type::arr(0.2));
        $this->assertSame(['1'], Type::arr('1'));
        $this->assertSame(['test1'], Type::arr('test1'));
        $this->assertSame(['1test2'], Type::arr('1test2'));
        $this->assertSame([], Type::arr([]));
        $this->assertSame(['test'], Type::arr(['test']));
        $this->assertFalse(Type::isArray(1));
        $this->assertFalse(Type::isArray('1'));
        $this->assertFalse(Type::isArray(1.2));
        $this->assertTrue(Type::isArray([]));
    }
}
