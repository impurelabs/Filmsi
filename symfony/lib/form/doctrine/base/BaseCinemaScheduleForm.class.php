<?php

/**
 * CinemaSchedule form base class.
 *
 * @method CinemaSchedule getObject() Returns the current form's model object
 *
 * @package    filmsi
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCinemaScheduleForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'        => new sfWidgetFormInputHidden(),
      'cinema_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Cinema'), 'add_empty' => true)),
      'film_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Film'), 'add_empty' => true)),
      'day'       => new sfWidgetFormDate(),
      'schedule'  => new sfWidgetFormInputText(),
      'format'    => new sfWidgetFormChoice(array('choices' => array('pelicula' => 'pelicula', 'digital' => 'digital', '3d' => '3d'))),
    ));

    $this->setValidators(array(
      'id'        => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'cinema_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Cinema'), 'required' => false)),
      'film_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Film'), 'required' => false)),
      'day'       => new sfValidatorDate(),
      'schedule'  => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'format'    => new sfValidatorChoice(array('choices' => array(0 => 'pelicula', 1 => 'digital', 2 => '3d'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('cinema_schedule[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CinemaSchedule';
  }

}
