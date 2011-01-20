<?php

/**
 * Homepage form.
 *
 * @package    filmsi
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class HomepageForm extends BaseHomepageForm
{
  public function configure()
  {
  	$this->useFields(array(
  		'background_filename'
  	));


  	$this->widgetSchema['background_filename'] = new sfWidgetFormInputFile();

  	$this->validatorSchema['background_filename'] = new sfValidatorFile(array('required' => false));
  }

	public function updateObject($values = null)
  {
  	//return parent::updateObject($values);
  	$file = $this->getValue('background_filename');
  	if(!isset($file)){
  		return parent::updateObject($values);
  	}

  	/* Delete old files */
    @unlink(sfConfig::get('app_homepage_background_path'). '/' . $this->getObject()->getBackgroundFilename());

  	$object = parent::updateObject($values);

    $backgroundFilename = md5($file->getOriginalName() . time() . rand(0, 999999)).$file->getExtension($file->getOriginalExtension());
    $file->save(sfConfig::get('app_homepage_background_path').'/'.$backgroundFilename);

    $object->setBackgroundFilename($backgroundFilename);

  	return $object;
  }
}
