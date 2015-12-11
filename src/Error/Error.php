<?php

namespace Loo\Error;

/**
 * Represents an error. There must be a message and optional a error code.
 */
class Error
{
    /**
     * @var string
     */
    public $message;
    /**
     * @var int|null
     */
    public $code;

    /**
     * @param string   $message
     * @param int|null $code
     */
    public function __construct($message, $code = null)
    {
        $this->message = $message;
        $this->code = $code;
    }

    /**
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getMessage();
    }
}
