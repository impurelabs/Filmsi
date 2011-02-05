<?php

/**
 * default actions.
 *
 * @package    filmsi
 * @subpackage default
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class filmStatusActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {  	
  	$filters = array();
  	
  	if ($request->hasParameter('filter_imdb') && $request->getParameter('filter_imdb') != ''){
  		$filters['imdb'] = $request->getParameter('filter_imdb');
  		$this->filterImdb = $request->getParameter('filter_imdb');
  	} else {
  		$this->filterImdb = '';
  	}
  	if ($request->hasParameter('filter_in_production')){
  		$filters['in_production'] = $request->getParameter('filter_in_production');
  		$this->filterInProduction = true;
  	} else {
  		$this->filterInProduction = false;
  	}
  	if ($request->hasParameter('filter_in_cinema')){
  		$filters['in_cinema'] = $request->getParameter('filter_in_cinema');
  		$this->filterInCinema = true;
  	} else {
  		$this->filterInCinema = false;
  	}
  	if ($request->hasParameter('filter_in_dvd')){
  		$filters['in_dvd'] = $request->getParameter('filter_in_dvd');
  		$this->filterInDvd = true;
  	} else {
  		$this->filterInDvd = false;
  	}
  	if ($request->hasParameter('filter_in_bluray')){
  		$filters['in_bluray'] = $request->getParameter('filter_in_bluray');
  		$this->filterInBluray = true;
  	} else {
  		$this->filterInBluray = false;
  	}
  	if ($request->hasParameter('filter_in_online')){
  		$filters['in_online'] = $request->getParameter('filter_in_online');
  		$this->filterInOnline = true;
  	} else {
  		$this->filterInOnline = false;
  	}
  	if ($request->hasParameter('filter_in_tv')){
  		$filters['in_tv'] = $request->getParameter('filter_in_tv');
  		$this->filterInTv = true;
  	} else {
  		$this->filterInTv = false;
  	}
  	
  	if ($request->hasParameter('filter_page')) {
  		$this->filterPage = $request->getParameter('filter_page');
  		$filters['offset'] = ($this->filterPage - 1) * sfConfig::get('app_film_status_list_limit');
  	} else {
  		$filters['offset'] = 0;
  		$this->filterPage = 1;
  	}
  	
  	$this->films = FilmTable::getInstance()->getFilteredByStatus($filters, sfConfig::get('app_film_status_list_limit'));
  	
  	$this->totalCount = FilmTable::getInstance()->countFilteredByStatus($filters);
  	
  	$this->pageCount = ceil($this->totalCount / sfConfig::get('app_film_status_list_limit'));
  	
  }

  public function executeExport(sfWebRequest $request)
  {
  	$this->getResponse()->setHttpHeader("Content-type", 'application/csv');
  	$this->getResponse()->setHttpHeader("Content-Disposition", 'attachment; filename=FilmsiRo-StatusFilme.csv');
  	$this->getResponse()->setHttpHeader("Pragma", 'no-cache');
  	$this->getResponse()->setHttpHeader("Expires", '0');
  	
  	$this->setLayout(false);
  	
  	
  	$filters = array();
  	
  	if ($request->hasParameter('filter_imdb') && $request->getParameter('filter_imdb') != ''){
  		$filters['imdb'] = $request->getParameter('filter_imdb');
  		$this->filterImdb = $request->getParameter('filter_imdb');
  	} else {
  		$this->filterImdb = '';
  	}
  	if ($request->hasParameter('filter_in_production')){
  		$filters['in_production'] = $request->getParameter('filter_in_production');
  		$this->filterInProduction = true;
  	} else {
  		$this->filterInProduction = false;
  	}
  	if ($request->hasParameter('filter_in_cinema')){
  		$filters['in_cinema'] = $request->getParameter('filter_in_cinema');
  		$this->filterInCinema = true;
  	} else {
  		$this->filterInCinema = false;
  	}
  	if ($request->hasParameter('filter_in_dvd')){
  		$filters['in_dvd'] = $request->getParameter('filter_in_dvd');
  		$this->filterInDvd = true;
  	} else {
  		$this->filterInDvd = false;
  	}
  	if ($request->hasParameter('filter_in_bluray')){
  		$filters['in_bluray'] = $request->getParameter('filter_in_bluray');
  		$this->filterInBluray = true;
  	} else {
  		$this->filterInBluray = false;
  	}
  	if ($request->hasParameter('filter_in_online')){
  		$filters['in_online'] = $request->getParameter('filter_in_online');
  		$this->filterInOnline = true;
  	} else {
  		$this->filterInOnline = false;
  	}
  	if ($request->hasParameter('filter_in_tv')){
  		$filters['in_tv'] = $request->getParameter('filter_in_tv');
  		$this->filterInTv = true;
  	} else {
  		$this->filterInTv = false;
  	}
  	
  	$this->films = Doctrine_Core::getTable('Film')->getFilteredByStatus($filters);
  }
 
  

}
