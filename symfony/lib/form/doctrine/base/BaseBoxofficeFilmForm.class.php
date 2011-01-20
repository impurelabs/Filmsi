<?php

/**
 * BoxofficeFilm form base class.
 *
 * @method BoxofficeFilm getObject() Returns the current form's model object
 *
 * @package    filmsi
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseBoxofficeFilmForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'type'      => new sfWidgetFormInputHidden(),
      'film_1_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Film1'), 'add_empty' => true)),
      'film_2_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Film2'), 'add_empty' => true)),
      'film_3_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Film3'), 'add_empty' => true)),
      'film_4_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Film4'), 'add_empty' => true)),
      'film_5_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Film5'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'type'      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('type')), 'empty_value' => $this->getObject()->get('type'), 'required' => false)),
      'film_1_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Film1'), 'required' => false)),
      'film_2_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Film2'), 'required' => false)),
      'film_3_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Film3'), 'required' => false)),
      'film_4_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Film4'), 'required' => false)),
      'film_5_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Film5'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('boxoffice_film[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'BoxofficeFilm';
  }

}
