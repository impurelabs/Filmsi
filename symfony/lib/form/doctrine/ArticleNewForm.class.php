<?php
class ArticleNewForm extends ArticleForm 
{
	public function configure()
  {
  	$this->useFields(array(
  		'name', 'content_teaser', 'content_content', 'filename', 'meta_description', 'meta_keywords', 'about_stars', 'url_key',
  		'expiration_date', 'publish_date', 'category_list', 'photo_album_id', 'video_album_id'
  	));
  	
  	$this->widgetSchema['name'] = new sfWidgetFormInput();
  	$this->widgetSchema['content_teaser'] = new sfWidgetFormTextarea();
  	$this->widgetSchema['content_content'] = new sfWidgetFormTextarea();
  	$this->widgetSchema['file'] = new sfWidgetFormInputFile();
  	$this->widgetSchema['meta_description'] = new sfWidgetFormTextarea();
  	$this->widgetSchema['meta_keywords'] = new sfWidgetFormTextarea();
  	$this->widgetSchema['about_stars'] = new sfWidgetFormInputCheckbox(array('value_attribute_value' => 1));
  	$this->widgetSchema['publish_date'] = new sfWidgetFormInput();
  	$this->widgetSchema['expiration_date'] = new sfWidgetFormInput();
  	$this->widgetSchema['category_list'] = new sfWidgetFormDoctrineChoice(array(
  		'multiple' => true,
  		'expanded' => true,
  		'model' => 'Category'
  	));
  	$this->widgetSchema['photo_album_id'] = new sfWidgetFormInputHidden();
  	$this->widgetSchema['video_album_id'] = new sfWidgetFormInputHidden();
  	
  	$this->validatorSchema['file'] = new sfValidatorFile();
	$this->validatorSchema['url_key'] = new sfValidatorRegex(array('pattern' => '/^[0-9a-z\-\_]+$/', 'required' => true));
	$this->validatorSchema['url_key']->setMessage('invalid', 'Caracterele admise sunt literele, cifrele, "-", "_"');
  }
  
	public function updateObject($values = null)
  {
  	$object = parent::updateObject($values);
  	
  	$object->setUserId(sfContext::getInstance()->getUser()->getGuardUser()->getId());
  	
  	$file = $this->getValue('file');
    $filename = md5($file->getOriginalName() . time() . rand(0, 999999)).$file->getExtension($file->getOriginalExtension());
    $file->save(sfConfig::get('app_article_path').'/'.$filename);
    
    $object->setFilename($filename);
    $object->createFile();
    
  	
  	return $object;
  }
}