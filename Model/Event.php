<?php

namespace BOMO\IcalBundle\Model;

use Kigkonsult\Icalcreator\Vevent;

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
        if ($object instanceOf Vevent) {
            $this->event = $object;
        } else {
            $this->event = new Vevent();
        }
    }

    public function setStartDate(\Datetime $date)
    {
        $params = array();
        if (true === $this->isAllDayEvent) {
            $params = array("VALUE" => "DATE");
        }

        $this->event->setDtstart($date, $params);

        return $this;
    }

    public function setEndDate(\Datetime $date)
    {
        $params = array();
        if (true === $this->isAllDayEvent) {
            $params = array("VALUE" => "DATE");
        }

        $this->event->setDtend($date, $params);

        return $this;
    }

    public function setIsAllDayEvent($bool = true)
    {
        $this->isAllDayEvent = $bool;

        return $this;
    }

    public function setName($name)
    {
        $this->event->setSummary($name);

        return $this;
    }

    public function setLocation($loc)
    {
        $this->event->setLocation($loc);

        return $this;
    }

    public function setDescription($desc)
    {
        $this->event->setDescription($desc);

        return $this;
    }

    public function setComment($comment)
    {
        $this->event->setComment($comment);

        return $this;
    }

    public function setAttendee($attendee)
    {
        $this->event->setAttendee($attendee);

        return $this;
    }

    public function setOrganizer($organizer)
    {
        $this->event->setOrganizer($organizer);

        return $this;
    }

    public function setStatus($status)
    {
        $this->event->setStatus($status);

        return $this;
    }

    public function setTransparent($name)
    {
        $this->event->setTransp($name);

        return $this;
    }

    public function setPriority($value)
    {
        $this->event->setPriority($value);

        return $this;
    }

    public function setSequence($value)
    {
        $this->event->setSequence($value);

        return $this;
    }

    public function setUrl($url)
    {
        $this->event->setUrl($url);

        return $this;
    }

    public function newAlarm()
    {
        return new Alarm($this->event->newValarm(), $this->event);
    }

    public function attachAlarm(Alarm $alarm)
    {
        $this->event->setComponent($alarm->getAlarm());

        return $this;
    }

    public function __call($name, $arguments)
    {
        if (method_exists($this->event, $name)) {
            return call_user_func_array(array($this->event, $name), $arguments);
        }
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
