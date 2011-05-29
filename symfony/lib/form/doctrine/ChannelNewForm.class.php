<?php
class ChannelNewForm extends ChannelForm
{
	public function configure()
  {
  	$this->useFields(array(
  		'name', 'cinemagia_pull_aid'
  	));
  	
  	$this->widgetSchema['name'] = new sfWidgetFormInput();
  	$this->widgetSchema['file'] = new sfWidgetFormInputFile();
  	
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