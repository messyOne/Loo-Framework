<?php

namespace Loo\Html;

use PHPUnit_Framework_TestCase;

/**
 * Form element tests
 */
class FormElementTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test rendering of a form element.
     */
    public function testRenderSingleElement()
    {
        $labelElement = new LabelElement('label', 'Label', 'text');
        $textElement = new TextElement('text');
        $container = new ElementContainer('text');
        $container->add($textElement);
        $formElement = new FormElement($container, $labelElement);

        $this->assertEquals(
            '<label for="text" id="label">Label</label><input type="text" id="text" name="text"/>'.PHP_EOL,
            $formElement->render()
        );
    }
}
