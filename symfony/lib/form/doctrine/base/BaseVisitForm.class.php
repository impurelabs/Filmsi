<?php

/**
 * Visit form base class.
 *
 * @method Visit getObject() Returns the current form's model object
 *
 * @package    filmsi
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseVisitForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'library_id' => new sfWidgetFormInputText(),
      'url'        => new sfWidgetFormInputText(),
      'name'       => new sfWidgetFormInputText(),
      'ip'         => new sfWidgetFormInputText(),
      'created_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'library_id' => new sfValidatorInteger(array('required' => false)),
      'url'        => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'name'       => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'ip'         => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'created_at' => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('visit[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Visit';
  }

}
