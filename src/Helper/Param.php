<?php

namespace Loo\Helper;

/**
 * Helper class to get values from an array casted to a specific data type.
 * Can be used via static methods or as an object.
 */
class Param
{
    /** @var array */
    private $data;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @param string $key
     * @param int    $default
     * @return int
     */
    public function getInt($key, $default = 0)
    {
        return static::int($this->data, $key, $default);
    }

    /**
     * @param string $key
     * @param float  $default
     * @return float
     */
    public function getFloat($key, $default = .0)
    {
        return static::float($this->data, $key, $default);
    }

    /**
     * @param string $key
     * @param string $default
     * @param bool   $htmlSpecialChars
     * @return string
     */
    public function getStr($key, $default = '', $htmlSpecialChars = true)
    {
        return static::str($this->data, $key, $default, $htmlSpecialChars);
    }

    /**
     * @param string $key
     * @param bool   $default
     * @return bool
     */
    public function getBool($key, $default = false)
    {
        return static::bool($this->data, $key, $default);
    }

    /**
     * @param string $key
     * @param array  $default
     * @return array
     */
    public function getArray($key, $default = [])
    {
        return static::arr($this->data, $key, $default);
    }

    /**
     * @param array  $values
     * @param string $key
     * @param int    $default
     * @return int
     */
    public static function int(array $values, $key, $default = 0)
    {
        if (isset($values[$key])) {
            return Type::int($values[$key]);
        }

        return $default;
    }

    /**
     * @param array  $values
     * @param string $key
     * @param float  $default
     * @return float
     */
    public static function float(array $values, $key, $default = .0)
    {
        if (isset($values[$key])) {
            return Type::float($values[$key]);
        }

        return $default;
    }

    /**
     * @param array  $values
     * @param string $key
     * @param string $default
     * @param bool   $htmlSpecialChars
     * @return string
     */
    public static function str(array $values, $key, $default = '', $htmlSpecialChars = true)
    {
        if (isset($values[$key])) {
            $value = Type::string($values[$key]);

            return $htmlSpecialChars ? htmlspecialchars($value) : $value;
        }

        return $default;
    }

    /**
     * @param array  $values
     * @param string $key
     * @param bool   $default
     * @return bool
     */
    public static function bool(array $values, $key, $default = false)
    {
        if (isset($values[$key])) {
            return Type::bool($values[$key]);
        }

        return $default;
    }

    /**
     * @param array  $values
     * @param string $key
     * @param array  $default
     * @return array
     */
    public static function arr(array $values, $key, $default = [])
    {
        if (isset($values[$key])) {
            return Type::arr($values[$key]);
        }

        return $default;
    }
}
