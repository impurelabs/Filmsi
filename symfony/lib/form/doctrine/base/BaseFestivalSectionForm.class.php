<?php

/**
 * FestivalSection form base class.
 *
 * @method FestivalSection getObject() Returns the current form's model object
 *
 * @package    filmsi
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseFestivalSectionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputHidden(),
      'name'                => new sfWidgetFormInputText(),
      'imdb_key'            => new sfWidgetFormInputText(),
      'festival_edition_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('FestivalEdition'), 'add_empty' => true)),
      'persons_list'        => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Person')),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'                => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'imdb_key'            => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'festival_edition_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('FestivalEdition'), 'required' => false)),
      'persons_list'        => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Person', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('festival_section[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'FestivalSection';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['persons_list']))
    {
      $this->setDefault('persons_list', $this->object->Persons->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->savePersonsList($con);

    parent::doSave($con);
  }

  public function savePersonsList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['persons_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Persons->getPrimaryKeys();
    $values = $this->getValue('persons_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Persons', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Persons', array_values($link));
    }
  }

}
