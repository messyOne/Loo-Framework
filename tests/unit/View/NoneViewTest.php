<?php

namespace Loo\View;

use PHPUnit_Framework_TestCase;

/**
 * Test NoneView
 */
class NoneViewTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test rendering of null view. Should return in a blank page.
     */
    public function testRenderDefault()
    {
        $view = new NullView();

        $this->assertEmpty($view->render());
    }
}
