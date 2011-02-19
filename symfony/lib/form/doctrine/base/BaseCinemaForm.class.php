<?php

/**
 * Cinema form base class.
 *
 * @method Cinema getObject() Returns the current form's model object
 *
 * @package    filmsi
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCinemaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputHidden(),
      'name'                => new sfWidgetFormInputText(),
      'location_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Location'), 'add_empty' => true)),
      'address'             => new sfWidgetFormInputText(),
      'phone'               => new sfWidgetFormInputText(),
      'website'             => new sfWidgetFormInputText(),
      'lat'                 => new sfWidgetFormInputText(),
      'lng'                 => new sfWidgetFormInputText(),
      'map_zoom'            => new sfWidgetFormInputText(),
      'seats'               => new sfWidgetFormInputText(),
      'room_count'          => new sfWidgetFormInputText(),
      'sound'               => new sfWidgetFormInputText(),
      'is_type_film'        => new sfWidgetFormInputText(),
      'is_type_digital'     => new sfWidgetFormInputText(),
      'is_type_3d'          => new sfWidgetFormInputText(),
      'ticket_price'        => new sfWidgetFormTextarea(),
      'filename'            => new sfWidgetFormInputText(),
      'description_teaser'  => new sfWidgetFormInputText(),
      'description_content' => new sfWidgetFormInputText(),
      'meta_description'    => new sfWidgetFormInputText(),
      'meta_keywords'       => new sfWidgetFormInputText(),
      'url_key'             => new sfWidgetFormInputText(),
      'publish_date'        => new sfWidgetFormDate(),
      'state'               => new sfWidgetFormChoice(array('choices' => array(-1 => -1, 0 => 0, 1 => 1))),
      'user_id'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Author'), 'add_empty' => true)),
      'library_id'          => new sfWidgetFormInputText(),
      'service_list'        => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Service')),
      'article_list'        => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Article')),
      'stires_list'         => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Stire')),
      'reservation_url'     => new sfWidgetFormInputText(),
      'photo_album_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PhotoAlbum'), 'add_empty' => true)),
      'admin_user_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Admin'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'                => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'location_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Location'), 'required' => false)),
      'address'             => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'phone'               => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'website'             => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'lat'                 => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'lng'                 => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'map_zoom'            => new sfValidatorInteger(array('required' => false)),
      'seats'               => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'room_count'          => new sfValidatorInteger(array('required' => false)),
      'sound'               => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'is_type_film'        => new sfValidatorPass(array('required' => false)),
      'is_type_digital'     => new sfValidatorPass(array('required' => false)),
      'is_type_3d'          => new sfValidatorPass(array('required' => false)),
      'ticket_price'        => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'filename'            => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'description_teaser'  => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'description_content' => new sfValidatorPass(array('required' => false)),
      'meta_description'    => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'meta_keywords'       => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'url_key'             => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'publish_date'        => new sfValidatorDate(array('required' => false)),
      'state'               => new sfValidatorChoice(array('choices' => array(0 => -1, 1 => 0, 2 => 1), 'required' => false)),
      'user_id'             => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Author'), 'required' => false)),
      'library_id'          => new sfValidatorInteger(array('required' => false)),
      'service_list'        => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Service', 'required' => false)),
      'article_list'        => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Article', 'required' => false)),
      'stires_list'         => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Stire', 'required' => false)),
      'reservation_url'             => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'photo_album_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('PhotoAlbum'), 'required' => false)),
      'admin_user_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Admin'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('cinema[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Cinema';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['service_list']))
    {
      $this->setDefault('service_list', $this->object->Service->getPrimaryKeys());
    }

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
    $this->saveServiceList($con);
    $this->saveArticleList($con);
    $this->saveStiresList($con);

    parent::doSave($con);
  }

  public function saveServiceList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['service_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Service->getPrimaryKeys();
    $values = $this->getValue('service_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Service', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Service', array_values($link));
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

}
