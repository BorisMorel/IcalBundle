<?php

namespace BOMO\IcalBundle\Model;

use kigkonsult\iCalcreator\valarm;

class Alarm
{
    /**
     * vAlarm object
     */
    private $alarm;

    public function __construct($object = null)
    {
        if ($object instanceOf valarm) {
            $this->alarm = $object;

        } else {
            $this->alarm = new valarm();

        }

    }

    public function setAction($action)
    {
        switch($action) {
        case 'DISPLAY':
            $this->alarm->setProperty('description', 'Need to be setted');
            $this->alarm->setProperty('trigger', '-PT1H', array('VALUE' => 'DURATION'));
            break;

        default:
            throw new \InvalidArgumentException('Only [DISPLAY] options are available');
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
