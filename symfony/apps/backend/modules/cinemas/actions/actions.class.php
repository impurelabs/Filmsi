<?php

/**
 * cinemas actions.
 *
 * @package    cinemasi
 * @subpackage cinemas
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class cinemasActions extends sfActions
{
  public function executeNewObject(sfWebRequest $request)
  {
  	$this->form = new CinemaNewForm();
  	
  	if ($request->isMethod('post')){
  		$this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
  		
  		if ($this->form->isValid()){
  			$this->form->save();
  			
  			$this->redirect($this->generateUrl('default', array('module' => 'cinemas', 'action' => 'view')) . '?lid=' . $this->form->getObject()->getLibraryId());
  		}
  	}
  }
  
	public function executeEdit(sfWebRequest $request)
  {
  	$cinema = Doctrine_Core::getTable('Cinema')->findOneByLibraryId($request->getParameter('lid'));
  	
  	$this->form = new CinemaEditForm($cinema);
  	
  	if ($request->isMethod('post')){
  		$this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
  		
  		if ($this->form->isValid()){
  			$this->form->save();
  			
  			$this->redirect($this->generateUrl('default', array('module' => 'cinemas', 'action' => 'view')) . '?lid=' . $this->form->getObject()->getLibraryId());
  		}
  	}
  }
  
	public function executeView(sfWebRequest $request)
  {
  	$this->cinema = Doctrine_Core::getTable('Cinema')->findOneByLibraryId($request->getParameter('lid'));
  }

	public function executeApi(sfWebRequest $request)
	{
		$this->setLayout(false);
		$this->getResponse()->setContentType('application/json');

		return $this->renderText(json_encode(Doctrine_Core::getTable('Cinema')->getForApi($request->getParameter('term'))));
	}
	
  public function executeAddPromotion(sfWebRequest $request)
  {
  	$this->forward404If(false == $this->cinema = Doctrine_Core::getTable('Cinema')->findOneById($request->getParameter('id')));
  	
  	$this->form = new CinemaPromotionNewForm();
  	$this->form->setDefault('cinema_id', $this->cinema->getId());
  	
  	if ($request->isMethod('post')){
  		$this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
  		
  		if ($this->form->isValid()){
  			$this->form->save();
  			
  			$this->redirect($this->generateUrl('default', array('module' => 'cinemas', 'action' => 'view')) . '?lid=' . $this->cinema->getLibraryId());
  		}
  	}
  }
  
  public function executeEditPromotion(sfWebRequest $request)
  {
  	$this->forward404If(false == $this->cinemaPromotion = Doctrine_Core::getTable('CinemaPromotion')->findOneById($request->getParameter('id')));
  	
  	$this->form = new CinemaPromotionEditForm($this->cinemaPromotion);
  	
  	if ($request->isMethod('post')){
  		$this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
  		
  		if ($this->form->isValid()){
  			$this->form->save();
  			
  			$this->redirect($this->generateUrl('default', array('module' => 'cinemas', 'action' => 'view')) . '?lid=' . $this->cinemaPromotion->getCinema()->getLibraryId());
  		}
  	} 
  }
  
  public function executeDeletePromotion(sfWebRequest $request)
  {
  	$cinemaPromotion = Doctrine_Core::getTable('CinemaPromotion')->findOneById($request->getParameter('id'));
  	$libraryId = $cinemaPromotion->getCinema()->getLibraryId();
  	$cinemaPromotion->delete();		  	
  	
  	$this->redirect($this->generateUrl('default', array('module' => 'cinemas', 'action' => 'view')) . '?lid=' . $libraryId);
  }

  public function executeSchedule(sfWebRequest $request)
  {
  	$this->cinema = Doctrine_Core::getTable('Cinema')->findOneByLibraryId($request->getParameter('lid'));
  	$this->form = new CinemaScheduleForm();
  	$this->form->setDefault('cinema_id', $this->cinema->getId());
  	
  	if ($request->isMethod('post')){
  		$this->form->bind($request->getParameter($this->form->getName()));
  		
  		if ($this->form->isValid()){
  			$this->form->save();

  			$this->redirect($this->generateUrl('default', array('module' => 'cinemas', 'action' => 'schedule')) . '?lid=' . $this->cinema->getLibraryId());
  		}
  	}
  	
  	$this->schedules = Doctrine_Core::getTable('CinemaSchedule')->getDetailedByCinema($this->cinema->getId());
  }
  
  public function executeDeleteSchedule(sfWebRequest $request)
  {
  	$schedule = Doctrine_Core::getTable('CinemaSchedule')->findOneById($request->getParameter('id'));
  	$schedule->delete();

  	$lid = $schedule->getCinema()->getLibraryId(); 
  	$this->redirect($this->generateUrl('default', array('module' => 'cinemas', 'action' => 'schedule')) . '?lid=' . $lid);
  }

  public function executeEditSchedule(sfWebRequest $request)
  {
  	$this->forward404If(false == $this->cinemaSchedule = Doctrine_Core::getTable('CinemaSchedule')->findOneById($request->getParameter('id')));
  	
  	$this->form = new CinemaScheduleEditForm($this->cinemaSchedule);
  	
  	if ($request->isMethod('post')){
  		$this->form->bind($request->getParameter($this->form->getName()));
  		
  		if ($this->form->isValid()){
  			$this->form->save();
  			
  			$this->redirect($this->generateUrl('default', array('module' => 'cinemas', 'action' => 'schedule')) . '?lid=' . $this->cinemaSchedule->getCinema()->getLibraryId());
  		}
  	} 
  }
  
  public function executeTest(sfWebRequest $request)
  {
  	copy('http://ia.media-imdb.com/images/M/MV5BMTk3NzcwNzgxOF5BMl5BanBnXkFtZTYwMjEzNjY2._V1._SX300_SY441_.jpg', sfConfig::get('app_photos_path') . '/aaa.jpg');
  	exit;
  }
}