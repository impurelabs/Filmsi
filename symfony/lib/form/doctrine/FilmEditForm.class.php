<?php
class FilmEditForm extends FilmForm
{
public function configure()
  {
  	$this->useFields(array(
  		'imdb', 'name_ro', 'name_en', 'year', 'rating', 'meta_description', 'meta_keywords', 'is_type_film', 'is_type_digital', 'is_type_3d', 'url_key',
  		'distribuitor', 'description_teaser', 'description_content', 'duration', 'publish_date', 'genres_list', 'photo_album_id', 'video_album_id'
  	));
  	
  	$this->widgetSchema['imdb'] = new sfWidgetFormInput();
  	$this->widgetSchema['name_ro'] = new sfWidgetFormInput();
  	$this->widgetSchema['name_en'] = new sfWidgetFormInput();
  	$this->widgetSchema['year'] = new sfWidgetFormInput();
  	$this->widgetSchema['rating'] = new sfWidgetFormChoice(array(
  		'choices' => array_merge(array('' => ''), array_combine(sfConfig::get('app_rating_types'), sfConfig::get('app_rating_types'))),
  		'multiple' => false,
  		'expanded' => false
  	));
  	$this->widgetSchema['meta_description'] = new sfWidgetFormTextarea();
  	$this->widgetSchema['meta_keywords'] = new sfWidgetFormTextarea();
  	$this->widgetSchema['is_type_film'] = new sfWidgetFormInputCheckbox(array('value_attribute_value' => 1));
  	$this->widgetSchema['is_type_digital'] = new sfWidgetFormInputCheckbox(array('value_attribute_value' => 1));
  	$this->widgetSchema['is_type_3d'] = new sfWidgetFormInputCheckbox(array('value_attribute_value' => 1));
  	$this->widgetSchema['distribuitor'] = new sfWidgetFormInput();
  	$this->widgetSchema['description_teaser'] = new sfWidgetFormTextarea();
  	$this->widgetSchema['description_content'] = new sfWidgetFormTextarea();
  	$this->widgetSchema['duration'] = new sfWidgetFormInput();
  	$this->widgetSchema['file'] = new sfWidgetFormInputFile();
  	$this->widgetSchema['publish_date'] = new sfWidgetFormInput();
  	$this->widgetSchema['genres_list'] = new sfWidgetFormDoctrineChoice(array(
  		'multiple' => true,
  		'expanded' => true, 
  		'model' => 'Genre'
  	));
  	$this->widgetSchema['photo_album_id'] = new sfWidgetFormInputHidden();
  	$this->widgetSchema['video_album_id'] = new sfWidgetFormInputHidden();
  	
  	$this->validatorSchema['year'] = new sfValidatorNumber(array('required' => false, 'min' => 0, 'max' => 3000));
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