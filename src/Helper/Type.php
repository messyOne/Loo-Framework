<?php

namespace Loo\Helper;

/**
 * Helper for type casting and type checks.
 */
class Type
{
    /**
     * @param mixed $value
     * @return int
     */
    public static function int($value)
    {
        return intval($value);
    }

    /**
     * @param mixed $value
     * @return bool
     */
    public static function isInt($value)
    {
        return is_int($value);
    }

    /**
     * @param mixed $value
     * @return float
     */
    public static function float($value)
    {
        return floatval($value);
    }

    /**
     * @param mixed $value
     * @return bool
     */
    public static function isFloat($value)
    {
        return is_float($value);
    }

    /**
     * @param mixed $value
     * @return bool
     */
    public static function bool($value)
    {
        return boolval($value);
    }

    /**
     * @param mixed $value
     * @return bool
     */
    public static function isBool($value)
    {
        return is_bool($value);
    }

    /**
     * @param mixed $value
     * @return string
     */
    public static function string($value)
    {
        return trim(strval($value));
    }

    /**
     * @param mixed $value
     * @return bool
     */
    public static function isString($value)
    {
        return is_string($value);
    }

    /**
     * @param mixed $value
     * @return array
     */
    public static function arr($value)
    {
        return (array) $value;
    }

    /**
     * @param mixed $value
     * @return bool
     */
    public static function isArray($value)
    {
        return is_array($value);
    }
}
