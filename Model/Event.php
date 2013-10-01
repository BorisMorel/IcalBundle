<?php

namespace BOMO\IcalBundle\Model;

class Event
{
    /**
     * vEvent object
     */
    private $event;

    /**
     * To ignore hours
     */
    private $allDayEvent;

    public function __construct($param)
    {
        if (is_array($param)) {
            $this->event = new \vevent($param);
        } elseif ($param instanceOf \vevent) {
            $this->event = $param;
        } else {
            throw new InvalidArgumentException('Invalid constructor parameter');
        }
    }

    public function setStartDate(\Datetime $date)
    {
        $params = array();
        if (true === $this->allDayEvent) {
            $params = array("VALUE" => "DATE");
        }

        $this->event->setProperty("DTSTART", $this->datetimeToArray($date), $params);

        return $this;
    }

    public function setEndDate(\Datetime $date)
    {
        $params = array();
        if (true === $this->allDayEvent) {
            $params = array("VALUE" => "DATE");
        }

        $this->event->setProperty("DTEND", $this->datetimeToArray($date), $params);
        
        return $this;
    }

    public function isAllDayEvent()
    {
        $this->allDayEvent = true;

        return $this;
    }

    public function setName($name)
    {
        $this->event->setProperty('summary', $name);

        return $this;
    }

    private function datetimeToArray(\Datetime $datetime)
    {
        $str = $datetime->format('Y-m-d H:i:s');

        return date_parse($str);
    }

    public function getEvent()
    {
        return $this->event;
    }
}