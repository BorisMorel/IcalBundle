<?php

namespace BOMO\IcalBundle\Model;

use Kigkonsult\Icalcreator\CalendarComponent;
use Kigkonsult\Icalcreator\Vtimezone;

class Timezone
{
    /**
     * vTimezone object
     */
    private $tz;

    /**
     * @var CalendarComponent
     */
    private $standard;

    /**
     * @var CalendarComponent
     */
    private $daylight;


    public function __construct(array $config = array())
    {
        $this->tz = new Vtimezone($config);
    }

    public function getTzid()
    {
        return $this->tz->getTzid();
    }

    public function setTzid($tzid)
    {
        $this->tz->setTzid($tzid);


        return $this;
    }

    public function __call($name, $arguments)
    {
        if (method_exists($this->tz, $name)) {
            return call_user_func_array(array($this->tz, $name), $arguments);
        }
    }

    public function getTimezone()
    {
        return $this->tz;
    }

    /**
     * This function sets the properties for the STANDARD component
     * in the timezone.
     *
     * Configuration example for Europe/Paris:
     * <pre>
     * array(
     *   'dtstart'       => '19710101T030000',
     *   'tzoffsetto'    => '+0100',
     *   'tzoffsetfrom'  => '+0200',
     *   'rrule'         => array(
     *       'freq'      => 'YEARLY',
     *       'wkst'      => 'MO',
     *       'interval'  => 1,
     *       'bymonth'   => 10,
     *   ),
     *   'tzname'        => 'CET'
     *  )
     *  </pre>
     *
     * @author Florian Steinbauer <florian@acid-design.at>
     *
     * @param array $config
     *
     * @return Timezone
     */
    public function setStandard(array $config = array()){

        $this->standard  = $this->tz->newStandard();

        $this->standard->setConfig($config);

        return $this;
    }


    /**
     * This function sets the properties for the STANDARD component
     * in the timezone.
     *
     * Configuration example for Europe/Paris:
     * <pre>
     * array(
     *   'dtstart'       => '19710101T030000',
     *   'tzoffsetto'    => '+0200',
     *   'tzoffsetfrom'  => '+0100',
     *   'rrule'         => array(
     *       'freq'      => 'YEARLY',
     *       'wkst'      => 'MO',
     *       'interval'  => 1,
     *       'bymonth'   => 10,
     *   ),
     *   'tzname'        => 'CET'
     *  )
     *  </pre>
     *
     * @author Florian Steinbauer <florian@acid-design.at>
     *
     * @param array $config
     *
     * @return Timezone
     */
    public function setDaylight(array $config = array()){

        $this->daylight  = $this->tz->newDaylight();
        $this->daylight->setConfig($config);

        return $this;
    }
}
