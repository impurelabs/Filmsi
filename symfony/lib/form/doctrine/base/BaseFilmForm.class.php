<?php

/**
 * Film form base class.
 *
 * @method Film getObject() Returns the current form's model object
 *
 * @package    filmsi
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseFilmForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                   => new sfWidgetFormInputHidden(),
      'imdb'                 => new sfWidgetFormInputText(),
      'is_series'            => new sfWidgetFormInputText(),
      'name_ro'              => new sfWidgetFormInputText(),
      'name_en'              => new sfWidgetFormInputText(),
      'year'                 => new sfWidgetFormInputText(),
      'rating'               => new sfWidgetFormInputText(),
      'filename'             => new sfWidgetFormInputText(),
      'meta_description'     => new sfWidgetFormInputText(),
      'meta_keywords'        => new sfWidgetFormInputText(),
      'url_key'              => new sfWidgetFormInputText(),
      'duration'             => new sfWidgetFormInputText(),
      'is_type_film'         => new sfWidgetFormInputText(),
      'is_type_digital'      => new sfWidgetFormInputText(),
      'is_type_3d'           => new sfWidgetFormInputText(),
      'distribuitor'         => new sfWidgetFormInputText(),
      'description_teaser'   => new sfWidgetFormInputText(),
      'description_content'  => new sfWidgetFormInputText(),
      'publish_date'         => new sfWidgetFormDate(),
      'state'                => new sfWidgetFormChoice(array('choices' => array(-1 => -1, 0 => 0, 1 => 1))),
      'user_id'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Author'), 'add_empty' => true)),
      'library_id'           => new sfWidgetFormInputText(),
      'photo_album_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PhotoAlbum'), 'add_empty' => true)),
      'video_album_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('VideoAlbum'), 'add_empty' => true)),
      'status_in_production' => new sfWidgetFormInputText(),
      'status_cinema'        => new sfWidgetFormInputText(),
      'status_cinema_year'   => new sfWidgetFormInputText(),
      'status_cinema_month'  => new sfWidgetFormInputText(),
      'status_cinema_day'    => new sfWidgetFormInputText(),
      'status_dvd'           => new sfWidgetFormInputText(),
      'status_dvd_year'      => new sfWidgetFormInputText(),
      'status_dvd_month'     => new sfWidgetFormInputText(),
      'status_dvd_day'       => new sfWidgetFormInputText(),
      'status_bluray'        => new sfWidgetFormInputText(),
      'status_bluray_year'   => new sfWidgetFormInputText(),
      'status_bluray_month'  => new sfWidgetFormInputText(),
      'status_bluray_day'    => new sfWidgetFormInputText(),
      'status_online'        => new sfWidgetFormInputText(),
      'status_online_year'   => new sfWidgetFormInputText(),
      'status_online_month'  => new sfWidgetFormInputText(),
      'status_online_day'    => new sfWidgetFormInputText(),
      'background_filename'  => new sfWidgetFormInputText(),
      'genres_list'          => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Genre')),
      'persons_list'         => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Person')),
      'article_list'         => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Article')),
      'stires_list'          => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Stire')),
      'shops_list'           => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Shop')),
    ));

    $this->setValidators(array(
      'id'                   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'imdb'                 => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'is_series'            => new sfValidatorPass(array('required' => false)),
      'name_ro'              => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'name_en'              => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'year'                 => new sfValidatorPass(array('required' => false)),
      'rating'               => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'filename'             => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'meta_description'     => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'meta_keywords'        => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'url_key'              => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'duration'             => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'is_type_film'         => new sfValidatorPass(array('required' => false)),
      'is_type_digital'      => new sfValidatorPass(array('required' => false)),
      'is_type_3d'           => new sfValidatorPass(array('required' => false)),
      'distribuitor'         => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'description_teaser'   => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'description_content'  => new sfValidatorPass(array('required' => false)),
      'publish_date'         => new sfValidatorDate(array('required' => false)),
      'state'                => new sfValidatorChoice(array('choices' => array(0 => -1, 1 => 0, 2 => 1), 'required' => false)),
      'user_id'              => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Author'), 'required' => false)),
      'library_id'           => new sfValidatorInteger(array('required' => false)),
      'photo_album_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('PhotoAlbum'), 'required' => false)),
      'video_album_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('VideoAlbum'), 'required' => false)),
      'status_in_production' => new sfValidatorPass(array('required' => false)),
      'status_cinema'        => new sfValidatorPass(array('required' => false)),
      'status_cinema_year'   => new sfValidatorInteger(array('required' => false)),
      'status_cinema_month'  => new sfValidatorInteger(array('required' => false)),
      'status_cinema_day'    => new sfValidatorInteger(array('required' => false)),
      'status_dvd'           => new sfValidatorPass(array('required' => false)),
      'status_dvd_year'      => new sfValidatorInteger(array('required' => false)),
      'status_dvd_month'     => new sfValidatorInteger(array('required' => false)),
      'status_dvd_day'       => new sfValidatorInteger(array('required' => false)),
      'status_bluray'        => new sfValidatorPass(array('required' => false)),
      'status_bluray_year'   => new sfValidatorInteger(array('required' => false)),
      'status_bluray_month'  => new sfValidatorInteger(array('required' => false)),
      'status_bluray_day'    => new sfValidatorInteger(array('required' => false)),
      'status_online'        => new sfValidatorPass(array('required' => false)),
      'status_online_year'   => new sfValidatorInteger(array('required' => false)),
      'status_online_month'  => new sfValidatorInteger(array('required' => false)),
      'status_online_day'    => new sfValidatorInteger(array('required' => false)),
      'background_filename'  => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'genres_list'          => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Genre', 'required' => false)),
      'persons_list'         => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Person', 'required' => false)),
      'article_list'         => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Article', 'required' => false)),
      'stires_list'          => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Stire', 'required' => false)),
      'shops_list'           => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Shop', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('film[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Film';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['genres_list']))
    {
      $this->setDefault('genres_list', $this->object->Genres->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['persons_list']))
    {
      $this->setDefault('persons_list', $this->object->Persons->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['article_list']))
    {
      $this->setDefault('article_list', $this->object->Article->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['stires_list']))
    {
      $this->setDefault('stires_list', $this->object->Stires->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['shops_list']))
    {
      $this->setDefault('shops_list', $this->object->Shops->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveGenresList($con);
    $this->savePersonsList($con);
    $this->saveArticleList($con);
    $this->saveStiresList($con);
    $this->saveShopsList($con);

    parent::doSave($con);
  }

  public function saveGenresList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['genres_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Genres->getPrimaryKeys();
    $values = $this->getValue('genres_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Genres', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Genres', array_values($link));
    }
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

  public function saveShopsList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['shops_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Shops->getPrimaryKeys();
    $values = $this->getValue('shops_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Shops', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Shops', array_values($link));
    }
  }

}
