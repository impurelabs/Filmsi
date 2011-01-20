<?php

/**
 * persons actions.
 *
 * @package    filmsi
 * @subpackage persons
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class personsActions extends sfActions
{
  public function executeNewObject(sfWebRequest $request)
  {
  	$this->form = new PersonNewForm();
  	
  	if ($request->isMethod('post')){
  		$this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
  		
  		if ($this->form->isValid()){
  			$this->form->save();
  			$this->redirect($this->generateUrl('default', array('module' => 'persons', 'action' => 'view')) . '?lid=' . $this->form->getObject()->getLibraryId());
  		}
  	}
  }
  
	public function executeView(sfWebRequest $request)
  {
  	$this->person = Doctrine_Core::getTable('Person')->findOneByLibraryId($request->getParameter('lid'));
  }
  
	public function executeEdit(sfWebRequest $request)
  {
  	$person = Doctrine_Core::getTable('Person')->findOneByLibraryId($request->getParameter('lid'));
  	
  	$this->form = new PersonEditForm($person);
  	
  	if ($request->isMethod('post')){
  		$this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
  		
  		if ($this->form->isValid()){
  			$this->form->save();
  			$this->redirect($this->generateUrl('default', array('module' => 'persons', 'action' => 'view')) . '?lid=' . $this->form->getObject()->getLibraryId());
  		}
  	}
  }

	public function executeApi(sfWebRequest $request)
	{
		$this->setLayout(false);
		$this->getResponse()->setContentType('application/json');

		return $this->renderText(json_encode(Doctrine_Core::getTable('Person')->getForApi($request->getParameter('term'))));
	}

	public function executeApiImdb(sfWebRequest $request)
	{
		$this->setLayout(false);
		$this->getResponse()->setContentType('application/json');

		return $this->renderText(json_encode(Doctrine_Core::getTable('Person')->getForApiImdb($request->getParameter('term'))));
	}

	public function executeImport(sfWebRequest $request)
  {
  	set_time_limit(10000);
  	
  	
  	$parameters = $request->getParameter('person');
  	$imdbCode = $parameters['imdb'];
  	
  	if (false !== Doctrine_Core::getTable('Person')->findOneByImdb($imdbCode)){
  		echo 'Persoana deja exista in baza de date! Click <a href="' . $this->generateUrl('default', array('module' => 'persons', 'action' => 'newObject')) . '">AICI</a> pentru a continua.';
  		exit;
  	}

  	try {
  		$imdbComPerson = new ImdbComPerson($imdbCode);
  		
	  	$person = new Person();
	  	$person->setImdb($imdbComPerson->getImdb());
	  	$person->setFirstName($imdbComPerson->getFirstName());
	  	$person->setLastName($imdbComPerson->getLastName());
	  	$person->setDateOfBirth($imdbComPerson->getDateOfBirth());
	  	$person->setDateOfDeath($imdbComPerson->getDateOfDeath());
	  	$person->setPlaceOfBirth($imdbComPerson->getPlaceOfBirth());
	  	$person->setBiographyContent($imdbComPerson->getBio());
	  	$person->setIsActor($imdbComPerson->getIsActor());
	  	$person->setIsDirector($imdbComPerson->getIsDirector());
	  	$person->setIsScriptwriter($imdbComPerson->getIsScriptwriter());
	  	$person->setIsProducer($imdbComPerson->getIsProducer());
	  	$person->setUserId($this->getUser()->getGuardUser()->getId());
	  	$person->setPublishDate(date('Y-m-d'), time());
	  	
	  	$filenameSource = $imdbComPerson->getFilenameSource() == '' ? sfConfig::get('app_person_nophoto_image_path') : $imdbComPerson->getFilenameSource();
	  	
	  	$pieces = explode('.', $filenameSource);
	  	$extension = array_pop($pieces);
	  	  
	  	$filename = md5($filenameSource . time() . rand(0, 999999)). '.' . $extension;
	    copy($filenameSource, sfConfig::get('app_person_path').'/'.$filename);
	        
	    $person->setFilename($filename);
	    $person->createFile();
	    
	    $person->save();
	  	
	    
	    /* Create the photo album */
	    $photoAlbum = new PhotoAlbum();
	    $photoAlbum->setName('Persoana: ' . $person->getName());
	  	$photoAlbum->setUserId($this->getUser()->getGuardUser()->getId());
	  	$photoAlbum->setPublishDate(date('Y-m-d'), time());
	  	$photoAlbum->save();
	
	  	
	  	$photo = new Photo();
	  	$photo->setAlbumId($photoAlbum->getId());
	  	
	  	/* Creating the filename */
	  	$pieces = explode('.', $person->getFilename());
	  	$extension = array_pop($pieces);
	  	
	  	$filename = md5(rand(0, 9000000) . $person->getFilename()) . '.' . $extension;
			// Set the filename for the object
	    $photo->setFilename($filename);		
	    $photo->createFile(sfConfig::get('app_person_path') . '/' . $person->getFilename(), $filename);
	    
	    $photo->save();
	    
	    
	    /* Assign the photo album to the person */
	    $person->setPhotoAlbumId($photoAlbum->getId());
	    $person->save();
  	
	    
  	  /* Add the Acted films */
	    foreach ($imdbComPerson->getActedFilms() as $filmImdbCode)
	    {
	    	/* If the film does not exist in the database, move to the next one */
	    	if (false == $film = Doctrine_Core::getTable('Film')->findOneByImdb($filmImdbCode)){
	    			continue;
	    	}
	    	
	    	/* Check if a connection between the person and the film is already made, if not, create it */
    		if (false == $filmPerson = Doctrine_Core::getTable('FilmPerson')->getOneByFilmAndPerson($film->getId(), $person->getId())){
    			$filmPerson = new FilmPerson();
    			$filmPerson->setFilmId($film->getId());
    			$filmPerson->setPersonId($person->getId());
    		}
    		
    			$filmPerson->setIsActor('1');
    			$filmPerson->save();
	    }
	    
  	  /* Add the Directed films */
	    foreach ($imdbComPerson->getDirectedFilms() as $filmImdbCode)
	    {
	    	/* If the film does not exist in the database, move to the next one */
	    	if (false == $film = Doctrine_Core::getTable('Film')->findOneByImdb($filmImdbCode)){
	    			continue;
	    	}
	    	
	    	/* Check if a connection between the person and the film is already made, if not, create it */
    		if (false == $filmPerson = Doctrine_Core::getTable('FilmPerson')->getOneByFilmAndPerson($film->getId(), $person->getId())){
    			$filmPerson = new FilmPerson();
    			$filmPerson->setFilmId($film->getId());
    			$filmPerson->setPersonId($person->getId());
    		}
    		
    			$filmPerson->setIsDirector('1');
    			$filmPerson->save();
	    }
	    
  	  /* Add the Produced films */
	    foreach ($imdbComPerson->getProducedFilms() as $filmImdbCode)
	    {
	    	/* If the film does not exist in the database, move to the next one */
	    	if (false == $film = Doctrine_Core::getTable('Film')->findOneByImdb($filmImdbCode)){
	    			continue;
	    	}
	    	
	    	/* Check if a connection between the person and the film is already made, if not, create it */
    		if (false == $filmPerson = Doctrine_Core::getTable('FilmPerson')->getOneByFilmAndPerson($film->getId(), $person->getId())){
    			$filmPerson = new FilmPerson();
    			$filmPerson->setFilmId($film->getId());
    			$filmPerson->setPersonId($person->getId());
    		}
    		
    			$filmPerson->setIsProducer('1');
    			$filmPerson->save();
	    }
	    
  	  /* Add the Written films */
	    foreach ($imdbComPerson->getWrittenFilms() as $filmImdbCode)
	    {
	    	/* If the film does not exist in the database, move to the next one */
	    	if (false == $film = Doctrine_Core::getTable('Film')->findOneByImdb($filmImdbCode)){
	    			continue;
	    	}
	    	
	    	/* Check if a connection between the person and the film is already made, if not, create it */
    		if (false == $filmPerson = Doctrine_Core::getTable('FilmPerson')->getOneByFilmAndPerson($film->getId(), $person->getId())){
    			$filmPerson = new FilmPerson();
    			$filmPerson->setFilmId($film->getId());
    			$filmPerson->setPersonId($person->getId());
    		}
    		
    			$filmPerson->setIsScriptwriter('1');
    			$filmPerson->save();
	    }
	    
	    echo '<br />Am terminat de importat persoana <strong>' . $person->getName() . '</strong>';
			ob_end_flush(); flush(); ob_start();
	    
  		
  	} catch (ImdbComPersonException $e){
  		echo 'A aparut o eroare! Click <a href="' . $this->generateUrl('default', array('module' => 'persons', 'action' => 'newObject')) . '">AICI</a> pentru a continua.';
  	}

  	echo 'Importul s-a terminat!  Click <a href="' . $this->generateUrl('default', array('module' => 'persons', 'action' => 'edit')) . '?lid=' . $person->getLibraryId() . '">AICI</a> pentru a continua.';
  	
  	exit;
  }
}
