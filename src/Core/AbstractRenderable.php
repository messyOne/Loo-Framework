<?php

namespace Loo\Core;

/**
 * Classes which shall be renderable have to implement this interface. Renderable means that the output will transform
 * to a string.
 */
abstract class AbstractRenderable
{
    /**
     * @return string
     */
    abstract public function render();

    /**
     * Calls the render method.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->render();
    }
}
