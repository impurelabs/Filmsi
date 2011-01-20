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
		
		$filename = md5(rand(0, 9000000)) . $file->getExtension($file->getOriginalExtension());
		
		// Set the filename for the object
    $this->getObject()->setFilename($filename);		
    $this->getObject()->createFile($file->getTempName(), $filename);

      
		return parent::doSave($con);
	}
	
}