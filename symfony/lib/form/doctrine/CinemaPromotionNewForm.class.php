<?php
class CinemaPromotionNewForm extends CinemaPromotionForm 
{
	public function configure()
  {
  	$this->useFields(array(
  		'name', 'content', 'cinema_id'
  	));
  	
  	$this->widgetSchema['name'] = new sfWidgetFormInput();
  	$this->widgetSchema['file'] = new sfWidgetFormInputFile();
  	$this->widgetSchema['content'] = new sfWidgetFormTextarea();
  	$this->widgetSchema['cinema_id'] = new sfWidgetFormInputHidden();
  	
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