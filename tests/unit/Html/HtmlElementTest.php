<?php

namespace Loo\Html;

use PHPUnit_Framework_TestCase;

/**
 * Html Element tests.
 */
class HtmlElementTest extends PHPUnit_Framework_TestCase
{
    /** @var $stub AbstractHtmlElement */
    public $stub;

    /**
     * Create mocked object.
     */
    protected function setUp()
    {
        parent::setUp();

        $this->stub = $this->getMockForAbstractClass(AbstractHtmlElement::class, ['test']);
        $this->stub->expects($this->any())
            ->method('render')
            ->will($this->returnValue(true));
    }

    /**
     * Getting a not set attribute should return null.
     */
    public function testAttributeNotSet()
    {
        $actual = $this->stub->getAttribute('test');

        $this->assertSame(null, $actual);
    }

    /**
     * Test if set attribute gets rendered.
     */
    public function testAttributeSet()
    {
        $this->stub->addAttributes(['test' => 'foo']);
        $actual = $this->stub->getAttribute('test');

        $this->assertSame('foo', $actual);
    }
}
