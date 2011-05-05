	<?php

/**
 * shops actions.
 *
 * @package    shopsi
 * @subpackage shops
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class shopsActions extends sfActions
{
	public function executeIndex(sfWebRequest $request)
	{
		$this->shops = Doctrine_Core::getTable('Shop')->getAllDetailed();
	}
	
  public function executeNew(sfWebRequest $request)
  {
  	$this->form = new ShopNewForm();
  	
  	if ($request->isMethod('post')){
  		$this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
  		
  		if ($this->form->isValid()){
  			$this->form->save();
  			
  			$this->redirect($this->generateUrl('default', array('module' => 'shops', 'action' => 'view')) . '?id=' . $this->form->getObject()->getId());
  		}
  	}
  	
  	$this->films = array();
  }
  
	public function executeEdit(sfWebRequest $request)
  {
  	$shop = Doctrine_Core::getTable('Shop')->findOneById($request->getParameter('id'));
  	
  	$this->form = new ShopEditForm($shop);
  	
  	if ($request->isMethod('post')){
  		$this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
  		
  		if ($this->form->isValid()){
  			$this->form->save();
  			
  			$this->redirect($this->generateUrl('default', array('module' => 'shops', 'action' => 'view')) . '?id=' . $this->form->getObject()->getId());
  		}
  	}
  	
  	$this->films = Doctrine_Core::getTable('ShopFilm')->getDetailedByShop($shop->getId());
  }
  
	public function executeView(sfWebRequest $request)
  {
  	$this->shop = Doctrine_Core::getTable('Shop')->findOneById($request->getParameter('id'));
  	
  	$this->films = Doctrine_Core::getTable('ShopFilm')->getDetailedByShop($this->shop->getId());
  }

	public function executeApi(sfWebRequest $request)
	{
		$this->setLayout(false);
		$this->getResponse()->setContentType('application/json');

		return $this->renderText(json_encode(Doctrine_Core::getTable('Shop')->getForApi($request->getParameter('term'))));
	}
	
	public function executeFilms(sfWebRequest $request)
	{
		$this->shop = Doctrine_Core::getTable('Shop')->findOneById($request->getParameter('id'));
		
		$this->form = new ShopFilmForm();
		$this->form->setDefault('shop_id', $this->shop->getId());
		
		if ($request->isMethod('post')){
			$this->form->bind($request->getParameter($this->form->getName()));
				
			if ($this->form->isValid()){
				$this->form->save();
				
				$this->redirect($this->generateUrl('default', array('module' => 'shops', 'action' => 'films')) . '?id=' . $this->shop->getId());
			}
		}
		
		$this->shopFilms = Doctrine_Core::getTable('ShopFilm')->getDetailedByShop($this->shop->getId());
	}
	
	public function executeDeleteFilm(sfWebRequest $request)
	{
		$shopFilm = Doctrine_Core::getTable('ShopFilm')->findOneById($request->getParameter('id'));
		$shopId= $shopFilm->getShopId();
		$shopFilm->delete();
		
		$this->redirect($this->generateUrl('default', array('module' => 'shops', 'action' => 'films')) . '?id=' . $shopId);
	}
	
	public function executeEditFilm(sfWebRequest $request)
	{
		$this->shopFilm = Doctrine_Core::getTable('ShopFilm')->findOneById($request->getParameter('id'));
		
		$this->form = new ShopFilmForm($this->shopFilm);
		
		if ($request->isMethod('post')){
			$this->form->bind($request->getParameter($this->form->getName()));
				
			if ($this->form->isValid()){
				$this->form->save();
				
				$this->redirect($this->generateUrl('default', array('module' => 'shops', 'action' => 'films')) . '?id=' . $this->shopFilm->getShopId());
			}
		}
	}

	public function executeImport(sfWebRequest $request)
	{
		$this->forward404If(false == $this->shop = Doctrine_Core::getTable('Shop')->findOneById($request->getParameter('sid')));
				
		$GLOBALS['shopId'] = $this->shop->getId();

		
		if ($request->isMethod('post')){
			/* delete the existing films from this shop */
			Doctrine_Core::getTable('ShopFilm')->deleteByShop($this->shop->getId());
			
			set_time_limit(10000);
			
			
			
			
			
			$parser = xml_parser_create();
			xml_set_element_handler($parser, 'start_element', 'end_element');
			xml_set_character_data_handler($parser, 'characted_data');
			
			$fp = fopen($request->getParameter('import_url'), 'r') or die('cannot open feed url');
			
			while ($data = fread($fp, 4096)) {
				xml_parse($parser, $data, feof($fp)) or die('parsing error');
			}
			
			
			
			
			
			
			exit;
			$products = array();
			$importedImdbCodes = array();
			
			$reader = new XMLReader();
			if (!$reader->open($request->getParameter('import_url')))
			{
				die("Failed to open feed");
			}
			
			
			
			while($reader->read())
			{
				$node = $reader->expand();
				unset($node);
				
				if ($node->tagName == 'product' && $node->getAttribute('imdb') != ''){
					
					/* If the product exists in the database, att the film to the shop */
					sfContext::getInstance()->getLogger()->info('Memory before: ' . $node->getAttribute('imdb') . '|' . memory_get_usage(true));
					
//					$q = Doctrine_Query::create()
//						->select('f.id')
//						->from('Film f')
//						->where('f.imdb = ?');
//					if ($film = $q->fetchOne(array($node->getAttribute('imdb')))) {
//						$film->free();
//					}
//					$q->free();
					
					
//					if ($film){
//						if ($node->getAttribute('is_dvd') == '1'){
//							sfContext::getInstance()->getLogger()->info('Mem BEFORE ' . $node->getAttribute('imdb') . ' dvd: ' . memory_get_usage(true));
//							$shopFilm = new ShopFilm();
//							$shopFilm->setShopId($this->shop->getId());
//							$shopFilm->setFilmId($film->getId());
//							$shopFilm->setUrl($node->getAttribute('dvd_url'));
//							$shopFilm->setFormat(ShopFilm::FORMAT_DVD);
//							$shopFilm->save();
//
//							$shopFilm->free();
//							unset($shopFilm);
//						}
//
//						if ($node->getAttribute('is_bluray') == '1'){
//							sfContext::getInstance()->getLogger()->info('Mem BEFORE ' . $node->getAttribute('imdb') . ' bluray: ' . memory_get_usage(true));
//							$shopFilm = new ShopFilm();
//							$shopFilm->setShopId($this->shop->getId());
//							$shopFilm->setFilmId($film->getId());
//							$shopFilm->setUrl($node->getAttribute('bluray_url'));
//							$shopFilm->setFormat(ShopFilm::FORMAT_BLURAY);
//							$shopFilm->save();
//
//							$shopFilm->free();
//							unset($shopFilm);
//							sfContext::getInstance()->getLogger()->info('Mem AFTER: ' . memory_get_usage(true));
//						}
//
//						if ($node->getAttribute('is_online') == '1'){
//							sfContext::getInstance()->getLogger()->info('Mem BEFORE ' . $node->getAttribute('imdb') . ' online: ' . memory_get_usage(true));
//							$shopFilm = new ShopFilm();
//							$shopFilm->setShopId($this->shop->getId());
//							$shopFilm->setFilmId($film->getId());
//							$shopFilm->setUrl($node->getAttribute('online_url'));
//							$shopFilm->setFormat(ShopFilm::FORMAT_ONLINE);
//							$shopFilm->save();
//
//							$shopFilm->free();
//							unset($shopFilm);
//							sfContext::getInstance()->getLogger()->info('Mem AFTER: ' . memory_get_usage(true));
//						}
						
						
//					}
				}
			}
			$reader->close();
			
			
			
			

			echo '<br /><br />Click <a href="' . $this->generateUrl('default', array('module' => 'shops', 'action' => 'films')) . '?id=' . $this->shop->getId() . '">AICI</a> pentru a continua.';
			exit;
		}
	}
}


