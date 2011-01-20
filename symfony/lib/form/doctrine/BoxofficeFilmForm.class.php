<?php

/**
 * BoxofficeFilm form.
 *
 * @package    filmsi
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class BoxofficeFilmForm extends BaseBoxofficeFilmForm
{
  public function configure()
  {
  	$this->widgetSchema['type'] = new sfWidgetFormInputHidden();
  	$this->widgetSchema['film_1_id'] = new sfWidgetFormInputHidden();
  	$this->widgetSchema['film_2_id'] = new sfWidgetFormInputHidden();
  	$this->widgetSchema['film_3_id'] = new sfWidgetFormInputHidden();
  	$this->widgetSchema['film_4_id'] = new sfWidgetFormInputHidden();
  	$this->widgetSchema['film_5_id'] = new sfWidgetFormInputHidden();
  }
}
