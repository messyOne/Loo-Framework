<?php

namespace Loo\Routing;

use Loo\Data\Store;

/**
 * Stores the routes for specific controllers and actions.
 */
class Routes
{
    const CONTROLLER = 'controller';
    const ACTION = 'action';
    const ROUTES = 'routes';
    const CONTROLLER_DIRECTORIES = 'controller_directories';

    /** @var Store */
    private $routes;
    /** @var Store */
    private $controllerDirectories;

    /**
     * @param Store $routes
     * @param Store $controllerDirectories
     */
    public function __construct(Store $routes, Store $controllerDirectories)
    {
        $this->routes = $routes;
        $this->controllerDirectories = $controllerDirectories;
    }

    /**
     * @return array
     */
    public function getEntries()
    {
        return $this->routes->getAll();
    }

    /**
     * @param string $name
     *
     * @return string
     */
    public function getController($name)
    {
        $route = $this->routes->get($name);

        return $route[self::CONTROLLER];
    }

    /**
     * @param string $name
     *
     * @return string
     */
    public function getAction($name)
    {
        $route = $this->routes->get($name);

        return $route[self::ACTION];
    }

    /**
     * @return array
     */
    public function getControllerDirectories()
    {
        return $this->controllerDirectories->getAll();
    }
}
