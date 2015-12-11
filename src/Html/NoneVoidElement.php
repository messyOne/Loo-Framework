<?php

namespace Loo\Html;

/**
 * Html elements which have a start and a end element. Those elements can contain sub elements or strings.
 */
class NoneVoidElement extends AbstractHtmlElement
{
    const OPEN_TAG_PRE = '<';
    const CLOSE_TAG_PRE = '>';
    const OPEN_TAG_PAST = '</';
    const CLOSE_TAG_PAST = '>';

    /**
     * Renders all sub elements and returns it.
     *
     * @return string
     */
    public function render()
    {
        $html = self::OPEN_TAG_PRE.$this->getType().$this->renderHtmlAttributes().self::CLOSE_TAG_PRE;

        $html .= $this->renderValue().self::OPEN_TAG_PAST.$this->getType().self::CLOSE_TAG_PAST;

        return $html;
    }

    /**
     * @return string
     */
    public function renderValue()
    {
        if ($this->isOblivious()) {
            return '';
        }

        return $this->getValue();
    }
}
