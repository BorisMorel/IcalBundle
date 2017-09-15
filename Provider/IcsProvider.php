<?php

namespace BOMO\IcalBundle\Provider;


use BOMO\IcalBundle\Model\Timezone,
    BOMO\IcalBundle\Model\Calendar,
    BOMO\IcalBundle\Model\Event,
    BOMO\IcalBundle\Model\Alarm
    ;

class IcsProvider
{
    public function createTimezone(array $config = array(), $timezoneType = FALSE)
    {
        return new Timezone($config, $timezoneType);
    }

    public function createCalendar(Timezone $tz = null, $allowNullTimezone = FALSE)
    {
        if (is_null($tz) && false === $allowNullTimezone) {
            $tz = $this->createTimezone();
        }
        return new Calendar($tz);
    }

    public function createEvent()
    {
        return new Event();
    }

    public function createAlarm()
    {
        return new Alarm();
    }
}
