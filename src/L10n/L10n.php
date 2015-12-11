<?php

namespace Loo\L10n;

/**
 * Containing methods used for localization.
 */
class L10n
{
    /**
     * Example: t('%s is a invalid user or wrong password.', $name).
     *
     * @param string $string
     * @param array  $args
     *
     * @return string
     */
    public static function msgReplace($string, $args = null)
    {
        return _(sprintf($string, $args));
    }

    /**
     * Wrapps the _() function.
     *
     * @param string $string
     * @return string
     */
    public static function msg($string)
    {
        return _($string);
    }
}
