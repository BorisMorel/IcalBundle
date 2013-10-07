<?php

namespace BOMO\IcalBundle\Provider;


use BOMO\IcalBundle\Model\Timezone,
    BOMO\IcalBundle\Model\Calendar,
    BOMO\IcalBundle\Model\Event,
    BOMO\IcalBundle\Model\Alarm
    ;

class IcsProvider
{
    public function createTimezone(array $config = array())
    {
        return new Timezone($config);
    }

    public function createCalendar(Timezone $tz)
    {
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