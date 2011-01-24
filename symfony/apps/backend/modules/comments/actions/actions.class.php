<?php

/**
 * comments actions.
 *
 * @package    filmsi
 * @subpackage comments
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class commentsActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
  	$filters = array();
  	if ($request->hasParameter('email')) $filters['email'] = $request->getParameter('email');
  	if ($request->hasParameter('model')) $filters['model'] = $request->getParameter('model');
  	if ($request->hasParameter('model_library_id')) $filters['model_library_id'] = $request->getParameter('model_library_id');
  	if ($request->hasParameter('date_from')) $filters['date_from'] = $request->getParameter('date_from');
  	if ($request->hasParameter('date_to')) $filters['date_to'] = $request->getParameter('date_to');

  	if ($request->hasParameter('filter_page')) {
  		$this->filterPage = $request->getParameter('filter_page');
  		$filters['offset'] = ($this->filterPage - 1) * sfConfig::get('app_comments_list_limit');
  	} else {
  		$filters['offset'] = 0;
  		$this->filterPage = 1;
  	}

  	$this->comments = Doctrine_Core::getTable('Comment')->getFiltered($filters, sfConfig::get('app_comments_list_limit'));

  	$this->totalCount = Doctrine_Core::getTable('Comment')->countFiltered($filters);

  	$this->pageCount = ceil($this->totalCount / sfConfig::get('app_comments_list_limit'));
  }

  public function executeDelete(sfWebRequest $request)
  {
      if ($request->isMethod('post')){
          Doctrine_Core::getTable('Comment')->deleteByIds($request->getParameter('selected_objects'));

          $this->redirect($request->getReferer());
      }
  }
}
