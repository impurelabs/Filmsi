<?php

/**
 * channels actions.
 *
 * @package    filmsi
 * @subpackage cms
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class channelsActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
	  $this->channels = ChannelTable::getInstance()->getAll();
  }

	public function executeChannelAdd(sfWebRequest $request)
	{
		$this->form = new ChannelNewForm();

		if ($request->isMethod('post')){
			$this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));

			if ($this->form->isValid()){
				$this->form->save();

				$this->redirect($this->generateUrl('default', array('module' => 'channels', 'action' => 'index')));
			}
		}
	}

	public function executeSchedule(sfWebRequest $request)
	{
	$this->channel = Doctrine_Core::getTable('Channel')->findOneById($request->getParameter('id'));
	$this->form = new ChannelScheduleForm();
	$this->form->setDefault('channel_id', $this->channel->getId());

	if ($request->isMethod('post')){
	$this->form->bind($request->getParameter($this->form->getName()));

	if ($this->form->isValid()){
		$this->form->save();

		$this->redirect($this->generateUrl('default', array('module' => 'channels', 'action' => 'schedule')) . '?id=' . $this->channel->getId());
	}
	}

	$this->schedules = ChannelScheduleTable::getInstance()->getDetailedByChannel($this->channel->getId());
	}

	public function executeScheduleDelete(sfWebRequest $request)
	{
	$schedule = Doctrine_Core::getTable('ChannelSchedule')->findOneById($request->getParameter('id'));
	$schedule->delete();

	$id = $schedule->getChannel()->getId();
	$this->redirect($this->generateUrl('default', array('module' => 'channels', 'action' => 'schedule')) . '?id=' . $id);
	}
  
	public function executeChannelEdit(sfWebRequest $request)
	{
		$this->channel = Doctrine_Core::getTable('Channel')->findOneById($request->getParameter('id'));

		$this->form = new ChannelEditForm($this->channel);

		if ($request->isMethod('post')){
			$this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));

			if ($this->form->isValid()){
				$this->form->save();

				$this->redirect($this->generateUrl('default', array('module' => 'channels', 'action' => 'index')));
			}
		}
	}
	
	public function executeImport(sfWebRequest $request)
	{
		set_time_limit(3000);
		
		$this->forward404If(false == $this->channel = Doctrine_Core::getTable('Channel')->findOneById($request->getParameter('id')));
		
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
			ChannelScheduleTable::getInstance()->deleteByChannelAndDay($this->channel->getId(), $selectedDate);

			/* Parse the schedule page */
			$handle = curl_init('http://www.cinemagia.ro/program-tv/post/' . $this->channel->getCinemagiaPullAid() . '/');
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

			/* Get the html with the schedule for each day */
			preg_match_all('/<table width="100%" border="0" cellspacing="0" cellpadding="0" class="events">(.*?)<\/table>/i', $html, $matches);

			/* For each day get the schedules */
			preg_match_all('/<tr>(.*?)\/tr>/i', $matches[1][$dateDiff], $dayMatches);

			/* For each schedule of the day get the details */
			$bruteSchedules = array();
			foreach ($dayMatches[0] as $scheduleHtml){
				preg_match('/.*?(\d\d:\d\d).*?<a href="([^"]*?)"[^>]*?>([^<]*?)<\/a>/i', $scheduleHtml, $scheduleMatches);
				if (count($scheduleMatches) > 0){
					$bruteSchedules[] = array(
						'time' => $scheduleMatches[1],
						'url' => $scheduleMatches[2],
						'name' => $scheduleMatches[3]
					);
				}
			}

			/* Prepare and add to the database */
			foreach ($bruteSchedules as $schedule){
				$time = explode(':', $schedule['time']);

				/* Get the cinemagia id of the film from the URL, and then query the page for the IMDB code */
				preg_match('/\-(\d+)\/$/i', $schedule['url'], $matches);
				$cinemagiaFilm = new CinemagiaFilm($matches[1]);

				/* Save to the database */
				$channelSchedule = new ChannelSchedule();
				$channelSchedule->setChannelId($this->channel->getId());
				$channelSchedule->setDay($selectedDate);
				$channelSchedule->setTimeHour($time[0]);
				$channelSchedule->setTimeMin($time[1]);

				if ($cinemagiaFilm->getImdb() === false || false == $film = FilmTable::getInstance()->findOneByImdb($cinemagiaFilm->getImdb())){
					$channelSchedule->setFilmNotInDb(1);
					$channelSchedule->setFilmName($schedule['name']);
				} else {
					$channelSchedule->setFilmId($film->getId());
				}

				$channelSchedule->save();
			}	

			$this->redirect($this->generateUrl('default', array('module' => 'channels', 'action' => 'schedule', 'id' => $this->channel->getId())));
		}

	}
}