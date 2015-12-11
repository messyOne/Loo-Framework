<?php

namespace Loo\Html;

/**
 * Represents a HTML textarea field.
 */
class TextareaElement extends NoneVoidElement
{
    /**
     * @param string $id
     * @param array  $htmlAttributes
     */
    public function __construct($id, array $htmlAttributes = [])
    {
        parent::__construct('textarea');

        $this->addAttributes(
            array_merge(
                [
                    'id' => $id,
                    'name' => $id,
                ],
                $htmlAttributes
            )
        );
    }
}
