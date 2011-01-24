<?php

/**
 * Comment form.
 *
 * @package    filmsi
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CommentForm extends BaseCommentForm
{
	private $state;
	private $ip;
	private $type;

	public function  __construct($object = null, $options = array(), $CSRFSecret = null) 
	{
		parent::__construct($object, $options, $CSRFSecret);

		$this->state = $options['state'];
		$this->ip = $options['ip'];
		$this->model = $options['model'];
		$this->model_library_id = $options['model_library_id'];
		$this->model_name = $options['model_name'];
	}

	public function configure()
	{
		unset($this['state'], $this['ip'], $this['type'], $this['created_at']);

		$this->widgetSchema['name'] = new sfWidgetFormInputText();
		$this->widgetSchema['email'] = new sfWidgetFormInputText();
		$this->widgetSchema['content'] = new sfWidgetFormTextarea();

		$this->validatorSchema['name'] = new sfValidatorString(array(
			'required' => true
		), array(
			'required' => 'Acest camp este obligatoriu.'
		));
        $this->validatorSchema['email'] = new sfValidatorEmail(array(
			'required' => true
		), array(
			'required' => 'Acest camp este obligatoriu.',
			'invalid' => 'Aceasta valoare este incorecta.',
		));
	}

	public function  updateObject($values = null) {
		$object = parent::updateObject($values);
		$object->setUserId(sfContext::getInstance()->getUser()->getGuardUser()->getId());
		$object->setState($this->state);
		$object->setIp($this->ip);
		$object->setModel($this->model);
		$object->setModelLibraryId($this->model_library_id);
		$object->setModelName($this->model_name);

		return $object;
	}
}
