<?php

/**
 * Comment form base class.
 *
 * @method Comment getObject() Returns the current form's model object
 *
 * @package    filmsi
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCommentForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'name'       => new sfWidgetFormTextarea(),
      'email'      => new sfWidgetFormTextarea(),
      'content'    => new sfWidgetFormInputText(),
      'user_id'    => new sfWidgetFormInputText(),
      'state'      => new sfWidgetFormInputText(),
      'ip'         => new sfWidgetFormInputText(),
      'model'       => new sfWidgetFormInputText(),
      'model_library_id'       => new sfWidgetFormInputText(),
      'model_name'       => new sfWidgetFormInputText(),
      'created_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'       => new sfValidatorString(array('required' => false)),
      'email'      => new sfValidatorEmail(array('required' => false)),
      'content'    => new sfValidatorPass(array('required' => false)),
      'user_id'    => new sfValidatorInteger(array('required' => false)),
      'state'      => new sfValidatorPass(array('required' => false)),
      'ip'         => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'model'       => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'model_library_id'       => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'model_name'       => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'created_at' => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('comment[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Comment';
  }

}
