<?php

namespace Loo\View;

use Loo\Core\Result;
use PHPUnit_Framework_TestCase;

/**
 * Test JsonView
 */
class JsonViewTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test normal rendering behaviour
     */
    public function testRenderDefault()
    {
        $view = new JsonView();
        $view->assignValue('test', 'foo');

        $this->assertSame(json_encode(['test' => 'foo']), $view->render());
    }

    /**
     * Test pretty rendering of a json object.
     */
    public function testRenderPrettyObject()
    {
        $view = new JsonView();
        $view->assignValue('test', 'foo');

        $this->assertSame(json_encode(['test' => 'foo'], JSON_PRETTY_PRINT), $view->render(true));
    }

    /**
     * Test if when I error is set it will be rendered and values bill be ignored.
     */
    public function testRenderWithError()
    {
        $result = new Result();
        $result->addError('error', 1);

        $view = new JsonView();
        $view->assignValue('test', 'foo');
        $view->setResult($result);

        $this->assertSame(json_encode(['errors' => [['message' => 'error', 'code' => 1]]]), $view->render());
    }
}
