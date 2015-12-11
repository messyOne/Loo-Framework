<?php

namespace Loo\Helper;

/**
 * Provides helper methods to work with class names etc.
 */
class ClassHelper
{
    /**
     * Extract the class name from the full namespace.
     *
     * @param string $string
     *
     * @return string
     */
    public static function extractClass($string)
    {
        $array = explode('\\', $string);

        return end($array);
    }

    /**
     * Transforms snake to camel wording.
     *
     * @param string $string
     *
     * @return string
     */
    public static function snakeToCamel($string)
    {
        return self::makeCamelWithGlue($string, '/_/');
    }

    /**
     * @param string $string
     * @return string
     */
    public static function dashToCamel($string)
    {
        return self::makeCamelWithGlue($string, '/-/');
    }

    /**
     * @param string $string
     * @param string $delimiter
     * @param bool   $firstLetterLow
     * @return string
     */
    public static function toCamel($string, $delimiter, $firstLetterLow = false)
    {
        $string = self::makeCamelWithGlue($string, $delimiter);

        return $firstLetterLow ? lcfirst($string) : $string;
    }

    /**
     * Transforms a path to namespace.
     *
     * @param string $path
     *
     * @return string
     */
    public static function pathToNamespace($path)
    {
        $path = str_replace('./', '', $path);

        return  self::makeCamelWithGlue($path, '/\/|\\\\/', '\\');
    }

    /**
     * @param string $class
     * @param bool   $withoutBasename
     *
     * @return string
     */
    public static function namespaceToPath($class, $withoutBasename = false)
    {
        $path = preg_replace('/\/|\\\\/', '/', $class);

        if ($withoutBasename) {
            $elements = explode('/', $path);
            array_pop($elements);
            $path = implode('/', $elements);
        }

        return $path;
    }

    /**
     * Creates a camel case string.
     *
     * @param string $string
     * @param string $delimiter
     * @param string $glue
     *
     * @return string
     */
    private static function makeCamelWithGlue($string, $delimiter = '_', $glue = '')
    {
        // merge all words with given glue
        return str_replace(
            ' ',
            $glue,
            // make each word's first letter uppercase
            ucwords(
                // replace each $delimiter with a space
                preg_replace(
                    $delimiter,
                    ' ',
                    // make it lower case
                    strtolower($string)
                )
            )
        );
    }
}
