<?php

/**
 * boxoffice actions.
 *
 * @package    filmsi
 * @subpackage boxoffice
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class boxofficeActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->boxofficeRoFilm = Doctrine_Core::getTable('BoxofficeFilm')->findOneByType('ro');
    $this->boxofficeUsFilm = Doctrine_Core::getTable('BoxofficeFilm')->findOneByType('us');
  }
  
  public function executeEditRo(sfWebRequest $request)
  {
  	$this->boxofficeFilm = Doctrine_Core::getTable('BoxofficeFilm')->findOneByType('ro');
  	
  	$this->form = new BoxofficeFilmForm($this->boxofficeFilm);
  	
  	if ($request->isMethod('post')){
  		$this->form->bind($request->getParameter($this->form->getName()));
  		
  		if ($this->form->isValid()){
  			$this->form->save();
  			
  			$this->redirect($this->generateUrl('default_index', array('module' => 'boxoffice')));
  		}
  	}
  }
  
  public function executeEditUs(sfWebRequest $request)
  {
  	$this->boxofficeFilm = Doctrine_Core::getTable('BoxofficeFilm')->findOneByType('us');
  	
  	$this->form = new BoxofficeFilmForm($this->boxofficeFilm);
  	
  	if ($request->isMethod('post')){
  		$this->form->bind($request->getParameter($this->form->getName()));
  		
  		if ($this->form->isValid()){
  			$this->form->save();
  			
  			$this->redirect($this->generateUrl('default_index', array('module' => 'boxoffice')));
  		}
  	}
  }
}