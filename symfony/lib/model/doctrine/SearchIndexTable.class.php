<?php

/**
 * SearchIndexTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class SearchIndexTable extends Doctrine_Table
{
	public static function getInstance()
	{
		return Doctrine_Core::getTable('SearchIndex');
	}
	
	public function buildAll()
	{
		/* Delete everything from the index */
		$q = Doctrine_Query::create()
			->delete('SearchIndex i')
			->where('1=1')
			->execute();

		$this->addFilms();
		$this->addPersons();
		$this->addArticles();
		$this->addStires();
		$this->addPhotos();
		$this->addVideos();
	}

	/* Add from the films */
	protected function addFilms()
	{
		$filmCount = Doctrine_Query::create()
			->select('COUNT(f.id) count')
			->from('Film f');

		$filmCount = $filmCount->fetchOne(array(), Doctrine_Core::HYDRATE_ARRAY);
		$filmCount = $filmCount['count'];

		$filmIds = array();
		for ($page = 1; $page <= ceil($filmCount / 1000); $page++){
			$q = Doctrine_Query::create()
				->select('f.id, f.name_ro, f.name_en, f.meta_keywords, f.description_content')
				->from('Film f')
				->limit(1000)
				->offset(($page - 1) * 1000);

			$q = $q->execute(array(), Doctrine_Core::HYDRATE_ARRAY);

			foreach ($q as $film){
				$index = new SearchIndex();
				$index->setContent($film['name_en'] . ' ' . $film['name_ro'] . ' ' . $film['meta_keywords'] . ' ' . strip_tags($film['description_content']));
				$index->setModel('Film');
				$index->setModelId($film['id']);
				$index->save();

				$filmIds[] = $film['id'];
			}
		}
	}

	/* Add the persons */
	protected function addPersons()
	{
		$itemCount = Doctrine_Query::create()
			->select('COUNT(p.id) count')
			->from('Person p');

		$itemCount = $itemCount->fetchOne(array(), Doctrine_Core::HYDRATE_ARRAY);
		$itemCount = $itemCount['count'];

		for ($page = 1; $page <= ceil($itemCount / 1000); $page++){
			$q = Doctrine_Query::create()
				->select('p.id, p.first_name, p.last_name, p.meta_keywords, p.biography_content')
				->from('Person p')
				->limit(1000)
				->offset(($page - 1) * 1000);

			$q = $q->execute(array(), Doctrine_Core::HYDRATE_ARRAY);

			foreach ($q as $person){
				$index = new SearchIndex();
				$index->setContent($person['first_name'] . ' ' . $person['last_name'] . ' ' . $person['meta_keywords'] . ' ' . strip_tags($person['biography_content']));
				$index->setModel('Person');
				$index->setModelId($person['id']);
				$index->save();
			}
		}
	}

	/* Add the articles */
	protected function addArticles()
	{
		$itemCount = Doctrine_Query::create()
			->select('COUNT(a.id) count')
			->from('Article a');

		$itemCount = $itemCount->fetchOne(array(), Doctrine_Core::HYDRATE_ARRAY);
		$itemCount = $itemCount['count'];

		for ($page = 1; $page <= ceil($itemCount / 1000); $page++){
			$q = Doctrine_Query::create()
				->select('a.id, a.name, a.content_content, a.meta_keywords')
				->from('Article a')
				->limit(1000)
				->offset(($page - 1) * 1000);

			$q = $q->execute(array(), Doctrine_Core::HYDRATE_ARRAY);

			foreach ($q as $article){
				$index = new SearchIndex();
				$index->setContent($article['name'] . ' ' . strip_tags($article['content_content']) . ' ' . $article['meta_keywords']);
				$index->setModel('Article');
				$index->setModelId($article['id']);
				$index->save();
			}
		}
	}

	/* Add the stires */
	protected function addStires()
	{
		$itemCount = Doctrine_Query::create()
			->select('COUNT(s.id) count')
			->from('Stire s');

		$itemCount = $itemCount->fetchOne(array(), Doctrine_Core::HYDRATE_ARRAY);
		$itemCount = $itemCount['count'];

		for ($page = 1; $page <= ceil($itemCount / 1000); $page++){
			$q = Doctrine_Query::create()
				->select('s.id, s.name, s.content_content, s.meta_keywords')
				->from('Stire s')
				->limit(1000)
				->offset(($page - 1) * 1000);

			$q = $q->execute(array(), Doctrine_Core::HYDRATE_ARRAY);

			foreach ($q as $stire){
				$index = new SearchIndex();
				$index->setContent($stire['name'] . ' ' . strip_tags($stire['content_content']) . ' ' . $stire['meta_keywords']);
				$index->setModel('Stire');
				$index->setModelId($stire['id']);
				$index->save();
			}
		}
	}

	/* Add the photos */
	protected function addPhotos()
	{
		$itemCount = Doctrine_Query::create()
			->select('COUNT(p.id) count')
			->from('Photo p');

		$itemCount = $itemCount->fetchOne(array(), Doctrine_Core::HYDRATE_ARRAY);
		$itemCount = $itemCount['count'];

		for ($page = 1; $page <= ceil($itemCount / 1000); $page++){
			$q = Doctrine_Query::create()
				->select('p.id, p.description, p.album_id, p.position')
				->from('Photo p')
				->limit(1000)
				->offset(($page - 1) * 1000);

			$q = $q->execute(array(), Doctrine_Core::HYDRATE_ARRAY);

			foreach ($q as $photo){
				if (empty($photo['description'])){
					continue;
				}

				/* Check which model has associated the parent photo album */
				$parent = $this->getPhotoParent($photo['album_id']);

				$index = new SearchIndex();
				$index->setContent($photo['description']);
				$index->setModel('Photo');
				$index->setModelId($parent . ':' . $photo['id']);
				$index->save();
			}
		}
	}

	/* Add the videos */
	protected function addVideos()
	{
		$itemCount = Doctrine_Query::create()
			->select('COUNT(v.id) count')
			->from('Video v');

		$itemCount = $itemCount->fetchOne(array(), Doctrine_Core::HYDRATE_ARRAY);
		$itemCount = $itemCount['count'];

		for ($page = 1; $page <= ceil($itemCount / 1000); $page++){
			$q = Doctrine_Query::create()
				->select('v.id, v.name, v.album_id, v.position')
				->from('Video v')
				->limit(1000)
				->offset(($page - 1) * 1000);

			$q = $q->execute(array(), Doctrine_Core::HYDRATE_ARRAY);

			foreach ($q as $video){
				if (empty($video['name'])){
					continue;
				}

				/* Check which model has associated the parent video album */
				$parent = $this->getVideoParent($video['album_id']);

				$index = new SearchIndex();
				$index->setContent($video['name']);
				$index->setModel('Video');
				$index->setModelId($parent . ':' . $video['id']);
				$index->save();
			}
		}
	}

	protected function getPhotoParent($albumId)
	{
		/* Search films */
		$q = Doctrine_Query::create()
			->select('f.id')
			->from('Film f')
			->where('photo_album_id = ?', $albumId)
			->fetchOne(array(), Doctrine_Core::HYDRATE_ARRAY);

		if (false !== $q) {
			return 'Film:' . $q['id'];
		}

		/* Search persons */
		$q = Doctrine_Query::create()
			->select('p.id')
			->from('Person p')
			->where('photo_album_id = ?', $albumId)
			->fetchOne(array(), Doctrine_Core::HYDRATE_ARRAY);

		if (false !== $q) {
			return 'Person:' . $q['id'];
		}

		/* Search cinemas */
		$q = Doctrine_Query::create()
			->select('c.id')
			->from('Cinema c')
			->where('photo_album_id = ?', $albumId)
			->fetchOne(array(), Doctrine_Core::HYDRATE_ARRAY);

		if (false !== $q) {
			return 'Cinema:' . $q['id'];
		}

		/* Search festival editions */
		$q = Doctrine_Query::create()
			->select('fe.id')
			->from('FestivalEdition fe')
			->where('photo_album_id = ?', $albumId)
			->fetchOne(array(), Doctrine_Core::HYDRATE_ARRAY);

		if (false !== $q) {
			return 'FestivalEdition:' . $q['id'];
		}

		/* Search stires */
		$q = Doctrine_Query::create()
			->select('s.id')
			->from('Stire s')
			->where('photo_album_id = ?', $albumId)
			->fetchOne(array(), Doctrine_Core::HYDRATE_ARRAY);

		if (false !== $q) {
			return 'Stire:' . $q['id'];
		}

		/* Search articles */
		$q = Doctrine_Query::create()
			->select('a.id')
			->from('Article a')
			->where('photo_album_id = ?', $albumId)
			->fetchOne(array(), Doctrine_Core::HYDRATE_ARRAY);

		if (false !== $q) {
			return 'Article:' . $q['id'];
		}
	}

	protected function getVideoParent($albumId)
	{
		/* Search films */
		$q = Doctrine_Query::create()
			->select('f.id')
			->from('Film f')
			->where('video_album_id = ?', $albumId)
			->fetchOne(array(), Doctrine_Core::HYDRATE_ARRAY);

		if (false !== $q) {
			return 'Film:' . $q['id'];
		}

		/* Search persons */
		$q = Doctrine_Query::create()
			->select('p.id')
			->from('Person p')
			->where('video_album_id = ?', $albumId)
			->fetchOne(array(), Doctrine_Core::HYDRATE_ARRAY);

		if (false !== $q) {
			return 'Person:' . $q['id'];
		}

		/* Search festival editions */
		$q = Doctrine_Query::create()
			->select('fe.id')
			->from('FestivalEdition fe')
			->where('video_album_id = ?', $albumId)
			->fetchOne(array(), Doctrine_Core::HYDRATE_ARRAY);

		if (false !== $q) {
			return 'FestivalEdition:' . $q['id'];
		}

		/* Search stires */
		$q = Doctrine_Query::create()
			->select('s.id')
			->from('Stire s')
			->where('video_album_id = ?', $albumId)
			->fetchOne(array(), Doctrine_Core::HYDRATE_ARRAY);

		if (false !== $q) {
			return 'Stire:' . $q['id'];
		}

		/* Search articles */
		$q = Doctrine_Query::create()
			->select('a.id')
			->from('Article a')
			->where('video_album_id = ?', $albumId)
			->fetchOne(array(), Doctrine_Core::HYDRATE_ARRAY);

		if (false !== $q) {
			return 'Article:' . $q['id'];
		}
	}

	public function searchFilms($term, $limit)
	{
		$items = Doctrine_Query::create()
			->select('i.model, i.model_id')
			->from('SearchIndex i')
			->where('MATCH(content) AGAINST(? IN BOOLEAN MODE)', $term)
			->andWhere('i.model = "Film"')
			->limit($limit)
			->execute(array(), Doctrine_Core::HYDRATE_ARRAY);

		$itemIds = array();
		foreach($items as $item){
			$itemIds[] = $item['model_id'];
		}

		if (count($itemIds) == 0){
			return array();
		}

		return Doctrine_Query::create()
			->select('f.id, f.name_ro, f.name_en, f.year, f.filename, f.url_key')
			->from('Film f')
			->orderBy('f.visit_count DESC')
			->whereIn('f.id', $itemIds)
			->execute();
	}

	public function searchPersons($term, $limit)
	{
		$items = Doctrine_Query::create()
			->select('i.model, i.model_id')
			->from('SearchIndex i')
			->where('MATCH(content) AGAINST(? IN BOOLEAN MODE)', $term)
			->andWhere('i.model = "Person"')
			->limit($limit)
			->execute(array(), Doctrine_Core::HYDRATE_ARRAY);

		$itemIds = array();
		foreach($items as $item){
			$itemIds[] = $item['model_id'];
		}

		if (count($itemIds) == 0){
			return array();
		}

		return Doctrine_Query::create()
			->select('p.id, p.first_name, p.last_name, p.is_actor, p.is_director, p.is_scriptwriter, p.is_producer, p.biography_teaser, f.filename, f.url_key')
			->from('Person p')
			->orderBy('p.visit_count DESC')
			->whereIn('p.id', $itemIds)
			->execute();
	}

	public function searchArticles($term, $limit)
	{
		$items = Doctrine_Query::create()
			->select('i.model, i.model_id')
			->from('SearchIndex i')
			->where('MATCH(content) AGAINST(? IN BOOLEAN MODE)', $term)
			->andWhere('i.model = "Article"')
			->limit($limit)
			->execute(array(), Doctrine_Core::HYDRATE_ARRAY);

		$itemIds = array();
		foreach($items as $item){
			$itemIds[] = $item['model_id'];
		}

		if (count($itemIds) == 0){
			return array();
		}

		return Doctrine_Query::create()
			->select('a.id, a.name, a.url_key, a.publish_date')
			->from('Article a')
			->orderBy('a.visit_count DESC')
			->whereIn('a.id', $itemIds)
			->execute();
	}

	public function searchStires($term, $limit)
	{
		$items = Doctrine_Query::create()
			->select('i.model, i.model_id')
			->from('SearchIndex i')
			->where('MATCH(content) AGAINST(? IN BOOLEAN MODE)', $term)
			->andWhere('i.model = "Stire"')
			->limit($limit)
			->execute(array(), Doctrine_Core::HYDRATE_ARRAY);

		$itemIds = array();
		foreach($items as $item){
			$itemIds[] = $item['model_id'];
		}

		if (count($itemIds) == 0){
			return array();
		}

		return Doctrine_Query::create()
			->select('s.id, s.name, s.url_key, s.publish_date')
			->from('Stire s')
			->orderBy('s.visit_count DESC')
			->whereIn('s.id', $itemIds)
			->execute();
	}

	public function searchPhotos($term, $limit)
	{
		$items = Doctrine_Query::create()
			->select('i.model, i.model_id')
			->from('SearchIndex i')
			->where('MATCH(content) AGAINST(? IN BOOLEAN MODE)', $term)
			->andWhere('i.model = "Photo"')
			->limit($limit)
			->execute(array(), Doctrine_Core::HYDRATE_ARRAY);

		if (count($items) == 0){
			return array();
		}

		$itemIds = array();
		$results = array();
		foreach($items as $item){
			$pices = explode(':', $item['model_id']);
			$itemIds[] = $pices[2];
			$results[$pices[2]]['route_prefix'] = strtolower($pices[0]);
			$results[$pices[2]]['route_model_id'] = strtolower($pices[1]);
		}

		$photos =  Doctrine_Query::create()
			->select('p.id, p.filename, p.position')
			->from('Photo p')
			->whereIn('p.id', $itemIds)
			->execute(array(), Doctrine_Core::HYDRATE_ARRAY);

		foreach ($photos as $photo) {
			$results[$photo['id']]['photo_filename'] = $photo['filename'];
			$results[$photo['id']]['photo_position'] = $photo['position'];
		}

		return $results;
	}

	public function searchVideos($term, $limit)
	{
		$items = Doctrine_Query::create()
			->select('i.model, i.model_id')
			->from('SearchIndex i')
			->where('MATCH(content) AGAINST(? IN BOOLEAN MODE)', $term)
			->andWhere('i.model = "Video"')
			->limit($limit)
			->execute(array(), Doctrine_Core::HYDRATE_ARRAY);

		if (count($items) == 0){
			return array();
		}

		$itemIds = array();
		$results = array();
		foreach($items as $item){
			$pices = explode(':', $item['model_id']);
			$itemIds[] = $pices[2];
			$results[$pices[2]]['route_prefix'] = strtolower($pices[0]);
			$results[$pices[2]]['route_model_id'] = strtolower($pices[1]);
		}

		$videos =  Doctrine_Query::create()
			->select('v.id, v.code, v.position')
			->from('Video v')
			->whereIn('v.id', $itemIds)
			->execute(array(), Doctrine_Core::HYDRATE_ARRAY);

		foreach ($videos as $video) {
			$results[$video['id']]['video_code'] = $video['code'];
			$results[$video['id']]['video_position'] = $video['position'];
		}

		return $results;
	}
}