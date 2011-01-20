<?php

class ClientForm extends BasesfGuardUserAdminForm
{
  /**
   * @see sfForm
   */
  public function configure()
  {
  	unset($this['groups_list'], $this['permissions_list']);

	$this->widgetSchema['location'] = new sfWidgetFormInput();
	$this->widgetSchema['location_id'] = new sfWidgetFormInputHidden();
	$this->widgetSchema['dob'] = new sfWidgetFormDate(array(
		'format' => '%day%/%month%/%year%',
		'can_be_empty' => true,
		'empty_values' => array(
			'year' => 'An',
			'month' => 'Luna',
			'day' => 'Zi'
		),
		'months' => array('1' => 'Ianuarie', '2' => 'Februarie', '3' => 'Martie', '4' => 'Aprilie', '5' => 'Mai', '6' => 'Iunie', '7' => 'Iulie', '8' => 'August', '9' => 'Septembrie', '10' => 'Octombrie', '11' => 'Noiembrie', '12' => 'Decembrie'),
		'years' => array_combine(range(2010, 1900, 1), range(2010, 1900, 1))
	));
	$this->widgetSchema['gender'] = new sfWidgetFormChoice(array(
		'choices' => array(0 => 'Barbat', 1 => 'Femeie'),
		'multiple' => false,
		'expanded' => false
	));





	$this->validatorSchema['location'] = new sfValidatorString(array('required' => false));

	$this->validatorSchema['dob'] = new sfValidatorDate(array('required' => true), array(
		'required' => 'Acest camp e obligatoriu',
		'invalid' => 'Valoarea este invalida'
	));

	$this->validatorSchema['first_name'] = new sfValidatorString(array(
		'max_length' => 255,
		'required' => true
	), array(
		'required' => 'Acest camp este obligatoriu',
		'invalid' => 'Aceasta valoare este invalida'
	));

	$this->validatorSchema['last_name'] = new sfValidatorString(array(
		'max_length' => 255,
		'required' => true
	), array(
		'required' => 'Acest camp este obligatoriu',
		'invalid' => 'Aceasta valoare este invalida'
	));

	$this->validatorSchema['email_address'] = new sfValidatorEmail(array(
		'max_length' => 255,
		'required' => true
	), array(
		'required' => 'Acest camp este obligatoriu',
		'invalid' => 'Aceasta valoare este invalida'
	));

	$this->validatorSchema['username']->setMessages(array(
		'required' => 'Acest camp este obligatoriu',
		'invalid' => 'Aceasta valoare este invalida'
	));

	$this->validatorSchema['password']->addOption('min_length', 6);
	$this->validatorSchema['password']->setMessages(array(
		'required' => 'Acest camp este obligatoriu',
		'min_length' => 'Parola trebuie sa fie de minim 6 caractere',
		'invalid' => 'Aceasta valoare este invalida'
	));

	$this->validatorSchema['password_again']->setMessages(array(
		'required' => 'Acest camp este obligatoriu',
		'invalid' => 'Aceasta valoare este invalida'
	));
  }

  public function updateObject($values = null)
  {
	  $object = parent::updateObject($values);

	  $object->setIsActive('1');
	  $object->setIsSuperAdmin('0');
  }

}
