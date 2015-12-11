<?php

namespace Loo\Http;

use Loo\Core\Controller;
use Loo\Exception\NullException;
use Loo\View\ViewFactory;

/**
 * Test the ControllerBuilder functionality
 */
class ControllerBuilderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * If the build action was not called before the getAction method will throw an exception
     *
     * @throws NullException
     */
    public function testGetActionException()
    {
        $this->setExpectedException(NullException::class, 'There is no action set. You have to run the build method at first');

        $builder = $this->getMockBuilder(ControllerBuilder::class)
            ->disableOriginalConstructor()
            ->setMethods(null)
            ->getMock();

        /** @var ControllerBuilder $builder */
        $builder->getAction();
    }

    /**
     * If the build action was not called before the getController method will throw an exception
     *
     * @throws NullException
     */
    public function testGetControllerException()
    {
        $this->setExpectedException(NullException::class, 'There is no controller set. You have to run the build method at first');

        $builder = $this->getMockBuilder(ControllerBuilder::class)
            ->disableOriginalConstructor()
            ->setMethods(null)
            ->getMock();

        /** @var ControllerBuilder $builder */
        $builder->getController();
    }

    /**
     * After the build action was called the controller and action are set
     *
     * @throws NullException
     */
    public function testBuild()
    {
        $router = $this->getMockBuilder(Router::class)
            ->disableOriginalConstructor()
            ->getMock();
        $router->method('getAction')
            ->willReturn('action');
        $router->method('getController')
            ->willReturn('getAction');

        $builder = $this->getMockBuilder(ControllerBuilder::class)
            ->setConstructorArgs([
                $this->getMockBuilder(Request::class)
                    ->disableOriginalConstructor()
                    ->getMock(),
                $router,
                $this->getMock(ViewFactory::class),
            ])
            ->setMethods(['createControllerObject'])
            ->getMock();
        $builder->method('createControllerObject')
            ->willReturn(
                $this->getMockBuilder(Controller::class)
                    ->disableOriginalConstructor()
                    ->getMock()
            );

        /** @var ControllerBuilder $builder */
        $builder->build();

        $this->assertInstanceOf(Controller::class, $builder->getController());
        $this->assertEquals('action', $builder->getAction());
    }
}
