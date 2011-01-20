<?php

/**
 * VideoAlbumTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class VideoAlbumTable extends Doctrine_Table
{
	public function cloneObject($libraryId)
	{
		$album = Doctrine_Core::getTable('VideoAlbum')->findOneByLibraryId($libraryId);
		
		/* Cloning the album */
		$newAlbum = new VideoAlbum();
		$newAlbum->setState($album->getState());
		$newAlbum->setPublishDate($album->getPublishDate());
		$newAlbum->setUserId(sfContext::getInstance()->getUser()->getGuardUser()->getId());
		$newAlbum->setName($album->getName() . ' - clone');
		$newAlbum->save();
		
		/* Cloning the videos in the album */
		$videos = Doctrine_Core::getTable('Video')->findByAlbumId($album->getId());
		foreach($videos as $video){
			/* Creating the new video in the database */
			$newVideo = new Video();
			$newVideo->setAlbumId($newAlbum->getId());
			$newVideo->setState($video->getState());
			$newVideo->setName($video->getName());
			$newVideo->setCode($video->getCode());
			$newVideo->setPosition($video->getPosition());
			$newVideo->save();
		}
	}
	
	public function allow($libraryId)
	{
		$album = Doctrine_Core::getTable('VideoAlbum')->findOneByLibraryId($libraryId);
		
		/* First update video state*/
		$q = Doctrine_Query::create()
			->update('Video p')
			->set('p.state', '?', Library::STATE_ACTIVE)
			->where('p.album_id = ?', $album->getId())
			->execute();
		
		/* Update album state*/
		$album->setState(Library::STATE_ACTIVE);
		$album->save();
	}

	public function getForApi($term)
	{
		$term = '(^| |-)' . $term ;
		
		$bruteAlbums = Doctrine_Query::create()
			->from('VideoAlbum a')
			->andWhere('a.state = 1')
			->andWhere('a.name REGEXP ?', $term)
			->orderBy('a.name ASC')
			->limit(50)
			->execute();

    $albums = array();					              
		foreach ($bruteAlbums as $key => $bruteAlbum){
			$albums[$key]['value'] = $bruteAlbum->getId();
			$albums[$key]['label'] = $bruteAlbum->getName();
		}
		
		return $albums;
	}
}