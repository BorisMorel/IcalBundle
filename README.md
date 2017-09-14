BOMOIcalBundle
==============

This bundle is used to create an ics file or url to populate a shared calendar with events.

## Overview

```php
<?php
public function getIcs()
{
    $provider = $this->get('bomo_ical.ics_provider');

    $tz = $provider->createTimezone();
    $tz
        ->setTzid('Europe/Paris')
        ->setProperty('X-LIC-LOCATION', $tz->getTzid())
        ;

    $cal = $provider->createCalendar($tz);

    $cal
        ->setName('My cal1')
        ->setDescription('Foo')
        ;

    $datetime = new \Datetime('now');
    $event = $cal->newEvent();
    $event
        ->setStartDate($datetime)
        ->setEndDate($datetime->modify('+5 hours'))
        ->setName('Event 1')
        ->setDescription('Desc for event')
        ->setAttendee('foo@bar.me')
        ->setAttendee('John Do')
        ;

    $alarm = $event->newAlarm();
    $alarm
        ->setAction('DISPLAY')
        ->setDescription($event->getProperty('description'))
        ->setTrigger('-PT2H') //See Dateinterval string format
        ;

    // All Day event
    $event = $cal->newEvent();
    $event
        ->isAllDayEvent()
        ->setStartDate($datetime)
        ->setEndDate($datetime->modify('+10 days'))
        ->setName('All day event')
        ->setDescription('All day visualisation')
        ;

    $calStr = $cal->returnCalendar();

    return new Response(
        $calStr,
        200,
        array(
            'Content-Type' => 'text/calendar; charset=utf-8',
            'Content-Disposition' => 'attachment; filename="calendar.ics"',
        )
    );
}
```

## Versions

 - 2013/10/01 : first version
 - 2013/10/02 : Fix issue #2
 - 2013/10/07 : Fix issue #1
 - 2017/01/05 : Merge pull request #15; Now Kigkonsult is required by composer
 - 2017/04/07 : Merge pull request #18
 - 2017/06/07 : Merge pull request #20
 - 2017/06/08 : Merge pull request #19

## Actual state

This bundle is in **stable** state;

## Installation

Add BOMOIcalBundle in your composer.json

```js
{
    "require": {
        "bomo/ical-bundle": "1.0.*"
    }
}
```

Now tell composer to download the bundle by running the step:

``` bash
$ php composer.phar update bomo/ical-bundle
```

AppKernel.php

``` php
$bundles = array(
    ...
    new BOMO\IcalBundle\BOMOIcalBundle(),
);
```


## User's Guide
All objects can be managed regardless by the provider. But the object need to be attached.
>Event attached to Calendar

>Alarm attached to Event

To simplify the use, the objects are a proxy method to create a child feature.
```php
$alarm = $event->newAlarm();
$alarm
    ->set[...]
    [...]
    ;
```

Is stricly same that

```php
$alarm = $provider->createAlarm();
$alarm
    ->set[...]
    [...]
    ;
$event->attachAlarm($alarm);
```

#### Outlook compatibility
Outlook does not support the parameter "x-wr-timezone". To prevent adding it to the ics, the _createCalendar_ has a new 
parameter for defining whether or not to include a Timezone in the ics.
```php
$ical = $cal = $this->provider->createCalendar(null, true);
```

## Object reference

###Provider
```php
Timezone function createTimezone();
Calendar function createCalendar();
Event function createEvent();
Alarm function createAlarm();
```

* * * * *

###Timezone
```php
Timezone function __construct(array $config=null);
string function getTzid();
this function setTzid($tz);
this function setProperty($name, $value);
vtimezone function getTimezone();
```

* * * * *

###Calendar
```php
Calendar function __construct(array $config);
this function setName($name);
this function setDescription($desc);
Event function newEvent(); //Directly attached to this Calendar
this function attachEvent(Event $event)
string function returnCalendar();
vcalendar function getCalendar();
```

* * * * *

###Event
```php
Event function __construct(mixed $param);
this function setStartDate(Datetime $date);
this function setEndDate(Datetime $date);
this function isAllDayEvent();
this function setName($name);
this function setLocation($loc);
this function setDescription($desc);
this function setComment($comment);
this function setAttendee($attendee);
this function setOrganizer($org);
Alarm function newAlarm(); //Directly attached to this Event
this function attachAlarm(Alarm $alarm);
mixed function getProperty($prop);
vevent function getEvent();
```

* * * * *

###Alarm
```php
Alarm function __construct(mixed $param);
this function setAction($action); //Currently, only 'DISPLAY' action is setted.
this function setDescription($desc);
this function setTrigger($trigger);
valarm function getAlarm();
```

## Configuration example

Currently, this bundle doesn't required any configuration section.
