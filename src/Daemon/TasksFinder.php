<?php

namespace Loo\Daemon;

use Loo\Core\AbstractEntityManagerModel;
use Loo\Daemon\Entity\DaemonTask;
use Loo\Daemon\Entity\DaemonTaskRepository;
use Loo\Helper\Time;
use messyOne\TasksFinderInterface;

/**
 * Find all the due tasks.
 */
class TasksFinder extends AbstractEntityManagerModel implements TasksFinderInterface
{
    /**
     * @return DaemonTask[]
     * @throws \Loo\Exception\NullException
     */
    public function findDueTasks()
    {
        /** @var DaemonTaskRepository $repository */
        $repository = $this->getEm()->getRepository(DaemonTask::class);

        return $repository->findDue(Time::now());
    }
}
