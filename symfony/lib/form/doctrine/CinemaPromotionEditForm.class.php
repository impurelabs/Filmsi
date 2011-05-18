<?php
class CinemaPromotionEditForm extends CinemaPromotionForm
{
	public function configure()
  {
  	$this->useFields(array(
  		'name', 'content', 'cinema_id'
  	));
  	
  	$this->widgetSchema['name'] = new sfWidgetFormInput();
  	$this->widgetSchema['filename'] = new sfWidgetFormInputFile();
  	$this->widgetSchema['content'] = new sfWidgetFormTextarea();
  	$this->widgetSchema['cinema_id'] = new sfWidgetFormInputHidden();
  	
  	$this->validatorSchema['file'] = new sfValidatorFile();
	$this->validatorSchema['file']->setOption('required', false);
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