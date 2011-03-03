<?php

/**
 * newsletter actions.
 *
 * @package    filmsi
 * @subpackage comments
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class newsletterActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
  	$this->emails = NewsletterEmailTable::getInstance()->findAll();
  }

  public function executeDelete(sfWebRequest $request)
  {
      if ($request->isMethod('post')){
          NewsletterEmailTable::getInstance()->deleteByIds($request->getParameter('selected_objects'));

          $this->redirect($request->getReferer());
      }
  }
}
