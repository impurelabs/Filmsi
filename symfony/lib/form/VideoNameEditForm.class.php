<?php
class VideoNameEditForm extends VideoForm
{
	public function configure()
	{
		parent::configure();
		
		$this->useFields(array('id', 'name'));
		
		$this->widgetSchema['id'] = new sfWidgetFormInputHidden();
		
		
	}
	
}