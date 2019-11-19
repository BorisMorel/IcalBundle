<?php

namespace BOMO\IcalBundle\Model;

use kigkonsult\iCalcreator\vevent;

class Event
{
    /**
     * vEvent object
     */
    private $event;

    /**
     * To ignore hours
     */
    private $isAllDayEvent;

    public function __construct($object = null)
    {
        if ($object instanceOf vevent) {
            $this->event = $object;
        } else {
            $this->event = new vevent();
        }
    }

    public function setStartDate(\Datetime $date)
    {
        $params = array();
        if (true === $this->isAllDayEvent) {
            $params = array("VALUE" => "DATE");
        }

        $this->event->setProperty("DTSTART", $this->datetimeToArray($date), $params);

        return $this;
    }

    public function setEndDate(\Datetime $date)
    {
        $params = array();
        if (true === $this->isAllDayEvent) {
            $params = array("VALUE" => "DATE");
        }

        $this->event->setProperty("DTEND", $this->datetimeToArray($date), $params);

        return $this;
    }

    public function setIsAllDayEvent($bool = true)
    {
        $this->isAllDayEvent = $bool;

        return $this;
    }

    public function setName($name)
    {
        $this->event->setProperty('summary', $name);

        return $this;
    }

    public function setLocation($loc)
    {
        $this->event->setProperty('LOCATION', $loc);

        return $this;
    }

    public function setDescription($desc)
    {
        $this->event->setProperty('description', $desc);

        return $this;
    }

    public function setComment($comment)
    {
        $this->event->setProperty('comment', $comment);

        return $this;
    }

    public function setAttendee($attendee)
    {
        $this->event->setProperty('attendee', $attendee);

        return $this;
    }

    public function setOrganizer($organizer)
    {
        $this->event->setProperty('organizer', $organizer);

        return $this;
    }

    public function setStatus($status)
    {
        $this->event->setProperty('status', $status);

        return $this;
    }

    public function setTransparent($name)
    {
        $this->event->setProperty('TRANSP', $name);

        return $this;
    }

    public function setPriority($value)
    {
        $this->event->setProperty('PRIORITY', $value);

        return $this;
    }

    public function setSequence($value)
    {
        $this->event->setProperty('SEQUENCE', $value);

        return $this;
    }

    public function setUrl($url)
    {
        $this->event->setProperty('URL', $url);

        return $this;
    }

    public function newAlarm()
    {
        return new Alarm($this->event->newComponent('valarm'), $this->event);
    }

    public function attachAlarm(Alarm $alarm)
    {
        $this->event->setComponent($alarm->getAlarm());

        return $this;
    }

    public function getProperty($prop)
    {
        return $this->event->getProperty($prop);
    }

    public function getEvent()
    {
        return $this->event;
    }

    private function datetimeToArray(\Datetime $datetime)
    {
        $str = $datetime->format('Y-m-d H:i:s');

        $date = date_parse($str);
        $date['min'] = $date['minute'];
        $date['sec'] = $date['second'];
        unset($date['minute'], $date['second']);

        $date['tz'] = $datetime->format('e');

        return $date;
    }
}
