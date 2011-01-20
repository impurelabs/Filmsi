<?php

/**
 * FestivalSectionParticipant form base class.
 *
 * @method FestivalSectionParticipant getObject() Returns the current form's model object
 *
 * @package    filmsi
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseFestivalSectionParticipantForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputHidden(),
      'festival_section_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('FestivalSection'), 'add_empty' => true)),
      'film_imdb'           => new sfWidgetFormInputText(),
      'person_imdb'         => new sfWidgetFormInputText(),
      'is_winner'           => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'festival_section_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('FestivalSection'), 'required' => false)),
      'film_imdb'           => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'person_imdb'         => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'is_winner'           => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('festival_section_participant[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'FestivalSectionParticipant';
  }

}
