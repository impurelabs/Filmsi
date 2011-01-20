<?php

/**
 * festivals actions.
 *
 * @package    filmsi
 * @subpackage festivals
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class festivalsActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->festivals = Doctrine_Core::getTable('Festival')->getAllOrdered();
  }
  
  public function executeNew(sfWebRequest $request)
  {
  	$this->form = new FestivalForm();
  	
  	if ($request->isMethod('post')){
  		$this->form->bind($request->getParameter($this->form->getName()));
  		
  		if ($this->form->isValid()){
  			$this->form->save();
  			
  			$this->redirect($this->generateUrl('default', array('module' => 'festivals', 'action' => 'index')));
  		}
  	}
  }
  
  public function executeEdit(sfWebRequest $request)
  {
  	$this->form = new FestivalForm(Doctrine_Core::getTable('Festival')->findOneById($request->getParameter('id')));
  	
  	if ($request->isMethod('post')){
  		$this->form->bind($request->getParameter($this->form->getName()));
  		
  		if ($this->form->isValid()){
  			$this->form->save();
  			
  			$this->redirect($this->generateUrl('default', array('module' => 'festivals', 'action' => 'index')));
  		}
  	}
  }
  
  public function executeDelete(sfWebRequest $request)
  {
  	$festival = Doctrine_Core::getTable('Festival')->findOneById($request->getParameter('id'));
  	$festival->delete();
  	
  	$this->redirect($this->generateUrl('default', array('module' => 'festivals', 'action' => 'index')));
  }
}
