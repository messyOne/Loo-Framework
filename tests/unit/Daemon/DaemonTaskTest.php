<?php

namespace Loo\Daemon;

use Loo\Daemon\Entity\DaemonTask;

/**
 * Test entity
 */
class DaemonTaskTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test getter and setter
     */
    public function testGetterAndSetter()
    {
        $entity = new DaemonTask();
        $entity->setHandlerClass('Foo')
            ->setArguments([1, 2, 3])
            ->setDueAt(123)
            ->setDisabled();

        $this->assertEquals('Foo', $entity->getHandlerClass());
        $this->assertEquals([1, 2, 3], $entity->getArguments());
        $this->assertEquals(123, $entity->getDueAt());
        $this->assertTrue($entity->isDisabled());
    }
}
