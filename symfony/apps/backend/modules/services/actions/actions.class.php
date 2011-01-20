<?php

/**
 * facilities actions.
 *
 * @package    filmsi
 * @subpackage facilities
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class servicesActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->services = Doctrine_Core::getTable('Service')->getAllOrdered();
  }
  
  public function executeNew(sfWebRequest $request)
  {
  	$this->form = new ServiceForm();
  	
  	if ($request->isMethod('post')){
  		$this->form->bind($request->getParameter($this->form->getName()));
  		
  		if ($this->form->isValid()){
  			$this->form->save();
  			
  			$this->redirect($this->generateUrl('default', array('module' => 'services', 'action' => 'index')));
  		}
  	}
  }
  
  public function executeEdit(sfWebRequest $request)
  {
  	$this->form = new ServiceForm(Doctrine_Core::getTable('Service')->findOneById($request->getParameter('id')));
  	
  	if ($request->isMethod('post')){
  		$this->form->bind($request->getParameter($this->form->getName()));
  		
  		if ($this->form->isValid()){
  			$this->form->save();
  			
  			$this->redirect($this->generateUrl('default', array('module' => 'services', 'action' => 'index')));
  		}
  	}
  }
  
  public function executeDelete(sfWebRequest $request)
  {
  	$service = Doctrine_Core::getTable('Service')->findOneById($request->getParameter('id'));
  	$service->delete();
  	
  	$this->redirect($this->generateUrl('default', array('module' => 'services', 'action' => 'index')));
  }
}
