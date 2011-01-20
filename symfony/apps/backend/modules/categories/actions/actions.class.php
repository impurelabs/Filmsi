<?php

/**
 * categories actions.
 *
 * @package    filmsi
 * @subpackage categorys
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class categoriesActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->categorys = Doctrine_Core::getTable('Category')->getAllOrdered();
  }
  
  public function executeNew(sfWebRequest $request)
  {
  	$this->form = new CategoryForm();
  	
  	if ($request->isMethod('post')){
  		$this->form->bind($request->getParameter($this->form->getName()));
  		
  		if ($this->form->isValid()){
  			$this->form->save();
  			
  			$this->redirect($this->generateUrl('default', array('module' => 'categories', 'action' => 'index')));
  		}
  	}
  }
  
  public function executeEdit(sfWebRequest $request)
  {
  	$this->form = new CategoryForm(Doctrine_Core::getTable('Category')->findOneById($request->getParameter('id')));
  	
  	if ($request->isMethod('post')){
  		$this->form->bind($request->getParameter($this->form->getName()));
  		
  		if ($this->form->isValid()){
  			$this->form->save();
  			
  			$this->redirect($this->generateUrl('default', array('module' => 'categories', 'action' => 'index')));
  		}
  	}
  }
  
  public function executeDelete(sfWebRequest $request)
  {
  	$category = Doctrine_Core::getTable('Category')->findOneById($request->getParameter('id'));
  	$category->delete();
  	
  	$this->redirect($this->generateUrl('default', array('module' => 'categories', 'action' => 'index')));
  }
}
