<?php

/**
 * articles actions.
 *
 * @package    articlesi
 * @subpackage articles
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class articlesActions extends sfActions
{
  public function executeNewObject(sfWebRequest $request)
  {
  	$this->form = new ArticleNewForm();
  	
  	if ($request->isMethod('post')){
  		$this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
  		
  		if ($this->form->isValid()){
  			$this->form->save();
  			
  			$persons = ($request->getParameter('person_list'));
  			$films = ($request->getParameter('film_list'));
  			$cinemas = ($request->getParameter('cinema_list'));
  			$festivalEditions = ($request->getParameter('festival_edition_list'));
  			
  			Doctrine_Core::getTable('PersonArticle')->updateObjects($this->form->getObject()->getId(), $persons);
  			Doctrine_Core::getTable('FilmArticle')->updateObjects($this->form->getObject()->getId(), $films);
  			Doctrine_Core::getTable('CinemaArticle')->updateObjects($this->form->getObject()->getId(), $cinemas);
  			Doctrine_Core::getTable('FestivalEditionArticle')->updateObjects($this->form->getObject()->getId(), $festivalEditions);
  			
  			$this->redirect($this->generateUrl('default', array('module' => 'articles', 'action' => 'view')) . '?lid=' . $this->form->getObject()->getLibraryId());
  		}
  	}
  }
  
	public function executeEdit(sfWebRequest $request)
  {
  	$article = Doctrine_Core::getTable('Article')->findOneByLibraryId($request->getParameter('lid'));
  	
  	$this->form = new ArticleEditForm($article);
  	
  	if ($request->isMethod('post')){
  		$this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
  		
  		if ($this->form->isValid()){
  			$this->form->save();
  			
  			$persons = ($request->getParameter('person_list'));
  			$films = ($request->getParameter('film_list'));
  			$cinemas = ($request->getParameter('cinema_list'));
  			$festivalEditions = ($request->getParameter('festival_edition_list'));
  			
  			Doctrine_Core::getTable('PersonArticle')->updateObjects($this->form->getObject()->getId(), $persons);
  			Doctrine_Core::getTable('FilmArticle')->updateObjects($this->form->getObject()->getId(), $films);
  			Doctrine_Core::getTable('CinemaArticle')->updateObjects($this->form->getObject()->getId(), $cinemas);
  			Doctrine_Core::getTable('FestivalEditionArticle')->updateObjects($this->form->getObject()->getId(), $festivalEditions);
  			
  			$this->redirect($this->generateUrl('default', array('module' => 'articles', 'action' => 'view')) . '?lid=' . $this->form->getObject()->getLibraryId());
  		}
  	}
  }
  
	public function executeView(sfWebRequest $request)
  {
  	$this->forward404If(false == $this->article = Doctrine_Core::getTable('Article')->findOneByLibraryId($request->getParameter('lid')));
  }

}