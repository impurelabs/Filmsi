<?php

/**
 * Cinema
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    cinemasi
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Cinema extends BaseCinema
{	
	public function preDelete($event)
	{
		// Delete the big file and the thumbnail
		unlink(sfConfig::get('app_cinema_path') . '/' . $event->getInvoker()->getFilename());
		unlink(sfConfig::get('app_cinema_path') . '/t-' . $event->getInvoker()->getFilename());
		unlink(sfConfig::get('app_cinema_path') . '/ts-' . $event->getInvoker()->getFilename());

		return parent::preDelete($event);
	}
	
	public function createFile()
	{
		$sourceFile = sfConfig::get('app_cinema_path') . '/' . $this->getFilename();
		
		if (!file_exists($sourceFile)){
			throw new sfException('Source file not available: ' . $sourceFile);
		}

		/* Create the big file */
		$photo = new sfThumbnail(sfConfig::get('app_cinema_sourceimage_size'), sfConfig::get('app_cinema_sourceimage_size'));
		$photo->loadFile($sourceFile);
		$photo->save(sfConfig::get('app_cinema_path') . '/' . $this->getFilename());

		/* Create the thumbnail */
		$thumb = new sfThumbnail(sfConfig::get('app_cinema_thumbnail_size'), sfConfig::get('app_cinema_thumbnail_size'));
		$thumb->loadFile($sourceFile);
		$thumb->save(sfConfig::get('app_cinema_path') . '/t-' . $this->getFilename());

		/* Create the small thumbnail */
		$thumb = new sfThumbnail(sfConfig::get('app_cinema_thumbnail_small_size'), sfConfig::get('app_cinema_thumbnail_small_size'));
		$thumb->loadFile($sourceFile);
		$thumb->save(sfConfig::get('app_cinema_path') . '/ts-' . $this->getFilename());
	}

}