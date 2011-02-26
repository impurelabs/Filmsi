<?php

/**
 * ChannelSchedule form.
 *
 * @package    filmsi
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ChannelScheduleForm extends BaseChannelScheduleForm
{
	public function configure()
	{
		$hours = array(
			'00' => '00', '01' => '01', '02' => '02', '03' => '03', '04' => '04', '05' => '05', '06' => '06', '07' => '07', '08' => '08', '09' => '09', '10' => '10', '11' => '11', '12' => '12', '13' => '13', '14' => '14', '15' => '15', '16' => '16', '17' => '17', '18' => '18', '19' => '19', '20' => '20',
			'21' => '21', '22' => '22', '23' => '23',
		);

		$mins = array(
			'00' => '00', '05' => '05', '10' => '10', '15' => '15', '20' => '20', '25' => '25', '30' => '30', '35' => '35', '40' => '40', '45' => '45', '50' => '50', '55' => '55',
		);


		$this->widgetSchema['channel_id'] = new sfWidgetFormInputHidden();
		$this->widgetSchema['film_id'] = new sfWidgetFormInputHidden();
		$this->widgetSchema['day'] = new sfWidgetFormInputText();
		$this->widgetSchema['time_hour'] = new sfWidgetFormChoice(array(
			'multiple' => false,
			'expanded' => false,
			'choices' => $hours
		));
		$this->widgetSchema['time_min'] = new sfWidgetFormChoice(array(
			'multiple' => false,
			'expanded' => false,
			'choices' => $mins
		));
	}
}
