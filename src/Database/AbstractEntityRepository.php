<?php

namespace Loo\Database;

use Doctrine\DBAL\LockMode;
use Doctrine\ORM\EntityRepository;

/**
 * Add new functionality to the EntityRepository by Doctrine.
 */
class AbstractEntityRepository extends EntityRepository
{
    /**
     * {@inheritdoc}
     *
     * @param array $criteria
     * @param array|null $orderBy
     * @param int $lockMode
     * @return null|object
     */
    public function findOneBy(array $criteria, array $orderBy = null, $lockMode = LockMode::NONE)
    {
        $persister = $this->_em->getUnitOfWork()->getEntityPersister($this->_entityName);

        return $persister->load($criteria, null, null, [], $lockMode, 1, $orderBy);
    }
}
