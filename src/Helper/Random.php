<?php

namespace Loo\Helper;

/**
 * Contain logic for calculation which have to be randomized
 */
class Random
{
    /**
     * Creates a unique string absolutely unique over time.
     *
     * @return string
     */
    public static function getUniqueString()
    {
        return md5(uniqid(rand(), true));
    }

    /**
     * Creates a seed value based on the microtime
     *
     * @return float
     */
    public static function getSeed()
    {
        list($usec, $sec) = explode(' ', microtime());

        return (float) $sec + ((float) $usec * 100000);
    }
}
