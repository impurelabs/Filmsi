<?php

/**
 * Description of ContactForm
 *
 * @author Iulian Manea
 */
class ContactForm extends BaseForm {
    public function  setup() {
		parent::setup();

		$this->setWidgets(array(
			'first_name' => new sfWidgetFormInputText(),
			'last_name' => new sfWidgetFormInputText(),
			'email' => new sfWidgetFormInputText(),
			'phone' => new sfWidgetFormInputText(),
			'message' => new sfWidgetFormTextarea(),
		));

		$this->setValidators(array(
			'first_name' => new sfValidatorString(array('max_length' => 250, 'required' => true), array('required' => 'Acest camp e obligatoriu.')),
			'last_name' => new sfValidatorString(array('max_length' => 250, 'required' => true), array('required' => 'Acest camp e obligatoriu.')),
			'email' => new sfValidatorEmail(array('max_length' => 250, 'required' => true), array('required' => 'Acest camp e obligatoriu.', 'invalid' => 'Adresa de email este invalida.')),
			'phone' => new sfValidatorString(array('max_length' => 250, 'required' => false)),
			'message' => new sfValidatorString(array('max_length' => 5000, 'required' => true), array('required' => 'Acest camp e obligatoriu.')),
		));

		$this->widgetSchema->setNameFormat('contact[%s]');
	}
}
?>