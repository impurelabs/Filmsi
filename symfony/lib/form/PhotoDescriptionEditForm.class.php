<?php
class PhotoDescriptionEditForm extends PhotoForm
{
	public function configure()
	{
		parent::configure();
		
		$this->useFields(array('id', 'description', 'on_home', 'is_redcarpet'));
		
		$this->widgetSchema['id'] = new sfWidgetFormInputHidden();
		
		
	}
	
}