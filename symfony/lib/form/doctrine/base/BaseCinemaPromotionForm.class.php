<?php

/**
 * CinemaPromotion form base class.
 *
 * @method CinemaPromotion getObject() Returns the current form's model object
 *
 * @package    filmsi
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCinemaPromotionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'        => new sfWidgetFormInputHidden(),
      'name'      => new sfWidgetFormInputText(),
      'filename'  => new sfWidgetFormInputText(),
      'content'   => new sfWidgetFormInputText(),
      'cinema_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Cinema'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'        => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'      => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'filename'  => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'content'   => new sfValidatorPass(array('required' => false)),
      'cinema_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Cinema'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('cinema_promotion[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CinemaPromotion';
  }

}
