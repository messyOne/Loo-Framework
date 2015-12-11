<?php

namespace Loo\Http;

use Loo\Data\Settings;
use Loo\Data\Store;

/**
 * Test the Http helper functionality
 */
class HttpHelperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider isActiveUrlDataProvider
     * @param string $currentUri
     * @param string $uri
     * @param bool   $expected
     */
    public function testIsActiveUrl($currentUri, $uri, $expected)
    {
        $_SERVER['REQUEST_URI'] = $currentUri;

        $this->assertEquals($expected, Helper::isActiveUri($uri));
    }

    /**
     * @return array
     */
    public function isActiveUrlDataProvider()
    {
        return [
            ['foo/bar/', 'foo/bar', true],
            ['foo/bar', 'foo/bar', true],
            ['foo/bar/index', 'foo/bar', true],
            ['foo/bar/bla', 'foo/bar', false],
            ['foo/', 'foo/bar', false],
        ];
    }

    /**
     * @dataProvider urlDataProvider
     * @param string $controller
     * @param string $action
     * @param array  $data
     * @param string $expected
     */
    public function testUrl($controller, $action, $data, $expected)
    {
        Settings::setConfig(new Store(['base_url' => 'http://foo.local/']));

        $this->assertEquals($expected, Helper::url($controller, $action, $data));
    }

    /**
     * @return array
     */
    public function urlDataProvider()
    {
        return [
            ['', '', [], 'http://foo.local/'],
            ['foo', '', [], 'http://foo.local/foo'],
            ['foo', 'bar', [], 'http://foo.local/foo/bar'],
            ['foo', 'bar', ['test' => '123'], 'http://foo.local/foo/bar?test=123'],
        ];
    }
}
