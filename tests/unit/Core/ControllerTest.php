<?php

namespace Loo\Core;

use Loo\Exception\NotExistsException;
use Loo\Http\Request;
use Loo\View\NullView;
use Loo\View\ViewFactory;

/**
 * Tests for the core controller.
 */
class ControllerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * If the action method does not exist there should be an exception be thrown.
     *
     * @throws NotExistsException
     */
    public function testHandleWithNotExistingMethod()
    {
        $this->setExpectedException(NotExistsException::class, 'Method actionMethod does not exist');

        $controller = $this->getMockBuilder(Controller::class)
            ->disableOriginalConstructor()
            ->setMethods(null)
            ->getMock();

        /** @var Controller $controller */
        $controller->handle('actionMethod');
    }

    /**
     * If user has access the methods should be called.
     *
     * @throws NotExistsException
     */
    public function testHandleWithAccess()
    {
        $controller = $this->getMockBuilder(Controller::class)
            ->setConstructorArgs([
                $this->getMockBuilder(Request::class)
                    ->disableOriginalConstructor()
                    ->getMock(),
                $this->getMockBuilder(ViewFactory::class)
                    ->disableOriginalConstructor()
                    ->getMock(),
            ])
            ->setMethods(['actionMethod', 'hasAccess', 'preAction', 'postAction', 'getStatus', 'isHttpMethodAllowed', 'getView'])
            ->getMock();

        $controller->method('hasAccess')
            ->willReturn(true);
        $controller->expects($this->once())->method('preAction');
        $controller->expects($this->once())->method('actionMethod');
        $controller->expects($this->once())->method('postAction');
        $controller->method('isHttpMethodAllowed')
            ->willReturn(true);
        $controller->method('getStatus')
            ->willReturn(200);
        $controller->method('getView')
            ->willReturn(new NullView());

        /** @var Controller $controller */
        $response = $controller->handle('actionMethod');

        $this->assertEquals(200, $response->getStatus());
    }

    /**
     * If user has access the methods should be called.
     *
     * @throws NotExistsException
     */
    public function testHandleWithNoAccess()
    {
        $controller = $this->getMockBuilder(Controller::class)
            ->setConstructorArgs([
                $this->getMockBuilder(Request::class)
                    ->disableOriginalConstructor()
                    ->getMock(),
                $this->getMockBuilder(ViewFactory::class)
                    ->disableOriginalConstructor()
                    ->getMock(),
            ])
            ->setMethods(['actionMethod', 'hasAccess', 'preAction', 'postAction', 'getStatus', 'isHttpMethodAllowed', 'getView'])
            ->getMock();

        $controller->method('hasAccess')
            ->willReturn(false);
        $controller->expects($this->never())->method('preAction');
        $controller->expects($this->never())->method('actionMethod');
        $controller->expects($this->never())->method('postAction');
        $controller->method('isHttpMethodAllowed')
            ->willReturn(true);
        $controller->method('getStatus')
            ->willReturn(200);
        $controller->method('getView')
            ->willReturn(new NullView());

        /** @var Controller $controller */
        $response = $controller->handle('actionMethod');

        $this->assertEquals(200, $response->getStatus());
    }

    /**
     * If there is any other status code than 3xx or 2xx skip action methods and return error response
     *
     * @throws NotExistsException
     */
    public function testHandleWithErrorStatus()
    {
        $controller = $this->getMockBuilder(Controller::class)
            ->setConstructorArgs([
                $this->getMockBuilder(Request::class)
                    ->disableOriginalConstructor()
                    ->getMock(),
                $this->getMockBuilder(ViewFactory::class)
                    ->disableOriginalConstructor()
                    ->getMock(),
            ])
            ->setMethods(['actionMethod', 'hasAccess', 'preAction', 'postAction', 'getStatus', 'isHttpMethodAllowed', 'getView'])
            ->getMock();

        $controller->method('hasAccess')
            ->willReturn(true);
        $controller->expects($this->never())->method('preAction');
        $controller->expects($this->never())->method('actionMethod');
        $controller->expects($this->never())->method('postAction');
        $controller->method('isHttpMethodAllowed')
            ->willReturn(true);
        $controller->method('getStatus')
            ->willReturn(403);
        $controller->method('getView')
            ->willReturn(new NullView());

        /** @var Controller $controller */
        $response = $controller->handle('actionMethod');

        $this->assertEquals(403, $response->getStatus());
        $this->assertEquals('403 Forbidden', $response->getBody());
    }

    /**
     * If any HTTP method is allowed the action should be called
     */
    public function testHandleIsHttpMethodAllowedNotRequiredMethod()
    {
        $controller = $this->getMockBuilder(Controller::class)
            ->setConstructorArgs([
                $this->getMockBuilder(Request::class)
                    ->disableOriginalConstructor()
                    ->getMock(),
                $this->getMockBuilder(ViewFactory::class)
                    ->disableOriginalConstructor()
                    ->getMock(),
            ])
            ->setMethods(['actionMethod', 'hasAccess', 'preAction', 'postAction', 'getView'])
            ->getMock();

        $controller->method('hasAccess')
            ->willReturn(true);
        $controller->expects($this->once())->method('preAction');
        $controller->expects($this->once())->method('actionMethod');
        $controller->expects($this->once())->method('postAction');
        $controller->method('getView')
            ->willReturn(new NullView());

        /** @var Controller $controller */
        $response = $controller->handle('actionMethod');

        $this->assertEquals(200, $response->getStatus());
    }

    /**
     * If HTTP method is allowed call actions
     */
    public function testHandleIsHttpMethodAllowedRequiredMethodSuccess()
    {
        $request = $this->getMockBuilder(Request::class)
            ->disableOriginalConstructor()
            ->setMethods(['getMethod'])
            ->getMock();
        $request->method('getMethod')
            ->willReturn(Request::GET);

        $controller = $this->getMockBuilder(Controller::class)
            ->setConstructorArgs([
                $request,
                $this->getMockBuilder(ViewFactory::class)
                    ->disableOriginalConstructor()
                    ->getMock(),
            ])
            ->setMethods(['actionMethod', 'hasAccess', 'preAction', 'postAction', 'getView', 'getRequiredHttpMethod'])
            ->getMock();

        $controller->method('hasAccess')
            ->willReturn(true);
        $controller->method('getRequiredHttpMethod')
            ->willReturn(Request::GET);
        $controller->expects($this->once())->method('preAction');
        $controller->expects($this->once())->method('actionMethod');
        $controller->expects($this->once())->method('postAction');
        $controller->method('getView')
            ->willReturn(new NullView());

        /** @var Controller $controller */
        $response = $controller->handle('actionMethod');

        $this->assertEquals(200, $response->getStatus());
    }

    /**
     * If HTTP method is not allowed does not call actions
     */
    public function testHandleIsHttpMethodAllowedRequiredMethodFail()
    {
        $request = $this->getMockBuilder(Request::class)
            ->disableOriginalConstructor()
            ->setMethods(['getMethod'])
            ->getMock();
        $request->method('getMethod')
            ->willReturn(Request::POST);

        $controller = $this->getMockBuilder(Controller::class)
            ->setConstructorArgs([
                $request,
                $this->getMockBuilder(ViewFactory::class)
                    ->disableOriginalConstructor()
                    ->getMock(),
            ])
            ->setMethods(['actionMethod', 'hasAccess', 'preAction', 'postAction', 'getView', 'getRequiredHttpMethod'])
            ->getMock();

        $controller->method('hasAccess')
            ->willReturn(true);
        $controller->method('getRequiredHttpMethod')
            ->willReturn(Request::GET);
        $controller->expects($this->once())->method('preAction');
        $controller->expects($this->once())->method('actionMethod');
        $controller->expects($this->once())->method('postAction');
        $controller->method('getView')
            ->willReturn(new NullView());

        /** @var Controller $controller */
        $response = $controller->handle('actionMethod');

        $this->assertEquals(405, $response->getStatus());
        $this->assertEquals('405 Method Not Allowed', $response->getBody());
    }
}
