<?php
class ShopNewForm extends ShopForm 
{
	public function configure()
  {
  	$this->useFields(array(
  		'name', 'email', 'phone', 'url', 'description'
  	));
  	
  	$this->widgetSchema['description'] = new sfWidgetFormTextarea();
  	$this->widgetSchema['file'] = new sfWidgetFormInputFile();
  	
  	$this->validatorSchema['email'] = new sfValidatorEmail();
  	$this->validatorSchema['file'] = new sfValidatorFile();
  }
  
	public function updateObject($values = null)
	{
		$file = $this->getValue('file');
		
		$object = parent::updateObject($values);

		$object->setFilename(md5($file->getOriginalName() . microtime() . rand(0, 999999)).$file->getExtension($file->getOriginalExtension()));
		
		$object->createFile(
			$file->getTempName(), 
			$file->getType()
		);
		
		return $object;
	}
}