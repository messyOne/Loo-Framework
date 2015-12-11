<?php

namespace Loo\Http;

use Loo\Core\FactoryInterface;
use Loo\Data\DataFactory;
use Loo\View\ViewFactory;

/**
 * Creates instances related to HTTP functionality
 */
class HttpFactory implements FactoryInterface
{
    /** @var Router */
    private static $router;
    /** @var DataFactory */
    private $dataFactory;
    /** @var ViewFactory */
    private $viewFactory;

    /**
     * @param DataFactory $dataFactory
     * @param ViewFactory $viewFactory
     */
    public function __construct(DataFactory $dataFactory, ViewFactory $viewFactory)
    {
        $this->dataFactory = $dataFactory;
        $this->viewFactory = $viewFactory;
    }

    /**
     * @param string $url
     *
     * @return Request
     *
     * Suppress warnings because the using of super globals
     */
    public function getRequest($url)
    {
        $request = new Request($url);

        return $request;
    }

    /**
     * @return Response
     */
    public function getResponse()
    {
        return new Response();
    }

    /**
     * @return Router
     */
    public function getRouter()
    {
        if (empty(static::$router)) {
            $routes = $this->dataFactory->getRoutes();
            static::$router = new Router($routes);
        }

        return static::$router;
    }

    /**
     * @param Request $request
     * @param Router  $router
     *
     * @return ControllerBuilder
     */
    public function getControllerBuilder(Request $request, Router $router)
    {
        return new ControllerBuilder($request, $router, $this->viewFactory);
    }
}
