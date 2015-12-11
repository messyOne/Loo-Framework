<?php

namespace Loo\Html;

use Loo\Core\AbstractRenderable;
use Loo\Helper\Type;

/**
 * Common methods of elements.
 */
abstract class AbstractElement extends AbstractRenderable implements ElementInterface
{
    /** @var Attributes */
    protected $attributes;

    /**
     * @param array $attributes
     *
     * @return AbstractHtmlElement
     */
    public function addAttributes(array $attributes)
    {
        $this->attributes->add($attributes);

        return $this;
    }

    /**
     * @param string $classes
     *
     * @return AbstractHtmlElement
     */
    public function addCssClasses($classes)
    {
        $addedClasses = ' ';

        if ($this->attributes->exists('class')) {
            $addedClasses .= Type::string($this->attributes->get('class'));
        }

        $this->attributes->add(['class' => $classes.$addedClasses]);

        return $this;
    }
}
