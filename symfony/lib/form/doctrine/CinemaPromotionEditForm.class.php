<?php
class CinemaPromotionEditForm extends CinemaPromotionForm
{
	public function configure()
  {
  	$this->useFields(array(
  		'name', 'filename', 'content', 'cinema_id'
  	));
  	
  	$this->widgetSchema['name'] = new sfWidgetFormInput();
  	$this->widgetSchema['filename'] = new sfWidgetFormInputFile();
  	$this->widgetSchema['content'] = new sfWidgetFormTextarea();
  	$this->widgetSchema['cinema_id'] = new sfWidgetFormInputHidden();
  	
  	$this->validatorSchema['filename'] = new sfValidatorFile();
	$this->validatorSchema['filename']->setOption('required', false);
  }
  
	public function updateObject($values = null)
  {
  	$file = $this->getValue('filename');
  	if(get_class($file) != 'sfValidatedFile'){
  		return parent::updateObject($values);
  	}
    
  	/* Delete old files */
    @unlink(sfConfig::get('app_cinemapromotion_path'). '/' . $this->getObject()->getFilename());
    @unlink(sfConfig::get('app_cinemapromotion_path'). '/t-' . $this->getObject()->getFilename());
    @unlink(sfConfig::get('app_cinemapromotion_path'). '/ts-' . $this->getObject()->getFilename());
    
  	$object = parent::updateObject($values);
  	
    $filename = md5($file->getOriginalName() . time() . rand(0, 999999)).$file->getExtension($file->getOriginalExtension());
    $file->save(sfConfig::get('app_cinemapromotion_path').'/'.$filename);
    
    $object->setFilename($filename);
    $object->createFile();
  	
  	return $object;
  }
}