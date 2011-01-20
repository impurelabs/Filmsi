<?php

/**
 * PhotoAlbum form.
 *
 * @package    filmsi
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PhotoAlbumForm extends BasePhotoAlbumForm
{
  public function configure()
  {
  	$this->useFields(array('name', 'publish_date'));
  	
  	$this->widgetSchema['publish_date'] = new sfWidgetFormInput();
  	$this->validatorSchema['publish_date'] = new sfValidatorDate();
  }
  
  public function updateObject($values = null)
  {
  	$object = parent::updateObject($values);
  	
  	$object->setUserId(sfContext::getInstance()->getUser()->getGuardUser()->getId());
  	
  	return $object;
  }
}
