<?php

/**
 * default actions.
 *
 * @package    filmsi
 * @subpackage default
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class defaultActions extends sfActions
{
    /**
    * Executes index action
    *
    * @param sfRequest $request A request object
    */
    public function executeIndex(sfWebRequest $request)
    {
        
    }

    public function executeSendFeedback(sfWebRequest $request)
    {
        $this->forward404If(!$request->isMethod('post'));

        $this->getMailer()->send(new FeedbackEmail(
            sfConfig::get('app_feedback_email'),
            $this->getPartial('default/send_feedback', array('name' => $request->getParameter('name'), 'email' => $request->getParameter('email'), 'content' => $request->getParameter('content'))),
            $request->getParameter('name')
        ));

        return $this->renderText(json_encode(array('status' => true)));
    }

	public function executeSearch(sfWebRequest $request)
	{
		$this->setLayout(false);
		$this->getResponse()->setContentType('application/json');

		return $this->renderText(json_encode(Doctrine_Core::getTable('Library')->getForSearch($request->getParameter('term'))));
	}

	public function executeSearchResults(sfWebRequest $request)
	{
		$item = LibraryTable::getInstance()->findOneById($request->getParameter('lid'));

		if ($item->getType() == 'Person'){
			$this->person = PersonTable::getInstance()->findOneByLibraryId($item->getId());
			$this->redirect('@person?id=' . $this->person->getId() . '&key=' . $this->person->getUrlKey());
		} elseif ($item->getType() == 'Film'){
			$this->film = FilmTable::getInstance()->findOneByLibraryId($item->getId());
			$this->redirect('@film?id=' . $this->film->getId() . '&key=' . $this->film->getUrlKey());
		}
	}
}
