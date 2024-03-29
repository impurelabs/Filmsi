<?php

require_once dirname(__FILE__).'/../lib/vendor/symfony/lib/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
  public function setup()
  {
  	$this->setWebDir($this->getRootDir().'/../public_html');
    $this->enablePlugins('sfDoctrinePlugin', 'sfDoctrineGuardPlugin', 'sfThumbnailPlugin');
  }
}
