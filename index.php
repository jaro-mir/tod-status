<?php
include_once('project/controller/widgetController.php');
include_once('project/lib/cache.class.php');

$cache = new Cache;
$cache->start();

$widget = new WidgetController();
$widget->invoke();

$cache->end();
