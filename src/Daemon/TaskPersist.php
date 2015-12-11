<?php

namespace Loo\Daemon;

use Loo\Database\LooEntityManager;
use messyOne\TaskHandlerInterface;
use messyOne\TaskInterface;
use messyOne\TaskPersistInterface;

/**
 * @inheritdoc
 */
class TaskPersist implements TaskPersistInterface
{
    /** @var LooEntityManager */
    private $entityManager;

    /**
     * TaskPersist constructor.
     *
     * @param LooEntityManager $entityManager
     */
    public function __construct(LooEntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @inheritdoc
     */
    public function cleanUp()
    {
        $this->entityManager->flush();
        $this->entityManager->clear();
    }

    /**
     * @inheritdoc
     *
     * @param TaskHandlerInterface $task
     */
    public function remove(TaskInterface $task)
    {
        $this->entityManager->remove($task);
    }

    /**
     * @inheritdoc
     *
     * @param TaskHandlerInterface $task
     */
    public function persist(TaskInterface $task)
    {
        $this->entityManager->persist($task);
    }
}
