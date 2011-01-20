<?php

/**
 * import actions.
 *
 * @package    filmsi
 * @subpackage import
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class importActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->forward('default', 'module');
  }

	public function executeProvideo(sfWebRequest $request)
	{
		set_time_limit(10000);
		
		$userId = $this->getUser()->getGuardUser()->getId();
		$produse = simplexml_load_file('i:/export.xml');
		
		$count = 0;
		foreach ($produse->produs as $produs)
		{
			
			break;
			$count += 1;
			/* Check if the imdb already exists */
			if (Doctrine_Core::getTable('Film')->countByImdb($produs['imdb']) != 0 or $produs['imdb'] == ''){
				continue;
			}
			
			/* Create the film */
			$film = new Film();
			$film->setNameRo($produs['titlu_romana']);
			$film->setNameEn($produs['titlu_engleza']);
			$film->setImdb($produs['imdb']);
			if ($produs['an'] != ''){
				$film->setYear($produs['an']);
			}
			$film->setRating($produs['rating_cnc']);
			$film->setDuration($produs['durata']);
			$film->setDescriptionContent($produs['sinopsis']);
			$film->setUserId($userId);
			
			/* Create the photo filename */
			if ($produs['coperta'] == ''){
				continue;
			} else {
				$source = str_replace('_thumb', '', $produs['coperta']);
			}
			$pieces = explode('.', $source);
			$extension = $pieces[count($pieces) - 1];
			$filename = md5(time() . rand(0, 999999)). '.' . $extension;
			copy($source, sfConfig::get('app_film_path').'/'.$filename);
			$film->setFilename($filename);
			$film->createFile();
			
			$film->save();
			
			/* Check if the genre already exists in the db, if not add it. Then save it to the film */
			foreach ($produs->genuri->gen as $gen){
				if (false == $genre = Doctrine_Core::getTable('Genre')->findOneByName($gen['nume'])){
					$genre = new Genre();
					$genre->setName($gen['nume']);
					$genre->save();
				}
				
				$filmGenre = new FilmGenre();
				$filmGenre->setFilmId($film->getId());
				$filmGenre->setGenreId($genre->getId());
				$filmGenre->save();
			}
			
			echo '<br />' . $count .') Am terminat filmul:' . $film->getNameRo();
			ob_end_flush(); flush(); ob_start(); 
		}  
		
		echo 'done ok!';
		exit;
	}
	
}
