<?php

namespace Loo\Data;

/**
 * Test JsonHandler
 */
class JsonHandlerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Load method should return the data as array
     */
    public function testLoad()
    {
        $handler = $this->getHandler();

        $data = $handler->load();

        $this->assertEquals(['foo' => 'bar'], $data);
    }

    /**
     * @param string $file
     * @return \PHPUnit_Framework_MockObject_MockObject|JsonHandler
     */
    private function getHandler($file = 'tests/unit/Data/test_data.json')
    {
        return new JsonHandler($file);
    }
}
