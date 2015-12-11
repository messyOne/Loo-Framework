<?php

namespace Loo\Html;

/**
 * Represents password element.
 */
class PasswordElement extends InputElement
{
    /**
     * @param string $id
     * @param array  $htmlAttributes
     */
    public function __construct($id, array $htmlAttributes)
    {
        parent::__construct('password', $id, $htmlAttributes);
    }
}
