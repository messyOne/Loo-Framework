<?php

namespace Loo\Html;

/**
 * Represents a href element.
 */
class UrlElement extends NoneVoidElement
{
    /**
     * @param string $title
     * @param string $href
     * @param string $cssClasses
     */
    public function __construct($title, $href, $cssClasses = '')
    {
        parent::__construct('a');

        $this->addAttributes(
            [
                'href' => $href,
                'class' => $cssClasses,
            ]
        );

        $this->setValue($title);
    }
}
