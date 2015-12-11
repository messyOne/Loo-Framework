<?php

namespace Loo\Helper;

/**
 * Helper class for time calculation
 */
class Time
{
    /**
     * @param int $weeks
     *
     * @return int
     */
    public static function weeks($weeks)
    {
        return $weeks * self::days(7);
    }

    /**
     * @param int $days
     *
     * @return int
     */
    public static function days($days)
    {
        return $days * 24 * self::hours(1);
    }

    /**
     * @param int $hours
     *
     * @return int
     */
    public static function hours($hours)
    {
        return $hours * 60 * self::minutes(1);
    }

    /**
     * @param int $minutes
     *
     * @return int
     */
    public static function minutes($minutes)
    {
        return $minutes * 60;
    }

    /**
     * Wraps the PHP time() function.
     *
     * @return int
     */
    public static function now()
    {
        return time();
    }
}
