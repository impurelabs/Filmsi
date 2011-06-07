<?php
class filmsComponents extends sfComponents
{
	public function executeMenu()
	{
		$this->displayBuy = $this->film->isOnDvd() || $this->film->isOnBluray() || $this->film->isOnline();
		
		$this->displayTickets = $this->film->isInCinema();
		
		/* Count the photos */
		$this->displayPhotos = $this->film->hasNonRedcarpetPhotos();
		
		/* Count the redcarpet photos */
		$this->displayRedcarpet = $this->film->hasRedcarpetPhotos(); 
	}
}