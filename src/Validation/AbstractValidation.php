<?php

namespace Loo\Validation;

use Loo\Core\Controller;
use Loo\Error\ErrorStack;

/**
 * Common logic of Validation implementation.
 */
abstract class AbstractValidation
{
    /**
     * @var ErrorStack
     */
    private $errorStack;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->errorStack = new ErrorStack();
    }

    /**
     * @return ErrorStack
     */
    public function getErrorStack()
    {
        return $this->errorStack;
    }

    /**
     * @param mixed $value
     *
     * @return bool
     */
    abstract public function validate($value);

    /**
     * @param string $message
     * @param int    $code
     *
     * @return Controller
     */
    protected function addError($message, $code = null)
    {
        $this->errorStack->addError($message, $code);
    }
}
