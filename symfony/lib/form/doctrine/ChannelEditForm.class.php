<?php
class ChannelEditForm extends ChannelForm
{
public function configure()
  {
  	$this->useFields(array(
  		'name', 'filename'
  	));
  	
  	$this->widgetSchema['name'] = new sfWidgetFormInput();
  	$this->widgetSchema['filename'] = new sfWidgetFormInputFile();
  	
  	$this->validatorSchema['filename'] = new sfValidatorFile(array('required' => false));
  }
  
	public function updateObject($values = null)
  {
  	$file = $this->getValue('filename');
  	if(!isset($file)){
  		return parent::updateObject($values);
  	}
    
  	/* Delete old files */
    @unlink(sfConfig::get('app_channel_path'). '/' . $this->getObject()->getFilename());
    @unlink(sfConfig::get('app_channel_path'). '/t-' . $this->getObject()->getFilename());
    @unlink(sfConfig::get('app_channel_path'). '/ts-' . $this->getObject()->getFilename());
    
  	$object = parent::updateObject($values);
  	
    $filename = md5($file->getOriginalName() . time() . rand(0, 999999)).$file->getExtension($file->getOriginalExtension());
    $file->save(sfConfig::get('app_channel_path').'/'.$filename);
    
    $object->setFilename($filename);
    $object->createFile();
  	
  	return $object;
  }
}