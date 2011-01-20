<?php
class ShopNewForm extends ShopForm 
{
	public function configure()
  {
  	$this->useFields(array(
  		'name', 'email', 'phone', 'url', 'filename', 'description'
  	));
  	
  	$this->widgetSchema['description'] = new sfWidgetFormTextarea();
  	$this->widgetSchema['file'] = new sfWidgetFormInputFile();
  	
  	$this->validatorSchema['email'] = new sfValidatorEmail();
  	$this->validatorSchema['file'] = new sfValidatorFile();
  }
  
	public function updateObject($values = null)
  {
  	$object = parent::updateObject($values);
  	
  	$file = $this->getValue('file');
    $filename = md5($file->getOriginalName() . time() . rand(0, 999999)).$file->getExtension($file->getOriginalExtension());
    $file->save(sfConfig::get('app_shop_path').'/'.$filename);
    
    $object->setFilename($filename);
    $object->createFile();
  	
  	return $object;
  }
}