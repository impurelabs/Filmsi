<?php

/**
 * VideoAlbum form base class.
 *
 * @method VideoAlbum getObject() Returns the current form's model object
 *
 * @package    filmsi
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseVideoAlbumForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'name'         => new sfWidgetFormInputText(),
      'library_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Library'), 'add_empty' => true)),
      'state'        => new sfWidgetFormChoice(array('choices' => array(-1 => -1, 0 => 0, 1 => 1))),
      'publish_date' => new sfWidgetFormDate(),
      'user_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Author'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'         => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'library_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Library'), 'required' => false)),
      'state'        => new sfValidatorChoice(array('choices' => array(0 => -1, 1 => 0, 2 => 1), 'required' => false)),
      'publish_date' => new sfValidatorDate(array('required' => false)),
      'user_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Author'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('video_album[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'VideoAlbum';
  }

}
