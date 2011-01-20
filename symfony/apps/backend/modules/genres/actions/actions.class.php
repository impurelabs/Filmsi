<?php

/**
 * genres actions.
 *
 * @package    filmsi
 * @subpackage genres
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class genresActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->genres = Doctrine_Core::getTable('Genre')->getAllOrdered();
  }
  
  public function executeNew(sfWebRequest $request)
  {
  	$this->form = new GenreForm();
  	
  	if ($request->isMethod('post')){
  		$this->form->bind($request->getParameter($this->form->getName()));
  		
  		if ($this->form->isValid()){
  			$this->form->save();
  			
  			$this->redirect($this->generateUrl('default', array('module' => 'genres', 'action' => 'index')));
  		}
  	}
  }
  
  public function executeEdit(sfWebRequest $request)
  {
  	$this->form = new GenreForm(Doctrine_Core::getTable('Genre')->findOneById($request->getParameter('id')));
  	
  	if ($request->isMethod('post')){
  		$this->form->bind($request->getParameter($this->form->getName()));
  		
  		if ($this->form->isValid()){
  			$this->form->save();
  			
  			$this->redirect($this->generateUrl('default', array('module' => 'genres', 'action' => 'index')));
  		}
  	}
  }
  
  public function executeDelete(sfWebRequest $request)
  {
  	$genre = Doctrine_Core::getTable('Genre')->findOneById($request->getParameter('id'));
  	$genre->delete();
  	
  	$this->redirect($this->generateUrl('default', array('module' => 'genres', 'action' => 'index')));
  }
}
