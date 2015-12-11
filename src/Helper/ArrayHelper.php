<?php

namespace Loo\Helper;

/**
 * Provides extended methods for simple array objects.
 */
class ArrayHelper
{
    /**
     * Checks if the given object is a associative array.
     *
     * @param array $array
     *
     * @return bool
     */
    public static function isAssoc(array $array)
    {
        return array_keys($array) !== range(0, count($array) - 1);
    }
}
