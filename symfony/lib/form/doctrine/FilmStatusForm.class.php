<?php
class FilmStatusForm extends FilmForm
{
public function configure()
  {
  	$yearRange = array('0' => '');
  	for ($i = (int)date('Y') + 2; $i >= date('Y') - 20; $i--){
  		$yearRange[$i] =$i;
  	}
  	$monthRange = array('0' => '');
  	for ($i = 1; $i <= 12; $i++){
  		$monthRange[$i] =$i;
  	}
  	$dayRange = array('0' => '');
  	for ($i = 1; $i <= 31; $i++){
  		$dayRange[$i] =$i;
  	}
  	
  	$this->useFields(array(
  		'status_in_production', 'status_cinema', 'status_cinema_year', 'status_cinema_month', 'status_cinema_day',
  		'status_cinema', 'status_cinema_year', 'status_cinema_month', 'status_cinema_day',
  		'status_dvd', 'status_dvd_year', 'status_dvd_month', 'status_dvd_day',
  		'status_bluray', 'status_bluray_year', 'status_bluray_month', 'status_bluray_day',
  		'status_online', 'status_online_year', 'status_online_month', 'status_online_day',
  		'status_tv', 'status_tv_year', 'status_tv_month', 'status_tv_day',
  	));
  	
  	$this->widgetSchema['status_in_production'] = new sfWidgetFormInputCheckbox(array('value_attribute_value' => '1'));
  	$this->widgetSchema['status_cinema'] = new sfWidgetFormInputCheckbox(array('value_attribute_value' => '1'));
  	$this->widgetSchema['status_cinema_year'] = new sfWidgetFormChoice(array(
  		'choices' => $yearRange,
  		'multiple' => false,
  		'expanded' => false
  	));
  	$this->widgetSchema['status_cinema_month'] = new sfWidgetFormChoice(array(
  		'choices' => $monthRange,
  		'multiple' => false,
  		'expanded' => false
  	));
  	$this->widgetSchema['status_cinema_day'] = new sfWidgetFormChoice(array(
  		'choices' => $dayRange,
  		'multiple' => false,
  		'expanded' => false
  	));
  	$this->widgetSchema['status_dvd'] = new sfWidgetFormInputCheckbox(array('value_attribute_value' => '1'));
  	
  	$this->widgetSchema['status_dvd_year'] = new sfWidgetFormChoice(array(
  		'choices' => $yearRange,
  		'multiple' => false,
  		'expanded' => false
  	));
  	$this->widgetSchema['status_dvd_month'] = new sfWidgetFormChoice(array(
  		'choices' => $monthRange,
  		'multiple' => false,
  		'expanded' => false
  	));
  	$this->widgetSchema['status_dvd_day'] = new sfWidgetFormChoice(array(
  		'choices' => $dayRange,
  		'multiple' => false,
  		'expanded' => false
  	));
  	$this->widgetSchema['status_bluray'] = new sfWidgetFormInputCheckbox(array('value_attribute_value' => '1'));
  	$this->widgetSchema['status_bluray_year'] = new sfWidgetFormChoice(array(
  		'choices' => $yearRange,
  		'multiple' => false,
  		'expanded' => false
  	));
  	$this->widgetSchema['status_bluray_month'] = new sfWidgetFormChoice(array(
  		'choices' => $monthRange,
  		'multiple' => false,
  		'expanded' => false
  	));
  	$this->widgetSchema['status_bluray_day'] = new sfWidgetFormChoice(array(
  		'choices' => $dayRange,
  		'multiple' => false,
  		'expanded' => false
  	));
  	$this->widgetSchema['status_online'] = new sfWidgetFormInputCheckbox(array('value_attribute_value' => '1'));
  	$this->widgetSchema['status_online_year'] = new sfWidgetFormChoice(array(
  		'choices' => $yearRange,
  		'multiple' => false,
  		'expanded' => false
  	));
  	$this->widgetSchema['status_online_month'] = new sfWidgetFormChoice(array(
  		'choices' => $monthRange,
  		'multiple' => false,
  		'expanded' => false
  	));
  	$this->widgetSchema['status_online_day'] = new sfWidgetFormChoice(array(
  		'choices' => $dayRange,
  		'multiple' => false,
  		'expanded' => false
  	));
  	$this->widgetSchema['status_tv'] = new sfWidgetFormInputCheckbox(array('value_attribute_value' => '1'));
  	$this->widgetSchema['status_tv_year'] = new sfWidgetFormChoice(array(
  		'choices' => $yearRange,
  		'multiple' => false,
  		'expanded' => false
  	));
  	$this->widgetSchema['status_tv_month'] = new sfWidgetFormChoice(array(
  		'choices' => $monthRange,
  		'multiple' => false,
  		'expanded' => false
  	));
  	$this->widgetSchema['status_tv_day'] = new sfWidgetFormChoice(array(
  		'choices' => $dayRange,
  		'multiple' => false,
  		'expanded' => false
  	));
  	
  	
  }
}