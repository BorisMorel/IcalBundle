<?php

namespace BOMO\IcalBundle\Model;

use kigkonsult\iCalcreator\vtimezone;

class Timezone
{
    /**
     * vTimezone object
     */
    private $tz;

    /**
     * @var \calendarComponent
     */
    private $standard;

    /**
     * @var \calendarComponent
     */
    private $daylight;


    public function __construct(array $config = array(), $timezoneType = FALSE)
    {
        $this->tz = new vtimezone($timezoneType, $config);
    }

    public function getTzid()
    {
        return $this->tz->getProperty('tzid');
    }

    public function setTzid($tzid)
    {
        $this->tz->setProperty('tzid', $tzid);

        return $this;
    }

    public function setProperty($prop, $value)
    {
        $this->tz->setProperty($prop, $value);

        return $this;
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

        $this->standard  = $this->tz->newComponent( "standard" );

        foreach($config as $prop => $value){
            $this->standard->setProperty($prop, $value);
        }

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

        $this->daylight  = $this->tz->newComponent( "daylight" );

        foreach($config as $prop => $value){
            $this->daylight->setProperty($prop, $value);
        }

        return $this;
    }
}