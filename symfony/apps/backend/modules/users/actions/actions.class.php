<?php

/**
 * users actions.
 *
 * @package    filmsi
 * @subpackage users
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class usersActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
  	if (!$this->getUser()->isSuperAdmin()){
  		$this->forward(sfConfig::get('sf_secure_module'), sfConfig::get('sf_secure_action'));
  	}
  	
  	$filters = array();
  	if ($request->hasParameter('id')) $filters['id'] = $request->getParameter('id');
  	if ($request->hasParameter('name')) $filters['name'] = $request->getParameter('name');
  	if ($request->hasParameter('email')) $filters['email'] = $request->getParameter('email');
  	if ($request->hasParameter('username')) $filters['username'] = $request->getParameter('username');
  	if ($request->hasParameter('clients') && $request->getParameter('clients') == 1) $filters['clients'] = true;
  	if ($request->hasParameter('webeditors') && $request->getParameter('webeditors') == 1) $filters['webeditors'] = true;
  	if ($request->hasParameter('active') && $request->getParameter('active') == 1) $filters['active'] = true;
  	if ($request->hasParameter('inactive') && $request->getParameter('inactive') == 1) $filters['inactive'] = true;
  
  	
  	if ($request->hasParameter('filter_page')) {
  		$this->filterPage = $request->getParameter('filter_page');
  		$filters['offset'] = ($this->filterPage - 1) * sfConfig::get('app_users_list_limit');
  	} else {
  		$filters['offset'] = 0;
  		$this->filterPage = 1;
  	}
  	
  	$this->users = Doctrine_Core::getTable('sfGuardUser')->getFiltered($filters, sfConfig::get('app_users_list_limit'));
  	
  	$this->totalCount = Doctrine_Core::getTable('sfGuardUser')->countFiltered($filters);
  	
  	$this->pageCount = ceil($this->totalCount / sfConfig::get('app_users_list_limit'));
  }
  
	public function executeExport(sfWebRequest $request)
  {
  	if (!$this->getUser()->isSuperAdmin()){
  		$this->forward(sfConfig::get('sf_secure_module'), sfConfig::get('sf_secure_action'));
  	}
  	
  	
  	$this->getResponse()->setHttpHeader("Content-type", 'application/csv');
  	$this->getResponse()->setHttpHeader("Content-Disposition", 'attachment; filename=FilmsiRo-Useri.csv');
  	$this->getResponse()->setHttpHeader("Pragma", 'no-cache');
  	$this->getResponse()->setHttpHeader("Expires", '0');
  	
  	$this->setLayout(false);
  	
  	$filters = array();
  	if ($request->hasParameter('id')) $filters['id'] = $request->getParameter('id');
  	if ($request->hasParameter('name')) $filters['name'] = $request->getParameter('name');
  	if ($request->hasParameter('email')) $filters['email'] = $request->getParameter('email');
  	if ($request->hasParameter('username')) $filters['username'] = $request->getParameter('username');
  	if ($request->hasParameter('clients') && $request->getParameter('clients') == 1) $filters['clients'] = true;
  	if ($request->hasParameter('webeditors') && $request->getParameter('webeditors') == 1) $filters['webeditors'] = true;
  	if ($request->hasParameter('active') && $request->getParameter('active') == 1) $filters['active'] = true;
  	if ($request->hasParameter('inactive') && $request->getParameter('inactive') == 1) $filters['inactive'] = true;
  
  	
  	$this->users = Doctrine_Core::getTable('sfGuardUser')->getFiltered($filters);
  }
  
  public function executeNewUser(sfWebRequest $request)
  {
  	$this->form = new UserForm();
  	
  	if ($request->isMethod('post'))
  	{
  		$this->form->bind($request->getParameter($this->form->getName()));
  		
  		if ($this->form->isValid()){
  			$this->form->save();
  			
  			$this->redirect($this->generateUrl('default_index', array('module' => 'users')));
  		}
  	}
  }
  
  public function executeEdit(sfWebRequest $request)
  {
  	$this->form = new UserForm(Doctrine_Core::getTable('sfGuardUser')->findOneById($request->getParameter('id')));
  	
  	if ($request->isMethod('post'))
  	{
  		$this->form->bind($request->getParameter($this->form->getName()));
  		
  		if ($this->form->isValid()){
  			$this->form->save();
  			
  			$this->redirect($this->generateUrl('default_index', array('module' => 'users')));
  		}
  	}
  }
  
  public function executeDelete(sfWebRequest $request)
  {
  	Doctrine_Core::getTable('sfGuardUser')->findOneById($request->getParameter('id'))->delete();
  	
  	$this->redirect($request->getReferer());
  }

	public function executeApi(sfWebRequest $request)
	{
		$this->setLayout(false);
		$this->getResponse()->setContentType('application/json');

		return $this->renderText(json_encode(Doctrine_Core::getTable('sfGuardUser')->getForApi($request->getParameter('term'))));
	}
}