<?php
class CinemaAdminForm extends CinemaForm
{
public function configure()
  {
  	$this->useFields(array(
  		'admin_user_id'
  	));
  	
  	$this->widgetSchema['admin_user_id'] = new sfWidgetFormInputHidden();
  }
}