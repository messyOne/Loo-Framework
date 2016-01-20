<?php

namespace Loo\Helper;

use JsonSerializable;
use LogicException;

/**
 * Provides extended methods for simple array objects.
 */
class ArrayHelper
{
    /**
     * Checks if the given object is a associative array.
     *
     * @param array $array
     *
     * @return bool
     */
    public static function isAssoc(array $array)
    {
        return array_keys($array) !== range(0, count($array) - 1);
    }

    /**
     * Transform objects to arrays. Objects have to implement the JsonSerializable interface.
     *
     * @param JsonSerializable[] $objects
     *
     * @return array
     */
    public static function objectsToArrays(array $objects)
    {
        $result = [];

        foreach ($objects as $object) {
            if (!($object instanceof JsonSerializable)) {
                throw new LogicException('Object has to implement JsonSerializable interface');
            }

            $result[] = $object->jsonSerialize();
        }

        return $result;
    }
}
