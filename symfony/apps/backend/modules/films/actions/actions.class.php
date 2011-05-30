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
  public function executeNewObject(sfWebRequest $request)
  {
  	$this->form = new FilmNewForm();
  	
  	if ($request->isMethod('post')){
  		$this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
  		
  		if ($this->form->isValid()){
  			$this->form->save();
  			
  			/* Save the persons in film */
  			$personIdArray = $request->getParameter('person_id');
  			$personIsActorArray = $request->getParameter('person_is_actor');
  			$personIsDirectorArray = $request->getParameter('person_is_director');
  			$personIsScriptwriterArray = $request->getParameter('person_is_scriptwriter');
  			$personIsProducerArray = $request->getParameter('person_is_producer');
  			
  			$personInFilmDetails = array();
  			foreach ($personIdArray as $key => $id){
					$personInFilmDetails[] = array(
						'id' => $id,
						'is_actor' => (isset($personIsActorArray[$key]) && $personIsActorArray[$key] == '1' ? '1' : '0'),
						'is_director' => (isset($personIsDirectorArray[$key]) && $personIsDirectorArray[$key] == '1' ? '1' : '0'),
						'is_scriptwriter' => (isset($personIsScriptwriterArray[$key]) && $personIsScriptwriterArray[$key] == '1' ? '1' : '0'),
						'is_producer' => (isset($personIsProducerArray[$key]) && $personIsProducerArray[$key] == '1' ? '1' : '0'),
					);
  			}
  			Doctrine_Core::getTable('FilmPerson')->update($personInFilmDetails, $this->form->getObject()->getId());
  			
  			
  			$this->redirect($this->generateUrl('default', array('module' => 'films', 'action' => 'view')) . '?lid=' . $this->form->getObject()->getLibraryId());
  		}
  	}
  	
  	$this->persons = array();
  }

  public function executeImport(sfWebRequest $request)
  {
  	set_time_limit(10000);


  	$parameters = $request->getParameter('film');
  	$imdbCode = $parameters['imdb'];

  	if (false !== Doctrine_Core::getTable('Film')->findOneByImdb($imdbCode)){
  		echo 'Filmul deja exista in baza de date! Click <a href="' . $this->generateUrl('default', array('module' => 'films', 'action' => 'newObject')) . '">AICI</a> pentru a continua.';
  		exit;
  	}

  	try {
  		$imdbComFilm = new ImdbComFilm($imdbCode);
		$imdbComFilm->parseTitlePage();
		$imdbComFilm->parseCastPage();
		$imdbComFilm->parseAwardsPage();

  		$film = new Film();
  		$film->setImdb($imdbComFilm->getImdb());
  		$film->setNameRo($imdbComFilm->getNameRo());
  		$film->setNameEn($imdbComFilm->getNameEn());
		if ($imdbComFilm->getYear() != ''){
			$film->setYear($imdbComFilm->getYear());
		}
  		$film->setDuration($imdbComFilm->getDuration());
  		$film->setDescriptionContent($imdbComFilm->getSinopsis());
  		$film->setUserId($this->getUser()->getGuardUser()->getId());
  		$film->setPublishDate(date('Y-m-d'), time());

  		$filenameSource = ( $imdbComFilm->getFilenameSource() == false || strpos($imdbComFilm->getFilenameSource(),'nopicture') !== false ) ? ( sfConfig::get('app_aws_s3_path') . sfConfig::get('app_aws_bucket') . '/' . sfConfig::get('app_asset_aws_s3_folder') . '/default-nophoto.jpg' ) : $imdbComFilm->getFilenameSource();
		
	  	$pieces = explode('.', $filenameSource);
	  	$extension = array_pop($pieces);
		
		$film->setFilename(md5($filenameSource . microtime() . rand(0, 999999)) . '.' . $extension);

		$imageData = getimagesize($filenameSource);
	    $film->createFile(
			$filenameSource, 
			$imageData['mime']
		);

	    $film->save();





      /* Assign the film genres */
	    foreach ($imdbComFilm->getGenres() as $genreName){
			if ($genreName == ''){
				continue;
			}
	    	$genre = Doctrine_Core::getTable('Genre')->findOneByName($genreName);

	    	$filmGenre = new FilmGenre();
	    	$filmGenre->setFilmId($film->getId());
	    	$filmGenre->setGenreId($genre->getId());
	    	$filmGenre->save();
	    }




	    echo '<br />Am terminat de importat filmul <strong>' . $film->getName() . '</strong>';
			ob_end_flush(); flush(); ob_start();




	    /* Add the Directors */
	    foreach ($imdbComFilm->getDirectors() as $personImdbCode)
	    {
	    	/* If the person does not exist in the database, move to the next one */
	    	if (false == $person = Doctrine_Core::getTable('Person')->findOneByImdb($personImdbCode)){
	    			continue;
	    	}

	    	/* Check if a connection between the person and the film is already made, if not, create it */
    		if (false == $filmPerson = Doctrine_Core::getTable('FilmPerson')->getOneByFilmAndPerson($film->getId(), $person->getId())){
    			$filmPerson = new FilmPerson();
    			$filmPerson->setFilmId($film->getId(), $person->getId());
    			$filmPerson->setPersonId($person->getId());
    		}

    			$filmPerson->setIsDirector('1');
    			$filmPerson->save();
	    }

		echo '<br />Am terminat de importat regizorii';
			ob_end_flush(); flush(); ob_start();

  		/* Add the Writers */
	    foreach ($imdbComFilm->getWriters() as $personImdbCode)
	    {
	    	/* If the person does not exist in the database, move to the next one */
	    	if (false == $person = Doctrine_Core::getTable('Person')->findOneByImdb($personImdbCode)){
	    			continue;
	    	}

	    	/* Check if a connection between the person and the film is already made, if not, create it */
    		if (false == $filmPerson = Doctrine_Core::getTable('FilmPerson')->getOneByFilmAndPerson($film->getId(), $person->getId())){
    			$filmPerson = new FilmPerson();
    			$filmPerson->setFilmId($film->getId(), $person->getId());
    			$filmPerson->setPersonId($person->getId());
    		}

    			$filmPerson->setIsScriptwriter('1');
    			$filmPerson->save();
	    }

		echo '<br />Am terminat de importat scenaristii';
			ob_end_flush(); flush(); ob_start();

  		/* Add the Producers */
	    foreach ($imdbComFilm->getProducers() as $personImdbCode)
	    {
	    	/* If the person does not exist in the database, move to the next one */
	    	if (false == $person = Doctrine_Core::getTable('Person')->findOneByImdb($personImdbCode)){
	    			continue;
	    	}

	    	/* Check if a connection between the person and the film is already made, if not, create it */
    		if (false == $filmPerson = Doctrine_Core::getTable('FilmPerson')->getOneByFilmAndPerson($film->getId(), $person->getId())){
    			$filmPerson = new FilmPerson();
    			$filmPerson->setFilmId($film->getId(), $person->getId());
    			$filmPerson->setPersonId($person->getId());
    		}

    			$filmPerson->setIsProducer('1');
    			$filmPerson->save();
	    }

		echo '<br />Am terminat de importat producatorii';
			ob_end_flush(); flush(); ob_start();

  		/* Add the Actors */
	    foreach ($imdbComFilm->getActors() as $personImdbCode)
	    {
	    	/* If the person does not exist in the database, move to the next one */
	    	if (false == $person = Doctrine_Core::getTable('Person')->findOneByImdb($personImdbCode)){
	    			continue;
	    	}

	    	/* Check if a connection between the person and the film is already made, if not, create it */
    		if (false == $filmPerson = Doctrine_Core::getTable('FilmPerson')->getOneByFilmAndPerson($film->getId(), $person->getId())){
    			$filmPerson = new FilmPerson();
    			$filmPerson->setFilmId($film->getId(), $person->getId());
    			$filmPerson->setPersonId($person->getId());
    		}

    			$filmPerson->setIsActor('1');
    			$filmPerson->save();
	    }


		echo '<br />Am terminat de importat actorii';
			ob_end_flush(); flush(); ob_start();

		/* Add the awards */
		foreach ($imdbComFilm->getAwards() as $award){
			/* If the festival doesn't exist in the database, add it */
			if (false == $festival = Doctrine_Core::getTable('Festival')->findOneByImdbKey($award['imdbKey'])){
				$festival = new Festival();
				$festival->setName($award['imdbKey']);
				$festival->setImdbKey($award['imdbKey']);
				$festival->save();
			}

			/* If the festival edition doesn't exist in the database, add it */
			if (false == $festivalEdition = Doctrine_Core::getTable('FestivalEdition')->getByEditionAndFestival($award['festivalEdition'], $festival->getId())){
				$festivalEdition = new FestivalEdition();
				$festivalEdition->setEdition($award['festivalEdition']);
				$festivalEdition->setFestivalId($festival->getId());
				$festivalEdition->setUserId($this->getUser()->getGuardUser()->getId());
				$festivalEdition->save();
			}

			if ($award['festivalSection'] == ''){
				continue;
			}

			/* If the festival section doesn't exist in the database, add it */
			if ($award['festivalSection'] != '' && false == $festivalSection = Doctrine_Core::getTable('FestivalSection')->getByFestivalEditionAndImdbKey($festivalEdition->getId(),$award['festivalSection'])){
				$festivalSection = new FestivalSection();
				$festivalSection->setName($award['festivalSection']);
				$festivalSection->setImdbKey($award['festivalSection']);
				$festivalSection->setFestivalEditionId($festivalEdition->getId());
				$festivalSection->save();
			}

			/* Add the participants that doen't exist */
			foreach($award['personImdbs'] as $person){
				if (false == Doctrine_Core::getTable('FestivalSectionParticipant')->getBySectionAndFilmAndPerson($festivalSection->getId(), $film->getImdb(), $person)){
					$festivalSectionParticipant = new FestivalSectionParticipant();
					if ($award['festivalSection'] != ''){
						$festivalSectionParticipant->setFestivalSectionId($festivalSection->getId());
					}
					$festivalSectionParticipant->setFilmImdb($film->getImdb());
					$festivalSectionParticipant->setPersonImdb($person);
					if ($award['status'] == 'Won'){
						$festivalSectionParticipant->setIsWinner('1');
					}
					$festivalSectionParticipant->save();
				}
			}

			if (count($award['personImdbs']) == 0){
				if (false == Doctrine_Core::getTable('FestivalSectionParticipant')->getBySectionAndFilmAndNullPerson($festivalSection->getId(), $film->getImdb())){
					$festivalSectionParticipant = new FestivalSectionParticipant();
					if ($award['festivalSection'] != ''){
						$festivalSectionParticipant->setFestivalSectionId($festivalSection->getId());
					}
					$festivalSectionParticipant->setFilmImdb($film->getImdb());
					if ($award['status'] == 'Won'){
						$festivalSectionParticipant->setIsWinner('1');
					}
					$festivalSectionParticipant->save();
				}
			}


		}

		echo '<br />Am terminat de importat premiile';
			ob_end_flush(); flush(); ob_start();

  	} catch (ImdbComFilmException $e){
  		echo 'A aparut o eroare! Click <a href="' . $this->generateUrl('default', array('module' => 'films', 'action' => 'newObject')) . '">AICI</a> pentru a continua.';
  	}

  	echo '<br /><br />Importul s-a terminat!  Click <a href="' . $this->generateUrl('default', array('module' => 'films', 'action' => 'view')) . '?lid=' . $film->getLibraryId() . '">AICI</a> pentru a continua.';

  	exit;
  }

  public function executeImportImdbPhotos(sfWebRequest $request)
  {
  	set_time_limit(10000);

	$film  = Doctrine_Core::getTable('Film')->findOneById($request->getParameter('id'));
  	if (false === $film){
  		echo 'Filmul nu exista in baza de date! Click <a href="' . $this->generateUrl('default', array('module' => 'films', 'action' => 'newObject')) . '">AICI</a> pentru a continua.';
  		exit;
  	}

	/* If the film doesn't have any album associated with it, just create one */
		if ('' == $film->getPhotoAlbumId()){
			$photoAlbum = new PhotoAlbum();
			$photoAlbum->setName('Film: ' . $film->getNameRo());
			$photoAlbum->setUserId($this->getUser()->getGuardUser()->getId());
			$photoAlbum->setPublishDate(date('Y-m-d'), time());
			$photoAlbum->save();

			/* Assign the photo album to the film */
			$film->setPhotoAlbumId($photoAlbum->getId());
			$film->save();
		}

	$imdbPhotoKeys = ImdbFilmPhotoKeyTable::getInstance()->findByImdb($film->getImdb());

  	try {
		$imdbComFilm = new ImdbComFilm($film->getImdb());
		/* Create the photos and add them to the album */
		$counter = 1;
		foreach ($imdbPhotoKeys as $imdbPhotoKey){

			/* Get the photo url from the photo page */
			$photoUrl = $imdbComFilm->parsePhotoPage($imdbPhotoKey->getPhotoKey());
			if (!$photoUrl){
				echo '<br />Nu s-a putut importa poza cu key-ul:' . $imdbPhoto;
				ob_end_flush(); flush(); ob_start();
				continue;
			}

			/* Create the actual photo in the database */
			$photo = new Photo();
			$photo->setAlbumId($film->getPhotoAlbumId());

			$pieces = explode('.', $photoUrl);
			$extension = array_pop($pieces);

			$photo->setFilename(md5($photoUrl . microtime() . rand(0, 999999)). '.' . $extension);
			
			$imageData = getimagesize($photoUrl);
			$photo->createFile(
				$photoUrl, 
				$imageData['mime']
			);

			$photo->save();

			echo '<br />Am terminat de importat poza nr ' . $counter . ' cu key-ul:' . $imdbPhotoKey->getPhotoKey();
			ob_end_flush(); flush(); ob_start();
			$counter += 1;

			/* Delete from database */
			$imdbPhotoKey->delete();
		}

		echo '<br />Am terminat de importat pozele';
			ob_end_flush(); flush(); ob_start();

  	} catch (ImdbComFilmException $e){
  		echo 'A aparut o eroare! Click <a href="' . $this->generateUrl('default', array('module' => 'films', 'action' => 'newObject')) . '">AICI</a> pentru a continua.';
  	}

  	echo '<br /><br />Importul s-a terminat!  Click <a href="' . $this->generateUrl('default', array('module' => 'films', 'action' => 'view')) . '?lid=' . $film->getLibraryId() . '">AICI</a> pentru a continua.';

  	exit;
  }

  public function executeImportImdbPhotoKeys(sfWebRequest $request)
  {
  	set_time_limit(10000);

	$film  = Doctrine_Core::getTable('Film')->findOneById($request->getParameter('id'));

	/* Delete any existing keys for this film */
	ImdbFilmPhotoKeyTable::getInstance()->deleteByFilm($film->getImdb());

	/* Import the keys */
	$imdbComFilm = new ImdbComFilm($film->getImdb());

	foreach ($imdbComFilm->parsePhotosPage() as $photoKey){
		$imdbFilmPhotoKey = new ImdbFilmPhotoKey();
		$imdbFilmPhotoKey->setImdb($film->getImdb());
		$imdbFilmPhotoKey->setPhotoKey($photoKey);
		$imdbFilmPhotoKey->save();
	}

  	$this->redirect($this->generateUrl('default', array('module' => 'films', 'action' => 'view')) . '?lid=' . $film->getLibraryId());
  }
  
  public function executeImportProvideoDetails(sfWebRequest $request)
  {
  	$this->film  = Doctrine_Core::getTable('Film')->findOneById($request->getParameter('id'));
  	
  	set_time_limit(10000);
		
        $produse = simplexml_load_file(sfConfig::get('app_provideo_url'));

		$this->imported = false;
		foreach ($produse->produs as $produs)
        {
            if ($produs['imdb'] == $this->film->getImdb()){
                $this->film->setDescriptionContent($produs['sinopsis']);
				if ($produs['rating_cnc'] != ''){
					$this->film->setRating($produs['rating_cnc']);
				}
                if ($produs['durata'] != ''){
                    $this->film->setDuration($produs['durata']);
                }
                if ($produs['titlu_romana'] != ''){
                    $this->film->setNameRo($produs['titlu_romana']);
                }
				if ($produs['titlu_engleza'] != ''){
                    $this->film->setNameEn($produs['titlu_engleza']);
                }
				if ($produs['an'] != ''){
                    $this->film->setYear($produs['an']);
                }

				/* Add the DVD status on the 2010-01-01  */
				$this->film->setStatusDvd('1');
				$this->film->setStatusDvdYear('2010');
				$this->film->setStatusDvdMonth('01');
				$this->film->setStatusDvdDay('01');


                $this->film->save();

                /* Add the photo to the album */
                if ($this->film->getPhotoAlbumId() != ''){
                    $sourcefile = str_replace('_thumb', '', $produs['coperta']);

					
					/* Create the actual photo in the database */
					$photo = new Photo();
					$photo->setAlbumId($this->film->getPhotoAlbumId());

					/* Creating the filename */
                    $pieces = explode('.', $sourcefile);
                    $extension = array_pop($pieces);

					$photo->setFilename(md5(rand(0, 9000000) . $this->film->getFilename()) . '.' . $extension);

					$imageData = getimagesize($sourcefile);
					$photo->createFile(
						$sourcefile, 
						$imageData['mime']
					);

					$photo->save();
                }

                $this->imported = true;
            }
        }
  }  
  
	public function executeEdit(sfWebRequest $request)
  {
  	$film = Doctrine_Core::getTable('Film')->findOneByLibraryId($request->getParameter('lid'));
  	
  	$this->form = new FilmEditForm($film);
  	
  	if ($request->isMethod('post')){
  		$this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
  		
  		if ($this->form->isValid()){
  			$this->form->save();
  			
  			$this->redirect($this->generateUrl('default', array('module' => 'films', 'action' => 'view')) . '?lid=' . $this->form->getObject()->getLibraryId());
  		}
  	}
  	
  	$this->persons = Doctrine_Core::getTable('FilmPerson')->getDetailedByFilm($film->getId());
  }
  
	public function executeView(sfWebRequest $request)
  {
  	$this->film = Doctrine_Core::getTable('Film')->findOneByLibraryId($request->getParameter('lid'));
  	
  	$this->persons = Doctrine_Core::getTable('FilmPerson')->getDetailedByFilm($this->film->getId());

	$this->imdbPhotoKeys = ImdbFilmPhotoKeyTable::getInstance()->countByFilm($this->film->getImdb());
  }

  public function executePerson(sfWebRequest $request)
  {
  	$this->film = Doctrine_Core::getTable('Film')->findOneByLibraryId($request->getParameter('lid'));

  	$this->persons = Doctrine_Core::getTable('FilmPerson')->getDetailedByFilm($this->film->getId());
  }

  public function executePersonAdd(sfWebRequest $request)
  {
	  $this->film = Doctrine_Core::getTable('Film')->findOneById($request->getParameter('id'));

	  if ($request->isMethod('post')){
		  $filmPerson = new FilmPerson();
		  $filmPerson->setFilmId($this->film->getId());
		  $filmPerson->setPersonId($request->getParameter('person_id'));
		  $filmPerson->setIsActor($request->getParameter('is_actor'));
		  $filmPerson->setIsDirector($request->getParameter('is_director'));
		  $filmPerson->setIsScriptwriter($request->getParameter('is_scriptwriter'));
		  $filmPerson->setIsProducer($request->getParameter('is_producer'));
		  $filmPerson->save();

		  $this->redirect($this->generateUrl('default', array('module' => 'films', 'action' => 'person')) . '?lid=' . $this->film->getLibraryId());
	  }
  }

  public function executePersonEdit(sfWebRequest $request)
  {
	  $this->film = Doctrine_Core::getTable('Film')->findOneById($request->getParameter('fid'));
	  $this->person = Doctrine_Core::getTable('Person')->findOneById($request->getParameter('pid'));
	  $this->filmPerson = Doctrine_Core::getTable('FilmPerson')->getOneByFilmAndPerson($request->getParameter('fid'), $request->getParameter('pid'));

	  if ($request->isMethod('post')){
		  $this->filmPerson->setIsActor($request->getParameter('is_actor', NULL));
		  $this->filmPerson->setIsDirector($request->getParameter('is_director', NULL));
		  $this->filmPerson->setIsScriptwriter($request->getParameter('is_scriptwriter', NULL));
		  $this->filmPerson->setIsProducer($request->getParameter('is_producer', NULL));
		  $this->filmPerson->save();

		  $this->redirect($this->generateUrl('default', array('module' => 'films', 'action' => 'person')) . '?lid=' . $this->film->getLibraryId());
	  }
  }

  public function executePersonDelete(sfWebRequest $request)
  {
	  $filmPerson = Doctrine_Core::getTable('FilmPerson')->getOneByFilmAndPerson($request->getParameter('fid'), $request->getParameter('pid'));
	  $filmPerson->delete();
	  $film = Doctrine_Core::getTable('Film')->findOneById($request->getParameter('fid'));

	  $this->redirect($this->generateUrl('default', array('module' => 'films', 'action' => 'person')) . '?lid=' . $film->getLibraryId());

  }

  public function executeEpisode(sfWebRequest $request)
  {
  	$this->film = Doctrine_Core::getTable('Film')->findOneByLibraryId($request->getParameter('lid'));

  	$this->episodes = Doctrine_Core::getTable('FilmEpisode')->getByFilm($this->film->getId());
  }

  public function executeEpisodeAdd(sfWebRequest $request)
  {
  	$this->film = Doctrine_Core::getTable('Film')->findOneById($request->getParameter('id'));
	$this->form = new FilmEpisodeForm();
	$this->form->setDefault('film_id', $this->film->getId());

	if ($request->isMethod('post')){
		$this->form->bind($request->getParameter($this->form->getName()));

		if ($this->form->isValid()){
			$this->form->save();

			$this->redirect($this->generateUrl('default', array('module' => 'films', 'action' => 'episode')) . '?lid=' . $this->film->getLibraryId());
		}
	}
  }

  public function executeEpisodeEdit(sfWebRequest $request)
  {
  	$this->filmEpisode = Doctrine_Core::getTable('FilmEpisode')->findOneById($request->getParameter('id'));
	$this->film = $this->filmEpisode->getFilm();
	$this->form = new FilmEpisodeForm($this->filmEpisode);

	if ($request->isMethod('post')){
		$this->form->bind($request->getParameter($this->form->getName()));

		if ($this->form->isValid()){
			$this->form->save();

			$this->redirect($this->generateUrl('default', array('module' => 'films', 'action' => 'episode')) . '?lid=' . $this->film->getLibraryId());
		}
	}
  }

  public function executeEpisodeDelete(sfWebRequest $request)
  {
	  $filmEpisode = Doctrine_Core::getTable('FilmEpisode')->findOneById($request->getParameter('id'));
	  $film = $filmEpisode->getFilm();
	  $filmEpisode->delete();

	  $this->redirect($this->generateUrl('default', array('module' => 'films', 'action' =>' episode')) . '?lid=' .$film->getLibraryId());
  }

	public function executeApi(sfWebRequest $request)
	{
		$this->setLayout(false);
		$this->getResponse()->setContentType('application/json');

		return $this->renderText(json_encode(Doctrine_Core::getTable('Film')->getForApi($request->getParameter('term'))));
	}

	public function executeApiImdb(sfWebRequest $request)
	{
		$this->setLayout(false);
		$this->getResponse()->setContentType('application/json');

		return $this->renderText(json_encode(Doctrine_Core::getTable('Film')->getForApiImdb($request->getParameter('term'))));
	}

	public function executeStatus(sfWebRequest$request)
	{
		$this->film = Doctrine_Core::getTable('Film')->findOneByLibraryId($request->getParameter('lid'));
	}

	public function executeStatusEdit(sfWebRequest $request)
	{
		$this->film = Doctrine_Core::getTable('Film')->findOneById($request->getParameter('id'));

		$this->form = new FilmStatusForm($this->film);

		if ($request->isMethod('post')){
			$this->form->bind($request->getParameter($this->form->getName()));

			if ($this->form->isValid()){
				$this->form->save();

				$this->redirect($this->generateUrl('default', array('module' => 'films', 'action' => 'status')) . '?lid=' . $this->film->getLibraryId());
			}
		}
	}

	public function executeBackground(sfWebRequest$request)
	{
		$this->film = Doctrine_Core::getTable('Film')->findOneByLibraryId($request->getParameter('lid'));
	}

	public function executeBackgroundEdit(sfWebRequest $request)
	{
		$this->film = Doctrine_Core::getTable('Film')->findOneById($request->getParameter('id'));

		$this->form = new FilmBackgroundForm($this->film);

		if ($request->isMethod('post')){
			$this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));

			if ($this->form->isValid()){
				$this->form->save();

				$this->redirect($this->generateUrl('default', array('module' => 'films', 'action' => 'background')) . '?lid=' . $this->film->getLibraryId());
			}
		}
	}

	public function executeBackgroundDelete(sfWebRequest $request)
	{
		$this->film = Doctrine_Core::getTable('Film')->findOneById($request->getParameter('id'));
		$this->film->deleteBackground();

		$this->redirect($this->generateUrl('default', array('module' => 'films', 'action' => 'background')) . '?lid=' . $this->film->getLibraryId());
	}
}