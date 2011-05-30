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

	public function executeAdmin(sfWebRequest $request)
	{
		$this->cinema = Doctrine_Core::getTable('Cinema')->findOneByLibraryId($request->getParameter('lid'));
		$this->admin = $this->cinema->getAdmin();
	}

	public function executeEditAdmin(sfWebRequest $request)
	{
		$cinema = Doctrine_Core::getTable('Cinema')->findOneByLibraryId($request->getParameter('lid'));

		$this->form = new CinemaAdminForm($cinema);
		
		if ($request->isMethod('post')){
			$this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));

			if ($this->form->isValid()){
				$this->form->save();

				$this->redirect($this->generateUrl('default', array('module' => 'cinemas', 'action' => 'admin')) . '?lid=' . $this->form->getObject()->getLibraryId());
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
  
  public function executeDeletePromotionPhoto(sfWebRequest $request)
  {
	  $this->forward404Unless($request->isMethod('post'));
	  
	  $this->forward404If(false == $this->cinemaPromotion = Doctrine_Core::getTable('CinemaPromotion')->findOneById($request->getParameter('id')));
	  
	  $this->cinemaPromotion->deletePhoto();
	  
	  $this->redirect($this->generateUrl('default', array('module' => 'cinemas', 'action' => 'view')) . '?lid=' . $this->cinemaPromotion->getCinema()->getLibraryId());
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
  
  public function executeImport(sfWebRequest $request)
  {  
	  $this->forward404If(false == $this->cinema = Doctrine_Core::getTable('Cinema')->findOneById($request->getParameter('id')));
	  
	  $this->days = array(
		  '1' => 'luni',
		  '2' => 'marti',
		  '3' => 'miercuri',
		  '4' => 'joi',
		  '5' => 'vineri',
		  '6' => 'sambata',
		  '7' => 'duminica'
	  );
	  
	  $this->today = (int)date('N');
	  
	  if ($request->isMethod('post')){
		  $selectedDay = (int)$request->getParameter('day');
		  
		  $dateDiff = $selectedDay - $this->today;
		  if ($dateDiff < 0) {
			  $dateDiff += 7;
		  }
		  
		  $selectedDate = date('Y-m-d', strtotime('+' . $dateDiff . ' day'));
		  
		  /* Delete all the schedules for the selected day */
		  CinemaScheduleTable::getInstance()->deleteByDayAndCinema($selectedDate, $this->cinema->getId());
		  
		  /* Parse the schedule page */
			$handle = curl_init('http://www.cinemagia.ro/program-cinema/' . $this->cinema->getCinemagiaPullAid() . '/' . $this->days[$selectedDay] . '/');
			curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($handle, CURLOPT_COOKIE, 'afisare_program_cinema=default');

			/* Get the HTML or whatever is linked in $url. */
			$html = curl_exec($handle);

			/* Check for 404 (file not found). */
			$httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);

			if($httpCode != 200) {
				throw new ImdbComFilmException('Nu s-a gasit pagina pentru.');
			}
			curl_close($handle);
		  
			$html = str_replace(array("\r", "\r\n", "\n"), '', $html);
			$html = str_replace('  ', '', $html);
			
			preg_match_all('/<table id="showInterval(\d*?)\-(\d*?)"(.*?)>(.*?)<td class="theatre_info">(.*?)<span class="nowrap">(.*?)<a href="#" class="show_hour_price_info"(.*?)>(.*?)<\/a>(.*?)<\/span>(.*?)<\/td>(.*?)<\/table>/i', $html, $matches);
			
			/* Group all the hours for each film */
			$filmsSchedule = array();
			foreach ($matches[2] as $key => $filmPullAid){
				if (!isset($filmsSchedule[$filmPullAid]['name'])){
					/* Get the name */
					preg_match('/<small>(.*?)<\/small>/i', $matches[4][$key], $otherMatches);
					
					//var_dump($otherMatches);
					$filmsSchedule[$filmPullAid]['name'] = $otherMatches[1];
					$filmsSchedule[$filmPullAid]['schedule'] = array();
				}
				
				$filmsSchedule[$filmPullAid]['schedule'][] = $matches[8][$key];
			}
			
			$filmsWithImdbSchedule = array();
			/* Convert each filmPullAid to the imdb code */
			foreach ($filmsSchedule as $key => $schedule){
				$film = new CinemagiaFilm($key);
				$filmsWithImdbSchedule[$film->getImdb()]['name'] = $schedule['name'];
				$filmsWithImdbSchedule[$film->getImdb()]['schedule'] = $schedule['schedule'];
			}
			unset($filmsSchedule);
			
			/* Add to the database */
			foreach ($filmsWithImdbSchedule as $imdb => $scheduledFilm){
				$schedule = new CinemaSchedule();
				$schedule->setCinemaId($this->cinema->getId());
				
				/* Try to find the film in the database  */
				if (false === $film = FilmTable::getInstance()->findOneByImdb($imdb)){					
					$schedule->setFilmNotInDb('1');
					$schedule->setFilmName($scheduledFilm['name']);
				} else {
					$schedule->setFilmId($film->getId());
				}
				
				$schedule->setDay($selectedDate);
				$schedule->setSchedule(implode(', ', $scheduledFilm['schedule']));
				
				$schedule->save();
			}
			
			$this->redirect($this->generateUrl('default', array('module' => 'cinemas', 'action' => 'schedule', 'lid' => $this->cinema->getLibraryId())));
	  }
  }
}