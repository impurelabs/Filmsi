<?php
class CinemaNewForm extends CinemaForm 
{
	public function configure()
  {
  	$this->useFields(array(
  		'name', 'location_id', 'address', 'phone', 'website', 'room_count', 'lat', 'lng', 'seats', 'sound', 'ticket_price',
		'is_type_film', 'is_type_digital', 'is_type_3d', 'is_type_imax', 'url_key', 'filename', 'description_teaser', 'description_content',  'meta_description', 'meta_keywords',
		'publish_date', 'service_list', 'lat', 'lng', 'map_zoom', 'reservation_url', 'photo_album_id', 'cinemagia_pull_aid'
  	));
  	
  	$this->widgetSchema['name'] = new sfWidgetFormInput();
  	$this->widgetSchema['location_id'] = new sfWidgetFormInputHidden();
  	$this->widgetSchema['location'] = new sfWidgetFormInput();
  	$this->widgetSchema['address'] = new sfWidgetFormTextarea();
  	$this->widgetSchema['phone'] = new sfWidgetFormInput();
  	$this->widgetSchema['website'] = new sfWidgetFormInput();
	$this->widgetSchema['room_count'] = new sfWidgetFormChoice(array(
		'choices' => array_combine(range(1, 40), range(1, 40))
	));
  	$this->widgetSchema['seats'] = new sfWidgetFormInput();
  	$this->widgetSchema['sound'] = new sfWidgetFormInput();
  	$this->widgetSchema['ticket_price'] = new sfWidgetFormTextarea();
  	$this->widgetSchema['is_type_film'] = new sfWidgetFormInputCheckbox(array('value_attribute_value' => 1));
  	$this->widgetSchema['is_type_digital'] = new sfWidgetFormInputCheckbox(array('value_attribute_value' => 1));
  	$this->widgetSchema['is_type_3d'] = new sfWidgetFormInputCheckbox(array('value_attribute_value' => 1));
  	$this->widgetSchema['is_type_imax'] = new sfWidgetFormInputCheckbox(array('value_attribute_value' => 1));
  	$this->widgetSchema['file'] = new sfWidgetFormInputFile();
  	$this->widgetSchema['description_teaser'] = new sfWidgetFormTextarea();
  	$this->widgetSchema['description_content'] = new sfWidgetFormTextarea();
  	$this->widgetSchema['meta_description'] = new sfWidgetFormTextarea();
  	$this->widgetSchema['meta_keywords'] = new sfWidgetFormTextarea();
  	$this->widgetSchema['publish_date'] = new sfWidgetFormInput();
  	$this->widgetSchema['service_list'] = new sfWidgetFormDoctrineChoice(array(
  		'multiple' => true,
  		'expanded' => true, 
  		'model' => 'Service'
  	));
	$this->widgetSchema['map_zoom'] = new sfWidgetFormInputHidden();
  	$this->widgetSchema['photo_album_id'] = new sfWidgetFormInputHidden();
  	
  	$this->validatorSchema['file'] = new sfValidatorFile();
  	$this->validatorSchema['location'] = new sfValidatorString();
  	$this->validatorSchema['lat'] = new sfValidatorString(array('max_length' => 250, 'required' => true));
  	$this->validatorSchema['lng'] = new sfValidatorString(array('max_length' => 250, 'required' => true));
	$this->validatorSchema['url_key'] = new sfValidatorRegex(array('pattern' => '/^[0-9a-z\-\_]+$/', 'required' => false));
	$this->validatorSchema['url_key']->setMessage('invalid', 'Caracterele admise sunt literele, cifrele, "-", "_"');

	$this->setDefault('map_zoom', '6');
  }
  
	public function updateObject($values = null)
	{
		$file = $this->getValue('file');
		
		$object = parent::updateObject($values);

		$object->setUserId(sfContext::getInstance()->getUser()->getGuardUser()->getId());

		$object->setFilename(md5($file->getOriginalName() . microtime() . rand(0, 999999)).$file->getExtension($file->getOriginalExtension()));
		
		$object->createFile(
			$file->getTempName(), 
			$file->getType()
		);
		
		return $object;
	}
}