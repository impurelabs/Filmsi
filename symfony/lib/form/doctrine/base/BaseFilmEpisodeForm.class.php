<?php

/**
 * FilmEpisode form base class.
 *
 * @method FilmEpisode getObject() Returns the current form's model object
 *
 * @package    filmsi
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseFilmEpisodeForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'      => new sfWidgetFormInputHidden(),
      'imdb'    => new sfWidgetFormInputText(),
      'name'    => new sfWidgetFormInputText(),
      'season'  => new sfWidgetFormInputText(),
      'number'  => new sfWidgetFormInputText(),
      'film_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Film'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'imdb'    => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'name'    => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'season'  => new sfValidatorInteger(array('required' => true), array('invalid' => 'Valoarea trebuie sa fie un numar intreg. ex 1, 2, 3, 4 ...')),
      'number'  => new sfValidatorInteger(array('required' => true), array('invalid' => 'Valoarea trebuie sa fie un numar intreg. ex 1, 2, 3, 4 ...')),
      'film_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Film'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('film_episode[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'FilmEpisode';
  }

}
