<?php

namespace Loo\View;

use Loo\Exception\FieldAlreadyExistsException;
use PHPUnit_Framework_TestCase;

/**
 * Tests basic behaviour of the View class
 */
class ViewTest extends PHPUnit_Framework_TestCase
{
    /**
     * If a value is not set it will return false.
     */
    public function testGetValueNotSet()
    {
        $stub = $this->getMockBuilder(AbstractView::class)
            ->getMockForAbstractClass();

        /** @var AbstractView $stub */
        $this->assertFalse(isset($stub->test));
        $this->assertSame(false, $stub->test);
    }

    /**
     * Test if getting a value which was set works
     */
    public function testGetWithValue()
    {
        $stub = $this->getMockBuilder(AbstractView::class)
            ->getMockForAbstractClass();

        /** @var AbstractView $stub */
        $stub->assignValue('test', 'foo');

        $this->assertTrue(isset($stub->test));
        $this->assertSame('foo', $stub->test);
    }

    /**
     * Test if getting values which were set by array works
     *
     * @throws \Loo\Exception\FieldAlreadyExistsException
     */
    public function testGetWithValues()
    {
        $stub = $this->getMockBuilder(AbstractView::class)
            ->getMockForAbstractClass();

        /** @var AbstractView $stub */
        $stub->assign(['test' => 'test', 'foo' => 'foo']);

        $this->assertTrue(isset($stub->test));
        $this->assertSame('test', $stub->test);

        $this->assertTrue(isset($stub->foo));
        $this->assertSame('foo', $stub->foo);
    }

    /**
     * If same value will be overriden there will be an exception thrown
     *
     * @throws FieldAlreadyExistsException
     */
    public function testInvalidOverrideAssignValue()
    {
        $this->setExpectedException(FieldAlreadyExistsException::class, 'Values already is set. Use the override param to override them.');

        $stub = $this->getMockBuilder(AbstractView::class)
            ->getMockForAbstractClass();

        /** @var AbstractView $stub */
        $stub->assignValue('test', 'foo');
        $stub->assignValue('test', 'bar');
    }

    /**
     * @throws FieldAlreadyExistsException
     */
    public function testAssignValueOverride()
    {
        $stub = $this->getMockBuilder(AbstractView::class)
            ->getMockForAbstractClass();

        /** @var AbstractView $stub */
        $stub->assignValue('test', 'foo');
        $stub->assignValue('test', 'bar', true);

        $this->assertTrue(isset($stub->test));
        $this->assertSame('bar', $stub->test);
    }

    /**
     * @throws FieldAlreadyExistsException
     */
    public function testInvalidOverrideAssignValueAfterAssign()
    {
        $this->setExpectedException(FieldAlreadyExistsException::class, 'Values already is set. Use the override param to override them.');

        $stub = $this->getMockBuilder(AbstractView::class)
            ->getMockForAbstractClass();

        /** @var AbstractView $stub */
        $stub->assign('foo');
        $stub->assignValue('test', 'bar');
    }

    /**
     * @throws FieldAlreadyExistsException
     */
    public function testOverrideAssignValueAfterAssign()
    {
        $stub = $this->getMockBuilder(AbstractView::class)
            ->getMockForAbstractClass();

        /** @var AbstractView $stub */
        $stub->assign('foo');
        $stub->assignValue('test', 'bar', true);

        $this->assertTrue(isset($stub->test));
        $this->assertSame('bar', $stub->test);
    }

    /**
     * @throws FieldAlreadyExistsException
     */
    public function testInvalidOverrideAssignAfterAssignValue()
    {
        $this->setExpectedException(FieldAlreadyExistsException::class, 'Values already is set. Use the override param to override them.');

        $stub = $this->getMockBuilder(AbstractView::class)
            ->getMockForAbstractClass();

        /** @var AbstractView $stub */
        $stub->assignValue('test', 'bar');
        $stub->assign('foo');
    }

    /**
     * @throws FieldAlreadyExistsException
     */
    public function testOverrideAssignAfterAssignValue()
    {
        $stub = $this->getMockBuilder(AbstractView::class)
            ->getMockForAbstractClass();

        /** @var AbstractView $stub */
        $stub->assignValue('test', 'bar');
        $stub->assign('foo', true);

        $this->assertSame('foo', $stub->getValues());
    }

    /**
     * @throws FieldAlreadyExistsException
     */
    public function testAssignValues()
    {
        $stub = $this->getMockBuilder(AbstractView::class)
            ->getMockForAbstractClass();

        /** @var AbstractView $stub */
        $stub->assignValue('foo', 123);
        $stub->assignValue('bar', 456);

        $this->assertTrue(isset($stub->foo));
        $this->assertSame(123, $stub->foo);
        $this->assertTrue(isset($stub->bar));
        $this->assertSame(456, $stub->bar);
    }
}
