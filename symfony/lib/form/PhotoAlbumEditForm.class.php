<?php
class PhotoAlbumEditForm extends PhotoAlbumForm
{
	public function configure()
	{
		parent::configure();
		
		$this->useFields(array('id', 'name', 'publish_date'));
		
		$this->widgetSchema['id'] = new sfWidgetFormInputHidden();
		
		
	}
	
}