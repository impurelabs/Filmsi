<?php

/**
 * Facility form base class.
 *
 * @method Facility getObject() Returns the current form's model object
 *
 * @package    filmsi
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseFacilityForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'name'            => new sfWidgetFormInputText(),
      'facilities_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Cinema')),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'            => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'facilities_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Cinema', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('facility[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Facility';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['facilities_list']))
    {
      $this->setDefault('facilities_list', $this->object->Facilities->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveFacilitiesList($con);

    parent::doSave($con);
  }

  public function saveFacilitiesList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['facilities_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Facilities->getPrimaryKeys();
    $values = $this->getValue('facilities_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Facilities', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Facilities', array_values($link));
    }
  }

}
