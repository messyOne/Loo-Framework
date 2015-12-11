<?php

namespace Loo\Data;

use Loo\Core\FactoryInterface;
use Loo\Routing\Routes;

/**
 * Create instances holding data
 */
class DataFactory implements FactoryInterface
{
    /**
     * @return Routes
     */
    public function getRoutes()
    {
        $store = new Store(require(ROOT.'/config/routes.php'));
        $routes = new Store($store->get(Routes::ROUTES));
        $controllerDirectories = new Store($store->get(Routes::CONTROLLER_DIRECTORIES));

        return new Routes($routes, $controllerDirectories);
    }

    /**
     * @return Store
     */
    public function getConfig()
    {
        $store = new Store(require(ROOT.'/config/global.php'));
        $store->setData(require(ROOT.'/config/local.php'));

        return $store;
    }

    /**
     * @return Store
     */
    public function getRoles()
    {
        return new Store(require(ROOT.'/config/roles.php'));
    }
}
