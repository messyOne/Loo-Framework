<?php

namespace Loo\Core;

/**
 * Provide a rough implementation of enum types
 */
abstract class AbstractEnum
{
    private static $constCache = [];

    /**
     * Instantiation will clear the constant cache
     */
    public function __construct()
    {
        self::$constCache = [];
    }

    /**
     * Return all values set by constants
     *
     * @return array
     */
    public function getValues()
    {
        return array_values($this->getConstants());
    }

    /**
     * Check if name is used by constant list
     *
     * @param string $name
     * @param bool   $strict True will be case sensitive
     * @return bool
     */
    public function isValidName($name, $strict = false)
    {
        $constants = $this->getConstants();

        if ($strict) {
            return array_key_exists($name, $constants);
        }

        $keys = array_map('strtolower', array_keys($constants));

        return in_array(strtolower($name), $keys);
    }

    /**
     * Check if value exists in constant list
     *
     * @param mixed $value
     * @return bool
     */
    public function isValidValue($value)
    {
        $values = array_values($this->getConstants());

        return in_array($value, $values, true);
    }

    /**
     * Get the list of constants via reflection and cache it
     *
     * @return array
     */
    protected function getConstants()
    {
        if (empty(self::$constCache)) {
            $reflect = new \ReflectionClass(get_called_class());
            self::$constCache = $reflect->getConstants();
        }

        return self::$constCache;
    }
}
