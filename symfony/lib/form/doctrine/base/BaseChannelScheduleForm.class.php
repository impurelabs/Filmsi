<?php

/**
 * ChannelSchedule form base class.
 *
 * @method ChannelSchedule getObject() Returns the current form's model object
 *
 * @package    filmsi
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseChannelScheduleForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'        => new sfWidgetFormInputHidden(),
      'channel_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Channel'), 'add_empty' => true)),
      'film_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Film'), 'add_empty' => true)),
      'day'       => new sfWidgetFormDate(),
      'time_from'  => new sfWidgetFormInputText(),
      'time_to'  => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'        => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'channel_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Channel'), 'required' => false)),
      'film_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Film'), 'required' => false)),
      'day'       => new sfValidatorDate(),
      'time_from'  => new sfValidatorString(array('max_length' => 250, 'required' => true)),
      'time_to'  => new sfValidatorString(array('max_length' => 250, 'required' => true)),
    ));

    $this->widgetSchema->setNameFormat('channel_schedule[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ChannelSchedule';
  }

}
