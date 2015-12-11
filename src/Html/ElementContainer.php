<?php

namespace Loo\Html;

use Loo\Core\AbstractRenderable;
use Loo\Data\Store;

/**
 * Wraps multiple elements and directs calls.
 */
class ElementContainer extends AbstractRenderable implements ElementInterface
{
    /**
     * @var Store
     */
    private $elements;
    /**
     * @var string
     */
    private $id;

    /**
     * @param string $id
     */
    public function __construct($id)
    {
        $this->elements = new Store();
        $this->id = $id;
    }

    /**
     * @param ElementInterface $element
     * @param string|null      $key
     */
    public function add(ElementInterface $element, $key = null)
    {
        if (is_null($key)) {
            $key = $element->getId();
        }
        $this->elements->set($key, $element);
    }

    /**
     * @param string|null $id
     * @return array|string
     */
    public function get($id = null)
    {
        if (is_null($id)) {
            return    $this->elements->getAll();
        }

        return $this->elements->get($id);
    }

    /**
     * @return string
     */
    public function render()
    {
        $output = '';
        /** @var AbstractElement[] $elementsIterator */
        $elementsIterator = $this->elements->getAll();

        foreach ($elementsIterator as $element) {
            $output .= $element->render();
        }

        return $output;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $value
     * @return ElementContainer
     */
    public function setValue($value)
    {
        if (is_null($this->elements->get('control'))) {
            if (is_array($value)) {
                // checkboxes
                foreach ($value as $v) {
                    $this->elements->get($this->getId().'_'.$v)->setValue($v);
                }
            } else {
                // radio
                $this->elements->get($this->getId().'_'.$value)->setValue($value);
            }
        } else {
            // default input field
            $this->elements->get('control')->setValue($value);
        }

        return $this;
    }

    /**
     * @param array $htmlAttributes
     * @return ElementContainer
     */
    public function addAttributes(array $htmlAttributes)
    {
        /** @var AbstractElement[] $elementsIterator */
        $elementsIterator = $this->elements->getAll();

        foreach ($elementsIterator as $elements) {
            // label elements does no inherit the attributes.
            if (!($elements instanceof LabelElement)) {
                $elements->addAttributes($htmlAttributes);
            }
        }

        return $this;
    }

    /**
     * @param string $classes
     * @return ElementContainer
     */
    public function addCssClasses($classes)
    {
        /** @var AbstractElement[] $elementsIterator */
        $elementsIterator = $this->elements->getAll();

        foreach ($elementsIterator as $elements) {
            $elements->addCssClasses($classes);
        }

        return $this;
    }
}
