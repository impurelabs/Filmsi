<?php


require_once(dirname(__FILE__).'/../symfony/config/ProjectConfiguration.class.php');

$configuration = ProjectConfiguration::getApplicationConfiguration('backend', 'prod', false);
sfContext::createInstance($configuration)->dispatch();
