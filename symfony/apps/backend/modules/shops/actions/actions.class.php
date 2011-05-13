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
		
		$this->page = $request->hasParameter('page') ? $request->getParameter('page') : 1;
		
		$this->shopFilms = Doctrine_Core::getTable('ShopFilm')->getPagedByShop($this->shop->getId(), $this->page, 200);
		$this->filmCount = Doctrine_Core::getTable('ShopFilm')->countByShop($this->shop->getId());
		$this->pageCount = ceil($this->filmCount / 200);
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
		/* just fo testing*/
		$this->forward404If(false == $this->shop = Doctrine_Core::getTable('Shop')->findOneById($request->getParameter('sid')));

		$this->preparedFilms = ShopFilmBufferTable::getInstance()->countByShop($this->shop->getId());
	}
	
	public function executeImportBuffer(sfWebRequest $request)
	{
		/* just fo testing*/
		$this->forward404If(false == $this->shop = Doctrine_Core::getTable('Shop')->findOneById($request->getParameter('sid')));
		

		if ($request->isMethod('post')){
			set_time_limit(10000);
			
			/* delete the existing films from this shop and from the buffer*/
			Doctrine_Core::getTable('ShopFilm')->deleteByShop($this->shop->getId());
			Doctrine_Core::getTable('ShopFilmBuffer')->deleteByShop($this->shop->getId());

			if (!$products = simplexml_load_file($request->getParameter('import_url'))){
				die('A aparut o eroare la deschiderea feed-ului!');
				$this->redirect($this->generateUrl('default', array('module' => 'shops', 'action' => 'films')) . '?id=' . $this->shop->getId());
			}
			
			$filmCollection = new Doctrine_Collection('ShopFilm');
			
			foreach ($products->product as $product) {	
				$productImdb = (string)$product['imdb'];
					
				if ($productImdb == ''){
					continue;
				}
				
				$shopFilmBuffer = new ShopFilmBuffer();
				$shopFilmBuffer->setShopId($this->shop->getId());
				$shopFilmBuffer->setImdb($productImdb);
				$shopFilmBuffer->setIsDvd($product['is_dvd']);
				$shopFilmBuffer->setDvdUrl($product['dvd_url']);
				$shopFilmBuffer->setIsBluray($product['is_bluray']);
				$shopFilmBuffer->setBlurayUrl($product['bluray_url']);
				$shopFilmBuffer->setIsOnline($product['is_online']);
				$shopFilmBuffer->setOnlineUrl($product['online_url']);
				//$shopFilmBuffer->save();
				
				$filmCollection->add($shopFilmBuffer);
			}
			
			$filmCollection->save();
			

			$this->redirect($this->generateUrl('default', array('module' => 'shops', 'action' => 'import')) . '?sid=' . $this->shop->getId());
		}
	}
	
	public function executeMakeImport(sfWebRequest $request)
	{
		/* just fo testing*/
		$this->forward404If(false == $this->shop = Doctrine_Core::getTable('Shop')->findOneById($request->getParameter('sid')));
		

		if ($request->isMethod('post')){
			set_time_limit(10000);
			
			$bufferFilms = ShopFilmBufferTable::getInstance()->getBatch($this->shop->getId(), 500);
			
			
			//die('aa' . $bufferFilms->count());
			foreach ($bufferFilms as $bufferFilm) {		
				
				/* If the film exists in the db, add it to the film shop table */
				if ($film = FilmTable::getInstance()->findOneByImdb($bufferFilm->getImdb())){
					if ($bufferFilm->getIsDvd() == '1'){
						$shopFilm = new ShopFilm();
						$shopFilm->setShopId($this->shop->getId());
						$shopFilm->setFilmId($film->getId());
						$shopFilm->setFormat(ShopFilm::FORMAT_DVD);
						$shopFilm->setUrl($bufferFilm->getDvdUrl());
						$shopFilm->save();
					}
					if ($bufferFilm->getIsBluray() == '1'){
						$shopFilm = new ShopFilm();
						$shopFilm->setShopId($this->shop->getId());
						$shopFilm->setFilmId($film->getId());
						$shopFilm->setFormat(ShopFilm::FORMAT_BLURAY);
						$shopFilm->setUrl($bufferFilm->getBlurayUrl());
						$shopFilm->save();
					}
					if ($bufferFilm->getIsOnline() == '1'){
						$shopFilm = new ShopFilm();
						$shopFilm->setShopId($this->shop->getId());
						$shopFilm->setFilmId($film->getId());
						$shopFilm->setFormat(ShopFilm::FORMAT_ONLINE);
						$shopFilm->setUrl($bufferFilm->getOnlineUrl());
						$shopFilm->save();
					}
				}
			}
			
			$this->redirect($this->generateUrl('default', array('module' => 'shops', 'action' => 'import')) . '?sid=' . $this->shop->getId());
		}
	}
}