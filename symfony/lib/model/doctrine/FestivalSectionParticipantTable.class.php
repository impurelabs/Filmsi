<?php

/**
 * FestivalSectionParticipantTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class FestivalSectionParticipantTable extends Doctrine_Table
{
	public static function getInstance()
	{
		return Doctrine_Core::getTable('FestivalSectionParticipant');
	}

	public function getBySectionAndFilmAndPerson($festivalSectionId, $filmImdb, $personImdb)
	{
		return Doctrine_Query::create()
			->from('FestivalSectionParticipant fsp')
			->where('fsp.festival_section_id = ? AND fsp.film_imdb = ? AND fsp.person_imdb = ?', array($festivalSectionId, $filmImdb, $personImdb))
			->fetchOne();
	}

	public function getBySectionAndFilmAndNullPerson($festivalSectionId, $filmImdb)
	{
		return Doctrine_Query::create()
			->from('FestivalSectionParticipant fsp')
			->where('fsp.festival_section_id = ? AND fsp.film_imdb = ? AND fsp.person_imdb IS NULL', array($festivalSectionId, $filmImdb))
			->fetchOne();
	}

	public function getDetailedByPerson($personImdb, $limit = 5)
	{
		$awards = Doctrine_Query::create()
			->select('fsp.id, fsp.film_imdb, fsp.is_winner is_winner, fs.id, fs.name, fe.id, fe.edition, f.id, f.name')
			->from('FestivalSectionParticipant fsp')
			->innerJoin('fsp.FestivalSection fs')
			->innerJoin('fs.FestivalEdition fe')
			->innerJoin('fe.Festival f')
			->where('fsp.person_imdb = ?', $personImdb)
			->limit($limit)
			->execute(array(), Doctrine_Core::HYDRATE_SCALAR);

		foreach ($awards as $key => $award){
			$q = Doctrine_Query::create()
				->select('f.library_id, f.id, f.name_en, f.name_ro, f.url_key')
				->from('Film f')
				->where('f.imdb = ?', $award['fsp_film_imdb'])
				->fetchOne(array(), Doctrine_Core::HYDRATE_ARRAY);

			$awards[$key]['film'] = $q;
			unset($awards[$key]['fsp_film_imdb']);
		}

		return $awards;
	}

	public function getDetailedByFilm($filmImdb, $limit = 5)
	{
		$bruteAwards = Doctrine_Query::create()
			->select('fsp.id, fsp.film_imdb, fsp.person_imdb, fsp.is_winner, fs.id, fs.name, fe.id, fe.edition, f.id, f.name')
			->from('FestivalSectionParticipant fsp')
			->innerJoin('fsp.FestivalSection fs')
			->innerJoin('fs.FestivalEdition fe')
			->innerJoin('fe.Festival f')
			->where('fsp.film_imdb = ?', $filmImdb)
			->limit($limit)
			->execute(array(), Doctrine_Core::HYDRATE_ARRAY);

		/* Put in the same field all the results that have the same person */
		$awards = array();
		foreach ($bruteAwards as $key => $bruteAward){
			/* Check if the award is already in the $awards array. If so, just add the person to the persons array */
			if (array_key_exists($bruteAward['FestivalSection']['id'], $awards)){
				if (!empty($bruteAward['person_imdb']) && false !== $person = PersonTable::getInstance()->findOneByImdb($bruteAward['person_imdb'], Doctrine_Core::HYDRATE_ARRAY)){
					$awards[$bruteAward['FestivalSection']['id']]['persons'][] = $person;
				}
			} else {
				if (!empty($bruteAward['person_imdb']) && false !== $person = PersonTable::getInstance()->findOneByImdb($bruteAward['person_imdb'], Doctrine_Core::HYDRATE_ARRAY)){
					$bruteAward['persons'] = array($person);
				}
				unset($bruteAward['person_imdb']);
				$awards[$bruteAward['FestivalSection']['id']] = $bruteAward;
			}
		}
		//echo '<pre>'; var_dump($awards); exit;
		return $awards;
	}
}