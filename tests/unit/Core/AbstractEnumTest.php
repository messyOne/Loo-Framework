<?php

namespace Loo\Core;

use PHPUnit_Framework_TestCase;

/**
 * AbstractEnum functionality tests
 */
class AbstractEnumTest extends PHPUnit_Framework_TestCase
{
    /**
     * Check for valid name should be true
     */
    public function testIsValidNameShouldBeValid()
    {
        $enum = $this->getMockBuilder(AbstractEnum::class)
            ->setMethods(['getConstants'])
            ->getMock();
        $enum->method('getConstants')
            ->willReturn(['TEST' => 1]);

        /** @var AbstractEnum $enum */
        $this->assertTrue($enum->isValidName('TEST'));
    }

    /**
     * Name should be valid even it is written in different case
     */
    public function testIsValidNameShouldBeValidNonStrict()
    {
        $enum = $this->getMockBuilder(AbstractEnum::class)
            ->setMethods(['getConstants'])
            ->getMock();
        $enum->method('getConstants')
            ->willReturn(['TEST' => 1]);

        /** @var AbstractEnum $enum */
        $this->assertTrue($enum->isValidName('test'));
    }

    /**
     * In strict mode the name should not be valid
     */
    public function testIsValidNameStrict()
    {
        $enum = $this->getMockBuilder(AbstractEnum::class)
            ->getMockForAbstractClass();

        /** @var AbstractEnum $enum */
        $this->assertFalse($enum->isValidName('test', true));
    }

    /**
     * If name not exists return false
     */
    public function testIsValidNameShouldBeInvalid()
    {
        $enum = $this->getMockBuilder(AbstractEnum::class)
            ->getMockForAbstractClass();

        /** @var AbstractEnum $enum */
        $this->assertFalse($enum->isValidName('TSET'));
    }

    /**
     * Check if the value is valid
     */
    public function testIsValidValueShouldBeValid()
    {
        $enum = $this->getMockBuilder(AbstractEnum::class)
            ->setMethods(['getConstants'])
            ->getMock();
        $enum->method('getConstants')
            ->willReturn(['TEST' => 1]);

        /** @var AbstractEnum $enum */
        $this->assertTrue($enum->isValidValue(1));
    }

    /**
     * Valid is not valid so return false
     */
    public function testIsValidValueShouldBeInvalid()
    {
        $enum = $this->getMockBuilder(AbstractEnum::class)
            ->setMethods(['getConstants'])
            ->getMock();
        $enum->method('getConstants')
            ->willReturn(['TEST' => 1]);

        /** @var AbstractEnum $enum */
        $this->assertFalse($enum->isValidValue(2));
    }

    /**
     * Method should return all set values.
     */
    public function testGetValues()
    {
        $enum = $this->getMockBuilder(AbstractEnum::class)
            ->setMethods(['getConstants'])
            ->getMock();
        $enum->method('getConstants')
            ->willReturn(['foo' => 1, 'bar' => 'baz']);

        /** @var AbstractEnum $enum */
        $this->assertEquals([1, 'baz'], $enum->getValues());
    }
}
