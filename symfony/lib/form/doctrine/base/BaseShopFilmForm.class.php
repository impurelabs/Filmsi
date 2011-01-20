<?php

/**
 * ShopFilm form base class.
 *
 * @method ShopFilm getObject() Returns the current form's model object
 *
 * @package    filmsi
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseShopFilmForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'      => new sfWidgetFormInputHidden(),
      'shop_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Shop'), 'add_empty' => true)),
      'film_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Film'), 'add_empty' => true)),
      'url'     => new sfWidgetFormInputText(),
      'format'  => new sfWidgetFormChoice(array('choices' => array('dvd' => 'dvd', 'bluray' => 'bluray', 'online' => 'online'))),
    ));

    $this->setValidators(array(
      'id'      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'shop_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Shop'), 'required' => false)),
      'film_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Film'), 'required' => false)),
      'url'     => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'format'  => new sfValidatorChoice(array('choices' => array(0 => 'dvd', 1 => 'bluray', 2 => 'online'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('shop_film[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ShopFilm';
  }

}
