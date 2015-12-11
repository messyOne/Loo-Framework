<?php

namespace Loo\Validation;

use Loo\Core\FactoryInterface;

/**
 * Creates Validation related instances.
 */
class ValidationFactory implements FactoryInterface
{
    /**
     * @return Validator
     */
    public function getValidator()
    {
        return new Validator();
    }

    /**
     * @param int $min
     * @param int $max
     *
     * @return Length
     */
    public function getLengthValidation($min, $max)
    {
        return new Length($min, $max);
    }

    /**
     * @return NotEmpty
     */
    public function getNotEmptyValidation()
    {
        return new NotEmpty();
    }
}
