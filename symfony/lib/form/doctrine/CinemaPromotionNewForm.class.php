<?php
class CinemaPromotionNewForm extends CinemaPromotionForm 
{
	public function configure()
  {
  	$this->useFields(array(
  		'name', 'filename', 'content', 'cinema_id'
  	));
  	
  	$this->widgetSchema['name'] = new sfWidgetFormInput();
  	$this->widgetSchema['file'] = new sfWidgetFormInputFile();
  	$this->widgetSchema['content'] = new sfWidgetFormTextarea();
  	$this->widgetSchema['cinema_id'] = new sfWidgetFormInputHidden();
  	
  	$this->validatorSchema['file'] = new sfValidatorFile();
  }
  
	public function updateObject($values = null)
  {
  	$object = parent::updateObject($values);
  	
  	$file = $this->getValue('file');
    $filename = md5($file->getOriginalName() . time() . rand(0, 999999)).$file->getExtension($file->getOriginalExtension());
    $file->save(sfConfig::get('app_cinemapromotion_path').'/'.$filename);
    
    $object->setFilename($filename);
    $object->createFile();
  	
  	return $object;
  }
}