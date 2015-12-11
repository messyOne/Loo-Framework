<?php

namespace Loo\Data;

use Loo\Exception\FieldNotSetException;

/**
 * Contains the values and provide methods to access them.
 */
class Store
{
    /** @var array */
    private $values;
    /**
     * @param array $values
     */
    public function __construct(array $values = [])
    {
        $this->values = $values;
    }

    /**
     * @param string $key
     *
     * @return mixed
     *
     * @throws FieldNotSetException
     */
    public function get($key)
    {
        if (!isset($this->values[$key])) {
            return;
        }

        return $this->values[$key];
    }

    /**
     * @param string $key
     * @param mixed  $value
     */
    public function set($key, $value)
    {
        $this->values[$key] = $value;
    }

    /**
     * @param string $key
     *
     * @return bool
     */
    public function exists($key)
    {
        return isset($this->values[$key]);
    }

    /**
     * @param array $values
     */
    public function setData(array $values)
    {
        foreach ($values as $key => $value) {
            $this->set($key, $value);
        }
    }

    /**
     * @return array
     */
    public function getAll()
    {
        return $this->values;
    }
}
