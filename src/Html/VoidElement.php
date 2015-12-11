<?php

namespace Loo\Html;

/**
 * Html void elements can only have strings as content.
 */
class VoidElement extends AbstractHtmlElement
{
    const OPEN_TAG = '<';
    const CLOSE_TAG = '/>';

    /**
     * @return string
     */
    public function render()
    {
        $html = self::OPEN_TAG.$this->getType().$this->renderHtmlAttributes().$this->renderValue().self::CLOSE_TAG.PHP_EOL;

        return $html;
    }

    /**
     * @return string
     */
    public function renderValue()
    {
        if ($this->isOblivious() || $this->isEmpty()) {
            return '';
        }

        return ' value="'.$this->getValue().'"';
    }
}
