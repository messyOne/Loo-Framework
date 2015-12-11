<?php

namespace Loo\Daemon;

use Loo\Core\MasterFactory;
use Loo\Debug\DebugFactory;
use messyOne\Daemon;

/**
 * Create Daemon related instances
 */
class DaemonFactory extends MasterFactory
{
    /**
     * @return DaemonTasks
     */
    public function getDaemonTasks()
    {
        return new DaemonTasks($this->getDatabaseFactory()->getEntityManager());
    }

    /**
     * @return Daemon
     */
    public function getDaemon()
    {
        return new Daemon(
            $this->getTasksFinder(),
            $this->getTaskPersist(),
            (new DebugFactory())->getDaemonLogger()
        );
    }

    /**
     * @return TasksFinder
     */
    protected function getTasksFinder()
    {
        return new TasksFinder($this->getDatabaseFactory()->getEntityManager());
    }

    /**
     * @return TaskPersist
     */
    private function getTaskPersist()
    {
        return new TaskPersist($this->getDatabaseFactory()->getEntityManager());
    }
}
