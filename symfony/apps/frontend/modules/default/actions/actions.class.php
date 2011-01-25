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
}
