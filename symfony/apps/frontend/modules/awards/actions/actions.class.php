<?php

/**
 * awards actions.
 *
 * @package    filmsi
 * @subpackage awards
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class awardsActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
	public function executeIndex(sfWebRequest $request)
	{	$this->getResponse()->setTitle('Festivaluri - Filmsi.ro');

		$this->currentPage = (int)$request->getParameter('p', 1);
		$this->festivals = FestivalTable::getInstance()->getAllOrdered();
		$this->currentFestivalId = $request->getParameter('id', null);
		if (!empty($this->currentFestivalId)){
			$this->currentFestival = FestivalTable::getInstance()->findOneById($this->currentFestivalId);
		}
		$this->editions = FestivalEdition::getInstance()->getList($this->currentFestivalId, sfConfig::get('app_festival_page_limit'), $this->currentPage);
		$this->editionCount = FestivalEdition::getInstance()->countByFestival($this->currentFestivalId);
		$this->pageCount = ceil($this->editionCount / sfConfig::get('app_festival_page_limit'));
		$this->firstEditionCount = sfConfig::get('app_festival_page_limit') * ($this->currentPage - 1) + 1;
		$this->lastEditionCount = $this->firstEditionCount + count($this->editions) - 1;
		if ($this->pageCount <= 5) {
			$this->navStart = 1;
			$this->navEnd = $this->pageCount;
		} else {
			$this->navStart = $this->currentPage - 2;
			$this->navEnd = $this->currentPage - 2;

			if ($this->navStart <= 0){
				$this->navStart = 1;
				$this->navEnd = 5;
			}

			if ($this->navEnd >= $this->pageCount){
				$this->navStart = $this->pageCount - 4;
				$this->navEnd = $this->pageCount;
			}
		}

		$this->stires = StireTable::getInstance()->getLatestRelatedToFestivalEditions(3);
	}

	public function executeView(sfWebRequest $request)
	{
		if (false === $this->edition = FestivalEditionTable::getInstance()->findOneById($request->getParameter('id'))){
			$this->redirect404();
		}

		$this->getResponse()->setTitle($this->edition->getName() . ' - Filmsi.ro');
		$this->getResponse()->addMeta('keywords', $this->edition->getMetaKeywords());
		$this->getResponse()->addMeta('description', $this->edition->getMetaDescription());

		$this->editions = FestivalEditionTable::getInstance()->getEditionsIdsByFestival($this->edition->getFestivalId());


		$this->commentForm = new CommentForm(null, array(
			'state' => 1,
			'ip' => $_SERVER['REMOTE_ADDR'],
			'model' => 'FestivalEdition',
                        'model_library_id' => $this->edition->getLibraryId(),
                        'model_name' => $this->edition->getName()
		));
		if ($this->getUser()->isAuthenticated()){
			$user = $this->getUser()->getGuardUser();
			$this->commentForm->setDefaults(array(
				'name' => $user->getName(),
				'email' => $user->getEmailAddress()
			));
		}
		if ($request->isMethod('post')){
			$this->commentForm->bind($request->getParameter($this->commentForm->getName()));

			if ($this->commentForm->isValid()){
				$this->commentForm->save();

                                $this->redirect($this->generateUrl('festival_edition', array('id' => $this->edition->getId(), 'key' => $this->edition->getUrlKey())) . '#comments');
			}
		}

		$this->comments = Doctrine_Core::getTable('Comment')->getActiveByModel('edition', $this->edition->getLibraryId(), $_SERVER['REMOTE_ADDR']);

		/* Add the visit */
		$visit = new Visit();
		$visit->setLibraryId($this->edition->getLibraryId());
		$visit->setUrl($this->generateUrl('festival_edition', array('id' => $this->edition->getId(), 'key' => $this->edition->getUrlKey())));
		$visit->setName($this->edition->getFestival()->getName() . ' - ' . $this->edition->getEdition());
		$visit->setIp($_SERVER['REMOTE_ADDR']);
		$visit->save();
	}

	public function executeArticles(sfWebRequest $request)
	{
		$this->edition = FestivalEditionTable::getInstance()->findOneById($request->getParameter('id'));

		$this->getResponse()->setTitle('Articole: ' . $this->edition->getName() . ' - Filmsi.ro');
		$this->getResponse()->addMeta('keywords', '');
		$this->getResponse()->addMeta('description', '');

		$this->currentPage = (int)$request->getParameter('p', 1);
		$this->articles = ArticleTable::getInstance()->getListByFestivalEdition($this->edition->getId(), sfConfig::get('app_article_page_limit'), $this->currentPage);
		$this->articleCount = ArticleTable::getInstance()->countByFestivalEdition($this->edition->getId());
		$this->pageCount = ceil($this->articleCount / sfConfig::get('app_article_page_limit'));
		$this->firstArticleCount = sfConfig::get('app_article_page_limit') * ($this->currentPage - 1) + 1;
		$this->lastArticleCount = $this->firstArticleCount + $this->articles->count() - 1;
		if ($this->pageCount <= 5) {
			$this->navStart = 1;
			$this->navEnd = $this->pageCount;
		} else {
			$this->navStart = $this->currentPage - 2;
			$this->navEnd = $this->currentPage - 2;

			if ($this->navStart <= 0){
				$this->navStart = 1;
				$this->navEnd = 5;
			}

			if ($this->navEnd >= $this->pageCount){
				$this->navStart = $this->pageCount - 4;
				$this->navEnd = $this->pageCount;
			}
		}
	}

	public function executePhotos(sfWebRequest $request)
	{
		$this->edition = FestivalEditionTable::getInstance()->findOneById($request->getParameter('id'));

		$this->getResponse()->setTitle('Fotografii: ' . $this->edition->getName() . ' - Filmsi.ro');
		$this->getResponse()->addMeta('keywords', '');
		$this->getResponse()->addMeta('description', '');

		$this->photos = $this->edition->getPhotoAlbum()->getPhotos();
		$this->photoCount = $this->photos->count();

		$this->currentPhoto = $request->getParameter('pid', 1);
	}

	public function executeStiri(sfWebRequest $request)
	{
		$this->edition = FestivalEditionTable::getInstance()->findOneById($request->getParameter('id'));
		$this->editions = FestivalEditionTable::getInstance()->getEditionsIdsByFestival($this->edition->getFestivalId());

		$this->getResponse()->setTitle('Stiri: ' . $this->edition->getName() . ' - Filmsi.ro');
		$this->getResponse()->addMeta('keywords', '');
		$this->getResponse()->addMeta('description', '');

		$this->currentPage = (int)$request->getParameter('p', 1);
		$this->stires = $this->edition->getRelatedStires(sfConfig::get('app_stire_page_limit'), $this->currentPage, false);

		$this->stireCount = $this->edition->getRelatedStiresCount();
		$this->pageCount = ceil($this->stireCount / sfConfig::get('app_stire_page_limit'));
		$this->firstStireCount = sfConfig::get('app_stire_page_limit') * ($this->currentPage - 1) + 1;
		$this->lastStireCount = $this->firstStireCount + $this->stires->count() - 1;
		if ($this->pageCount <= 5) {
				$this->navStart = 1;
				$this->navEnd = $this->pageCount;
		} else {
				$this->navStart = $this->currentPage - 2;
				$this->navEnd = $this->currentPage - 2;

				if ($this->navStart <= 0){
						$this->navStart = 1;
						$this->navEnd = 5;
				}

				if ($this->navEnd >= $this->pageCount){
						$this->navStart = $this->pageCount - 4;
						$this->navEnd = $this->pageCount;
				}
		}
	}

	public function executeVideos(sfWebRequest $request)
	{
		$this->edition = FestivalEditionTable::getInstance()->findOneById($request->getParameter('id'));

		$this->getResponse()->setTitle('Trailere si clipuri: ' . $this->edition->getName() . ' - Filmsi.ro');
		$this->getResponse()->addMeta('keywords', '');
		$this->getResponse()->addMeta('description', '');

		$this->videos = $this->edition->getVideoAlbum()->getVideos();
		$this->videoCount = $this->videos->count();

		$this->currentVideo = $request->getParameter('vid', 1);
	}

	public function executeWinners(sfWebRequest $request)
	{
		$this->edition = FestivalEditionTable::getInstance()->findOneById($request->getParameter('id'));

		$this->getResponse()->setTitle('Castigatori si nominalizati: ' . $this->edition->getName() . ' - Filmsi.ro');
		$this->getResponse()->addMeta('keywords', '');
		$this->getResponse()->addMeta('description', '');
	}

	public function executeJudges(sfWebRequest $request)
	{
		$this->edition = FestivalEditionTable::getInstance()->findOneById($request->getParameter('id'));

		$this->getResponse()->setTitle('Juriu ' . $this->edition->getName() . ' - Filmsi.ro');
		$this->getResponse()->addMeta('keywords', '');
		$this->getResponse()->addMeta('description', '');
	}
}
