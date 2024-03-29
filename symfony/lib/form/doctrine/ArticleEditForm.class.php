<?php
class ArticleEditForm extends ArticleForm
{
public function configure()
  {
  	$this->useFields(array(
  		'name', 'content_teaser', 'content_content', 'meta_description', 'meta_keywords', 'about_stars', 'url_key',
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
  	
  	$this->validatorSchema['file'] = new sfValidatorFile(array('required' => false));
	$this->validatorSchema['url_key'] = new sfValidatorRegex(array('pattern' => '/^[0-9a-z\-\_]+$/', 'required' => false));
	$this->validatorSchema['url_key']->setMessage('invalid', 'Caracterele admise sunt literele, cifrele, "-", "_"');
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