<?php

namespace Loo\View;

use Loo\Error\ErrorStack;

/**
 * The JsonView object renders the given values as json encoded object. Often used for Controllers
 * acting as APIs.
 */
class JsonView extends AbstractView
{
    /** @var bool */
    private $prettyPrint;

    /**
     * JsonView constructor.
     * @param bool $prettyPrint
     */
    public function __construct($prettyPrint = false)
    {
        $this->prettyPrint = $prettyPrint;
    }

    /**
     * Renders the values as a json object.
     *
     * @return string
     */
    public function render()
    {
        $options = 0;

        $options |= $this->prettyPrint ? JSON_PRETTY_PRINT : 0;

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
