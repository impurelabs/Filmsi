<?php

/**
 * films actions.
 *
 * @package    filmsi
 * @subpackage films
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class filmsActions extends sfActions
{
	public function executeView(sfWebRequest $request)
	{
		$this->film = FilmTable::getInstance()->findOneById($request->getParameter('id'));

		if ($this->film->getIsSeries() == '1'){
			$this->selectedSeason = $request->getParameter('s', 1);

			$this->episodes = FilmEpisodeTable::getInstance()->getByFilmAndSeason($this->film->getId(), $this->selectedSeason);
			$this->seasons = FilmEpisodeTable::getInstance()->getSeasonsByFilm($this->film->getId());
		}

		if ($this->film->getBackgroundFilename() != ''){
			$this->setLayout('layoutFilm');
			$details = getimagesize(sfConfig::get('app_film_background_path') . '/' .$this->film->getBackgroundFilename());
			$this->backgroundWidth = $details[0];
		}else{
			$this->backgroundWidth = '';
		}

		$this->getResponse()->setTitle($this->film->getName() . ' - Filmsi.ro');
		$this->getResponse()->addMeta('keywords', $this->film->getMetaKeywords());
		$this->getResponse()->addMeta('description', $this->film->getMetaDescription());

		$this->getContext()->getConfiguration()->loadHelpers('Date');
		$this->statuses = array();
		$this->isInCinema = false;

		if ($this->film->getStatusInProduction() == '1'){
			$this->statuses[] = 'IN PRODUCTIE';
		} else {
			/* Set the cinema status */
			if ($this->film->getStatusCinema() == '1'){
				if ($this->film->getStatusCinemaYear() != '0' && $this->film->getStatusCinemaMonth() != '0' && $this->film->getStatusCinemaDay() != '0'){
					if(strtotime($this->film->getStatusCinemaYear() . '-' . $this->film->getStatusCinemaMonth() . '-01') < time()){
						$this->statuses[] = 'ACUM in cinema';
						$this->isInCinema = true;
					} else {
						$this->statuses[] = 'DIN ' . strtoupper(format_date($this->film->getStatusCinemaYear() . '-' . $this->film->getStatusCinemaMonth() . '-' . $this->film->getStatusCinemaDay(),'D', 'ro')) . ' in cinema';
					}
				} elseif ($this->film->getStatusCinemaYear() != '0' && $this->film->getStatusCinemaMonth() != '0') {
					$this->statuses[] = 'DIN ' . strtoupper(format_date($this->film->getStatusCinemaYear() . '-' . $this->film->getStatusCinemaMonth() . '-01', 'M', 'ro')) . ' in cinema';
				} else {
					$this->statuses[] = 'IN CURAND in cinema';
				}
			}

			/* Set the DVD status */
			if ($this->film->getStatusDvd() == '1'){
				if ($this->film->getStatusDvdYear() != '0' && $this->film->getStatusDvdMonth() != '0' && $this->film->getStatusDvdDay() != '0'){
					if(strtotime($this->film->getStatusDvdYear() . '-' . $this->film->getStatusDvdMonth() . '-01') < time()){
						$this->statuses[] = 'ACUM pe DVD';
					} else {
						$this->statuses[] = 'DIN ' . strtoupper(format_date($this->film->getStatusDvdYear() . '-' . $this->film->getStatusDvdMonth() . '-' . $this->film->getStatusDvdDay(),'D', 'ro')) . ' pe DVD';
					}
				} elseif ($this->film->getStatusDvdYear() != '0' && $this->film->getStatusDvdMonth() != '0') {
					$this->statuses[] = 'DIN ' . strtoupper(format_date($this->film->getStatusDvdYear() . '-' . $this->film->getStatusDvdMonth() . '-01', 'M', 'ro')) . ' pe DVD';
				} else {
					$this->statuses[] = 'IN CURAND pe DVD';
				}
			}

			/* Set the Bluray status */
			if ($this->film->getStatusBluray() == '1'){
				if ($this->film->getStatusBlurayYear() != '0' && $this->film->getStatusBlurayMonth() != '0' && $this->film->getStatusBlurayDay() != '0'){
					if(strtotime($this->film->getStatusBlurayYear() . '-' . $this->film->getStatusBlurayMonth() . '-01') < time()){
						$this->statuses[] = 'ACUM pe Blu-ray';
					} else {
						$this->statuses[] = 'DIN ' . strtoupper(format_date($this->film->getStatusBlurayYear() . '-' . $this->film->getStatusBlurayMonth() . '-' . $this->film->getStatusBlurayDay(),'D', 'ro')) . ' pe Blu-ray';
					}
				} elseif ($this->film->getStatusBlurayYear() != '0' && $this->film->getStatusBlurayMonth() != '0') {
					$this->statuses[] = 'DIN ' . strtoupper(format_date($this->film->getStatusBlurayYear() . '-' . $this->film->getStatusBlurayMonth() . '-01', 'M', 'ro')) . ' pe Blu-ray';
				} else {
					$this->statuses[] = 'IN CURAND pe Blu-ray';
				}
			}

			/* Set the Online status */
			if ($this->film->getStatusOnline() == '1'){
				if ($this->film->getStatusOnlineYear() != '0' && $this->film->getStatusOnlineMonth() != '0' && $this->film->getStatusOnlineDay() != '0'){
					if(strtotime($this->film->getStatusOnlineYear() . '-' . $this->film->getStatusOnlineMonth() . '-01') < time()){
						$this->statuses[] = 'ACUM online';
					} else {
						$this->statuses[] = 'DIN ' . strtoupper(format_date($this->film->getStatusOnlineYear() . '-' . $this->film->getStatusOnlineMonth() . '-' . $this->film->getStatusOnlineDay(),'D', 'ro')) . ' online';
					}
				} elseif ($this->film->getStatusOnlineYear() != '0' && $this->film->getStatusOnlineMonth() != '0') {
					$this->statuses[] = 'DIN ' . strtoupper(format_date($this->film->getStatusOnlineYear() . '-' . $this->film->getStatusOnlineMonth() . '-01', 'M', 'ro')) . ' online';
				} else {
					$this->statuses[] = 'IN CURAND online';
				}
			}
		}


		$this->actors = FilmPersonTable::getInstance()->getBestActorsByFilm($this->film->getId(), 3);
		$this->directors = FilmPersonTable::getInstance()->getBestDirectorsByFilm($this->film->getId());


		$this->commentForm = new CommentForm(null, array(
			'state' => 1,
			'ip' => $_SERVER['REMOTE_ADDR'],
			'model' => 'Film',
                        'model_library_id' => $this->film->getLibraryId(),
                        'model_name' => $this->film->getName()
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

                                $this->redirect($this->generateUrl('film', array('id' => $this->film->getId(), 'key' => $this->film->getUrlKey())) . '#comments');
			}
		}

		$this->comments = Doctrine_Core::getTable('Comment')->getActiveByModel('film', $this->film->getLibraryId(), $_SERVER['REMOTE_ADDR']);

		/* Add the visit */
		$visit = new Visit();
		$visit->setLibraryId($this->film->getLibraryId());
		$visit->setUrl($this->generateUrl('film', array('id' => $this->film->getId(), 'key' => $this->film->getUrlKey())));
		$visit->setName($this->film->getNameRo());
		$visit->setIp($_SERVER['REMOTE_ADDR']);
		$visit->save();
	}

	public function executeVote(sfWebRequest $request)
	{
		$this->forward404If(!$request->isMethod('post'));

		$vote = new FilmVote();
		$vote->setFilmId($request->getParameter('film_id'));
		$vote->setGrade($request->getParameter('grade'));
		$vote->setIp($_SERVER['REMOTE_ADDR']);
		$vote->save();

		$this->redirect($request->getReferer());
	}

	public function executeArticles(sfWebRequest $request)
	{
		$this->film = FilmTable::getInstance()->findOneById($request->getParameter('id'));

		if ($this->film->getBackgroundFilename() != ''){
			$this->setLayout('layoutFilm');
			$details = getimagesize(sfConfig::get('app_film_background_path') . '/' .$this->film->getBackgroundFilename());
			$this->backgroundWidth = $details[0];
		}else{
			$this->backgroundWidth = '';
		}

		$this->getResponse()->setTitle('Articole: ' . $this->film->getName() . ' - Filmsi.ro');
		$this->getResponse()->addMeta('keywords', '');
		$this->getResponse()->addMeta('description', '');

		$this->currentPage = (int)$request->getParameter('p', 1);
		$this->articles = ArticleTable::getInstance()->getListByFilm($this->film->getId(), sfConfig::get('app_article_page_limit'), $this->currentPage);
		$this->articleCount = ArticleTable::getInstance()->countByFilm($this->film->getId());
		$this->pageCount = ceil($this->articleCount / sfConfig::get('app_article_page_limit'));
		$this->firstArticleCount = sfConfig::get('app_article_page_limit') * ($this->currentPage - 1) + 1;
		$this->lastArticleCount = $this->firstArticleCount + $this->articles->count() - 1;
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

	public function executeComments(sfWebRequest $request)
	{		
		$this->film = FilmTable::getInstance()->findOneById($request->getParameter('id'));

		if ($this->film->getBackgroundFilename() != ''){
			$this->setLayout('layoutFilm');
			$details = getimagesize(sfConfig::get('app_film_background_path') . '/' .$this->film->getBackgroundFilename());
			$this->backgroundWidth = $details[0];
		}else{
			$this->backgroundWidth = '';
		}

		$this->getResponse()->setTitle('Comentarii: ' . $this->film->getName() . ' - Filmsi.ro');
		$this->getResponse()->addMeta('keywords', '');
		$this->getResponse()->addMeta('description', '');



		$this->commentForm = new CommentForm(null, array(
			'state' => 1,
			'ip' => $_SERVER['REMOTE_ADDR'],
			'model' => 'Film',
                        'model_library_id' => $this->film->getLibraryId(),
                        'model_name' => $this->film->getName()
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

                                $this->redirect($this->generateUrl('film', array('id' => $this->film->getId(), 'key' => $this->film->getUrlKey())) . '#comments');
			}
		}

		$this->comments = Doctrine_Core::getTable('Comment')->getActiveByModel('film', $this->film->getLibraryId(), $_SERVER['REMOTE_ADDR']);
	}

	public function executePhotos(sfWebRequest $request)
	{
		$this->film = FilmTable::getInstance()->findOneById($request->getParameter('id'));

		if ($this->film->getBackgroundFilename() != ''){
			$this->setLayout('layoutFilm');
			$details = getimagesize(sfConfig::get('app_film_background_path') . '/' .$this->film->getBackgroundFilename());
			$this->backgroundWidth = $details[0];
		}else{
			$this->backgroundWidth = '';
		}

		$this->getResponse()->setTitle('Fotografii: ' . $this->film->getName() . ' - Filmsi.ro');
		$this->getResponse()->addMeta('keywords', '');
		$this->getResponse()->addMeta('description', '');

		$this->photos = $this->film->getPhotoAlbum()->getPhotos();
		$this->photoCount = $this->photos->count();

		$this->currentPhoto = $request->getParameter('pid', 1);
	}

	public function executeStiri(sfWebRequest $request)
	{
		$this->film = Doctrine_Core::getTable('Film')->findOneById($request->getParameter('id'));

		if ($this->film->getBackgroundFilename() != ''){
			$this->setLayout('layoutFilm');
			$details = getimagesize(sfConfig::get('app_film_background_path') . '/' .$this->film->getBackgroundFilename());
			$this->backgroundWidth = $details[0];
		}else{
			$this->backgroundWidth = '';
		}

		$this->getResponse()->setTitle('Stiri: ' . $this->film->getName() . ' - Filmsi.ro');
		$this->getResponse()->addMeta('keywords', '');
		$this->getResponse()->addMeta('description', '');

		$this->currentPage = (int)$request->getParameter('p', 1);
		$this->stires = $this->film->getRelatedStires(sfConfig::get('app_stire_page_limit'), $this->currentPage, false);

		$this->stireCount = $this->film->getRelatedStiresCount();
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

	public function executeSinopsis(sfWebRequest $request)
	{
		$this->film = Doctrine_Core::getTable('Film')->findOneById($request->getParameter('id'));

		if ($this->film->getBackgroundFilename() != ''){
			$this->setLayout('layoutFilm');
			$details = getimagesize(sfConfig::get('app_film_background_path') . '/' .$this->film->getBackgroundFilename());
			$this->backgroundWidth = $details[0];
		}else{
			$this->backgroundWidth = '';
		}

		$this->getResponse()->setTitle('Sinopsis: ' . $this->film->getName() . ' - Filmsi.ro');
		$this->getResponse()->addMeta('keywords', '');
		$this->getResponse()->addMeta('description', '');
	}

	public function executeCast(sfWebRequest $request)
	{
		$this->film = Doctrine_Core::getTable('Film')->findOneById($request->getParameter('id'));

		if ($this->film->getBackgroundFilename() != ''){
			$this->setLayout('layoutFilm');
			$details = getimagesize(sfConfig::get('app_film_background_path') . '/' .$this->film->getBackgroundFilename());
			$this->backgroundWidth = $details[0];
		}else{
			$this->backgroundWidth = '';
		}

		$this->getResponse()->setTitle('Actori & echipa: ' . $this->film->getName() . ' - Filmsi.ro');
		$this->getResponse()->addMeta('keywords', '');
		$this->getResponse()->addMeta('description', '');

		$this->actors        = FilmPersonTable::getInstance()->getBestActorsByFilm($this->film->getId());
		$this->directors     = FilmPersonTable::getInstance()->getBestDirectorsByFilm($this->film->getId());
		$this->scriptwriters = FilmPersonTable::getInstance()->getBestScriptwritersByFilm($this->film->getId(), 3);
		$this->producers     = FilmPersonTable::getInstance()->getBestProducersByFilm($this->film->getId());
	}

	public function executeBuy(sfWebRequest $request)
	{
		$this->film = FilmTable::getInstance()->findOneById($request->getParameter('id'));

		if ($this->film->getBackgroundFilename() != ''){
			$this->setLayout('layoutFilm');
			$details = getimagesize(sfConfig::get('app_film_background_path') . '/' .$this->film->getBackgroundFilename());
			$this->backgroundWidth = $details[0];
		}else{
			$this->backgroundWidth = '';
		}

		$this->getResponse()->setTitle('Cumpara pe DVD & Bluray: ' . $this->film->getName() . ' - Filmsi.ro');
		$this->getResponse()->addMeta('keywords', '');
		$this->getResponse()->addMeta('description', '');

		$this->shops = $this->film->getShopUrls();
	}

	public function executeAwards(sfWebRequest $request)
	{
		$this->film = FilmTable::getInstance()->findOneById($request->getParameter('id'));

		if ($this->film->getBackgroundFilename() != ''){
			$this->setLayout('layoutFilm');
			$details = getimagesize(sfConfig::get('app_film_background_path') . '/' .$this->film->getBackgroundFilename());
			$this->backgroundWidth = $details[0];
		}else{
			$this->backgroundWidth = '';
		}

		$this->getResponse()->setTitle('Premii: ' . $this->film->getName() . ' - Filmsi.ro');
		$this->getResponse()->addMeta('keywords', '');
		$this->getResponse()->addMeta('description', '');

		$this->awards = $this->film->getRecentAwardsDetailed(0);
	}

	public function executeVideos(sfWebRequest $request)
	{
		$this->film = FilmTable::getInstance()->findOneById($request->getParameter('id'));

		if ($this->film->getBackgroundFilename() != ''){
			$this->setLayout('layoutFilm');
			$details = getimagesize(sfConfig::get('app_film_background_path') . '/' .$this->film->getBackgroundFilename());
			$this->backgroundWidth = $details[0];
		}else{
			$this->backgroundWidth = '';
		}

		$this->getResponse()->setTitle('Trailere si clipuri: ' . $this->film->getName() . ' - Filmsi.ro');
		$this->getResponse()->addMeta('keywords', '');
		$this->getResponse()->addMeta('description', '');

		$this->videos = $this->film->getVideoAlbum()->getVideos();
		$this->videoCount = $this->videos->count();

		$this->currentVideo = $request->getParameter('vid', 1);
	}

	public function executeNowInCinema(sfWebRequest $request)
	{
		$this->selectedGenres = $request->getParameter('genres', array());
		$this->selectedRatings = $request->getParameter('ratings', array());
		$this->selectedLocations = $request->getParameter('locations', array());

		$this->locations = CinemaTable::getInstance()->getLocations();

		$this->genres = GenreTable::getInstance()->getAllOrdered();
		$this->ratings = sfConfig::get('app_rating_types');

		$selectedRatingNames = array();
		foreach ($this->selectedRatings as $ratingId){
			$selectedRatingNames[] = $this->ratings[$ratingId];
		}

		$this->days = array();
		$today = (int)date('N');
		$todayTime = time();
		for($i = 1; $i <= 7; $i++){
			$this->days[$i] = date('Y-m-d', ( $i - $today ) * 86400 + $todayTime);
		}

		$this->currentPage = (int)$request->getParameter('p', 1);
		$this->films = FilmTable::getInstance()->getInCinemaNow($this->days, sfConfig::get('app_film_in_cinema_page_limit'), $this->currentPage, $this->selectedGenres, $selectedRatingNames, $this->selectedLocations);

		$this->filmCount = FilmTable::getInstance()->getInCinemaNowCount($this->days, $this->selectedGenres, $selectedRatingNames, $this->selectedLocations);
		$this->pageCount = ceil($this->filmCount / sfConfig::get('app_film_in_cinema_page_limit'));
		$this->firstFilmCount = sfConfig::get('app_film_in_cinema_page_limit') * ($this->currentPage - 1) + 1;
		$this->lastFilmCount = $this->firstFilmCount + count($this->films) - 1;
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

		$filmIds = array();
		foreach($this->films as $film){
			$filmIds[] = $film['id'];
		}
		$this->stires = StireTable::getInstance()->getRelatedByFilm($filmIds, 3);




		$this->parameterQuery = '';
		$isFirst = true;
		if ($request->hasParameter('genres')){
			foreach ($request->getParameter('genres') as $key => $genre){
				if ($isFirst){
					$this->parameterQuery .= 'genres[]=' . $genre;
					$isFirst = false;
				} else {
					$this->parameterQuery .= '&genres[]=' . $genre;
				}
			}
		}
		if ($request->hasParameter('ratings')){
			foreach ($request->getParameter('ratings') as $key => $rating){
				if ($isFirst){
					$this->parameterQuery .= 'ratings[]=' . $rating;
					$isFirst = false;
				} else {
					$this->parameterQuery .= '&ratings[]=' . $rating;
				}
			}
		}
		if ($request->hasParameter('locations')){
			foreach ($request->getParameter('locations') as $key => $location){
				if ($isFirst){
					$this->parameterQuery .= 'locations[]=' . $location;
					$isFirst = false;
				} else {
					$this->parameterQuery .= '&locations[]=' . $location;
				}
			}
		}
	}

	public function executeDayInCinema(sfWebRequest $request)
	{
		$this->selectedGenres = $request->getParameter('genres', array());
		$this->selectedRatings = $request->getParameter('ratings', array());
		$this->selectedLocations = $request->getParameter('locations', array());

		$this->locations = CinemaTable::getInstance()->getLocations();

		$this->genres = GenreTable::getInstance()->getAllOrdered();
		$this->ratings = sfConfig::get('app_rating_types');

		$selectedRatingNames = array();
		foreach ($this->selectedRatings as $ratingId){
			$selectedRatingNames[] = $this->ratings[$ratingId];
		}

		$this->days = array();
		$today = (int)date('N');
		$todayTime = time();
		for($i = 1; $i <= 7; $i++){
			$this->days[$i] = date('Y-m-d', ( $i - $today ) * 86400 + $todayTime);
		}

		$this->currentPage = (int)$request->getParameter('p', 1);
		$this->films = FilmTable::getInstance()->getInCinemaNow($request->getParameter('day'), sfConfig::get('app_film_in_cinema_page_limit'), $this->currentPage, $this->selectedGenres, $selectedRatingNames, $this->selectedLocations);

		$this->filmCount = FilmTable::getInstance()->getInCinemaNowCount($request->getParameter('day'), $this->selectedGenres, $selectedRatingNames, $this->selectedLocations);
		$this->pageCount = ceil($this->filmCount / sfConfig::get('app_film_in_cinema_page_limit'));
		$this->firstFilmCount = sfConfig::get('app_film_in_cinema_page_limit') * ($this->currentPage - 1) + 1;
		$this->lastFilmCount = $this->firstFilmCount + count($this->films) - 1;
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

		$filmIds = array();
		foreach($this->films as $film){
			$filmIds[] = $film['id'];
		}
		$this->stires = StireTable::getInstance()->getRelatedByFilm($filmIds, 3);



		$this->parameterQuery = '';
		$isFirst = true;
		if ($request->hasParameter('genres')){
			foreach ($request->getParameter('genres') as $key => $genre){
				if ($isFirst){
					$this->parameterQuery .= 'genres[]=' . $genre;
					$isFirst = false;
				} else {
					$this->parameterQuery .= '&genres[]=' . $genre;
				}
			}
		}
		if ($request->hasParameter('ratings')){
			foreach ($request->getParameter('ratings') as $key => $rating){
				if ($isFirst){
					$this->parameterQuery .= 'ratings[]=' . $rating;
					$isFirst = false;
				} else {
					$this->parameterQuery .= '&ratings[]=' . $rating;
				}
			}
		}
		if ($request->hasParameter('locations')){
			foreach ($request->getParameter('locations') as $key => $location){
				if ($isFirst){
					$this->parameterQuery .= 'locations[]=' . $location;
					$isFirst = false;
				} else {
					$this->parameterQuery .= '&locations[]=' . $location;
				}
			}
		}
	}

	public function executeSoonInCinema(sfWebRequest $request)
	{
		$this->selectedGenres = $request->getParameter('genres', array());
		$this->selectedRatings = $request->getParameter('ratings', array());

		$this->genres = GenreTable::getInstance()->getAllOrdered();
		$this->ratings = sfConfig::get('app_rating_types');

		$selectedRatingNames = array();
		foreach ($this->selectedRatings as $ratingId){
			$selectedRatingNames[] = $this->ratings[$ratingId];
		}

		$this->days = array();
		$today = (int)date('N');
		$todayTime = time();
		for($i = 1; $i <= 7; $i++){
			$this->days[$i] = date('Y-m-d', ( $i - $today ) * 86400 + $todayTime);
		}

		$this->currentPage = (int)$request->getParameter('p', 1);
		$this->films = FilmTable::getInstance()->getInCinemaSoon(sfConfig::get('app_film_in_cinema_page_limit'), $this->currentPage, $this->selectedGenres, $selectedRatingNames);

		$this->filmCount = FilmTable::getInstance()->getInCinemaSoonCount($this->selectedGenres, $selectedRatingNames);
		$this->pageCount = ceil($this->filmCount / sfConfig::get('app_film_in_cinema_page_limit'));
		$this->firstFilmCount = sfConfig::get('app_film_in_cinema_page_limit') * ($this->currentPage - 1) + 1;
		$this->lastFilmCount = $this->firstFilmCount + count($this->films) - 1;
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

		$filmIds = array();
		foreach($this->films as $film){
			$filmIds[] = $film['id'];
		}
		$this->stires = StireTable::getInstance()->getRelatedByFilm($filmIds, 3);

		$this->parameterQuery = '';
		$isFirst = true;
		if ($request->hasParameter('genres')){
			foreach ($request->getParameter('genres') as $key => $genre){
				if ($isFirst){
					$this->parameterQuery .= 'genres[]=' . $genre;
					$isFirst = false;
				} else {
					$this->parameterQuery .= '&genres[]=' . $genre;
				}
			}
		}
		if ($request->hasParameter('ratings')){
			foreach ($request->getParameter('ratings') as $key => $rating){
				if ($isFirst){
					$this->parameterQuery .= 'ratings[]=' . $rating;
					$isFirst = false;
				} else {
					$this->parameterQuery .= '&ratings[]=' . $rating;
				}
			}
		}

	}

	public function executeSoonOnDvd(sfWebRequest $request)
	{
		$this->selectedGenres = $request->getParameter('genres', array());
		$this->selectedRatings = $request->getParameter('ratings', array());
		$this->selectedAwards = $request->getParameter('awards', array());
		if (in_array($request->getParameter('format'), array('dvd', 'bluray'))){
			if ($request->getParameter('format') == 'dvd'){
				$this->selectedFormatDvd = true;
			} elseif ($request->getParameter('format') == 'bluray') {
				$this->selectedFormatBluray = true;
			}
		} else {
			$this->selectedFormatDvd = true;
			$this->selectedFormatBluray = true;
		}

		/* Put here, as parameters the ids of the festivals you want to show up in the filterlist */
		$this->awards = FestivalTable::getInstance()->getByIds(array(1, 2, 3, 4, 5, 6));
		$this->genres = GenreTable::getInstance()->getAllOrdered();
		$this->ratings = sfConfig::get('app_rating_types');

		$selectedRatingNames = array();
		foreach ($this->selectedRatings as $ratingId){
			$selectedRatingNames[] = $this->ratings[$ratingId];
		}

		$this->currentPage = (int)$request->getParameter('p', 1);
		$this->films = FilmTable::getInstance()->getOnDvdAndBluraySoon(sfConfig::get('app_film_in_cinema_page_limit'), $this->currentPage, $this->selectedGenres, $selectedRatingNames, $this->selectedAwards, $this->selectedFormatDvd, $this->selectedFormatBluray);

		$this->filmCount = FilmTable::getInstance()->getOnDvdAndBluraySoonCount($this->selectedGenres, $selectedRatingNames, $this->selectedAwards, $this->selectedFormatDvd, $this->selectedFormatBluray);
		
		$this->pageCount = ceil($this->filmCount / sfConfig::get('app_film_in_cinema_page_limit'));
		$this->firstFilmCount = sfConfig::get('app_film_in_cinema_page_limit') * ($this->currentPage - 1) + 1;
		$this->lastFilmCount = $this->firstFilmCount + count($this->films) - 1;
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

		$filmIds = array();
		foreach($this->films as $film){
			$filmIds[] = $film['id'];
		}
		$this->stires = StireTable::getInstance()->getRelatedByFilm($filmIds, 3);




		$this->parameterQuery = '';
		$isFirst = true;
		if ($request->hasParameter('genres')){
			foreach ($request->getParameter('genres') as $key => $genre){
				if ($isFirst){
					$this->parameterQuery .= 'genres[]=' . $genre;
					$isFirst = false;
				} else {
					$this->parameterQuery .= '&genres[]=' . $genre;
				}
			}
		}
		if ($request->hasParameter('ratings')){
			foreach ($request->getParameter('ratings') as $key => $rating){
				if ($isFirst){
					$this->parameterQuery .= 'ratings[]=' . $rating;
					$isFirst = false;
				} else {
					$this->parameterQuery .= '&ratings[]=' . $rating;
				}
			}
		}
		if ($request->hasParameter('awards')){
			foreach ($request->getParameter('awards') as $key => $location){
				if ($isFirst){
					$this->parameterQuery .= 'awards[]=' . $location;
					$isFirst = false;
				} else {
					$this->parameterQuery .= '&awards[]=' . $location;
				}
			}
		}
		if (in_array($request->getParameter('format'), array('dvd', 'bluray'))){
			if ($isFirst){
				$this->parameterQuery .= 'format=' . $request->getParameter('format');
				$isFirst = false;
			} else {
				$this->parameterQuery .= '&format=' . $request->getParameter('format');
			}
		}
	}

	public function executeNowOnDvd(sfWebRequest $request)
	{
		$this->selectedGenres = $request->getParameter('genres', array());
		$this->selectedRatings = $request->getParameter('ratings', array());
		$this->selectedAwards = $request->getParameter('awards', array());
		if (in_array($request->getParameter('format'), array('dvd', 'bluray'))){
			if ($request->getParameter('format') == 'dvd'){
				$this->selectedFormatDvd = true;
			} elseif ($request->getParameter('format') == 'bluray') {
				$this->selectedFormatBluray = true;
			}
		} else {
			$this->selectedFormatDvd = true;
			$this->selectedFormatBluray = true;
		}

		/* Put here, as parameters the ids of the festivals you want to show up in the filterlist */
		$this->awards = FestivalTable::getInstance()->getByIds(array(1, 2, 3, 4, 5, 6));
		$this->genres = GenreTable::getInstance()->getAllOrdered();
		$this->ratings = sfConfig::get('app_rating_types');

		$selectedRatingNames = array();
		foreach ($this->selectedRatings as $ratingId){
			$selectedRatingNames[] = $this->ratings[$ratingId];
		}

		$this->currentPage = (int)$request->getParameter('p', 1);
		$this->films = FilmTable::getInstance()->getOnDvdAndBlurayNow(sfConfig::get('app_film_in_cinema_page_limit'), $this->currentPage, $this->selectedGenres, $selectedRatingNames, $this->selectedAwards, $this->selectedFormatDvd, $this->selectedFormatBluray);

		$this->filmCount = FilmTable::getInstance()->getOnDvdAndBlurayNowCount($this->selectedGenres, $selectedRatingNames, $this->selectedAwards, $this->selectedFormatDvd, $this->selectedFormatBluray);

		$this->pageCount = ceil($this->filmCount / sfConfig::get('app_film_in_cinema_page_limit'));
		$this->firstFilmCount = sfConfig::get('app_film_in_cinema_page_limit') * ($this->currentPage - 1) + 1;
		$this->lastFilmCount = $this->firstFilmCount + count($this->films) - 1;
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

		$filmIds = array();
		foreach($this->films as $film){
			$filmIds[] = $film['id'];
		}
		$this->stires = StireTable::getInstance()->getRelatedByFilm($filmIds, 3);




		$this->parameterQuery = '';
		$isFirst = true;
		if ($request->hasParameter('genres')){
			foreach ($request->getParameter('genres') as $key => $genre){
				if ($isFirst){
					$this->parameterQuery .= 'genres[]=' . $genre;
					$isFirst = false;
				} else {
					$this->parameterQuery .= '&genres[]=' . $genre;
				}
			}
		}
		if ($request->hasParameter('ratings')){
			foreach ($request->getParameter('ratings') as $key => $rating){
				if ($isFirst){
					$this->parameterQuery .= 'ratings[]=' . $rating;
					$isFirst = false;
				} else {
					$this->parameterQuery .= '&ratings[]=' . $rating;
				}
			}
		}
		if ($request->hasParameter('awards')){
			foreach ($request->getParameter('awards') as $key => $location){
				if ($isFirst){
					$this->parameterQuery .= 'awards[]=' . $location;
					$isFirst = false;
				} else {
					$this->parameterQuery .= '&awards[]=' . $location;
				}
			}
		}
		if (in_array($request->getParameter('format'), array('dvd', 'bluray'))){
			if ($isFirst){
				$this->parameterQuery .= 'format=' . $request->getParameter('format');
				$isFirst = false;
			} else {
				$this->parameterQuery .= '&format=' . $request->getParameter('format');
			}
		}
	}

	public function executeOnTv(sfWebRequest $request)
	{
		$this->selectedDay = $request->getParameter('d', date('Y-m-d'));
		$this->selectedHour = $request->getParameter('h', date('H'));
		$this->selectedChannel = $request->getParameter('c', null);
		$this->selectedType = $request->getParameter('t', null);

		$this->schedules = ChannelScheduleTable::getInstance()->getFiltered($this->selectedDay, $this->selectedHour, $this->selectedChannel, $this->selectedType);
		$this->channels = ChannelTable::getInstance()->getAll();


		$this->days = array();
		$today = (int)date('N');
		$todayTime = time();
		for($i = 1; $i <= 7; $i++){
			$this->days[$i] = date('Y-m-d', ( $i - $today ) * 86400 + $todayTime);
		}
		$this->today = date('Y-m-d', time());
		$this->tomorrow = date('Y-m-d', time() + 86400);
	}

	public function executeAlertAdd(sfWebRequest $request)
	{
		if (!$this->getUser()->isAuthenticated()){
			$this->setTemplate('alertAddNotAuthenticated');
			return sfView::SUCCESS;
		}

		$this->film = FilmTable::getInstance()->findOneById($request->getParameter('id'));

		$this->form = new FilmAlertForm();
		$this->form->setDefault('film_id', $this->film->getId());
		$this->form->setDefault('user_id', $this->getUser()->getGuardUser()->getId());

		if ($request->isMethod('post')){
			$this->form->bind($request->getParameter($this->form->getName()));

			if ($this->form->isValid()){
				$this->form->save();

				return $this->renderText(json_encode(array('status' => true)));
			}
		}
	}
}
