<?php
class PhotoUploadForm extends PhotoForm
{
	public function configure()
	{
		parent::configure();
		
		$this->useFields(array('album_id'));
		
		$this->widgetSchema['album_id'] = new sfWidgetFormInputHidden();
		
		$this->widgetSchema['file'] = new sfWidgetFormInputFile();
		$this->validatorSchema['file'] = new sfValidatorFile(array('max_size' => sfConfig::get('app_photos_maxfilesize'),
		                                                           'mime_types' => 'web_images'));
		
		
	}
	
	public function doSave($con = null)
	{
		$file = $this->getValue('file');

		$this->getObject()->setFilename(md5($file->getOriginalName() . microtime() . rand(0, 999999)).$file->getExtension($file->getOriginalExtension()));
		
		$this->getObject()->createFile(
			$file->getTempName(), 
			$file->getType()
		);
      
		return parent::doSave($con);
	}
	
}