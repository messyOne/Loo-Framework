<?php

namespace Loo\Html;

/**
 * Represents a checkbox element
 */
class CheckboxElement extends InputElement
{
    /**
     * @param string $id
     * @param string $group
     * @param array  $value
     * @param array  $htmlAttributes
     */
    public function __construct($id, $group, $value, array $htmlAttributes)
    {
        parent::__construct('checkbox', $id, $htmlAttributes);

        $this->addAttributes(['name' => $group.'['.$value.']']);
        parent::setValue($value);
    }

    /**
     * @param string $value
     * @return CheckboxElement
     */
    public function setValue($value)
    {
        $this->addAttributes(['checked' => 'checked']);

        return $this;
    }
}
