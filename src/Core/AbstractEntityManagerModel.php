<?php

namespace Loo\Core;

use Loo\Database\LooEntityManager;
use Loo\Exception\NullException;

/**
 * Models inherit this class and can access a DatabaseFactory instance and use a getter to the
 * entity manager.
 */
abstract class AbstractEntityManagerModel implements ModelInterface
{
    /**
     * @var LooEntityManager
     */
    private $entityManager;

    /**
     * @param LooEntityManager $entityManager
     */
    public function __construct(LooEntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @throws NullException
     *
     * @return LooEntityManager
     */
    protected function getEm()
    {
        return $this->entityManager;
    }
}
