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
  	$this->widgetSchema['filename'] = new sfWidgetFormInputFile();
  	
  	$this->validatorSchema['filename'] = new sfValidatorFile(array('required' => false));
    }
  
    public function updateObject($values = null)
    {
  	$object = parent::updateObject($values);

  	$object->setUserId(sfContext::getInstance()->getUser()->getGuardUser()->getId());

  	$file = $this->getValue('filename');
        
        if (get_class($file) != 'sfValidatedFile') {
            return $object;
        }

        $filename = md5($file->getOriginalName() . time() . rand(0, 999999)).$file->getExtension($file->getOriginalExtension());
        $file->save(sfConfig::get('app_stire_path').'/'.$filename);

        $object->setFilename($filename);
        $object->createFile();

  	return $object;
    }
}