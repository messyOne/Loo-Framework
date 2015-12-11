<?php

namespace Loo\Html;

/**
 * Represents a html label element
 */
class LabelElement extends NoneVoidElement
{
    /**
     * @param string $id
     * @param string $label
     * @param string $forId
     */
    public function __construct($id, $label, $forId = '')
    {
        parent::__construct('label');

        $this->addAttributes(
            [
                'for' => $forId,
                'id' => $id,
            ]
        );
        $this->setValue($label);
    }
}
