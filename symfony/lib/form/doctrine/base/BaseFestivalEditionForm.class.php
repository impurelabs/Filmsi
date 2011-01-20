<?php

/**
 * FestivalEdition form base class.
 *
 * @method FestivalEdition getObject() Returns the current form's model object
 *
 * @package    filmsi
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseFestivalEditionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputHidden(),
      'edition'             => new sfWidgetFormInputText(),
      'filename'            => new sfWidgetFormInputText(),
      'meta_description'    => new sfWidgetFormInputText(),
      'meta_keywords'       => new sfWidgetFormInputText(),
      'url_key'             => new sfWidgetFormInputText(),
      'description_teaser'  => new sfWidgetFormInputText(),
      'description_content' => new sfWidgetFormInputText(),
      'publish_date'        => new sfWidgetFormDate(),
      'state'               => new sfWidgetFormChoice(array('choices' => array(-1 => -1, 0 => 0, 1 => 1))),
      'festival_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Festival'), 'add_empty' => true)),
      'user_id'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Author'), 'add_empty' => true)),
      'library_id'          => new sfWidgetFormInputText(),
      'photo_album_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PhotoAlbum'), 'add_empty' => true)),
      'video_album_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('VideoAlbum'), 'add_empty' => true)),
      'article_list'        => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Article')),
      'stires_list'         => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Stire')),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'edition'             => new sfValidatorPass(),
      'filename'            => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'meta_description'    => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'meta_keywords'       => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'url_key'             => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'description_teaser'  => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'description_content' => new sfValidatorPass(array('required' => false)),
      'publish_date'        => new sfValidatorDate(array('required' => false)),
      'state'               => new sfValidatorChoice(array('choices' => array(0 => -1, 1 => 0, 2 => 1), 'required' => false)),
      'festival_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Festival'), 'required' => false)),
      'user_id'             => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Author'), 'required' => false)),
      'library_id'          => new sfValidatorInteger(array('required' => false)),
      'photo_album_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('PhotoAlbum'), 'required' => false)),
      'video_album_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('VideoAlbum'), 'required' => false)),
      'article_list'        => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Article', 'required' => false)),
      'stires_list'         => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Stire', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('festival_edition[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'FestivalEdition';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['article_list']))
    {
      $this->setDefault('article_list', $this->object->Article->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['stires_list']))
    {
      $this->setDefault('stires_list', $this->object->Stires->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveArticleList($con);
    $this->saveStiresList($con);

    parent::doSave($con);
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
