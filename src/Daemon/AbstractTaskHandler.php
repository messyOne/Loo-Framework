<?php

namespace Loo\Daemon;

use Loo\Database\DatabaseFactory;
use Loo\Database\LooEntityManager;
use messyOne\TaskHandlerInterface;

/**
 * Handles the task object and does the real work.
 */
abstract class AbstractTaskHandler implements TaskHandlerInterface
{
    /**
     * @var LooEntityManager
     */
    private $entityManager;

    /**
     * AbstractTaskHandler constructor.
     */
    public function __construct()
    {
        $this->entityManager = (new DatabaseFactory())->getEntityManager();
    }

    /**
     * @return LooEntityManager
     */
    protected function getEm()
    {
        return $this->entityManager;
    }
}
