<?php

/**
 * FilmAlert form.
 *
 * @package    filmsi
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class FilmAlertForm extends BaseFilmAlertForm
{
	public function  updateObject($values = null) {
		parent::updateObject($values);

		/* Remove other alerts */
		FilmAlertTable::getInstance()->deleteByUserAndFilm($this->getObject()->getUserId(), $this->getObject()->getFilmId());
	}
}
