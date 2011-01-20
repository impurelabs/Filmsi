<?php

/**
 * FilmStatus form base class.
 *
 * @method FilmStatus getObject() Returns the current form's model object
 *
 * @package    filmsi
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseFilmStatusForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'film_id'       => new sfWidgetFormInputHidden(),
      'in_production' => new sfWidgetFormInputText(),
      'cinema_status' => new sfWidgetFormInputText(),
      'cinema_year'   => new sfWidgetFormInputText(),
      'cinema_month'  => new sfWidgetFormInputText(),
      'cinema_day'    => new sfWidgetFormInputText(),
      'dvd_status'    => new sfWidgetFormInputText(),
      'dvd_year'      => new sfWidgetFormInputText(),
      'dvd_month'     => new sfWidgetFormInputText(),
      'dvd_day'       => new sfWidgetFormInputText(),
      'bluray_status' => new sfWidgetFormInputText(),
      'bluray_year'   => new sfWidgetFormInputText(),
      'bluray_month'  => new sfWidgetFormInputText(),
      'bluray_day'    => new sfWidgetFormInputText(),
      'online_status' => new sfWidgetFormInputText(),
      'online_year'   => new sfWidgetFormInputText(),
      'online_month'  => new sfWidgetFormInputText(),
      'online_day'    => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'film_id'       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('film_id')), 'empty_value' => $this->getObject()->get('film_id'), 'required' => false)),
      'in_production' => new sfValidatorPass(array('required' => false)),
      'cinema_status' => new sfValidatorPass(array('required' => false)),
      'cinema_year'   => new sfValidatorInteger(array('required' => false)),
      'cinema_month'  => new sfValidatorInteger(array('required' => false)),
      'cinema_day'    => new sfValidatorInteger(array('required' => false)),
      'dvd_status'    => new sfValidatorPass(array('required' => false)),
      'dvd_year'      => new sfValidatorInteger(array('required' => false)),
      'dvd_month'     => new sfValidatorInteger(array('required' => false)),
      'dvd_day'       => new sfValidatorInteger(array('required' => false)),
      'bluray_status' => new sfValidatorPass(array('required' => false)),
      'bluray_year'   => new sfValidatorInteger(array('required' => false)),
      'bluray_month'  => new sfValidatorInteger(array('required' => false)),
      'bluray_day'    => new sfValidatorInteger(array('required' => false)),
      'online_status' => new sfValidatorPass(array('required' => false)),
      'online_year'   => new sfValidatorInteger(array('required' => false)),
      'online_month'  => new sfValidatorInteger(array('required' => false)),
      'online_day'    => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('film_status[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'FilmStatus';
  }

}
