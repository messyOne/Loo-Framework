<?php

namespace Loo\Database;

use Doctrine\ORM\Decorator\EntityManagerDecorator;

/**
 * Decorator for the Doctrine EntityManager.
 */
class LooEntityManager extends EntityManagerDecorator
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
        $this->lock($entity, $lockMode, $lockVersion);
        $this->refresh($entity);
    }
}
