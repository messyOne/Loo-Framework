<?php

namespace Loo\Html;

/**
 * Represents a radio element.
 */
class RadioElement extends InputElement
{
    /**
     * @param string $id
     * @param string $group
     * @param array  $value
     * @param array  $htmlAttributes
     */
    public function __construct($id, $group, $value, array $htmlAttributes)
    {
        parent::__construct('radio', $id, $htmlAttributes);

        $this->addAttributes(['name' => $group]);
        parent::setValue($value);
    }

    /**
     * Value will be ignored. Instead of that the box will be marked as checked.
     *
     * @param string $value
     * @return RadioElement
     */
    public function setValue($value)
    {
        $this->addAttributes(['checked' => 'checked']);

        return $this;
    }
}
