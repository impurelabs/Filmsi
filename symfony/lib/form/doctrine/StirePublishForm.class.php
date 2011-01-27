<?php
class StirePublishForm extends StireForm
{
    public function configure()
    {
  	$this->useFields(array(
  		'name', 'content_content', 'filename'
  	));
  	
  	$this->widgetSchema['name'] = new sfWidgetFormInput();
  	$this->widgetSchema['content_content'] = new sfWidgetFormTextarea();
  	$this->widgetSchema['file'] = new sfWidgetFormInputFile();
  	
  	$this->validatorSchema['file'] = new sfValidatorFile();
    }
  
    public function updateObject($values = null)
    {
  	$object = parent::updateObject($values);
  	
  	$object->setUserId(sfContext::getInstance()->getUser()->getGuardUser()->getId());
  	
  	$file = $this->getValue('file');
        $filename = md5($file->getOriginalName() . time() . rand(0, 999999)).$file->getExtension($file->getOriginalExtension());
        $file->save(sfConfig::get('app_stire_path').'/'.$filename);

        $object->setFilename($filename);
        $object->createFile();
    
  	return $object;
    }
}