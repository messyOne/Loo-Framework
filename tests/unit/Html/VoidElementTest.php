<?php

namespace Loo\Html;

use PHPUnit_Framework_TestCase;

/**
 * Test void element.
 */
class VoidElementTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test simple rendering
     */
    public function testSimple()
    {
        $expected = "<hr/>".PHP_EOL;

        $element = new VoidElement('hr');

        $this->assertEquals($expected, $element->render());
    }

    /**
     * Test rendering with set value
     */
    public function testWithValue()
    {
        $expected = "<input value=\"test\"/>".PHP_EOL;

        $element = new VoidElement('input');
        $element->setValue('test');

        $this->assertEquals($expected, $element->render());
    }

    /**
     * Test adding one attribute
     */
    public function testOneAttribute()
    {
        $expected = "<hr class=\"test\"/>".PHP_EOL;

        $element = new VoidElement('hr');
        $element->addAttributes(['class' => 'test']);

        $this->assertEquals($expected, $element->render());
    }

    /**
     * Test if adding two attributes works
     */
    public function testTwoAttributes()
    {
        $expected = "<hr class=\"test\" id=\"foo\"/>".PHP_EOL;

        $element = new VoidElement('hr');
        $element->addAttributes(['class' => 'test']);
        $element->addAttributes(['id' => 'foo']);

        $this->assertEquals($expected, $element->render());
    }

    /**
     * Test adding different kinds of attributes.
     */
    public function testTwoAttributesComplex()
    {
        $expected = "<hr class=\"test another\" id=\"foo\"/>".PHP_EOL;

        $element = new VoidElement('hr');
        $element->addAttributes(['class' => ['test', 'another']]);
        $element->addAttributes(['id' => 'foo']);

        $this->assertEquals($expected, $element->render());
    }

    /**
     * Test escaping special characters.
     */
    public function testValueHtmlSpecialChar()
    {
        $element = new VoidElement('input');
        $element->setValue('<test>');

        $this->assertSame("<input value=\"&lt;test&gt;\"/>".PHP_EOL, $element->render());
    }
}
