<?php

namespace Loo\View;

/**
 * The simplest way to return a view object. It just does nothing.
 */
class NullView extends AbstractView
{
    /**
     * Empty method.
     */
    public function render()
    {
    }

    /**
     * @return string 'text/plain'
     */
    public function getContentType()
    {
        return 'text/plain';
    }
}
