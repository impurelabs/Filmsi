<?php

/**
 * stires actions.
 *
 * @package    stiresi
 * @subpackage stires
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class stiresActions extends sfActions
{
  public function executeNewObject(sfWebRequest $request)
  {
  	$this->form = new StireNewForm();
  	
  	if ($request->isMethod('post')){
  		$this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
  		
  		if ($this->form->isValid()){
  			$this->form->save();
  			
  			$persons = ($request->getParameter('person_list'));
  			$films = ($request->getParameter('film_list'));
  			$cinemas = ($request->getParameter('cinema_list'));
  			$festivalEditions = ($request->getParameter('festival_edition_list'));
  			
  			Doctrine_Core::getTable('PersonStire')->updateObjects($this->form->getObject()->getId(), $persons);
  			Doctrine_Core::getTable('FilmStire')->updateObjects($this->form->getObject()->getId(), $films);
  			Doctrine_Core::getTable('CinemaStire')->updateObjects($this->form->getObject()->getId(), $cinemas);
  			Doctrine_Core::getTable('FestivalEditionStire')->updateObjects($this->form->getObject()->getId(), $festivalEditions);
  			
  			$this->redirect($this->generateUrl('default', array('module' => 'stires', 'action' => 'view')) . '?lid=' . $this->form->getObject()->getLibraryId());
  		}
  	}
  }
  
	public function executeEdit(sfWebRequest $request)
  {
  	$stire = Doctrine_Core::getTable('Stire')->findOneByLibraryId($request->getParameter('lid'));
  	
  	$this->form = new StireEditForm($stire);
  	
  	if ($request->isMethod('post')){
  		$this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
  		
  		if ($this->form->isValid()){
  			$this->form->save();
  			
  			$persons = ($request->getParameter('person_list'));
  			$films = ($request->getParameter('film_list'));
  			$cinemas = ($request->getParameter('cinema_list'));
  			$festivalEditions = ($request->getParameter('festival_edition_list'));
  			
  			Doctrine_Core::getTable('PersonStire')->updateObjects($this->form->getObject()->getId(), $persons);
  			Doctrine_Core::getTable('FilmStire')->updateObjects($this->form->getObject()->getId(), $films);
  			Doctrine_Core::getTable('CinemaStire')->updateObjects($this->form->getObject()->getId(), $cinemas);
  			Doctrine_Core::getTable('FestivalEditionStire')->updateObjects($this->form->getObject()->getId(), $festivalEditions);
  			
  			$this->redirect($this->generateUrl('default', array('module' => 'stires', 'action' => 'view')) . '?lid=' . $this->form->getObject()->getLibraryId());
  		}
  	}
  }
  
	public function executeView(sfWebRequest $request)
  {
  	$this->stire = Doctrine_Core::getTable('Stire')->findOneByLibraryId($request->getParameter('lid'));
  }

}