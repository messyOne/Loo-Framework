<?php

namespace Loo\Html;

/**
 * Represents a html form element.
 */
class FormElement extends AbstractElement
{
    /**
     * @var ElementContainer
     */
    private $elements;
    /**
     * @var LabelElement
     */
    private $labelElement;

    /**
     * @param ElementContainer  $elements
     * @param LabelElement|null $labelElement
     */
    public function __construct(ElementContainer $elements, LabelElement $labelElement = null)
    {
        $this->elements = $elements;
        $this->labelElement = $labelElement;
    }

    /**
     * @return string
     */
    public function render()
    {
        $html = '';

        if (!is_null($this->labelElement)) {
            $html .= $this->labelElement->render();
        }

        return $html.$this->elements->render();
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->elements->getId();
    }
}
