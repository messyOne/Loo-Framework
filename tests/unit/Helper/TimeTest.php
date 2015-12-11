<?php

namespace Loo\Helper;

/**
 * Time tests
 */
class TimeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Weeks in seconds
     */
    public function testWeeks()
    {
        $weeksInSeconds = 60 * 60 * 24 * 7 * 2;

        $this->assertEquals($weeksInSeconds, Time::weeks(2));
    }

    /**
     * Days in seconds
     */
    public function testDays()
    {
        $daysInSeconds = 60 * 60 * 24 * 12;

        $this->assertEquals($daysInSeconds, Time::days(12));
    }

    /**
     * Hours in seconds
     */
    public function testHours()
    {
        $hoursInSeconds = 60 * 60 * 24;

        $this->assertEquals($hoursInSeconds, Time::hours(24));
    }

    /**
     * Minutes in seconds
     */
    public function testMinutes()
    {
        $minutesInSeconds = 60 * 35;

        $this->assertEquals($minutesInSeconds, Time::minutes(35));
    }
}
