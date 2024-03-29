<?php

/**
 * PersonAlert form base class.
 *
 * @method PersonAlert getObject() Returns the current form's model object
 *
 * @package    personsi
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePersonAlertForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'      => new sfWidgetFormInputHidden(),
      'user_id'    => new sfWidgetFormInputHidden(),
      'person_id' => new sfWidgetFormInputHidden(),
      'cinema'  => new sfWidgetFormInputCheckbox(array('value_attribute_value' => '1')),
      'dbo'  => new sfWidgetFormInputCheckbox(array('value_attribute_value' => '1')),
      'stire'  => new sfWidgetFormInputCheckbox(array('value_attribute_value' => '1')),
      'tv'  => new sfWidgetFormInputCheckbox(array('value_attribute_value' => '1')),
    ));

    $this->setValidators(array(
		'id'      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
		'user_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'required' => false)),
		'person_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Person'), 'required' => false)),
		'cinema'    => new sfValidatorPass(array('required' => false)),
		'dbo'    => new sfValidatorPass(array('required' => false)),
		'stire'    => new sfValidatorPass(array('required' => false)),
		'tv'    => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('person_alert[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PersonAlert';
  }

}
