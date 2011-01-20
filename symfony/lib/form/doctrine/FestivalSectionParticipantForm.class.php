<?php

/**
 * FestivalSectionParticipant form.
 *
 * @package    filmsi
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class FestivalSectionParticipantForm extends BaseFestivalSectionParticipantForm
{
  public function configure()
  {
	  $this->widgetSchema['festival_section_id'] = new sfWidgetFormInputHidden();
	  $this->widgetSchema['film_imdb'] = new sfWidgetFormInputHidden();
	  $this->widgetSchema['person_imdb'] = new sfWidgetFormInputHidden();
	  $this->widgetSchema['is_winner'] = new sfWidgetFormInputCheckbox(array('value_attribute_value' => '1'));
  }
}