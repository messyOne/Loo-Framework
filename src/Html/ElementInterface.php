<?php

namespace Loo\Html;

/**
 * Html elements have to implement this interface.
 */
interface ElementInterface
{
    /**
     * @return string
     */
    public function getId();

    /**
     * @param array $htmlAttributes
     * @return mixed
     */
    public function addAttributes(array $htmlAttributes);

    /**
     * @param string $classes
     * @return mixed
     */
    public function addCssClasses($classes);
}
