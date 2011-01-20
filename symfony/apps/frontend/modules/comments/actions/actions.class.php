<?php

/**
 * comments actions.
 *
 * @package    filmsi
 * @subpackage comments
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class commentsActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
	public function executeSubmit(sfWebRequest $request)
	{
		$this->forward404Unless($reques->isMethod('post'));

	}
}
