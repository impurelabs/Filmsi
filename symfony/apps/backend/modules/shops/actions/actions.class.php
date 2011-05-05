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

		
		if ($request->isMethod('post')){
			/* delete the existing films from this shop */
			Doctrine_Core::getTable('ShopFilm')->deleteByShop($this->shop->getId());
			
			set_time_limit(10000);
			
			
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
				
				if ($node->tagName == 'product' && $node->getAttribute('imdb') != ''){
					
					/* If the product exists in the database, att the film to the shop */
					sfContext::getInstance()->getLogger()->info('Memory before: ' . $node->getAttribute('imdb') . '|' . memory_get_usage(true));
					$film = FilmTable::getInstance()->findOneByImdbForShopImport($node->getAttribute('imdb'));
					
					if ($film){
						if ($node->getAttribute('is_dvd') == '1'){
							sfContext::getInstance()->getLogger()->info('Mem BEFORE ' . $node->getAttribute('imdb') . ' dvd: ' . memory_get_usage(true));
							$shopFilm = new ShopFilm();
							$shopFilm->setShopId($this->shop->getId());
							$shopFilm->setFilmId($film->getId());
							$shopFilm->setUrl($node->getAttribute('dvd_url'));
							$shopFilm->setFormat(ShopFilm::FORMAT_DVD);
							$shopFilm->save();

							$shopFilm->free();
							unset($shopFilm);
						}

						if ($node->getAttribute('is_bluray') == '1'){
							sfContext::getInstance()->getLogger()->info('Mem BEFORE ' . $node->getAttribute('imdb') . ' bluray: ' . memory_get_usage(true));
							$shopFilm = new ShopFilm();
							$shopFilm->setShopId($this->shop->getId());
							$shopFilm->setFilmId($film->getId());
							$shopFilm->setUrl($node->getAttribute('bluray_url'));
							$shopFilm->setFormat(ShopFilm::FORMAT_BLURAY);
							$shopFilm->save();

							$shopFilm->free();
							unset($shopFilm);
							sfContext::getInstance()->getLogger()->info('Mem AFTER: ' . memory_get_usage(true));
						}

						if ($node->getAttribute('is_online') == '1'){
							sfContext::getInstance()->getLogger()->info('Mem BEFORE ' . $node->getAttribute('imdb') . ' online: ' . memory_get_usage(true));
							$shopFilm = new ShopFilm();
							$shopFilm->setShopId($this->shop->getId());
							$shopFilm->setFilmId($film->getId());
							$shopFilm->setUrl($node->getAttribute('online_url'));
							$shopFilm->setFormat(ShopFilm::FORMAT_ONLINE);
							$shopFilm->save();

							$shopFilm->free();
							unset($shopFilm);
							sfContext::getInstance()->getLogger()->info('Mem AFTER: ' . memory_get_usage(true));
						}
						
						$film->free();
					}
					
					unset($film);
				}
			}
			$reader->close();
			
			
			
			

			echo '<br /><br />Click <a href="' . $this->generateUrl('default', array('module' => 'shops', 'action' => 'films')) . '?id=' . $this->shop->getId() . '">AICI</a> pentru a continua.';
			exit;
		}
	}
}
