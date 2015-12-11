<?php

namespace Loo\Daemon;

/**
 * Daemon related tests
 */
class DaemonTasksTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test creation of DaemonTask entity
     */
    public function testCreate()
    {
        $entity = DaemonTasks::create(123, 'Foo', [1, 2, 3]);

        $this->assertEquals(123, $entity->getDueAt());
        $this->assertEquals('Foo', $entity->getHandlerClass());
        $this->assertEquals([1, 2, 3], $entity->getArguments());
    }
}
