<?php

/**
 * Shop form base class.
 *
 * @method Shop getObject() Returns the current form's model object
 *
 * @package    filmsi
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseShopForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'name'        => new sfWidgetFormInputText(),
      'email'       => new sfWidgetFormInputText(),
      'phone'       => new sfWidgetFormInputText(),
      'url'         => new sfWidgetFormInputText(),
      'filename'    => new sfWidgetFormInputText(),
      'description' => new sfWidgetFormInputText(),
      'films_list'  => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Film')),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'        => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'email'       => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'phone'       => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'url'         => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'filename'    => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'description' => new sfValidatorPass(array('required' => false)),
      'films_list'  => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Film', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('shop[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Shop';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['films_list']))
    {
      $this->setDefault('films_list', $this->object->Films->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveFilmsList($con);

    parent::doSave($con);
  }

  public function saveFilmsList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['films_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Films->getPrimaryKeys();
    $values = $this->getValue('films_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Films', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Films', array_values($link));
    }
  }

}
