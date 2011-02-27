<?php

/**
 * PersonAlert form.
 *
 * @package    personsi
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PersonAlertForm extends BasePersonAlertForm
{
	public function  updateObject($values = null) {
		parent::updateObject($values);

		/* Remove other alerts */
		PersonAlertTable::getInstance()->deleteByUserAndPerson($this->getObject()->getUserId(), $this->getObject()->getPersonId());
	}
}
