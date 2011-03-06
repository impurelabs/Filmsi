<?php

/**
 * gadgets actions.
 *
 * @package    filmsi
 * @subpackage content
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class gadgetsActions extends sfActions
{
	/**
	* Executes index action
	*
	* @param sfRequest $request A request object
	*/
	public function executeIndex(sfWebRequest $request)
	{
	$this->pagesByGadget = PageGadgetTable::getInstance()->getPagesGroupedByGadget();
	}
  
	public function executeView(sfWebRequest $request)
	{
  	$this->content = Doctrine_Core::getTable('Content')->findOneById($request->getParameter('id'));
  }
  
	public function executeEditPages(sfWebRequest $request)
	{
		$this->gid = $request->getParameter('gid');
		$this->pages = PageGadgetTable::getInstance()->getPagesByGadget($this->gid);

		if ($request->isMethod('post')){
			PageGadgetTable::getInstance()->updatePagesByGadget($this->gid, $request->getParameter('pages'));

			$this->redirect($this->generateUrl('default_index', array('module' => 'gadgets')));
		}
	  }
}