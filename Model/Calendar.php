<?php

namespace BOMO\IcalBundle\Model;

use kigkonsult\iCalcreator\vcalendar;

class Calendar
{
    /**
     * vCalendar object
     */
    private $cal;

    /**
     * Timezone object
     */
    private $tz;

    public function __construct(Timezone $tz)
    {
        $this->tz = $tz;
        $this->cal = new vcalendar();
        $this->cal->setProperty("x-wr-timezone", $tz->getTzid());
        $this->cal->addComponent($tz->getTimezone());
    }

    public function setMethod($method)
    {
        $this->cal->setProperty("method", $method);

        return $this;
    }

    public function setUniqueId($uniqId)
    {
        $this->cal->unique_id = $uniqId;

        return $this;
    }

    public function setName($name)
    {
        $this->cal->setProperty("x-wr-calname", $name);
        
        return $this;
    }
    
    public function setDescription($desc)
    {
        $this->cal->setProperty("x-wr-caldesc", $desc);

        return $this;
    }

    public function newEvent()
    {
        return new Event($this->cal->newComponent('vevent'));
    }

    public function attachEvent(Event $event)
    {
        $this->cal->setComponent($event->getEvent());

        return $this;
    }

    public function getCalendar()
    {
        return $this->cal;
    }

    public function returnCalendar($uid = null)
    {
        $str = $this->cal->createCalendar($uid);

        if (false === mb_check_encoding($str, 'UTF-8')) {
            $str = utf8_encode($str);
        } 

        return $str;
    }
}
