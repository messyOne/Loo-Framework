<?php

namespace Loo\Helper;

/**
 * Creates hash values
 */
class Hash
{
    /**
     * @param mixed $value
     * @return string
     */
    public static function getShort($value)
    {
        return substr(md5($value), 0, 5);
    }
}
