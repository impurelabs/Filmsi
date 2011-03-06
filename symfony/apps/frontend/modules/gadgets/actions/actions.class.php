<?php
 
/**
 * gadgets actions.
 *
 * @package    filmsi
 * @subpackage articles
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class gadgetsActions extends sfActions
{
	/**
	* Executes index action
	*
	* @param sfRequest $request A request object
	*/
	public function executeIndex(sfWebRequest $request)
	{
		$this->forward('gadgets', 'gadget' . $request->getParameter('gid'));
	}

	/**
	 * renders Gadget::MOST_READ_ARTICLES
	 */
	public function executeGadget0(sfWebRequest $request){
		$this->setLayout(false);
		$this->articles = ArticleTable::getInstance()->getMostVisited(3);
	}

	/**
	 * renders Gadget::MOST_COMMENTED_ARTICLES
	 */
	public function executeGadget1(sfWebRequest $request){
		$this->setLayout(false);
		$this->articles = ArticleTable::getInstance()->getMostCommented(3);
	}

	/**
	 * renders Gadget::NOW_ON_DBO
	 */
	public function executeGadget2(sfWebRequest $request){
		$this->setLayout(false);
		$this->films = FilmTable::getInstance()->getOnDvdAndBlurayNow(5, null, null, null, null, true, true, Doctrine_Core::HYDRATE_RECORD);
	}

	/**
	 * renders Gadget::CINEMA_RESERVATIONS
	 */
	public function executeGadget3(sfWebRequest $request){
		$this->setLayout(false);
		$this->cinemaLocations = CinemaTable::getInstance()->getLocations();
	}

	/**
	 * renders Gadget::BOX_OFFICE_RO
	 */
	public function executeGadget4(sfWebRequest $request){
		$this->setLayout(false);
		$this->films = BoxofficeFilmTable::getInstance()->getByType('ro');
	}

	/**
	 * renders Gadget::BOX_OFFICE_US
	 */
	public function executeGadget5(sfWebRequest $request){
		$this->setLayout(false);
		$this->films = BoxofficeFilmTable::getInstance()->getByType('us');
	}

	/**
	 * renders Gadget::NOW_ON_TV
	 */
	public function executeGadget6(sfWebRequest $request){
		$this->setLayout(false);
		$this->films = ChannelScheduleTable::getInstance()->getFilmsByDay(date('Y-m-d'), 5);
	}

	/**
	 * renders Gadget::SHOPS
	 */
	public function executeGadget7(sfWebRequest $request){
		$this->setLayout(false);
		$this->shops = ShopTable::getInstance()->getForGadget(4);
	}

	/**
	 * renders Gadget::NEWSEST_TRAILERS
	 */
	public function executeGadget8(sfWebRequest $request){
		$this->setLayout(false);
		$this->videos = VideoTable::getInstance()->getLatestTrailers(5);
	}

	/**
	 * renders Gadget::NEWSEST_PHOTOS
	 */
	public function executeGadget9(sfWebRequest $request){
		$this->setLayout(false);
		$this->photos = PhotoTable::getInstance()->getNewest(3);
	}

	/**
	 * renders Gadget::NEWSEST_ARTICLES
	 */
	public function executeGadget10(sfWebRequest $request){
		$this->setLayout(false);
		$this->articles = ArticleTable::getInstance()->getNewest(3);
	}

	/**
	 * renders Gadget::MOST_READ
	 */
	public function executeGadget11(sfWebRequest $request){
		$this->setLayout(false);
		$this->stires = StireTable::getInstance()->getNewest(3);
	}

	/**
	 * renders Gadget::MOST_READ_STIRES
	 */
	public function executeGadget12(sfWebRequest $request){
		$this->setLayout(false);
		$this->stires = StireTable::getInstance()->getMostVisited(3);
	}

	/**
	 * renders Gadget::MOST_COMMENTED_STIRES
	 */
	public function executeGadget13(sfWebRequest $request){
		$this->setLayout(false);
		$this->stires = StireTable::getInstance()->getMostCommented(3);
	}
}
