<?php

namespace Loo\Data;

use PHPUnit_Framework_TestCase;

class StoreTest extends PHPUnit_Framework_TestCase
{
    public function testGetStoreValueExists()
    {
        $config = new Store(
            [
            'test' => 'foo'
            ]
        );

        $this->assertEquals('foo', $config->get('test'));
    }

    public function testGetStoreValueNotExists()
    {
        $config = new Store([]);

        $this->assertNull($config->get('test'));
    }

    public function testGetStoreSetValue()
    {
        $config = new Store();

        $config->set('test', 'foo');

        $this->assertSame('foo', $config->get('test'));
    }
}
