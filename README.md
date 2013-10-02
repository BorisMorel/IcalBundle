BOMOIcalBundle
==============

This bundle is used to create an ics file or url to populate a shared calendar with events.

## Overview

```php
<?php
public function getIcs()
{
    $icsManager = $this->get('bomo_ical.ics_provider');
    
    $icsManager
        ->setUniqueId('imag.fr')
        ->setTimezone('Europe/Paris')
        ;
    
    $cal = $icsManager->createCalendar();
    
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
        ->setAction('display')
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

2013/10/01 : first version

## Actual state

This bundle is in **beta**

## Installation

Add BOMOIcalBundle in your composer.json

```js
{
    "require": {
        "bomo/ical-bundle": "*"
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

## Object reference

###Provider
```php
this function setUniqueId($uniquId);
this function setTimezone($tz);
Calendar function createCalendar();
Event function createEvent();
Alarm function createAlarm();
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
this function setAction($action); //Currently, only 'display' action is setted.
this function setDescription($desc);
this function setTrigger($trigger);
valarm function getAlarm();
```

## Configuration example

Currently, this bundle doesn't required any configuration section.
