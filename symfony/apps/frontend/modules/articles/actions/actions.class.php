<?php

/**
 * articles actions.
 *
 * @package    filmsi
 * @subpackage articles
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class articlesActions extends sfActions
{
	/**
	* Executes index action
	*
	* @param sfRequest $request A request object
	*/
	public function executeIndex(sfWebRequest $request)
	{
		$this->getResponse()->setTitle('Filmsi.ro - Din Filme');

		$this->currentPage = (int)$request->getParameter('p', 1);
		$this->currentCategory = $request->getParameter('c', null);
		$this->categories = Doctrine_Core::getTable('ArticleCategory')->getList();
		$this->articles = Doctrine_Core::getTable('Article')->getList($this->currentCategory, sfConfig::get('app_article_page_limit'), $this->currentPage);
		$this->articleCount = Doctrine_Core::getTable('Article')->countByCategory($this->currentCategory);
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

                $this->bestArticles = Doctrine_Core::getTable('Article')->getMostVisited(10);
	}

	public function executeView(sfWebRequest $request)
	{
		$this->article = Doctrine_Core::getTable('Article')->findOneById($request->getParameter('id'));
		$this->categories = Doctrine_Core::getTable('ArticleCategory')->getList();
		if ($request->hasParameter('c')){
			$this->currentCategory = Doctrine_Core::getTable('Category')->findOneById($request->getParameter('c'));
		}

		$this->relatedArticles = $this->article->getRelated(5);

		$this->getResponse()->setTitle($this->article->getName() . ' - Filmsi.ro');
		$this->getResponse()->addMeta('keywords', $this->article->getMetaKeywords());
		$this->getResponse()->addMeta('description', $this->article->getMetaDescription());

		$this->commentForm = new CommentForm(null, array(
			'state' => 1,
			'ip' => $_SERVER['REMOTE_ADDR'],
			'model' => 'Article',
                        'model_library_id' => $this->article->getLibraryId(),
                        'model_name' => $this->article->getName()
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

                                $this->redirect($this->generateUrl('article', array('id' => $this->article->getId(), 'key' => $this->article->getUrlKey())) . '#comments');
			}
		}

                $this->comments = Doctrine_Core::getTable('Comment')->getActiveByModel('Article', $this->article->getLibraryId(), $_SERVER['REMOTE_ADDR']);


		/* Add the visit */
		$visit = new Visit();
		$visit->setLibraryId($this->article->getLibraryId());
		$visit->setUrl($this->generateUrl('article', array('id' => $this->article->getId(), 'key' => $this->article->getUrlKey())));
		$visit->setName($this->article->getName());
		$visit->setIp($_SERVER['REMOTE_ADDR']);
		$visit->save();
	}
}
