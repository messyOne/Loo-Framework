<?php

namespace Loo\Error;

use JsonSerializable;

/**
 * Stack for Error instances.
 */
class ErrorStack implements JsonSerializable
{
    /** @var Error[] */
    public $errors = [];

    /**
     * @param string $message
     * @param int    $code
     */
    public function addError($message, $code = null)
    {
        $this->errors[] = new Error($message, $code);
    }

    /**
     * @param ErrorStack $messageStack
     */
    public function merge(ErrorStack $messageStack)
    {
        $this->errors = array_merge($this->errors, $messageStack->getErrors());
    }

    /**
     * @return string[]
     */
    public function getTexts()
    {
        $messages = [];

        foreach ($this->errors as $error) {
            $messages[] = $error->getMessage();
        }

        return $messages;
    }

    /**
     * @return int[]
     */
    public function getCodes()
    {
        $codes = [];

        foreach ($this->errors as $error) {
            $codes[] = $error->getCode();
        }

        return $codes;
    }

    /**
     * @return bool
     */
    public function hasErrors()
    {
        return count($this->errors) ? true : false;
    }

    /**
     * @return Error[]
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * (PHP 5 &gt;= 5.4.0)<br/>
     * Specify data which should be serialized to JSON.
     *
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     *
     * @return mixed data which can be serialized by <b>json_encode</b>,
     *               which is a value of any type other than a resource.
     */
    public function jsonSerialize()
    {
        return $this->errors;
    }
}
