<?php

/**
 * PhotoTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class PhotoTable extends Doctrine_Table
{
	public static function getInstance()
	{
		return Doctrine_Core::getTable('Photo');
	}

	public function getListForView($albumId)
	{
		return Doctrine_Query::create()
			->from('Photo p')
			->where('p.album_id = ?', $albumId)
			->orderBy('p.position ASC')
			->execute();
	}

	public function getFirst($albumId)
	{
		return Doctrine_Query::create()
			->from('Photo p')
			->where('p.album_id = ?', $albumId)
			->andWhere('p.position = 1')
			->fetchOne();
	}

	public function getNeighbours($albumId, $position)
	{
		$photos = Doctrine_Query::create()
			->from('Photo p')
			->select('p.id, p.position')
			->where('p.album_id = ?', $albumId)
			->whereIn('p.position', array($position - 1, $position + 1))
			->execute(array(), Doctrine_Core::HYDRATE_ARRAY);
			
		$neighbours = array();
		 
		foreach($photos as $photo){
			if ($photo['position'] == $position - 1){
				$neighbours['previous'] = $photo;
			}

			if ($photo['position'] == $position + 1){
				$neighbours['next'] = $photo;
			}
		}
		 
		return $neighbours;
	}
	
	public function getCountByAlbum($albumId)
	{
		$q = Doctrine_Query::create()
			->select('COUNT(DISTINCT p.id) counter')
			->from('Photo p')		
			->where('p.album_id = ?', $albumId)
			->fetchOne(array(), Doctrine_Core::HYDRATE_ARRAY);
			
		return $q['counter'];
	}

	public function getLatestForFilms($limit = null)
	{
		$q = Doctrine_Query::create()
			->select('p.*, f.id, a.id, f.url_key, f.name_ro, f.name_en')
			->from('Photo p')
			->innerJoin('p.Album a')
			->innerJoin('a.Film f')
			->orderBy('p.updated_at DESC')
			->where('p.state = 1 AND a.publish_date IS NOT NULL AND a.publish_date <= NOW()');

		if (isset($limit)){
			$q = $q->limit($limit);
		}

		return $q->execute();

	}

	public function getLatestForFestivalEditions($limit = null)
	{
		$q = Doctrine_Query::create()
			->select('p.*, e.id, a.id, e.url_key, e.edition, f.name')
			->from('Photo p')
			->innerJoin('p.Album a')
			->innerJoin('a.FestivalEdition e')
			->innerJoin('e.Festival f')
			->orderBy('p.updated_at DESC')
			->where('p.state = 1 AND a.publish_date IS NOT NULL AND a.publish_date <= NOW()');

		if (isset($limit)){
			$q = $q->limit($limit);
		}

		return $q->execute();

	}

	public function getNewest($limit = null)
	{
		$photos = array();
		$filmPhotos = Doctrine_Query::create()
			->select('p.*, f.id, a.id, f.url_key')
			->from('Photo p')
			->innerJoin('p.Album a')
			->innerJoin('a.Film f')
			->orderBy('p.updated_at DESC')
			->where('p.state = 1 AND a.publish_date IS NOT NULL AND a.publish_date <= NOW()')
			->limit($limit)
			->execute(array(), Doctrine_Core::HYDRATE_ARRAY);
		foreach($filmPhotos as $filmPhoto){
			$photos[$filmPhoto['updated_at']] = array(
				'id' => $filmPhoto['id'],
				'filename' => $filmPhoto['filename'],
				'position' => $filmPhoto['position'],
				'parent_type' => 'film',
				'parent_id' => $filmPhoto['Album']['Film']['id'],
				'parent_url_key' => $filmPhoto['Album']['Film']['url_key']
			);
		}

		$personPhotos = Doctrine_Query::create()
			->select('p.*, f.id, a.id, f.url_key')
			->from('Photo p')
			->innerJoin('p.Album a')
			->innerJoin('a.Person f')
			->orderBy('p.updated_at DESC')
			->where('p.state = 1 AND a.publish_date IS NOT NULL AND a.publish_date <= NOW()')
			->limit($limit)
			->execute(array(), Doctrine_Core::HYDRATE_ARRAY);
		foreach($personPhotos as $personPhoto){
			$photos[$personPhoto['updated_at']] = array(
				'id' => $personPhoto['id'],
				'filename' => $personPhoto['filename'],
				'position' => $personPhoto['position'],
				'parent_type' => 'person',
				'parent_id' => $personPhoto['Album']['Person']['id'],
				'parent_url_key' => $personPhoto['Album']['Person']['url_key']
			);
		}

		$stirePhotos = Doctrine_Query::create()
			->select('p.*, f.id, a.id, f.url_key')
			->from('Photo p')
			->innerJoin('p.Album a')
			->innerJoin('a.Stire f')
			->orderBy('p.updated_at DESC')
			->where('p.state = 1 AND a.publish_date IS NOT NULL AND a.publish_date <= NOW()')
			->limit($limit)
			->execute(array(), Doctrine_Core::HYDRATE_ARRAY);
		foreach($stirePhotos as $stirePhoto){
			$photos[$stirePhoto['updated_at']] = array(
				'id' => $stirePhoto['id'],
				'filename' => $stirePhoto['filename'],
				'position' => $stirePhoto['position'],
				'parent_type' => 'stire',
				'parent_id' => $stirePhoto['Album']['Stire']['id'],
				'parent_url_key' => $stirePhoto['Album']['Stire']['url_key']
			);
		}

		$articlePhotos = Doctrine_Query::create()
			->select('p.*, f.id, a.id, f.url_key')
			->from('Photo p')
			->innerJoin('p.Album a')
			->innerJoin('a.Article f')
			->orderBy('p.updated_at DESC')
			->where('p.state = 1 AND a.publish_date IS NOT NULL AND a.publish_date <= NOW()')
			->limit($limit)
			->execute(array(), Doctrine_Core::HYDRATE_ARRAY);
		foreach($articlePhotos as $articlePhoto){
			$photos[$articlePhoto['updated_at']] = array(
				'id' => $articlePhoto['id'],
				'filename' => $articlePhoto['filename'],
				'position' => $articlePhoto['position'],
				'parent_type' => 'article',
				'parent_id' => $articlePhoto['Album']['Article']['id'],
				'parent_url_key' => $articlePhoto['Album']['Article']['url_key']
			);
		}

		$festivalEditionPhotos = Doctrine_Query::create()
			->select('p.*, f.id, a.id, f.url_key')
			->from('Photo p')
			->innerJoin('p.Album a')
			->innerJoin('a.FestivalEdition f')
			->orderBy('p.updated_at DESC')
			->where('p.state = 1 AND a.publish_date IS NOT NULL AND a.publish_date <= NOW()')
			->limit($limit)
			->execute(array(), Doctrine_Core::HYDRATE_ARRAY);
		foreach($festivalEditionPhotos as $festivalEditionPhoto){
			$photos[$festivalEditionPhoto['updated_at']] = array(
				'id' => $festivalEditionPhoto['id'],
				'filename' => $festivalEditionPhoto['filename'],
				'position' => $festivalEditionPhoto['position'],
				'parent_type' => 'festival_edition',
				'parent_id' => $festivalEditionPhoto['Album']['FestivalEdition']['id'],
				'parent_url_key' => $festivalEditionPhoto['Album']['FestivalEdition']['url_key']
			);
		}

		$cinemaPhotos = Doctrine_Query::create()
			->select('p.*, f.id, a.id, f.url_key')
			->from('Photo p')
			->innerJoin('p.Album a')
			->innerJoin('a.Cinema f')
			->orderBy('p.updated_at DESC')
			->where('p.state = 1 AND a.publish_date IS NOT NULL AND a.publish_date <= NOW()')
			->limit($limit)
			->execute(array(), Doctrine_Core::HYDRATE_ARRAY);
		foreach($cinemaPhotos as $cinemaPhoto){
			$photos[$cinemaPhoto['updated_at']] = array(
				'id' => $cinemaPhoto['id'],
				'filename' => $cinemaPhoto['filename'],
				'position' => $cinemaPhoto['position'],
				'parent_type' => 'cinema',
				'parent_id' => $cinemaPhoto['Album']['Cinema']['id'],
				'parent_url_key' => $cinemaPhoto['Album']['Cinema']['url_key']
			);
		}

		krsort($photos);
		return array_slice($photos, 0, $limit);



	}
}