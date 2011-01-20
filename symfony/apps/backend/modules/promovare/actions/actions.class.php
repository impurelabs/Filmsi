<?php


class promovareActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
  	
  }

  public function executeBackgroundHomepage(sfWebRequest$request)
	{
		$this->homepage = Doctrine_Core::getTable('Homepage')->findOneById(1);
	}

	public function executeBackgroundHomepageEdit(sfWebRequest $request)
	{
		$this->homepage = Doctrine_Core::getTable('Homepage')->findOneById(1);

		$this->form = new HomepageForm($this->homepage);

		if ($request->isMethod('post')){
			$this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));

			if ($this->form->isValid()){
				$this->form->save();

				$this->redirect($this->generateUrl('default', array('module' => 'promovare', 'action' => 'backgroundHomepage')));
			}
		}
	}

	public function executeBackgroundHomepageDelete(sfWebRequest $request)
	{
		$this->homepage = Doctrine_Core::getTable('Homepage')->findOneById(1);
		$this->homepage->deleteBackground();

		$this->redirect($this->generateUrl('default', array('module' => 'promovare', 'action' => 'backgroundHomepage')));
	}
}
