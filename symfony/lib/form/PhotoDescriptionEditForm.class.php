<?php
class PhotoDescriptionEditForm extends PhotoForm
{
	public function configure()
	{
		parent::configure();
		
		$this->useFields(array('id', 'description'));
		
		$this->widgetSchema['id'] = new sfWidgetFormInputHidden();
		
		
	}
	
}