<?php

/**
 * stires actions.
 *
 * @package    filmsi
 * @subpackage stires
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class stiresActions extends sfActions
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
            $this->stires = Doctrine_Core::getTable('Stire')->getList(sfConfig::get('app_stire_page_limit'), $this->currentPage);
            $this->stireCount = Doctrine_Core::getTable('Stire')->getCount();
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

	public function executeView(sfWebRequest $request)
	{
            $this->forward404If(false === $this->stire = Doctrine_Core::getTable('Stire')->findOneById($request->getParameter('id')));

            $this->relatedStires = $this->stire->getRelated(5);

            $this->getResponse()->setTitle($this->stire->getName() . ' - Filmsi.ro');
            $this->getResponse()->addMeta('keywords', $this->stire->getMetaKeywords());
            $this->getResponse()->addMeta('description', $this->stire->getMetaDescription());

            $this->commentForm = new CommentForm(null, array(
                    'state' => 1,
                    'ip' => $_SERVER['REMOTE_ADDR'],
                    'model' => 'Stire',
                    'model_library_id' => $this->stire->getLibraryId(),
                    'model_name' => $this->stire->getName()
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

                            $this->redirect($this->generateUrl('stire', array('id' => $this->stire->getId(), 'key' => $this->stire->getUrlKey())) . '#comments');
                    }
            }

            $this->comments = Doctrine_Core::getTable('Comment')->getActiveByModel('Stire', $this->stire->getLibraryId(), $_SERVER['REMOTE_ADDR']);


            /* Add the visit */
            $visit = new Visit();
            $visit->setLibraryId($this->stire->getLibraryId());
            $visit->setUrl($this->generateUrl('stire', array('id' => $this->stire->getId(), 'key' => $this->stire->getUrlKey())));
            $visit->setName($this->stire->getName());
            $visit->setIp($_SERVER['REMOTE_ADDR']);
            $visit->save();
	}

	public function executePublish(sfWebRequest $request)
	{
		if (!$this->getUser()->isAuthenticated()){
			$this->setTemplate('publishNotLoggedIn');
		}

		$this->contentTop = ContentTable::getInstance()->findOneById(4);
		$this->contentRight = ContentTable::getInstance()->findOneById(5);

		$this->form = new StirePublishForm();

		if ($request->isMethod('post')){
			$this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));

			if ($this->form->isValid()){
				$this->form->save();

				$this->setTemplate('publishOk');
			}
		}
	}
}
