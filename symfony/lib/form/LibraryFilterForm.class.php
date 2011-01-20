<?php
class LibraryFilterForm extends BaseForm
{
	public function configure()
	{
		parent::configure();

		$authors = Doctrine_Core::getTable('sfGuardUser')->getAdminsForWidget();
		
		$categories = Doctrine_Core::getTable('Category')->getForWidget();
		
		$bruteTypes = array_combine(sfConfig::get('app_library_types'), sfConfig::get('app_library_type_names'));
		$types = array();
		foreach ($bruteTypes as $key => $bruteType){
			if (sfContext::getInstance()->getUser()->hasCredential($key)){
				$types[$key] = $bruteType;
			}
		}
		
		$this->widgetSchema['offset'] = new sfWidgetFormInputHidden();
		$this->widgetSchema['id'] = new sfWidgetFormInput();
		$this->widgetSchema['imdb'] = new sfWidgetFormInput();
		$this->widgetSchema['keyword'] = new sfWidgetFormInput();
		$this->widgetSchema['date_from'] = new sfWidgetFormInput();
		$this->widgetSchema['date_to'] = new sfWidgetFormInput();
		$this->widgetSchema['type'] = new sfWidgetFormChoice(array(
			'multiple' => false,
			'expanded' => false,
			'choices' => array_merge(array('' => ''), $types)
		));
		$this->widgetSchema['category'] = new sfWidgetFormChoice(array(
			'multiple' => false,
			'expanded' => false,
			'choices' => $categories
		));
		$this->widgetSchema['author'] = new sfWidgetFormChoice(array(
			'multiple' => false,
			'expanded' => false,
			'choices' => $authors
		));
		$this->widgetSchema['with_photo'] = new sfWidgetFormInputCheckbox(array('value_attribute_value' => '1'));
		$this->widgetSchema['with_video'] = new sfWidgetFormInputCheckbox(array('value_attribute_value' => '1'));
		
		
		$this->validatorSchema['offset'] = new sfValidatorInteger(array('required' => false, 'trim' => true));
		$this->validatorSchema['id'] = new sfValidatorInteger(array('required' => false, 'trim' => true));
		$this->validatorSchema['imdb'] = new sfValidatorString(array('required' => false, 'trim' => true));
		$this->validatorSchema['keyword'] = new sfValidatorInteger(array('required' => false, 'trim' => true));
		$this->validatorSchema['date_from'] = new sfValidatorDate(array('required' => false, 'trim' => true));
		$this->validatorSchema['date_to'] = new sfValidatorDate(array('required' => false, 'trim' => true));
		$this->validatorSchema['type'] = new sfValidatorChoice(array(
			'choices' => sfConfig::get('app_library_types'),
			'required' => false
		));
		$this->validatorSchema['category'] = new sfValidatorChoice(array(
			'choices' => array_keys($categories),
			'required' => false
		));
		$this->validatorSchema['author'] = new sfValidatorChoice(array(
			'choices' => array_keys($authors),
			'required' => false
		));
		$this->validatorSchema['with_photo'] = new sfValidatorPass();
		$this->validatorSchema['with_video'] = new sfValidatorPass();
		
		$this->widgetSchema->setNameFormat('filter[%s]');
	}
}