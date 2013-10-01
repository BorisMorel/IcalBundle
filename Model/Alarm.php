<?php

namespace BOMO\IcalBundle\Model;

class Alarm
{
    /**
     * vAlarm object
     */
    private $alarm;

    public function __construct($param)
    {
        if (is_array($param)) {
            $this->alarm = new \valarm($param);
            
        } elseif ($param instanceOf \valarm) {
            $this->alarm = $param;

        } else {
            throw new InvalidArgumentException('Invalid constructor parameter');
            
        }
        
    }

    public function setAction($action)
    {
        switch($action) {
        case 'display':
            $this->alarm->setProperty('description', 'Need to be setted');
            $this->alarm->setProperty('trigger', '-PT1H', array('VALUE' => 'DURATION'));
            break;

        default:
            throw new \InvalidArgumentException('Only [display] options are available');
            break;
        }

        $this->alarm->setProperty('action', $action);

        return $this;
    }

    public function setDescription($desc)
    {
        $this->alarm->setProperty('description', $desc);

        return $this;
    }

    public function setTrigger($str)
    {
        $this->alarm->setProperty('trigger', $str, array('VALUE' => 'DURATION'));

        return $this;
    }

    public function getAlarm()
    {
        return $this->alarm;
    }
}