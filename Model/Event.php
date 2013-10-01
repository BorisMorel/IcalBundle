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

    public function getEvent()
    {
        return $this->event;
    }

    private function datetimeToArray(\Datetime $datetime)
    {
        $str = $datetime->format('Y-m-d H:i:s');

        return date_parse($str);
    }
}