<?php
class filmsComponents extends sfComponents
{
	public function executeMenu()
	{
		$this->displayBuy = $this->film->isOnDvd() || $this->film->isOnBluray() || $this->film->isOnline();
		
		$this->displayTickets = $this->film->isInCinema();
		
		/* Count the photos */
		$this->displayPhotos = PhotoTable::getInstance()->hasNonRedcarpetByAlbum($this->film->getPhotoAlbumId());
		
		/* Count the redcarpet photos */
		$this->displayRedcarpet = PhotoTable::getInstance()->hasRedcarpetByAlbum($this->film->getPhotoAlbumId());
	}
}