<?php

/**
 * films actions.
 *
 * @package    filmsi
 * @subpackage films
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class festivalEditionsActions extends sfActions
{
	public function executeNewObject(sfWebRequest $request)
	{
		$this->form = new FestivalEditionNewForm();

		if ($request->isMethod('post')){
			$this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));

			if ($this->form->isValid()){
				$this->form->save();

				$this->redirect($this->generateUrl('default', array('module' => 'festivalEditions', 'action' => 'view')) . '?lid=' . $this->form->getObject()->getLibraryId());
			}
		}
	}
  
	public function executeEdit(sfWebRequest $request)
	{
		$this->festivalEdition = Doctrine_Core::getTable('FestivalEdition')->findOneByLibraryId($request->getParameter('lid'));

		$this->form = new FestivalEditionEditForm($this->festivalEdition);

		if ($request->isMethod('post')){
			$this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));

			if ($this->form->isValid()){
				$this->form->save();

				$this->redirect($this->generateUrl('default', array('module' => 'festivalEditions', 'action' => 'view')) . '?lid=' . $this->form->getObject()->getLibraryId());
			}
		}
	}
  
	public function executeView(sfWebRequest $request)
	{
		$this->festivalEdition = Doctrine_Core::getTable('FestivalEdition')->findOneByLibraryId($request->getParameter('lid'));
	}

	public function executeSection(sfWebRequest $request)
	{
		$this->festivalEdition = Doctrine_Core::getTable('FestivalEdition')->findOneByLibraryId($request->getParameter('lid'));
		$this->sections = Doctrine_Core::getTable('FestivalSection')->findByFestivalEditionId($this->festivalEdition->getId());
	}

	public function executeJudges(sfWebRequest $request)
	{
		$this->festivalEdition = Doctrine_Core::getTable('FestivalEdition')->findOneByLibraryId($request->getParameter('lid'));
		$this->judges = $this->festivalEdition->getPersons();
	}

	public function executeJudgeAdd(sfWebRequest $request)
	{
		$this->festivalEdition = Doctrine_Core::getTable('FestivalEdition')->findOneById($request->getParameter('id'));

		if ($request->isMethod('post')){
			$festivalJudge = new FestivalJudge();
			$festivalJudge->setPersonId($request->getParameter('person_id'));
			$festivalJudge->setFestivalEditionId($request->getParameter('id'));
			$festivalJudge->save();

			$this->redirect($this->generateUrl('default', array('module' => 'festivalEditions', 'action' => 'judges')) . '?lid=' . $this->festivalEdition->getLibraryId());
		}
	}

	public function executeJudgeDelete(sfWebRequest $request)
	{
		if ($request->isMethod('post')){
			$this->festivalEdition = Doctrine_Core::getTable('FestivalEdition')->findOneById($request->getParameter('id'));
			Doctrine_Core::getTable('FestivalJudge')->deleteByEditionAndPerson($this->festivalEdition->getId(), $request->getParameter('person_id'));

			$this->redirect($this->generateUrl('default', array('module' => 'festivalEditions', 'action' => 'judges')) . '?lid=' . $this->festivalEdition->getLibraryId());
		}
	}

	public function executeSectionAdd(sfWebRequest $request)
	{
		$this->forward404If(false == $this->festivalEdition = Doctrine_Core::getTable('FestivalEdition')->findOneById($request->getParameter('id')));

		$this->form = new FestivalSectionForm();
		$this->form->setDefault('festival_edition_id', $this->festivalEdition->getId());

		if ($request->isMethod('post')){
			$this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));

			if ($this->form->isValid()){
				$this->form->save();

				$this->redirect($this->generateUrl('default', array('module' => 'festivalEditions', 'action' => 'section')) . '?lid=' . $this->festivalEdition->getLibraryId());
			}
		}
	}

	public function executeSectionEdit(sfWebRequest $request)
	{
		$this->forward404If(false == $this->festivalSection = Doctrine_Core::getTable('FestivalSection')->findOneById($request->getParameter('id')));
		$this->festivalEdition = $this->festivalSection->getFestivalEdition();

		$this->form = new FestivalSectionForm($this->festivalSection);

		if ($request->isMethod('post')){
			$this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));

			if ($this->form->isValid()){
				$this->form->save();

				$this->redirect($this->generateUrl('default', array('module' => 'festivalEditions', 'action' => 'section')) . '?lid=' . $this->festivalSection->getFestivalEdition()->getLibraryId());
			}
		}
	}

	public function executeSectionDelete(sfWebRequest $request)
	{
		$this->section = Doctrine_Core::getTable('FestivalSection')->findOneById($request->getParameter('id'));

		$lid = $this->section->getFestivalEdition()->getLibraryId();

		$this->section->delete();

		$this->redirect($this->generateUrl('default', array('module' => 'festivalEditions', 'action' => 'section')) . '?lid=' . $lid);
	}
	
	public function executeParticipantAdd(sfWebRequest $request)
	{
		$this->section = Doctrine_Core::getTable('FestivalSection')->findOneById($request->getParameter('id'));
		$this->festivalEdition = $this->section->getFestivalEdition();

		$this->form = new FestivalSectionParticipantForm();
		$this->form->setDefault('festival_section_id', $this->section->getId());

		if ($request->isMethod('post')){
			$this->form->bind($request->getParameter($this->form->getName()));

			if ($this->form->isValid()){
				$this->form->save();

				$this->redirect($this->generateUrl('default', array('module' => 'festivalEditions', 'action' => 'section')) . '?lid=' . $this->festivalEdition->getLibraryId());
			}
		}
	}

	public function executeParticipantDelete(sfWebRequest $request)
	{
		$participant = Doctrine_Core::getTable('FestivalSectionParticipant')->findOneById($request->getParameter('id'));
		$edition = $participant->getFestivalSection()->getFestivalEdition();
		$participant->delete();

		$this->redirect($this->generateUrl('default', array('module' => 'festivalEditions', 'action' => 'section')) . '?lid=' . $edition->getLibraryId());
	}
    
	public function executeApi(sfWebRequest $request)
	{
		$this->setLayout(false);
		$this->getResponse()->setContentType('application/json');

		return $this->renderText(json_encode(Doctrine_Core::getTable('FestivalEdition')->getForApi($request->getParameter('term'))));
	}
}