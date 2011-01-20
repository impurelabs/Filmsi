<?php

/**
 * FestivalSection form.
 *
 * @package    filmsi
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class FestivalSectionForm extends BaseFestivalSectionForm
{
  public function configure()
  {
  	$this->widgetSchema['festival_edition_id'] = new sfWidgetFormInputHidden();
  }
}
