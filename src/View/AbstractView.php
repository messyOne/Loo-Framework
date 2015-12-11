<?php

namespace Loo\View;

use Loo\Core\AbstractRenderable;
use Loo\Core\Result;
use Loo\Error\ErrorStack;
use Loo\Exception\FieldAlreadyExistsException;
use Loo\Exception\FieldNotSetException;
use Loo\Exception\NotExistsException;

/**
 * Basic View class which implements magic getter and stores the Container instance.
 */
abstract class AbstractView extends AbstractRenderable
{
    /**
     * @var mixed
     */
    protected $values = [];

    /**
     * @var ErrorStack
     */
    private $errors;

    /**
     * @return string Return the MIME content type for the view.
     */
    abstract public function getContentType();

    /**
     * Returns a object from the Container instance.
     *
     * @param string $name
     *
     * @return mixed
     *
     * @throws FieldNotSetException
     * @throws NotExistsException
     */
    public function __get($name)
    {
        if (!isset($this->values[$name])) {
            return false;
        }

        return $this->values[$name];
    }

    /**
     * The isset check for a container value.
     *
     * @param mixed $name
     *
     * @return bool
     */
    public function __isset($name)
    {
        if (!isset($this->values[$name])) {
            return false;
        }

        return true;
    }

    /**
     * @param mixed $key
     * @param mixed $value
     * @param bool  $override
     * @throws FieldAlreadyExistsException
     */
    public function assignValue($key, $value, $override = false)
    {
        if (!$override && (!is_array($this->values) || isset($this->values[$key]))) {
            throw new FieldAlreadyExistsException('Values already is set. Use the override param to override them.');
        }

        if (!is_array($this->values)) {
            $this->values = [];
        }

        $this->values[$key] = $value;
    }

    /**
     * @param mixed $values
     * @param bool  $override
     *
     * @throws FieldAlreadyExistsException
     */
    public function assign($values, $override = false)
    {
        if (!$override && !empty($this->values)) {
            throw new FieldAlreadyExistsException('Values already is set. Use the override param to override them.');
        }

        $this->values = $values;
    }

    /**
     * @param Result $result
     */
    public function setResult(Result $result)
    {
        $this->errors = $result->getErrors();
        foreach ($result->getValues() as $key => $value) {
            $this->assignValue($key, $value);
        }
    }

    /**
     * @return array
     */
    public function getValues()
    {
        return $this->values;
    }

    /**
     * Alternative to use of __get()
     *
     * @param string $key
     * @return array
     */
    public function getValue($key)
    {
        // handled by __get()
        return $this->$key;
    }

    /**
     * @return bool
     */
    protected function hasErrors()
    {
        return !empty($this->errors) && $this->errors->hasErrors();
    }

    /**
     * @return ErrorStack
     */
    protected function getErrorStack()
    {
        return $this->hasErrors() ? $this->errors->getErrors() : [];
    }
}
