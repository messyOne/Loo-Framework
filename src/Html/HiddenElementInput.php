<?php

namespace Loo\Html;

/**
 * Represents a hidden field.
 */
class HiddenElementInput extends InputElement
{
    /**
     * @param string $id
     * @param array  $htmlAttributes
     */
    public function __construct($id, array $htmlAttributes)
    {
        parent::__construct('hidden', $id, $htmlAttributes);
    }
}
