<?php

/**
 * default actions.
 *
 * @package    filmsi
 * @subpackage default
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class defaultActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
  	$this->filterForm = new LibraryFilterForm();
  	
  	$filters = $request->getParameter($this->filterForm->getName());
  	
  	if (isset($filters['id'])) $this->filterForm->setDefault('id', $filters['id']);
  	if (isset($filters['imdb'])) $this->filterForm->setDefault('imdb', $filters['imdb']);
  	if (isset($filters['keyword'])) $this->filterForm->setDefault('keyword', $filters['keyword']);
  	if (isset($filters['date_from'])) $this->filterForm->setDefault('date_from', $filters['date_from']);
  	if (isset($filters['date_to'])) $this->filterForm->setDefault('date_to', $filters['date_to']);
  	if (isset($filters['type'])) $this->filterForm->setDefault('type', $filters['type']);
  	if (isset($filters['category'])) $this->filterForm->setDefault('category', $filters['category']);
  	if (isset($filters['author'])) $this->filterForm->setDefault('author', $filters['author']);
  	if (isset($filters['with_photo'])) $this->filterForm->setDefault('with_photo', $filters['with_photo']);
  	if (isset($filters['with_video'])) $this->filterForm->setDefault('with_video', $filters['with_video']);
  	
  	if (isset($filters['offset'])) {
  		$this->page = $filters['offset'];
  		$this->filterForm->setDefault('offset', $filters['offset']);
  		$filters['offset'] = ($filters['offset'] - 1) * sfConfig::get('app_library_list_limit');
  	} else {
  		$filters['offset'] = 0;
  		$this->filterForm->setDefault('offset', 1);
  		$this->page = 1;
  	}
  	
  	$this->objects = Doctrine_Core::getTable('Library')->getFilteredObjects($filters, sfConfig::get('app_library_list_limit'));
  	
  	$this->totalCount = Doctrine_Core::getTable('Library')->countFilteredObjects($filters);

  	$this->pageCount = ceil($this->totalCount / sfConfig::get('app_library_list_limit'));

	$this->statisticActive = Doctrine_Core::getTable('Library')->countFilteredActive($filters);
	$this->statisticInactive = $this->totalCount - $this->statisticActive;
	$this->statisticWithPhoto = Doctrine_Core::getTable('Library')->countFilteredWithPhoto($filters);
	$this->statisticWithVideo = Doctrine_Core::getTable('Library')->countFilteredWithVideo($filters);
	$this->statisticWithImdb = Doctrine_Core::getTable('Library')->countFilteredWithImdb($filters);
  }

  public function executeExport(sfWebRequest $request)
  {
  	$this->getResponse()->setHttpHeader("Content-type", 'application/csv');
  	$this->getResponse()->setHttpHeader("Content-Disposition", 'attachment; filename=FilmsiRo-Library.csv');
  	$this->getResponse()->setHttpHeader("Pragma", 'no-cache');
  	$this->getResponse()->setHttpHeader("Expires", '0');
  	
  	$this->setLayout(false);
  	
  	
  	$this->filterForm = new LibraryFilterForm();
  	
  	$filters = $request->getParameter($this->filterForm->getName());
  	
  	if (isset($filters['id'])) $this->filterForm->setDefault('id', $filters['id']);
  	if (isset($filters['imdb'])) $this->filterForm->setDefault('imdb', $filters['imdb']);
  	if (isset($filters['keyword'])) $this->filterForm->setDefault('keyword', $filters['keyword']);
  	if (isset($filters['date_from'])) $this->filterForm->setDefault('date_from', $filters['date_from']);
  	if (isset($filters['date_to'])) $this->filterForm->setDefault('date_to', $filters['date_to']);
  	if (isset($filters['type'])) $this->filterForm->setDefault('type', $filters['type']);
  	if (isset($filters['category'])) $this->filterForm->setDefault('category', $filters['category']);
  	if (isset($filters['author'])) $this->filterForm->setDefault('author', $filters['author']);
  	
  	if (isset($filters['offset'])) {
  		$this->page = $filters['offset'];
  		$this->filterForm->setDefault('offset', $filters['offset']);
  		$filters['offset'] = ($filters['offset'] - 1) * sfConfig::get('app_library_list_limit');
  	} else {
  		$filters['offset'] = 0;
  		$this->filterForm->setDefault('offset', 1);
  		$this->page = 1;
  	}

	if ($request->hasParameter('export_objects')){
		$this->objects = Doctrine_Core::getTable('Library')->getByIds($request->getParameter('export_objects'));
	} else {
		$this->objects = Doctrine_Core::getTable('Library')->getFilteredObjects($filters);
	}
  	
  }
  
  public function executeNewObject(sfWebRequest $request)
  {
  	
  }
  
	public function executeModerate(sfWebRequest $request)
	{
		if ($request->hasParameter('filter_page')) {
			$this->filterPage = $request->getParameter('filter_page');
			$offset = ($this->filterPage - 1) * sfConfig::get('app_library_list_limit');
		} else {
			$offset = 0;
			$this->filterPage = 1;
		}

		$this->objects = LibraryTable::getInstance()->getPending($offset, sfConfig::get('app_library_list_limit'));
		$this->totalCount = LibraryTable::getInstance()->countPending();
		$this->pageCount = ceil($this->totalCount / sfConfig::get('app_library_list_limit'));
	}
  
  public function executeAllow(sfWebRequest $request)
  {
  	Doctrine_Core::getTable('Library')->allow($request->getParameter('lid'));
  	
  	$this->redirect($request->getReferer());	
  }
  
  public function executeDelete(sfWebRequest $request)
  {
  	$ids = $request->getParameter('selected_objects');
  	
  	if (!is_null($ids) && !is_array($ids)){
  		$ids = array($ids);
  	}
  	
  	Doctrine_Core::getTable('Library')->delete($ids);
  	
  	$this->redirect($request->getReferer());
  }
  
  public function executeCloneObjects(sfWebRequest $request)
  {
  	$ids = $request->getParameter('selected_objects');
  	
  	Doctrine_Core::getTable('Library')->cloneObjects($ids);
  	
  	$this->redirect($request->getReferer());
  }

	public function executeLocations(sfWebRequest $request)
	{
		$this->setLayout(false);
		$this->getResponse()->setContentType('application/json');

		return $this->renderText(json_encode(Doctrine_Core::getTable('Location')->getForApi($request->getParameter('term'))));
	}
}
