<?php
class FilmBackgroundForm extends FilmForm
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
    @unlink(sfConfig::get('app_film_background_path'). '/' . $this->getObject()->getBackgroundFilename());
    
  	$object = parent::updateObject($values);
  	//die('aaa:' . sfConfig::get('app_film_background_path'));
    $backgroundFilename = md5($file->getOriginalName() . time() . rand(0, 999999)).$file->getExtension($file->getOriginalExtension());
    $file->save(sfConfig::get('app_film_background_path').'/'.$backgroundFilename);
    
    $object->setBackgroundFilename($backgroundFilename);
  	
  	return $object;
  }
}