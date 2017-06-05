<?php

namespace BOMO\IcalBundle\Model;

class Timezone
{
    /**
     * vTimezone object
     */
    private $tz;
    
    public function __construct(array $config = array(), $timezoneType = FALSE)
    {
        $this->tz = new \vtimezone($timezoneType, $config);
    }

    public function getTzid()
    {
        return $this->tz->getProperty('tzid');
    }

    public function setTzid($tzid)
    {
        $this->tz->setProperty('tzid', $tzid);

        return $this;
    }

    public function setProperty($prop, $value)
    {
        $this->tz->setProperty($prop, $value);

        return $this;
    }

    public function getTimezone()
    {
        return $this->tz;
    }
}