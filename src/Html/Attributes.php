<?php

namespace Loo\Html;

use Loo\Core\AbstractRenderable;
use Loo\Data\Store;
use Loo\Helper\ArrayHelper;
use Loo\Exception\NotExistsException;
use Loo\Helper\Type;

/**
 * Contains attributes for Html elements.
 */
class Attributes extends AbstractRenderable
{
    /** @var Store */
    private $attributes;

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->attributes = new Store($attributes);
    }

    /**
     * @param array $attributes
     */
    public function add(array $attributes)
    {
        if (ArrayHelper::isAssoc($attributes)) {
            $this->attributes->setData($attributes);
        } else {
            foreach ($attributes as $attribute) {
                if (is_array($attribute)) {
                    $this->attributes->setData($attribute);
                } else {
                    $this->attributes->set($attribute, $attribute);
                }
            }
        }
    }

    /**
     * @param string $key
     *
     * @return mixed
     *
     * @throws NotExistsException
     */
    public function get($key)
    {
        if ($this->exists($key)) {
            return $this->attributes->get($key);
        }

        throw new NotExistsException('Field "'.$key.'" not exists.');
    }

    /**
     * @param string $key
     * @return bool
     */
    public function exists($key)
    {
        return $this->attributes->exists($key);
    }

    /**
     * @return string
     */
    public function render()
    {
        $attributes = '';

        foreach ($this->attributes->getAll() as $type => $values) {
            $attributes .= $this->renderField($type, $this->renderAttributeValues($values));
        }

        return $attributes;
    }

    /**
     * @param string|array $values
     *
     * @return string
     */
    private function renderAttributeValues($values)
    {
        $valueString = '';

        if (is_array($values)) {
            foreach ($values as $value) {
                $valueString .= $value.' ';
            }
        } else {
            $valueString = $values.' ';
        }

        return trim($valueString);
    }

    /**
     * @param string $name
     * @param string $value
     *
     * @return string
     */
    private function renderField($name, $value)
    {
        if (trim($value) !== '') {
            if (Type::isInt($name)) {
                return " {$value}";
            } else {
                return " {$name}=\"{$value}\"";
            }
        }

        return '';
    }
}
