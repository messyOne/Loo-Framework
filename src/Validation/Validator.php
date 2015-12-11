<?php

namespace Loo\Validation;

use Loo\Error\ErrorStack;

/**
 * Wraps AbstractValidation instances and validate the value.
 */
class Validator
{
    /** @var AbstractValidation[] */
    private $validations = [];
    /** @var ErrorStack */
    private $errorStack;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->errorStack = new ErrorStack();
    }

    /**
     * @param AbstractValidation[] $validations
     */
    public function addValidations(...$validations)
    {
        $this->validations = array_merge($validations, $this->validations);
    }

    /**
     * @param mixed $value
     *
     * @return bool
     */
    public function validate($value)
    {
        /** @var AbstractValidation $validation */
        foreach ($this->validations as $validation) {
            $validation->validate($value);
            $this->errorStack->merge($validation->getErrorStack());
        }

        return !$this->errorStack->hasErrors();
    }

    /**
     * @return ErrorStack
     */
    public function getErrorStack()
    {
        return $this->errorStack;
    }
}
