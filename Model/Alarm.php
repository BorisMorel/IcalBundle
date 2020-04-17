<?php

namespace BOMO\IcalBundle\Model;

use Kigkonsult\ICalcreator\Valarm;

class Alarm
{
    /**
     * vAlarm object
     */
    private $alarm;

    public function __construct($object = null)
    {
        if ($object instanceOf Valarm) {
            $this->alarm = $object;

        } else {
            $this->alarm = new Valarm();

        }

    }

    public function setAction($action)
    {
        switch($action) {
        case 'DISPLAY':
            $this->alarm->setDescription('Need to be setted');
            $this->alarm->setTrigger('-PT1H', array('VALUE' => 'DURATION'));
            break;

        default:
            throw new \InvalidArgumentException('Only [DISPLAY] options are available');
            break;
        }

        $this->alarm->setAction($action);

        return $this;
    }

    public function setDescription($desc)
    {
        $this->alarm->setDescription($desc);

        return $this;
    }

    public function setTrigger($str)
    {
        $this->alarm->setTrigger($str, array('VALUE' => 'DURATION'));

        return $this;
    }

    public function getAlarm()
    {
        return $this->alarm;
    }
}
