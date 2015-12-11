<?php

namespace Loo\Daemon;

use Loo\Core\AbstractEntityManagerModel;
use Loo\Daemon\Entity\DaemonTask;

/**
 * Daemon tasks related logic.
 */
class DaemonTasks extends AbstractEntityManagerModel
{
    /**
     * Creates an entity object.
     *
     * @param int    $dueAt
     * @param string $handlerClass
     * @param array  $arguments
     *
     * @return DaemonTask
     */
    public static function create($dueAt, $handlerClass, array $arguments = [])
    {
        $entity = new DaemonTask();
        $entity->setDueAt($dueAt)
            ->setHandlerClass($handlerClass)
            ->setArguments($arguments);

        return $entity;
    }
}
