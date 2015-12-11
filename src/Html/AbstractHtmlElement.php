<?php

namespace Loo\Html;

/**
 * Elements represent simple html elements and provide the logic for this items.
 */
abstract class AbstractHtmlElement extends AbstractElement implements ElementInterface
{
    /** @var string */
    private $type = '';
    /** @var string */
    private $value;
    /** @var bool */
    private $isOblivious;

    /**
     * @param string $type
     */
    public function __construct($type)
    {
        $this->type = $type;
        $this->attributes = new Attributes();
    }

    /**
     * @param string $key
     *
     * @return mixed
     */
    public function getAttribute($key)
    {
        if (!$this->attributes->exists($key)) {
            return;
        }

        return $this->attributes->get($key);
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->getAttribute('id');
    }

    /**
     * @param string $value
     *
     * @return AbstractHtmlElement
     */
    public function setValue($value)
    {
        $this->value = htmlspecialchars(trim($value));

        return $this;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return bool
     */
    public function isEmpty()
    {
        return !trim($this->getValue());
    }

    /**
     * @param bool $isOblivious
     *
     * @return AbstractHtmlElement
     */
    public function setOblivious($isOblivious = true)
    {
        $this->isOblivious = $isOblivious;

        return $this;
    }

    /**
     * @return mixed
     */
    public function isOblivious()
    {
        return $this->isOblivious;
    }

    /**
     * @return string
     */
    protected function renderHtmlAttributes()
    {
        return $this->attributes->render();
    }

    abstract protected function renderValue();
}
