<?php

namespace Loo\Core;

use Loo\Auth\AuthFactory;
use Loo\Data\DataFactory;
use Loo\Database\DatabaseFactory;
use Loo\Debug\DebugFactory;
use Loo\Http\HttpFactory;
use Loo\View\ViewFactory;

/**
 * Creates all the factories used by the framework.
 */
class MasterFactory implements FactoryInterface
{
    /**
     * @return ViewFactory
     */
    public function getViewFactory()
    {
        return new ViewFactory();
    }

    /**
     * @return DataFactory
     */
    public function getDataFactory()
    {
        return new DataFactory();
    }

    /**
     * @return DatabaseFactory
     */
    public function getDatabaseFactory()
    {
        return new DatabaseFactory();
    }

    /**
     * @return AuthFactory
     */
    public function getAuthFactory()
    {
        return new AuthFactory();
    }

    /**
     * @return HttpFactory
     */
    public function getHttpFactory()
    {
        return new HttpFactory($this->getDataFactory(), $this->getViewFactory());
    }

    /**
     * @return DebugFactory
     */
    public function getDebugFactory()
    {
        return new DebugFactory();
    }
}
