<?php

/**
 * Location form base class.
 *
 * @method Location getObject() Returns the current form's model object
 *
 * @package    filmsi
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseLocationForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'country'    => new sfWidgetFormInputText(),
      'region'     => new sfWidgetFormInputText(),
      'city'       => new sfWidgetFormInputText(),
      'importance' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'country'    => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'region'     => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'city'       => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'importance' => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('location[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Location';
  }

}
