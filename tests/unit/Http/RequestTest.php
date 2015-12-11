<?php

namespace Loo\Http;

use PHPUnit_Framework_TestCase;

/**
 * Test the Request functionality
 */
class RequestTest extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider dataProviderGetData
     * @param string $key
     * @param mixed  $data
     */
    public function testGetData($key, $data)
    {
        $request = new Request('');
        $_SERVER['REQUEST_METHOD'] = $key;

        $this->assertSame($data, $request->getData());
    }

    /**
     * @return array
     */
    public function dataProviderGetData()
    {
        $_GET = [Request::GET => 'get_data'];
        $_POST = [Request::POST => 'post_data'];

        return [
            [Request::GET, $_GET],
            [Request::POST, $_POST],
            ['not_existing_method', []],
        ];
    }

    /**
     * Data which was added later overrides data which the same key
     */
    public function testAddData()
    {
        $_SERVER['REQUEST_METHOD'] = Request::GET;
        $_GET = [];
        $_POST = [];
        $request = new Request('');

        $request->addData(['foo' => 123]);
        $request->addData(['bar' => 456]);
        $request->addData(['bar' => 789]);

        $this->assertEquals([
            'foo' => 123,
            'bar' => 789,
        ], $request->getData());
    }

    /**
     * @dataProvider isMethodDataProvider
     * @param string $actualMethod
     * @param string $requestedMethod
     * @param bool   $expected
     */
    public function testIsMethod($actualMethod, $requestedMethod, $expected)
    {
        $_SERVER['REQUEST_METHOD'] = $requestedMethod;

        $request = new Request('');

        $this->assertEquals($expected, $request->isMethod($actualMethod));
    }

    /**
     * @return array
     */
    public function isMethodDataProvider()
    {
        return [
            ['get', 'GET', true],
            ['GET', 'GET', true],
            ['post', 'GET', false],
        ];
    }
}
