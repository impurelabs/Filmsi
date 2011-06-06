<?php
class filmsComponents extends sfComponents
{
	public function executeMenu()
	{
		/* Count the photos */
		$this->displayPhotos = PhotoTable::getInstance()->hasNonRedcarpetByAlbum($this->film->getPhotoAlbumId());
		
		/* Count the redcarpet photos */
		$this->displayRedcarpet = PhotoTable::getInstance()->hasRedcarpetByAlbum($this->film->getPhotoAlbumId());
	}
}