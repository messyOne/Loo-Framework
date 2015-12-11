<?php

namespace Loo\Html;

/**
 * An input field defined by the type you inject.
 */
class InputElement extends VoidElement
{
    /**
     * @param string $type
     * @param string $id
     * @param array  $htmlAttributes
     */
    public function __construct($type, $id, array $htmlAttributes)
    {
        parent::__construct('input');

        $this->addAttributes(
            array_merge(
                [
                'type' => $type,
                'id' => $id,
                'name' => $id,
                ],
                $htmlAttributes
            )
        );
    }
}
