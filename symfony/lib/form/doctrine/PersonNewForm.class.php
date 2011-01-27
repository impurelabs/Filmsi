<?php
class PersonNewForm extends PersonForm
{
	public function configure()
  {
  	$this->useFields(array(
  		'first_name', 'last_name', 'date_of_birth', 'date_of_death', 'place_of_birth', 'meta_description', 'meta_keywords', 'url_key',
  		'filename', 'biography_teaser', 'biography_content', 'imdb', 'is_actor', 'is_director', 'is_scriptwriter',
  		'is_producer', 'photo_album_id', 'video_album_id', 'publish_date'
  	));
  	
  	$this->widgetSchema['date_of_birth'] = new sfWidgetFormInput();
  	$this->widgetSchema['date_of_death'] = new sfWidgetFormInput();
  	$this->widgetSchema['biography_teaser'] = new sfWidgetFormTextarea();
  	$this->widgetSchema['biography_content'] = new sfWidgetFormTextarea();
  	$this->widgetSchema['meta_description'] = new sfWidgetFormTextarea();
  	$this->widgetSchema['meta_keywords'] = new sfWidgetFormTextarea();
  	$this->widgetSchema['is_actor'] = new sfWidgetFormInputCheckbox(array('value_attribute_value' => 1));
  	$this->widgetSchema['is_director'] = new sfWidgetFormInputCheckbox(array('value_attribute_value' => 1));
  	$this->widgetSchema['is_scriptwriter'] = new sfWidgetFormInputCheckbox(array('value_attribute_value' => 1));
  	$this->widgetSchema['is_producer'] = new sfWidgetFormInputCheckbox(array('value_attribute_value' => 1));
  	$this->widgetSchema['file'] = new sfWidgetFormInputFile();
  	$this->widgetSchema['publish_date'] = new sfWidgetFormInput();
  	$this->widgetSchema['photo_album_id'] = new sfWidgetFormInputHidden();
  	$this->widgetSchema['video_album_id'] = new sfWidgetFormInputHidden();
  	
  	$this->validatorSchema['file'] = new sfValidatorFile();
	$this->validatorSchema['url_key'] = new sfValidatorRegex(array('pattern' => '/^[0-9a-z\-\_]+$/', 'required' => true));
	$this->validatorSchema['url_key']->setMessage('invalid', 'Caracterele admise sunt literele, cifrele, "-", "_"');
  }
  
  public function doSave($con = null)
  {
  	
 
    return parent::doSave($con);
  }
  
	public function updateObject($values = null)
  {
  	$object = parent::updateObject($values);
  	
  	$object->setUserId(sfContext::getInstance()->getUser()->getGuardUser()->getId());
  	
  	$file = $this->getValue('file');
    $filename = md5($file->getOriginalName() . time() . rand(0, 999999)).$file->getExtension($file->getOriginalExtension());
    $file->save(sfConfig::get('app_person_path').'/'.$filename);
    
    $object->setFilename($filename);
    $object->createFile();
  	
  	return $object;
  }
}