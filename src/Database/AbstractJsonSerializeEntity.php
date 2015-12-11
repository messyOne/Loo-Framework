<?php

namespace Loo\Database;

/**
 * Implements the JsonSerializable interface and provides a method to get all members in a array for json encoding.
 */
abstract class AbstractJsonSerializeEntity implements \JsonSerializable, EntityInterface
{
    /**
     * (PHP 5 &gt;= 5.4.0)<br/>
     * Specify data which should be serialized to JSON.
     *
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     *
     * @return mixed data which can be serialized by <b>json_encode</b>,
     *               which is a value of any type other than a resource.
     */
    public function jsonSerialize()
    {
        $json = [];
        foreach ($this as $key => $value) {
            $json[$key] = $value;
        }

        return $json;
    }
}
