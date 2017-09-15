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

    /**
     * Calendar constructor.
     *
     * For compatibility with Outlook, we need to allow creating calendars without Timezone. This is due to the Property
     * "x-wr-timezone" is not supported, and using it derives in obtaining the following error:
     * "not supported calendar message"
     *
     * @param Timezone|null $tz
     */
    public function __construct(Timezone $tz = null)
    {
        $this->cal = new vcalendar();
        if(isset($tz)) {
            $this->tz = $tz;
            $this->cal->setProperty("x-wr-timezone", $tz->getTzid());
            $this->cal->addComponent($tz->getTimezone());
        }
    }

    public function setMethod($method)
    {
        $this->cal->setProperty("method", $method);

        return $this;
    }

    public function setUniqueId($uniqId)
    {
        $this->cal->setProperty("unique_id", $uniqId);

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
