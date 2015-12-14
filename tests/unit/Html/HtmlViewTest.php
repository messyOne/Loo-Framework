<?php

namespace Loo\Html;

use Loo\View\HtmlView;
use PHPUnit_Framework_TestCase;

/**
 * Html view tests
 */
class HtmlViewTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test if html view gets rendered.
     */
    public function testRendering()
    {
        $view = $this->getMockBuilder(HtmlView::class)
            ->setConstructorArgs(['template/view'])
            ->setMethods(['getLayouts', 'getLayoutFile', 'setDefaultLayout', 'setDefaultViewPath'])
            ->getMock();
        $view->method('getLayoutFile')
            ->willReturn(realpath(__DIR__).DIRECTORY_SEPARATOR.'template/layout');

        /** @var HtmlView $view */
        $view->setViewPath(realpath(__DIR__).DIRECTORY_SEPARATOR);

        $this->assertEquals('Layout'.PHP_EOL, $view->render());
        $this->assertEquals('View', $view->renderContent());
    }
}
