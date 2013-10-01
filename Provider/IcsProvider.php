<?php

namespace BOMO\IcalBundle\Provider;


use BOMO\IcalBundle\Model\Calendar,
    BOMO\IcalBundle\Model\Event,
    BOMO\IcalBundle\Model\Alarm
    ;

class IcsProvider
{
    /**
     * Config array
     */
    private $config;

    public function __construct()
    {
        $this->config = array();
    }

    public function setUniqueId($uniqId)
    {
        $this->config['unique_id'] = $uniqId;

        return $this;
    }

    public function setTimezone($tz)
    {
        $this->config['TZID'] = $tz;

        return $this;
    }

    public function createCalendar()
    {
        return new Calendar($this->config);
    }

    public function createEvent()
    {
        return new Event($this->config);
    }

    public function createAlarm()
    {
        return new Alarm($this->config);
    }
}