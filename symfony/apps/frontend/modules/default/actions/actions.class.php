<?php

/**
 * default actions.
 *
 * @package    filmsi
 * @subpackage default
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class defaultActions extends sfActions
{
    /**
    * Executes index action
    *
    * @param sfRequest $request A request object
    */
    public function executeIndex(sfWebRequest $request)
    {
        $this->stires = StireTable::getInstance()->getList(9);
		$this->starStires = StireTable::getInstance()->getAboutStars(9);

		$days = array();
		$today = (int)date('N');
		$todayTime = time();
		for($i = 1; $i <= 7; $i++){
			$days[$i] = date('Y-m-d', ( $i - $today ) * 86400 + $todayTime);
		}
		$this->filmsNowInCinema = FilmTable::getInstance()->getInCinemaNow($days, 5, null, null, null, null, Doctrine_Core::HYDRATE_RECORD);
		$this->filmsNowDbo = FilmTable::getInstance()->getOnDvdAndBlurayNow(5, null, null, null, null, true, true, Doctrine_Core::HYDRATE_RECORD);
		$this->filmsNowTv = ChannelScheduleTable::getInstance()->getFilmsByDay(date('Y-m-d'), 5);
		$this->cinemaLocations = CinemaTable::getInstance()->getLocations();
		$this->filmsSoonInCinema = FilmTable::getInstance()->getInCinemaSoon(5, null, null, null, Doctrine_Core::HYDRATE_RECORD);
		$this->filmsSoonDbo = FilmTable::getInstance()->getOnDvdAndBluraySoon(5, null, null, null, null, true, true, Doctrine_Core::HYDRATE_RECORD);
		$this->filmsSoonTv = FilmTable::getInstance()->getOnTvSoon(5, null, null, null, Doctrine_Core::HYDRATE_RECORD);
		$this->latestTrailers = VideoTable::getInstance()->getLatestTrailers(6);
		$this->personsBorn = PersonTable::getInstance()->getBornToday(5);
		$this->bestActors = PersonTable::getInstance()->getBestActors(5);
		$this->latestComments = CommentTable::getInstance()->getLatestForFilms(7);
		$this->boxRoFilms = BoxofficeFilmTable::getInstance()->getByType('ro');
		$this->boxUsFilms = BoxofficeFilmTable::getInstance()->getByType('us');
		$this->filmPhotos = PhotoTable::getInstance()->getLatestNonRedcarpetPhotosOnHome(5);
		$this->redcarpetPhotos = PhotoTable::getInstance()->getLatestRedcarpetPhotosOnHome(5);
		$this->latestAwards = FestivalEditionTable::getInstance()->getLatest(3);

		$this->homepage = HomepageTable::getInstance()->findOneById(1);
		if ($this->homepage->getBackgroundFilename() != ''){
			$this->setLayout('layoutHome');
			$details = getimagesize(sfConfig::get('app_aws_s3_path') . sfConfig::get('app_aws_bucket') . '/' . sfConfig::get('app_homepage_aws_s3_folder') .  '/' . $this->homepage->getBackgroundFilename());
			$this->width = $details[0];
		}

		$this->newsletterForm = new NewsletterEmailForm();
		if ($request->isMethod('post')){
			$this->newsletterForm->bind($request->getParameter($this->newsletterForm->getName()));

			if ($this->newsletterForm->isValid()){
				$this->newsletterForm->save();

				$this->newsletterSaved = true;
			} else {
				$this->newsletterSaved = false;
			}
		} else {
			$this->newsletterSaved = false;
		}
    }

    public function executeSendFeedback(sfWebRequest $request)
    {
        $this->forward404If(!$request->isMethod('post'));

        $this->getMailer()->send(new FeedbackEmail(
            sfConfig::get('app_feedback_email'),
            $this->getPartial('default/send_feedback', array('name' => $request->getParameter('name'), 'email' => $request->getParameter('email'), 'content' => $request->getParameter('content'))),
            $request->getParameter('name')
        ));

        return $this->renderText(json_encode(array('status' => true)));
    }

	public function executeSearch(sfWebRequest $request)
	{
		$this->setLayout(false);
		
		$results = array();
		
		$this->getContext()->getConfiguration()->loadHelpers('Filmsi');
		
		$results['films'] = array();
		foreach (FilmTable::getInstance()->getForSearch($request->getParameter('term'), 5) as $film) {
			$persons = array();
			foreach($film->getBestActors(2) as $person){
				$persons[] = array(
					'name' => $person->getName(),
					'url' => $this->generateUrl('person', array('id' => $person->getId(), 'key' => $person->getUrlKey()))
				);
			}
			
			$results['films'][] = array(
				'name_ro' => $film->getNameRo(),
				'name_en' => $film->getNameEn(),
				'url' => $this->generateUrl('film', array('id' => $film->getId(), 'key' => $film->getUrlKey())),
				'filename_url' => filmsiFilmPhotoThumbS($film->getFilename()),
				'persons' => $persons
			);
		}
		
		$results['persons'] = array();
		foreach (PersonTable::getInstance()->getForSearch($request->getParameter('term'), 5) as $person) {
			if ($film = $person->getMostViewedFilmsByRole(1, null, Doctrine_Core::HYDRATE_RECORD)->getFirst()){
				$filmParam = array(
					'name' => $film->getNameRo(),
					'url' => $this->generateUrl('film', array('id' => $film->getId(), 'key' => $film->getUrlKey()))
				);
			} else {
				$filmParam = array();
			}
				
			
			$results['persons'][] = array(
				'name' => $person->getName(),
				'url' => $this->generateUrl('person', array('id' => $person->getId(), 'key' => $person->getUrlKey())),
				'filename_url' => filmsiPersonPhotoThumb($person->getFilename()),
				'film' => $filmParam
			);
		}
		
		return $this->renderText(json_encode($results));
	}

	public function executeSearchResults(sfWebRequest $request)
	{
		$term = $request->getParameter('q');
		
		$results = array();
		
		$this->getContext()->getConfiguration()->loadHelpers('Filmsi');
		
		$this->films = FilmTable::getInstance()->getForSearch($term, 20);
		$this->persons = PersonTable::getInstance()->getForSearch($term, 20);
		$this->cinemas = CinemaTable::getInstance()->getForSearch($term, 20);
		$this->articles = ArticleTable::getInstance()->getForSearch($term, 20);
		$this->stires = StireTable::getInstance()->getForSearch($term, 20);
		$this->photos = PhotoTable::getInstance()->getForSearch($term, 3);
		$this->videos = VideoTable::getInstance()->getForSearch($term, 1);
		
		
		/* Update the search counter for the films, persons and cinemas */
		$searchedIds = array();
		foreach ($this->films as $film){
			$searchedIds[] = $film->getLibraryId();
		}
		foreach ($this->persons as $person){
			$searchedIds[] = $person->getLibraryId();
		}
		foreach ($this->cinemas as $cinema){
			$searchedIds[] = $cinema->getLibraryId();
		}
		
		LibraryTable::getInstance()->raiseSearchCounterByIds($searchedIds);
	}

	public function executeSearchResultsFilms(sfWebRequest $request)
	{
		$term = $request->getParameter('q');
		
		$results = array();
		
		$this->getContext()->getConfiguration()->loadHelpers('Filmsi');
		
		$this->films = FilmTable::getInstance()->getForSearch($term, 100);
	}

	public function executeSearchResultsPersons(sfWebRequest $request)
	{
		$term = $request->getParameter('q');
		
		$results = array();
		
		$this->getContext()->getConfiguration()->loadHelpers('Filmsi');
		
		$this->persons = PersonTable::getInstance()->getForSearch($term, 100);
	}

	public function executeSearchResultsCinemas(sfWebRequest $request)
	{
		$term = $request->getParameter('q');
		
		$results = array();
		
		$this->getContext()->getConfiguration()->loadHelpers('Filmsi');
		
		$this->cinemas = CinemaTable::getInstance()->getForSearch($term, 100);
	}

	public function executeSearchResultsArticles(sfWebRequest $request)
	{
		$term = $request->getParameter('q');
		
		$results = array();
		
		$this->getContext()->getConfiguration()->loadHelpers('Filmsi');
		
		$this->articles = ArticleTable::getInstance()->getForSearch($term, 100);
	}

	public function executeSearchResultsStires(sfWebRequest $request)
	{
		$term = $request->getParameter('q');
		
		$results = array();
		
		$this->getContext()->getConfiguration()->loadHelpers('Filmsi');
		
		$this->stires = StireTable::getInstance()->getForSearch($term, 100);
	}

	public function executeSearchResultsPhotos(sfWebRequest $request)
	{
		$term = $request->getParameter('q');
		
		$results = array();
		
		$this->getContext()->getConfiguration()->loadHelpers('Filmsi');
		
		$this->photos = PhotoTable::getInstance()->getForSearch($term, 100);
	}

	public function executeSearchResultsVideos(sfWebRequest $request)
	{
		$term = $request->getParameter('q');
		
		$results = array();
		
		$this->getContext()->getConfiguration()->loadHelpers('Filmsi');
		
		$this->videos = VideoTable::getInstance()->getForSearch($term, 100);
	}

	public function executeTerms(sfWebRequest $request)
	{
		$this->content = ContentTable::getInstance()->findOneById(2);
	}

	public function executePublicitate(sfWebRequest $request)
	{
		$this->content = ContentTable::getInstance()->findOneById(3);
	}

	public function executeContact(sfWebRequest $request)
	{
		$this->content = ContentTable::getInstance()->findOneById(1);

		$this->form = new ContactForm();

		if ($request->isMethod('post')){
			$this->form->bind($request->getParameter($this->form->getName()));
			if ($this->form->isValid()){
				$this->getMailer()->send(new ContactEmail(
					sfConfig::get('app_contact_email'),
					$this->getPartial('default/send_contact', array(
						'firstName' => $this->form->getValue('first_name'),
						'lastName' => $this->form->getValue('last_name'),
						'email' => $this->form->getValue('email'),
						'phone' => $this->form->getValue('phone'),
						'message' => $this->form->getValue('message')
					)),
					$this->form->getValue('first_name') . ' ' . $this->form->getValue('last_name')
				));

				$this->messageSentOk = true;
			}
		}
	}
}