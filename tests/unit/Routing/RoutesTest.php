<?php

namespace Loo\Routing;

use Loo\Data\Store;
use PHPUnit_Framework_TestCase;

class RoutesTest extends PHPUnit_Framework_TestCase
{
    /** @var Routes */
    private $routes;

    protected function setUp()
    {
        parent::setUp();

        $store = new Store(
            [
            'test' => [
                'controller' => 'testController',
                'action' => 'testAction'
            ]
            ]
        );

        $this->routes = new Routes($store, new Store());
    }

    public function testGetController()
    {
        $this->assertSame('testController', $this->routes->getController('test'));
    }

    public function testGetAction()
    {
        $this->assertSame('testAction', $this->routes->getAction('test'));
    }
}
