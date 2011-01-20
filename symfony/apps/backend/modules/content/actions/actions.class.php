<?php

/**
 * content actions.
 *
 * @package    filmsi
 * @subpackage content
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class contentActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
  	$this->contents = Doctrine_Core::getTable('Content')->findAll();
  }
  
  public function executeView(sfWebRequest $request)
  {
  	$this->content = Doctrine_Core::getTable('Content')->findOneById($request->getParameter('id'));
  }
  
  public function executeEdit(sfWebRequest $request)
{
  	$this->content = Doctrine_Core::getTable('content')->findOneById($request->getParameter('id'));
  	
  	$this->form = new ContentForm($this->content);
  	
  	if ($request->isMethod('post')){
  		$this->form->bind($request->getParameter($this->form->getName()));
  		
  		if ($this->form->isValid()){
  			$this->form->save();
  			
  			$this->redirect($this->generateUrl('default', array('module' => 'content', 'action' => 'view')) . '?id=' . $this->content->getId());
  		}
  	}
  }
}