<?php

/**
 * persons actions.
 *
 * @package    filmsi
 * @subpackage persons
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class personsActions extends sfActions
{
	/**
	* Executes index action
	*
	* @param sfRequest $request A request object
	*/
	public function executeIndex(sfWebRequest $request)
	{
            $this->getResponse()->setTitle('Filmsi.ro - Actori & Regizori');

            
	}

	public function executeView(sfWebRequest $request)
	{
		$this->person = Doctrine_Core::getTable('Article')->findOneById($request->getParameter('id'));
		$this->categories = Doctrine_Core::getTable('ArticleCategory')->getList();
		if ($request->hasParameter('c')){
			$this->currentCategory = Doctrine_Core::getTable('Category')->findOneById($request->getParameter('c'));
		}

		$this->relatedArticles = $this->person->getRelated(5);

		$this->getResponse()->setTitle($this->person->getName() . ' - Filmsi.ro');
		$this->getResponse()->addMeta('keywords', $this->person->getMetaKeywords());
		$this->getResponse()->addMeta('description', $this->person->getMetaDescription());

		$this->commentForm = new CommentForm(null, array(
			'state' => 1,
			'ip' => $_SERVER['REMOTE_ADDR'],
			'model' => 'Article',
                        'model_library_id' => $this->person->getLibraryId(),
                        'model_name' => $this->person->getName()
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

                                $this->redirect($this->generateUrl('person', array('id' => $this->person->getId(), 'key' => $this->person->getUrlKey())) . '#comments');
			}
		}

                $this->comments = Doctrine_Core::getTable('Comment')->getActiveByModel('Article', $this->person->getLibraryId(), $_SERVER['REMOTE_ADDR']);


		/* Add the visit */
		$visit = new Visit();
		$visit->setLibraryId($this->person->getLibraryId());
		$visit->setUrl($this->generateUrl('person', array('id' => $this->person->getId(), 'key' => $this->person->getUrlKey())));
		$visit->setName($this->person->getName());
		$visit->setIp($_SERVER['REMOTE_ADDR']);
		$visit->save();
	}
}
