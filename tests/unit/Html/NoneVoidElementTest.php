<?php

namespace Loo\Html;

use PHPUnit_Framework_TestCase;

/**
 * Test the NoneVoidElement
 */
class NoneVoidElementTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test if the most simple rendering works
     */
    public function testSimple()
    {
        $expected = "<p></p>";

        $element = new NoneVoidElement('p');

        $this->assertEquals($expected, $element->render());
    }

    /**
     * Test if adding a value works
     */
    public function testWithValue()
    {
        $expected = "<p>test</p>";

        $element = new NoneVoidElement('p');
        $element->setValue('test');

        $this->assertEquals($expected, $element->render());
    }

    /**
     * Test adding an attribute
     */
    public function testOneAttribute()
    {
        $expected = "<p class=\"test\"></p>";

        $element = new NoneVoidElement('p');
        $element->addCssClasses('test');

        $this->assertEquals($expected, $element->render());
    }

    /**
     * Test adding css class and attribute
     */
    public function testAddingAttributeAndCssClass()
    {
        $expected = "<p class=\"test\" id=\"foo\"></p>";

        $element = new NoneVoidElement('p');
        $element->addCssClasses('test');
        $element->addAttributes(['id' => 'foo']);

        $this->assertEquals($expected, $element->render());
    }

    /**
     * Test if adding multiple attributes works
     */
    public function testTwoAttributesComplex()
    {
        $expected = "<p class=\"test another\" id=\"foo\"></p>";

        $element = new NoneVoidElement('p');
        $element->addAttributes(['class' => ['test', 'another']]);
        $element->addAttributes(['id' => 'foo']);

        $this->assertEquals($expected, $element->render());
    }


    /**
     * Test if html chars get escaped
     */
    public function testAddElementHtmlSpecialChars()
    {
        $element = new NoneVoidElement('form');
        $element->setValue('<strong>');

        $this->assertSame("<form>&lt;strong&gt;</form>", $element->render());
    }
}
