<?php

/**
 * cinemas actions.
 *
 * @package    filmsi
 * @subpackage cinemas
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class cinemasActions extends sfActions
{
	/**
	* Executes index action
	*
	* @param sfRequest $request A request object
	*/
	public function executeIndex(sfWebRequest $request)
	{
		$this->cinemaCountByRegion = CinemaTable::getInstance()->countByRegion();

		if ($request->hasParameter('region')){
			$this->cinemas = CinemaTable::getInstance()->getByRegionKey(str_replace('-', '', $request->getParameter('region')));
			$this->region = $this->cinemas[0]->getLocation()->getRegion();
		}
	}

	public function executeSearch(sfWebRequest $request)
	{
		$this->currentWeekDays = array();
		$today = (int)date('N');
		$todayTime = time();
		for($i = 1; $i <= 7; $i++){
			$this->currentWeekDays[$i] = date('Y-m-d', ( $i - $today ) * 86400 + $todayTime);
		}

		$this->filmsInCinema = CinemaScheduleTable::getInstance()->getAllFilmListByDays($this->currentWeekDays);
		$this->locations = CinemaTable::getInstance()->getLocations();
		
		$this->currentDay = $request->getParameter('d', date('Y-m-d'));
		$this->currentLocation = $request->getParameter('l', null);
		if ($this->currentLocation == ''){
			$this->currentLocation = null;
		}
		$this->currentFilm = $request->getParameter('f', null);
		if ($this->currentFilm == ''){
			$this->currentFilm = null;
		}

		$this->films = CinemaScheduleTable::getInstance()->getFilmsAndCinemasByDayAndLocationAndFilm($this->currentDay, $this->currentLocation, $this->currentFilm);
	}

	public function executeView(sfWebRequest $request)
	{
		$this->cinema = CinemaTable::getInstance()->findOneById($request->getParameter('id'));

		$this->getResponse()->setTitle($this->cinema->getName() . ' - Filmsi.ro');
		$this->getResponse()->addMeta('keywords', $this->cinema->getMetaKeywords());
		$this->getResponse()->addMeta('description', $this->cinema->getMetaDescription());

		$this->getContext()->getConfiguration()->loadHelpers('Date');

		$this->currentWeekDays = array();
		$today = (int)date('N');
		$todayTime = time();
		for($i = 1; $i <= 7; $i++){
			$this->currentWeekDays[$i] = date('Y-m-d', ( $i - $today ) * 86400 + $todayTime);
		}

		$pieces = explode('-', $this->currentWeekDays[1]);
		$this->firstDay = $pieces[2];
		$pieces = explode('-', $this->currentWeekDays[7]);
		$this->lastDay = $pieces[2];


		$this->currentFilms = CinemaScheduleTable::getInstance()->getScheduledFilmsByDays($this->cinema->getId(), $this->currentWeekDays, 4);
		$this->futureFilms = CinemaScheduleTable::getInstance()->getFutureFilms($this->cinema->getId(), $this->currentWeekDays[7], array_keys($this->currentFilms), 4);

		$this->commentForm = new CommentForm(null, array(
			'state' => 1,
			'ip' => $_SERVER['REMOTE_ADDR'],
			'model' => 'Cinema',
                        'model_library_id' => $this->cinema->getLibraryId(),
                        'model_name' => $this->cinema->getName()
		));
		if ($this->getUser()->isAuthenticated()){
			$user = $this->getUser()->getGuardUser();
			$this->commentForm->setDefaults(array(
				'name' => $user->getName(),
				'email' => $user->getEmailAddress()
			));
		}
		if ($request->isMethod('post')){
			$this->commentForm->bind($request->getParameter($this->commentForm->getName()));

			if ($this->commentForm->isValid()){
				$this->commentForm->save();

                                $this->redirect($this->generateUrl('cinema', array('id' => $this->cinema->getId(), 'key' => $this->cinema->getUrlKey())) . '#comments');
			}
		}

		$this->comments = Doctrine_Core::getTable('Comment')->getActiveByModel('cinema', $this->cinema->getLibraryId(), $_SERVER['REMOTE_ADDR']);

		/* Add the visit */
		$visit = new Visit();
		$visit->setLibraryId($this->cinema->getLibraryId());
		$visit->setUrl($this->generateUrl('cinema', array('id' => $this->cinema->getId(), 'key' => $this->cinema->getUrlKey())));
		$visit->setName($this->cinema->getName());
		$visit->setIp($_SERVER['REMOTE_ADDR']);
		$visit->save();
	}

	public function executeDescription(sfWebRequest $request)
	{
		$this->cinema = CinemaTable::getInstance()->findOneById($request->getParameter('id'));

		$this->getResponse()->setTitle($this->cinema->getName() . ' - Filmsi.ro');
		$this->getResponse()->addMeta('keywords', $this->cinema->getMetaKeywords());
		$this->getResponse()->addMeta('description', $this->cinema->getMetaDescription());
	}

	public function executePromotions(sfWebRequest $request)
	{
		$this->cinema = CinemaTable::getInstance()->findOneById($request->getParameter('id'));

		$this->getResponse()->setTitle($this->cinema->getName() . ' - Filmsi.ro');
		$this->getResponse()->addMeta('keywords', $this->cinema->getMetaKeywords());
		$this->getResponse()->addMeta('description', $this->cinema->getMetaDescription());
	}

	public function executePromotionEdit(sfWebRequest $request)
	{
		$this->forward404If(false == $this->cinemaPromotion = Doctrine_Core::getTable('CinemaPromotion')->findOneById($request->getParameter('id')));

		$this->cinema = $this->cinemaPromotion->getCinema();

		$this->form = new CinemaPromotionEditForm($this->cinemaPromotion);

		if ($request->isMethod('post')){
			$this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));

			if ($this->form->isValid()){
				$this->form->save();

				$this->redirect($this->generateUrl('cinema_promotions', array('id' => $this->cinema->getId(), 'key' => $this->cinema->getUrlKey())));
			}
		}

	}

	public function executeSchedule(sfWebRequest $request)
	{
		$this->cinema = CinemaTable::getInstance()->findOneById($request->getParameter('id'));

		$this->getResponse()->setTitle($this->cinema->getName() . ' - Filmsi.ro');
		$this->getResponse()->addMeta('keywords', $this->cinema->getMetaKeywords());
		$this->getResponse()->addMeta('description', $this->cinema->getMetaDescription());

		$weekFirstDay = date('Y-m-d', ( 1 - (int)date('N') ) * 86400 + time());
		$this->films = CinemaScheduleTable::getInstance()->getAllScheduledFilmsFromWeekStart($this->cinema->getId(), $weekFirstDay);
	}

	public function executeTickets(sfWebRequest $request)
	{
		$this->cinema = CinemaTable::getInstance()->findOneById($request->getParameter('id'));

		$this->getResponse()->setTitle($this->cinema->getName() . ' - Filmsi.ro');
		$this->getResponse()->addMeta('keywords', $this->cinema->getMetaKeywords());
		$this->getResponse()->addMeta('description', $this->cinema->getMetaDescription());
	}

	public function executeComments(sfWebRequest $request)
	{
		$this->cinema = CinemaTable::getInstance()->findOneById($request->getParameter('id'));

		$this->getResponse()->setTitle('Comentarii: ' . $this->cinema->getName() . ' - Filmsi.ro');
		$this->getResponse()->addMeta('keywords', '');
		$this->getResponse()->addMeta('description', '');



		$this->commentForm = new CommentForm(null, array(
			'state' => 1,
			'ip' => $_SERVER['REMOTE_ADDR'],
			'model' => 'Cinema',
                        'model_library_id' => $this->cinema->getLibraryId(),
                        'model_name' => $this->cinema->getName()
		));
		if ($this->getUser()->isAuthenticated()){
			$user = $this->getUser()->getGuardUser();
			$this->commentForm->setDefaults(array(
				'name' => $user->getName(),
				'email' => $user->getEmailAddress()
			));
		}
		if ($request->isMethod('post')){
			$this->commentForm->bind($request->getParameter($this->commentForm->getName()));

			if ($this->commentForm->isValid()){
				$this->commentForm->save();

                                $this->redirect($this->generateUrl('cinema', array('id' => $this->cinema->getId(), 'key' => $this->cinema->getUrlKey())) . '#comments');
			}
		}

		$this->comments = Doctrine_Core::getTable('Comment')->getActiveByModel('cinema', $this->cinema->getLibraryId(), $_SERVER['REMOTE_ADDR']);
	}

	public function executePhotos(sfWebRequest $request)
	{
		$this->cinema = CinemaTable::getInstance()->findOneById($request->getParameter('id'));

		$this->getResponse()->setTitle('Fotografii: ' . $this->cinema->getName() . ' - Filmsi.ro');
		$this->getResponse()->addMeta('keywords', '');
		$this->getResponse()->addMeta('description', '');

		$this->photos = $this->cinema->getPhotoAlbum()->getPhotos();
		$this->photoCount = $this->photos->count();

		$this->currentPhoto = $request->getParameter('pid', 1);
	}

	public function executeStiri(sfWebRequest $request)
	{
		$this->cinema = Doctrine_Core::getTable('Cinema')->findOneById($request->getParameter('id'));

		$this->getResponse()->setTitle('Cinema: ' . $this->cinema->getName() . ' - Filmsi.ro');
		$this->getResponse()->addMeta('keywords', '');
		$this->getResponse()->addMeta('description', '');

		$this->currentPage = (int)$request->getParameter('p', 1);
		$this->stires = $this->cinema->getRelatedStires(sfConfig::get('app_stire_page_limit'), $this->currentPage, false);

		$this->stireCount = $this->cinema->getRelatedStiresCount();
		$this->pageCount = ceil($this->stireCount / sfConfig::get('app_stire_page_limit'));
		$this->firstStireCount = sfConfig::get('app_stire_page_limit') * ($this->currentPage - 1) + 1;
		$this->lastStireCount = $this->firstStireCount + $this->stires->count() - 1;
		if ($this->pageCount <= 5) {
				$this->navStart = 1;
				$this->navEnd = $this->pageCount;
		} else {
				$this->navStart = $this->currentPage - 2;
				$this->navEnd = $this->currentPage - 2;

				if ($this->navStart <= 0){
						$this->navStart = 1;
						$this->navEnd = 5;
				}

				if ($this->navEnd >= $this->pageCount){
						$this->navStart = $this->pageCount - 4;
						$this->navEnd = $this->pageCount;
				}
		}
	}

	public function executeVote(sfWebRequest $request)
	{
		$this->forward404If(!$request->isMethod('post'));

		$vote = new CinemaVote();
		$vote->setCinemaId($request->getParameter('cinema_id'));
		$vote->setGrade($request->getParameter('grade'));
		$vote->setIp($_SERVER['REMOTE_ADDR']);
		$vote->save();

		$this->redirect($request->getReferer());
	}
}
