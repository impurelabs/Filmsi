<?php

/**
 * Video form base class.
 *
 * @method Video getObject() Returns the current form's model object
 *
 * @package    filmsi
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseVideoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'       => new sfWidgetFormInputHidden(),
      'code'     => new sfWidgetFormInputText(),
      'name'     => new sfWidgetFormInputText(),
      'state'    => new sfWidgetFormChoice(array('choices' => array(-1 => -1, 0 => 0, 1 => 1))),
      'album_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Album'), 'add_empty' => true)),
      'position' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'code'     => new sfValidatorString(array('max_length' => 250)),
      'name'     => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'state'    => new sfValidatorChoice(array('choices' => array(0 => -1, 1 => 0, 2 => 1), 'required' => false)),
      'album_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Album'), 'required' => false)),
      'position' => new sfValidatorInteger(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Video', 'column' => array('position', 'album_id')))
    );

    $this->widgetSchema->setNameFormat('video[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Video';
  }

}
