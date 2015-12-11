<?php

namespace Loo\Daemon\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;

/**
 * Repository for DaemonTask objects.
 */
class DaemonTaskRepository extends EntityRepository
{

    /**
     * Get all entities which are due by given timestamp.
     *
     * @param int $timestamp
     * @return DaemonTask[]
     */
    public function findDue($timestamp)
    {
        $rsm = $this->getResultMapping();

        $query = $this->getEntityManager()->createNativeQuery('
            SELECT *
            FROM daemon_tasks dt
            WHERE dt.due_at <= :due_at AND dt.disabled IS FALSE
        ', $rsm);

        $query->setParameter('due_at', $timestamp);

        return $query->getResult();
    }

    /**
     * @return ResultSetMapping
     */
    public function getResultMapping()
    {
        $rsm = new ResultSetMapping();
        $rsm->addEntityResult(DaemonTask::class, 'dt');
        $rsm->addFieldResult('dt', 'id', 'id');
        $rsm->addFieldResult('dt', 'due_at', 'dueAt');
        $rsm->addFieldResult('dt', 'handler_class', 'handlerClass');
        $rsm->addFieldResult('dt', 'arguments', 'arguments');
        $rsm->addFieldResult('dt', 'disabled', 'disabled');

        return $rsm;
    }
}
