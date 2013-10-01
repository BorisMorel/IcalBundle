BOMOIcalBundle
==============

This bundle is used for... // TODO //

## Overview

```php
$icsManager = $this->get('bomo_ical.ics_provider');

$icsManager
    ->setUniqueId('imag.fr')
    ->setTimezone('Europe/Paris')
    ;

$cal = $icsManager->createCalendar();

$cal
    ->setName('Test')
    ->setDescription('Desc')
    ;

$event = $cal->newEvent();
$event
    ->setStartDate(new \Datetime('now'))
    ->setEndDate(new \Datetime('+5 hours'))
    ->setName('MON EVENT ATTACH')
    ;
```

## Versions

2013/10/01 : first version

## Actual state

This bundle is in beta

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



## Configuration example

``` yaml
```

