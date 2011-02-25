<?php
class ChannelNewForm extends ChannelForm
{
	public function configure()
  {
  	$this->useFields(array(
  		'name', 'filename'
  	));
  	
  	$this->widgetSchema['name'] = new sfWidgetFormInput();
  	$this->widgetSchema['file'] = new sfWidgetFormInputFile();
  	
  	$this->validatorSchema['file'] = new sfValidatorFile();
  }
  
	public function updateObject($values = null)
  {
  	$object = parent::updateObject($values);
  	
  	$file = $this->getValue('file');
    $filename = md5($file->getOriginalName() . time() . rand(0, 999999)).$file->getExtension($file->getOriginalExtension());
    $file->save(sfConfig::get('app_channel_path').'/'.$filename);
    
    $object->setFilename($filename);
    $object->createFile();
  	
  	return $object;
  }
}