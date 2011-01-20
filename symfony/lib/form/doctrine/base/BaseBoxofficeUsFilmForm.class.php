<?php

/**
 * BoxofficeUsFilm form base class.
 *
 * @method BoxofficeUsFilm getObject() Returns the current form's model object
 *
 * @package    filmsi
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseBoxofficeUsFilmForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'      => new sfWidgetFormInputHidden(),
      'film_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Film'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'film_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Film'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('boxoffice_us_film[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'BoxofficeUsFilm';
  }

}
