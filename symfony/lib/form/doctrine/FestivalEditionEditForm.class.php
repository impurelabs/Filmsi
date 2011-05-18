<?php
class FestivalEditionEditForm extends FestivalEditionForm
{
public function configure()
  {
  	$this->useFields(array(
  		'festival_id', 'edition', 'description_teaser', 'description_content', 'meta_description', 'meta_keywords', 'url_key',
  		'publish_date', 'photo_album_id', 'video_album_id'
  	));

  	$this->widgetSchema['edition'] = new sfWidgetFormChoice(array(
		'choices' => array_combine(range(date('Y'), 1900), range(date('Y'), 1900))
	));
  	$this->widgetSchema['description_teaser'] = new sfWidgetFormTextarea();
  	$this->widgetSchema['description_content'] = new sfWidgetFormTextarea();
  	$this->widgetSchema['meta_description'] = new sfWidgetFormTextarea();
  	$this->widgetSchema['meta_keywords'] = new sfWidgetFormTextarea();
  	$this->widgetSchema['file'] = new sfWidgetFormInputFile();
  	$this->widgetSchema['publish_date'] = new sfWidgetFormInput();
  	$this->widgetSchema['photo_album_id'] = new sfWidgetFormInputHidden();
  	$this->widgetSchema['video_album_id'] = new sfWidgetFormInputHidden();
  	
  	$this->validatorSchema['edition'] = new sfValidatorNumber(array('required' => false, 'min' => 0, 'max' => 3000));
  	$this->validatorSchema['file'] = new sfValidatorFile(array('required' => false));
	$this->validatorSchema['url_key'] = new sfValidatorRegex(array('pattern' => '/^[0-9a-z\-\_]+$/', 'required' => false));
	$this->validatorSchema['url_key']->setMessage('invalid', 'Caracterele admise sunt literele, cifrele, "-", "_"');
	$this->validatorSchema->setPostValidator(new sfValidatorDoctrineUnique(array(
		'model' => 'FestivalEdition',
		'column' => array('edition', 'festival_id')
	)));
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