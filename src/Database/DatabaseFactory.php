<?php

namespace Loo\Database;

use Doctrine\ORM\EntityManager;
use Loo\Core\FactoryInterface;
use Loo\Data\Settings;
use Doctrine\ORM\Tools\SchemaTool;
use Doctrine\ORM\Tools\Setup;

/**
 * Provides instance creation for database specific classes.
 */
class DatabaseFactory implements FactoryInterface
{
    /**
     * @var LooEntityManager
     */
    private static $entityManager;

    /**
     * Uses the configuration from the application and returns the LooEntityManager.
     *
     * @return LooEntityManager
     */
    public function getEntityManager()
    {
        if (empty(static::$entityManager)) {
            $config = Setup::createAnnotationMetadataConfiguration(Settings::getEntityPaths(), Settings::isDevMode());
            $connection = Settings::getDbConnection();

            static::$entityManager = new LooEntityManager(EntityManager::create($connection, $config));
        }

        return static::$entityManager;
    }

    /**
     * @return SchemaTool
     */
    public function getSchemaTool()
    {
        return new SchemaTool($this->getEntityManager());
    }
}
