<?php

namespace Loo\Http;

use PHPUnit_Framework_TestCase;

/**
 * Router test.
 */
class RouterTest extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider dataProviderTestParsing
     */
    public function testParsing()
    {
        $url = 'controller/action/foo/bar';

        $parser = new Router(new \Loo\Routing\Routes(new \Loo\Data\Store(), new \Loo\Data\Store()));
        $parser->parseUrl($url);

        $this->assertSame('Controller', $parser->getControllerAsString());
        $this->assertSame('actionAction', $parser->getAction());
        $this->assertSame(['foo' => 'bar'], $parser->getQueryData());
    }

    /**
     * @return array
     */
    public function dataProviderTestParsing()
    {
        return [
            ['controller/action/query=true', 'Controller', 'action', 'query=true'],
            ['subfolder/controller/action/query=true', 'Namespace\\For\\Controller\\Controller', 'action', 'query=true'],
            ['super_controller/call_for_action/query=true', 'SuperController', 'callForAction', 'query=true'],
            ['super-controller/call-for-action/query=true', 'SuperController', 'callForAction', 'query=true'],
        ];
    }
}
