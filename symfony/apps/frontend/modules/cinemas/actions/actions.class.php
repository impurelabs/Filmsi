<?php

/**
 * cinemas actions.
 *
 * @package    filmsi
 * @subpackage cinemas
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class cinemasActions extends sfActions
{
	/**
	* Executes index action
	*
	* @param sfRequest $request A request object
	*/
	public function executeIndex(sfWebRequest $request)
	{
		$this->cinemaCountByRegion = CinemaTable::getInstance()->countByRegion();

		if ($request->hasParameter('region')){
			$this->cinemas = CinemaTable::getInstance()->getByRegionKey(str_replace('-', '', $request->getParameter('region')));
			$this->region = $this->cinemas[0]->getLocation()->getRegion();
		}
	}
}
