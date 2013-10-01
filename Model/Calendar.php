<?php

namespace BOMO\IcalBundle\Model;

class Calendar
{
    /**
     * vCalendar object
     */
    private $cal;

    public function __construct(array $config)
    {
        $this->cal = new \vcalendar($config);
        $this->cal->setProperty("method", "PUBLISH");
        $this->cal->setProperty("x-wr-timezone", $config['TZID']);

        \iCalUtilityFunctions::createTimezone($this->cal, $config['TZID'], array("x-lic-location" => $config['TZID']));
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

    public function returnCalendar()
    {
        return $this->cal->returnCalendar();
    }
}