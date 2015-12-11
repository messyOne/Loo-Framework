<?php

namespace Loo\Html;

/**
 * Represents a html text field.
 */
class TextElement extends InputElement
{
    /**
     * @param string $id
     * @param array  $htmlAttributes
     */
    public function __construct($id, array $htmlAttributes = [])
    {
        parent::__construct('text', $id, $htmlAttributes);
    }
}
