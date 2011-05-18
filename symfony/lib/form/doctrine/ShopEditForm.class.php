<?php
class ShopEditForm extends ShopForm
{
public function configure()
  {
  	$this->useFields(array(
  		'name', 'email', 'phone', 'url', 'description'
  	));
  	
  	$this->widgetSchema['description'] = new sfWidgetFormTextarea();
  	$this->widgetSchema['file'] = new sfWidgetFormInputFile();
  	
  	$this->validatorSchema['email'] = new sfValidatorEmail();
  	$this->validatorSchema['file'] = new sfValidatorFile(array('required' => false));
  }
  
	public function updateObject($values = null)
	{
		$file = $this->getValue('file');

		if(!isset($file)){
			unset($this['file']);
			return parent::updateObject($values);
		}

		$object = parent::updateObject($values);

		/* Delete the old files */
		$object->deleteFiles();

		$object->setFilename(md5($file->getOriginalName() . microtime() . rand(0, 999999)).$file->getExtension($file->getOriginalExtension()));

		$object->createFile(
			$file->getTempName(), 
			$file->getType()
		);

		return $object;
	}
}