<?php
class filmsComponents extends sfComponents
{
	public function executeMenu()
	{
		/* Count the photos */
		$displayPhotos = PhotoTable::getInstance()->hasNonRedcarpetByAlbum($this->film->getPhotoAlbumId());
		
		/* Count the redcarpet photos */
		$displayRedcarpet = PhotoTable::getInstance()->hasRedcarpetByAlbum($this->film->getPhotoAlbumId());
	}
}