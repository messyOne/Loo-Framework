<?php

namespace Loo\Validation;

use Loo\L10n\L10n;

/**
 * Validate whether the string has the correct length.
 */
class Length extends AbstractValidation
{
    /**
     * @var int
     */
    private $min;
    /**
     * @var int
     */
    private $max;

    /**
     * @param int $min
     * @param int $max
     */
    public function __construct($min, $max)
    {
        parent::__construct();

        $this->min = $min;
        $this->max = $max;
    }

    /**
     * @param string $value
     *
     * @return bool
     */
    public function validate($value)
    {
        if (strlen($value) < $this->min) {
            $this->addError(L10n::msg('Value is too short'));
        } elseif (strlen($value) > $this->max) {
            $this->addError(L10n::msg('Value is too long'));
        }

        return !$this->getErrorStack()->hasErrors();
    }
}
