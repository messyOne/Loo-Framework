<?php

namespace Loo\Core;

use Loo\Error\ErrorStack;

/**
 * Result objects are returned by e.g. models and contain success data or error messages. They can be sent to view
 * instances and they handle the success/error data.
 */
class Result
{
    /** @var ErrorStack */
    private $errorStack;
    /** @var array */
    private $values = [];

    /**
     * @param array $values
     */
    public function __construct(array $values = [])
    {
        $this->errorStack = new ErrorStack();
        $this->values = $values;
    }

    /**
     * @return bool
     */
    public function wasSuccessful()
    {
        return !$this->hasErrors();
    }

    /**
     * @param string $message
     * @param int    $code
     *
     * @return Result
     */
    public function addError($message, $code = null)
    {
        $this->errorStack->addError($message, $code);

        return $this;
    }

    /**
     * @return ErrorStack
     */
    public function getErrors()
    {
        return $this->errorStack;
    }

    /**
     * @return bool
     */
    public function hasErrors()
    {
        return $this->errorStack->hasErrors();
    }

    /**
     * @param mixed $key
     * @param mixed $value
     */
    public function addValueByKey($key, $value)
    {
        $this->values[$key] = $value;
    }

    /**
     * @param mixed $value
     */
    public function addValue($value)
    {
        $this->values[] = $value;
    }

    /**
     * @param mixed $values
     */
    public function setValues(array $values)
    {
        $this->values = $values;
    }

    /**
     * @return mixed
     */
    public function getValues()
    {
        return $this->values;
    }
}
