<?php

/**
 * FilmEpisode form.
 *
 * @package    filmsi
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class FilmEpisodeForm extends BaseFilmEpisodeForm
{
  public function configure()
  {
	  $this->widgetSchema['film_id'] = new sfWidgetFormInputHidden();
  }
}
