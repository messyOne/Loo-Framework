<?php

namespace Loo\Validation;

use Loo\L10n\L10n;

/**
 * Checks if a value is not empty. White lines will be ignored.
 */
class NotEmpty extends AbstractValidation
{
    /**
     * @param mixed $value
     *
     * @return bool
     */
    public function validate($value)
    {
        if (!trim($value)) {
            $this->addError(L10n::msg('Value is empty.'));
        }

        return !$this->getErrorStack()->hasErrors();
    }
}
