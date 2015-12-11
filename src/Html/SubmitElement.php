<?php

namespace Loo\Html;

/**
 * Represents a submit field.
 */
class SubmitElement extends InputElement
{
    /**
     * @param string $id
     * @param string $title
     * @param array  $htmlAttributes
     */
    public function __construct($id, $title, array $htmlAttributes = [])
    {
        parent::__construct('submit', $id, $htmlAttributes);

        $this->setValue($title);
    }
}
