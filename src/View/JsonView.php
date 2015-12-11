<?php

namespace Loo\View;

use Loo\Error\ErrorStack;

/**
 * The JsonView object renders the given values as json encoded object. Often used for Controllers
 * acting as APIs.
 */
class JsonView extends AbstractView
{
    /**
     * Renders the values as a json object.
     *
     * @param bool $prettyPrint Shall use the pretty print functionality of JSON?
     *
     * @return string
     */
    public function render($prettyPrint = false)
    {
        $options = 0;

        $options |= $prettyPrint ? JSON_PRETTY_PRINT : 0;

        if ($this->hasErrors()) {
            $json = json_encode(['errors' => $this->getErrorStack()], $options);
        } else {
            $json = json_encode($this->values, $options);
        }

        if (json_last_error() !== JSON_ERROR_NONE) {
            $errorStack = new ErrorStack();
            $errorStack->addError('Invalid JSON');
            $json = json_encode(['errors' => $errorStack->getErrors()], $options);
        }

        return $json;
    }

    /**
     * @return string 'application/json'
     */
    public function getContentType()
    {
        return 'application/json; charset=utf-8';
    }
}
