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
			set_time_limit(10000);

			if (false == $products = simplexml_load_file($request->getParameter('import_url'))){
				die('A aparut o eroare la deschiderea feed-ului!');
				$this->redirect($this->generateUrl('default', array('module' => 'shops', 'action' => 'films')) . '?id=' . $this->shop->getId());
			}

			/* delete the existing films from this shop */
			Doctrine_Core::getTable('ShopFilm')->deleteByShop($this->shop->getId());

			$notImportedFilms = array();
			$importedCount = 0;
			$notImportedCount = 0;
			foreach ($products->product as $product)
			{
				if (false == $film = Doctrine_Core::getTable('Film')->findOneByImdb($product['imdb'])){
					$notImportedCount += 1;

					$notImportedFilms[] = array(
						'name' => $product['name'],
						'imdb' => $product['imdb']
					);
					continue;
				}

				if ($product['is_dvd'] == '1'){
					$shopFilm = new ShopFilm();
					$shopFilm->setShopId($this->shop->getId());
					$shopFilm->setFilmId($film->getId());
					$shopFilm->setUrl($product['dvd_url']);
					$shopFilm->setFormat(ShopFilm::FORMAT_DVD);
					$shopFilm->save();
				}

				if ($product['is_bluray'] == '1'){
					$shopFilm = new ShopFilm();
					$shopFilm->setShopId($this->shop->getId());
					$shopFilm->setFilmId($film->getId());
					$shopFilm->setUrl($product['bluray_url']);
					$shopFilm->setFormat(ShopFilm::FORMAT_BLURAY);
					$shopFilm->save();
				}

				if ($product['is_online'] == '1'){
					$shopFilm = new ShopFilm();
					$shopFilm->setShopId($this->shop->getId());
					$shopFilm->setFilmId($film->getId());
					$shopFilm->setUrl($product['online_url']);
					$shopFilm->setFormat(ShopFilm::FORMAT_ONLINE);
					$shopFilm->save();
				}

				$importedCount += 1;

				echo '<br />Am terminat de importat filmul:' . $product['name'];
				ob_end_flush(); flush(); ob_start();
			}

			echo '<br />-----------------';
			echo '<br />S-au importat ' . $importedCount . ' filme';

			if ((int)$notImportedCount > 0){
				echo '<br />Nu s-a putut face importarea pentru ' . $notImportedCount . ' filme:';

				foreach ($notImportedFilms as $notImportedFilm){
					echo '<br />' . $notImportedFilm['name'] . ', IMDB: ' . $notImportedFilm['imdb'];
				}
			}

			echo '<br /><br />Click <a href="' . $this->generateUrl('default', array('module' => 'shops', 'action' => 'films')) . '?id=' . $this->shop->getId() . '">AICI</a> pentru a continua.';
			exit;
		}
	}
}