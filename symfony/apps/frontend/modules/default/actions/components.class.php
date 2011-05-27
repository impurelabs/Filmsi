<?php
class defaultComponents extends sfComponents
{
	public function executeVisitHistory()
	{
		$this->visits = Doctrine_Core::getTable('Visit')->getLatestByIp($_SERVER['REMOTE_ADDR'], 5);
	}

	public function executeBestItems()
	{
		$this->bestItems = LibraryTable::getInstance()->getBestItemsWithoutStires(7);

		$this->bestStires = StireTable::getInstance()->getBest(3);
	}

	public function executeHomeBackground()
	{	
		$this->homepage = HomepageTable::getInstance()->findOneById(1);
		$details = getimagesize(sfConfig::get('app_homepage_background_path') . '/' .$this->homepage->getBackgroundFilename());
		$this->width = $details[0];
	}

	public function executeUnderFooter()
	{
		$days = array();
		$today = (int)date('N');
		$todayTime = time();
		for($i = 1; $i <= 7; $i++){
			$days[$i] = date('Y-m-d', ( $i - $today ) * 86400 + $todayTime);
		}
		$this->filmsNowInCinema = FilmTable::getInstance()->getInCinemaNow($days, 5, null, null, null, null, Doctrine_Core::HYDRATE_RECORD);
		$this->filmsSoonInCinema = FilmTable::getInstance()->getInCinemaSoon(5, null, null, null, Doctrine_Core::HYDRATE_RECORD);
		$this->filmsNowDbo = FilmTable::getInstance()->getOnDvdAndBlurayNow(5, null, null, null, null, true, true, Doctrine_Core::HYDRATE_RECORD);
		$this->filmsSoonDbo = FilmTable::getInstance()->getOnDvdAndBluraySoon(5, null, null, null, null, true, true, Doctrine_Core::HYDRATE_RECORD);
		$this->filmsNowTv = ChannelScheduleTable::getInstance()->getFilmsByDay(date('Y-m-d'), 5);
		$this->filmsTomorrowTv = ChannelScheduleTable::getInstance()->getFilmsByDay(date('Y-m-d', time() + 86400), 5);
		$this->actors = PersonTable::getInstance()->getBestActors(5);
		$this->stires = StireTable::getInstance()->getBest(5);
	}

	public function executeRightColumn(sfWebRequest $request) {
		$this->gadgets = PageGadgetTable::getInstance()->findByPage($this->page);
	}
	
	public function executeSearch(sfWebRequest $request)
	{
		if ($this->getContext()->has('mostSearchedItems')){
			$this->mostSearchedItems = $this->getContext()->get('mostSearchedItems');
		} else {
			$this->mostSearchedItems = LibraryTable::getInstance()->getMostSearchedItems(3);
			
			$this->getContext()->set('mostSearchedItems', $this->mostSearchedItems);
		}
	}
}