<?php
class StireEditForm extends StireForm
{
public function configure()
  {
  	$this->useFields(array(
  		'name', 'content_teaser', 'content_content', 'filename', 'meta_description', 'meta_keywords', 'about_stars', 'url_key',
  		'expiration_date', 'publish_date', 'photo_album_id', 'video_album_id'
  	));
  	
  	$this->widgetSchema['name'] = new sfWidgetFormInput();
  	$this->widgetSchema['content_teaser'] = new sfWidgetFormTextarea();
  	$this->widgetSchema['content_content'] = new sfWidgetFormTextarea();
  	$this->widgetSchema['filename'] = new sfWidgetFormInputFile();
  	$this->widgetSchema['meta_description'] = new sfWidgetFormTextarea();
  	$this->widgetSchema['meta_keywords'] = new sfWidgetFormTextarea();
  	$this->widgetSchema['about_stars'] = new sfWidgetFormInputCheckbox(array('value_attribute_value' => 1));
  	$this->widgetSchema['publish_date'] = new sfWidgetFormInput();
  	$this->widgetSchema['expiration_date'] = new sfWidgetFormInput();
  	$this->widgetSchema['photo_album_id'] = new sfWidgetFormInputHidden();
  	$this->widgetSchema['video_album_id'] = new sfWidgetFormInputHidden();
  	
  	$this->validatorSchema['filename'] = new sfValidatorFile(array('required' => false));
	$this->validatorSchema['url_key'] = new sfValidatorRegex(array('pattern' => '/^[0-9a-z\-\_]+$/', 'required' => false));
	$this->validatorSchema['url_key']->setMessage('invalid', 'Caracterele admise sunt literele, cifrele, "-", "_"');
  }
  
	public function updateObject($values = null)
  {
  	//return parent::updateObject($values);
  	$file = $this->getValue('filename');
  	if(!isset($file)){
  		return parent::updateObject($values);
  	}
    
  	/* Delete old files */
    @unlink(sfConfig::get('app_stire_path'). '/' . $this->getObject()->getFilename());
    @unlink(sfConfig::get('app_stire_path'). '/t-' . $this->getObject()->getFilename());
    @unlink(sfConfig::get('app_stire_path'). '/ts-' . $this->getObject()->getFilename());
    
  	$object = parent::updateObject($values);
  	
    $filename = md5($file->getOriginalName() . time() . rand(0, 999999)).$file->getExtension($file->getOriginalExtension());
    $file->save(sfConfig::get('app_stire_path').'/'.$filename);
    
    $object->setFilename($filename);
    $object->createFile();
  	
  	return $object;
  }
}