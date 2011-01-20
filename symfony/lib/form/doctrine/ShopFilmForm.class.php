<?php

/**
 * ShopFilm form.
 *
 * @package    filmsi
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ShopFilmForm extends BaseShopFilmForm
{
	public function configure()
	{
		$this->widgetSchema['shop_id'] = new sfWidgetFormInputHidden();
		$this->widgetSchema['film_id'] = new sfWidgetFormInputHidden();

		$this->validatorSchema['shop_id'] = new sfValidatorDoctrineChoice(array('model' => 'Shop', 'required' => false));
		$this->validatorSchema['film_id'] = new sfValidatorDoctrineChoice(array('model' => 'Film', 'required' => false));
	}
}
