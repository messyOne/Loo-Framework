<?php

namespace Loo\Helper;

use PHPUnit_Framework_TestCase;

class ClassHelperTest extends PHPUnit_Framework_TestCase
{
    /**
     * @param $string
     * @param $excepted
     * @dataProvider dataProviderSnakeCases
     */
    public function testSnakeSoCamel($string, $excepted)
    {
        $this->assertEquals($excepted, ClassHelper::snakeToCamel($string));
    }

    /**
     * @param string $string
     * @param string $execpted
     * @dataProvider dataProviderDashCases
     */
    public function testDashToCamel($string, $execpted)
    {
        $this->assertEquals($execpted, ClassHelper::dashToCamel($string));
    }

    /**
     * @param string $string
     * @param string $excepted
     * @dataProvider dataProviderAllCases
     */
    public function testDashAndSnakeToCamel($string, $excepted)
    {
        $this->assertEquals($excepted, ClassHelper::toCamel($string, '/-|_/'));
    }

    public function dataProviderAllCases()
    {
        return array_merge(
            $this->dataProviderDashCases(),
            $this->dataProviderSnakeCases()
        );
    }

    public function dataProviderSnakeCases()
    {
        return [
            ['simple_test', 'SimpleTest'],
            ['easy', 'Easy'],
            ['start_middle_last', 'StartMiddleLast'],
            ['a_string', 'AString'],
            ['some4_numbers234', 'Some4Numbers234'],
            ['test123_string', 'Test123String'],
            ['abc_123_456', 'Abc123456'],
            ['SOME_STRING', 'SomeString']
        ];
    }

    public function dataProviderDashCases()
    {
        return [
            ['simple-test', 'SimpleTest'],
            ['easy', 'Easy'],
            ['start-middle-last', 'StartMiddleLast'],
            ['a-string', 'AString'],
            ['some4-numbers234', 'Some4Numbers234'],
            ['test123-string', 'Test123String'],
            ['abc-123-456', 'Abc123456'],
            ['SOME-STRING', 'SomeString']
        ];
    }

    /**
     * @param $string
     * @param $excepted
     * @dataProvider dataProviderExtractClassName
     */
    public function testExtractClassName($string, $excepted)
    {
        $this->assertEquals($excepted, ClassHelper::extractClass($string));
    }

    public function dataProviderExtractClassName()
    {
        return [
            ['\Namespace\Class', 'Class'],
            ['\\Namespace\\Class', 'Class'],
            ['Namespace\Class', 'Class']
        ];
    }

    /**
     * @param $string
     * @param $excepted
     * @dataProvider dataProviderPathToNamespace
     */
    public function testPathToNamespace($string, $excepted)
    {
        $this->assertEquals($excepted, ClassHelper::pathToNamespace($string));
    }

    public function dataProviderPathToNamespace()
    {
        return [
            ['path', 'Path'],
            ['path/path2', 'Path\Path2'],
            ['./path', 'Path']
        ];
    }

    /**
     * @param $excepted
     * @param $class
     * @dataProvider dataProviderNamespaceToPath
     */
    public function testNamespaceToPath($class, $excepted, $withoutBasename)
    {
        $this->assertEquals($excepted, ClassHelper::namespaceToPath($class, $withoutBasename));
    }

    public function dataProviderNamespaceToPath()
    {
        return [
            ['Path', 'Path', false],
            ['Path\Path2', 'Path/Path2', false],
            ['Path\Path2', 'Path', true],
            ['Path', '', true],
        ];
    }
}
