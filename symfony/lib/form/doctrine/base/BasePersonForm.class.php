<?php

/**
 * Person form base class.
 *
 * @method Person getObject() Returns the current form's model object
 *
 * @package    filmsi
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePersonForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                    => new sfWidgetFormInputHidden(),
      'first_name'            => new sfWidgetFormInputText(),
      'last_name'             => new sfWidgetFormInputText(),
      'date_of_birth'         => new sfWidgetFormDate(),
      'date_of_death'         => new sfWidgetFormDate(),
      'place_of_birth'        => new sfWidgetFormInputText(),
      'filename'              => new sfWidgetFormInputText(),
      'biography_teaser'      => new sfWidgetFormInputText(),
      'biography_content'     => new sfWidgetFormInputText(),
      'meta_description'      => new sfWidgetFormInputText(),
      'meta_keywords'         => new sfWidgetFormInputText(),
      'url_key'               => new sfWidgetFormInputText(),
      'state'                 => new sfWidgetFormChoice(array('choices' => array(-1 => -1, 0 => 0, 1 => 1))),
      'imdb'                  => new sfWidgetFormInputText(),
      'is_actor'              => new sfWidgetFormInputText(),
      'is_director'           => new sfWidgetFormInputText(),
      'is_scriptwriter'       => new sfWidgetFormInputText(),
      'is_producer'           => new sfWidgetFormInputText(),
      'publish_date'          => new sfWidgetFormDate(),
      'user_id'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Author'), 'add_empty' => true)),
      'library_id'            => new sfWidgetFormInputText(),
      'photo_album_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PhotoAlbum'), 'add_empty' => true)),
      'video_album_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('VideoAlbum'), 'add_empty' => true)),
      'films_list'            => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Film')),
      'article_list'          => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Article')),
      'festival_section_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'FestivalSection')),
      'stires_list'           => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Stire')),
      'no_display'            => new sfWidgetFormInputCheckbox(array('value_attribute_value' => 1))
    ));

    $this->setValidators(array(
      'id'                    => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'first_name'            => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'last_name'             => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'date_of_birth'         => new sfValidatorDate(array('required' => false)),
      'date_of_death'         => new sfValidatorDate(array('required' => false)),
      'place_of_birth'        => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'filename'              => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'biography_teaser'      => new sfValidatorString(array('max_length' => 400, 'required' => false)),
      'biography_content'     => new sfValidatorPass(array('required' => false)),
      'meta_description'      => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'meta_keywords'         => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'url_key'               => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'state'                 => new sfValidatorChoice(array('choices' => array(0 => -1, 1 => 0, 2 => 1), 'required' => false)),
      'imdb'                  => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'is_actor'              => new sfValidatorPass(array('required' => false)),
      'is_director'           => new sfValidatorPass(array('required' => false)),
      'is_scriptwriter'       => new sfValidatorPass(array('required' => false)),
      'is_producer'           => new sfValidatorPass(array('required' => false)),
      'publish_date'          => new sfValidatorDate(array('required' => false)),
      'user_id'               => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Author'), 'required' => false)),
      'library_id'            => new sfValidatorInteger(array('required' => false)),
      'photo_album_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('PhotoAlbum'), 'required' => false)),
      'video_album_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('VideoAlbum'), 'required' => false)),
      'films_list'            => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Film', 'required' => false)),
      'article_list'          => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Article', 'required' => false)),
      'festival_section_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'FestivalSection', 'required' => false)),
      'stires_list'           => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Stire', 'required' => false)),
      'no_display'              => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('person[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Person';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['films_list']))
    {
      $this->setDefault('films_list', $this->object->Films->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['article_list']))
    {
      $this->setDefault('article_list', $this->object->Article->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['festival_section_list']))
    {
      $this->setDefault('festival_section_list', $this->object->FestivalSection->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['stires_list']))
    {
      $this->setDefault('stires_list', $this->object->Stires->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveFilmsList($con);
    $this->saveArticleList($con);
    $this->saveFestivalSectionList($con);
    $this->saveStiresList($con);

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

  public function saveArticleList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['article_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Article->getPrimaryKeys();
    $values = $this->getValue('article_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Article', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Article', array_values($link));
    }
  }

  public function saveFestivalSectionList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['festival_section_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->FestivalSection->getPrimaryKeys();
    $values = $this->getValue('festival_section_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('FestivalSection', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('FestivalSection', array_values($link));
    }
  }

  public function saveStiresList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['stires_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Stires->getPrimaryKeys();
    $values = $this->getValue('stires_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Stires', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Stires', array_values($link));
    }
  }

}
