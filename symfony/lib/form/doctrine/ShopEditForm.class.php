<?php
class ShopEditForm extends ShopForm
{
public function configure()
  {
  	$this->useFields(array(
  		'name', 'email', 'phone', 'url', 'filename', 'description'
  	));
  	
  	$this->widgetSchema['description'] = new sfWidgetFormTextarea();
  	$this->widgetSchema['filename'] = new sfWidgetFormInputFile();
  	
  	$this->validatorSchema['email'] = new sfValidatorEmail();
  	$this->validatorSchema['filename'] = new sfValidatorFile(array('required' => false));
  }
  
	public function updateObject($values = null)
  {
  	//return parent::updateObject($values);
  	$file = $this->getValue('filename');
  	if(!isset($file)){
  		return parent::updateObject($values);
  	}
    
  	/* Delete old files */
    @unlink(sfConfig::get('app_shop_path'). '/' . $this->getObject()->getFilename());
    @unlink(sfConfig::get('app_shop_path'). '/t-' . $this->getObject()->getFilename());
    @unlink(sfConfig::get('app_shop_path'). '/ts-' . $this->getObject()->getFilename());
    
  	$object = parent::updateObject($values);
  	
    $filename = md5($file->getOriginalName() . time() . rand(0, 999999)).$file->getExtension($file->getOriginalExtension());
    $file->save(sfConfig::get('app_shop_path').'/'.$filename);
    
    $object->setFilename($filename);
    $object->createFile();
  	
  	return $object;
  }
}