function start_element($parser, $elementName, $elementAttrs)
{
	if ($elementName != 'PRODUCT' || $elementAttrs['IMDB'] == ''){
		return;
	}
		
	/* If the product exists in the database, att the film to the shop */
	echo '<br />' . 'Memory 245: ' . $elementAttrs['IMDB'] . '|' . memory_get_usage(true);

	$q = Doctrine_Query::create()
		->select('f.id')
		->from('Film f')
		->where('f.imdb = ?');
	echo '<br />' . 'Memory 251: ' . $elementAttrs['IMDB'] . '|' . memory_get_usage(true);
	if ($film = $q->fetchOne(array($elementAttrs['IMDB']))){
		$film->free();
	}
	echo '<br />' . 'Memory 255: ' . $elementAttrs['IMDB'] . '|' . memory_get_usage(true);
	$q->free();
	
	echo '<br />' . 'Memory 260: ' . $elementAttrs['IMDB'] . '|' . memory_get_usage(true);
	
	
	

//	if ($film = $q->fetchOne(array($elementAttrs['IMDB']))){
//		if ($elementAttrs['IS_DVD'] == '1'){
//			$shopFilm = new ShopFilm();
//			$shopFilm->setShopId($GLOBALS['shopId']);
//			$shopFilm->setFilmId($film->getId());
//			$shopFilm->setUrl($elementAttrs['DVD_URL']);
//			$shopFilm->setFormat(ShopFilm::FORMAT_DVD);
//			$shopFilm->save();
//
//			$shopFilm->free();
//			unset($shopFilm);
//		}
//
//		if ($elementAttrs['IS_BLURAY'] == '1'){
//			$shopFilm = new ShopFilm();
//			$shopFilm->setShopId($GLOBALS['shopId']);
//			$shopFilm->setFilmId($film->getId());
//			$shopFilm->setUrl($elementAttrs['BLURAY_URL']);
//			$shopFilm->setFormat(ShopFilm::FORMAT_BLURAY);
//			$shopFilm->save();
//
//			$shopFilm->free();
//			unset($shopFilm);
//			sfContext::getInstance()->getLogger()->info('Mem AFTER: ' . memory_get_usage(true));
//		}
//
//		if ($elementAttrs['IS_ONLINE'] == '1'){
//			$shopFilm = new ShopFilm();
//			$shopFilm->setShopId($GLOBALS['shopId']);
//			$shopFilm->setFilmId($film->getId());
//			$shopFilm->setUrl($elementAttrs['ONLINE_URL']);
//			$shopFilm->setFormat(ShopFilm::FORMAT_ONLINE);
//			$shopFilm->save();
//
//			$shopFilm->free();
//			unset($shopFilm);
//			sfContext::getInstance()->getLogger()->info('Mem AFTER: ' . memory_get_usage(true));
//		}
		
//		$film->free();
		
//	}
	
//	$q->free();

}

function end_element($parser, $elementName){
	
}

function character_data($parser, $data){
	
}