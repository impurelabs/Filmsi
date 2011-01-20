<?php

/**
 * Stire form base class.
 *
 * @method Stire getObject() Returns the current form's model object
 *
 * @package    filmsi
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseStireForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                    => new sfWidgetFormInputHidden(),
      'name'                  => new sfWidgetFormInputText(),
      'content_teaser'        => new sfWidgetFormInputText(),
      'content_content'       => new sfWidgetFormInputText(),
      'filename'              => new sfWidgetFormInputText(),
      'meta_description'      => new sfWidgetFormInputText(),
      'meta_keywords'         => new sfWidgetFormInputText(),
      'url_key'               => new sfWidgetFormInputText(),
      'about_stars'           => new sfWidgetFormInputText(),
      'publish_date'          => new sfWidgetFormDate(),
      'expiration_date'       => new sfWidgetFormDate(),
      'state'                 => new sfWidgetFormChoice(array('choices' => array(-1 => -1, 0 => 0, 1 => 1))),
      'user_id'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Author'), 'add_empty' => true)),
      'library_id'            => new sfWidgetFormInputText(),
      'photo_album_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PhotoAlbum'), 'add_empty' => true)),
      'video_album_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('VideoAlbum'), 'add_empty' => true)),
      'person_list'           => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Person')),
      'film_list'             => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Film')),
      'cinema_list'           => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Cinema')),
      'festival_edition_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'FestivalEdition')),
    ));

    $this->setValidators(array(
      'id'                    => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'                  => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'content_teaser'        => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'content_content'       => new sfValidatorPass(array('required' => false)),
      'filename'              => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'meta_description'      => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'meta_keywords'         => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'url_key'               => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'about_stars'           => new sfValidatorPass(array('required' => false)),
      'publish_date'          => new sfValidatorDate(array('required' => false)),
      'expiration_date'       => new sfValidatorDate(array('required' => false)),
      'state'                 => new sfValidatorChoice(array('choices' => array(0 => -1, 1 => 0, 2 => 1), 'required' => false)),
      'user_id'               => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Author'), 'required' => false)),
      'library_id'            => new sfValidatorInteger(array('required' => false)),
      'photo_album_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('PhotoAlbum'), 'required' => false)),
      'video_album_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('VideoAlbum'), 'required' => false)),
      'person_list'           => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Person', 'required' => false)),
      'film_list'             => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Film', 'required' => false)),
      'cinema_list'           => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Cinema', 'required' => false)),
      'festival_edition_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'FestivalEdition', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('stire[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Stire';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['person_list']))
    {
      $this->setDefault('person_list', $this->object->Person->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['film_list']))
    {
      $this->setDefault('film_list', $this->object->Film->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['cinema_list']))
    {
      $this->setDefault('cinema_list', $this->object->Cinema->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['festival_edition_list']))
    {
      $this->setDefault('festival_edition_list', $this->object->FestivalEdition->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->savePersonList($con);
    $this->saveFilmList($con);
    $this->saveCinemaList($con);
    $this->saveFestivalEditionList($con);

    parent::doSave($con);
  }

  public function savePersonList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['person_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Person->getPrimaryKeys();
    $values = $this->getValue('person_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Person', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Person', array_values($link));
    }
  }

  public function saveFilmList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['film_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Film->getPrimaryKeys();
    $values = $this->getValue('film_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Film', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Film', array_values($link));
    }
  }

  public function saveCinemaList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['cinema_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Cinema->getPrimaryKeys();
    $values = $this->getValue('cinema_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Cinema', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Cinema', array_values($link));
    }
  }

  public function saveFestivalEditionList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['festival_edition_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->FestivalEdition->getPrimaryKeys();
    $values = $this->getValue('festival_edition_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('FestivalEdition', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('FestivalEdition', array_values($link));
    }
  }

}
