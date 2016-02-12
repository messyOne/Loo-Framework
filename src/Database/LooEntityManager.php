<?php

namespace Loo\Database;

use Doctrine\Common\EventManager;
use Doctrine\DBAL\Driver\Connection;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;

/**
 * Decorator for the Doctrine EntityManager.
 */
class LooEntityManager extends EntityManager
{
    /**
     * Acquire a lock on the given entity and refreshes the entity to have an up to date state.
     *
     * @param object $entity
     * @param int    $lockMode
     * @param null   $lockVersion
     */
    public function lock($entity, $lockMode, $lockVersion = null)
    {
        parent::lock($entity, $lockMode, $lockVersion);
        $this->refresh($entity);
    }

    /**
     * @inheritdoc
     *
     * @param mixed $conn
     * @param Configuration $config
     * @param EventManager|null $eventManager
     * @return LooEntityManager
     * @throws ORMException
     * @throws \Doctrine\DBAL\DBALException
     */
    public static function create($conn, Configuration $config, EventManager $eventManager = null)
    {
        if ( ! $config->getMetadataDriverImpl()) {
            throw ORMException::missingMappingDriverImpl();
        }

        switch (true) {
            case (is_array($conn)):
                $conn = \Doctrine\DBAL\DriverManager::getConnection(
                    $conn, $config, ($eventManager ?: new EventManager())
                );
                break;

            case ($conn instanceof Connection):
                if ($eventManager !== null && $conn->getEventManager() !== $eventManager) {
                    throw ORMException::mismatchedEventManager();
                }
                break;

            default:
                throw new \InvalidArgumentException("Invalid argument: " . $conn);
        }

        return new LooEntityManager($conn, $config, $conn->getEventManager());
    }
}
