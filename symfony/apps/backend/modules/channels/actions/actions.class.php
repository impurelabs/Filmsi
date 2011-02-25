<?php

/**
 * channels actions.
 *
 * @package    filmsi
 * @subpackage cms
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class channelsActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
	  $this->channels = ChannelTable::getInstance()->getAll();
  }

	public function executeChannelAdd(sfWebRequest $request)
	{
		$this->form = new ChannelNewForm();

		if ($request->isMethod('post')){
			$this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));

			if ($this->form->isValid()){
				$this->form->save();

				$this->redirect($this->generateUrl('default', array('module' => 'channels', 'action' => 'index')));
			}
		}
	}

	public function executeSchedule(sfWebRequest $request)
	{
	$this->channel = Doctrine_Core::getTable('Channel')->findOneById($request->getParameter('id'));
	$this->form = new ChannelScheduleForm();
	$this->form->setDefault('channel_id', $this->channel->getId());

	if ($request->isMethod('post')){
	$this->form->bind($request->getParameter($this->form->getName()));

	if ($this->form->isValid()){
		$this->form->save();

		$this->redirect($this->generateUrl('default', array('module' => 'channels', 'action' => 'schedule')) . '?id=' . $this->channel->getId());
	}
	}

	$this->schedules = Doctrine_Core::getTable('ChannelSchedule')->getDetailedByChannel($this->channel->getId());
	}

	public function executeScheduleDelete(sfWebRequest $request)
	{
	$schedule = Doctrine_Core::getTable('ChannelSchedule')->findOneById($request->getParameter('id'));
	$schedule->delete();

	$id = $schedule->getChannel()->getId();
	$this->redirect($this->generateUrl('default', array('module' => 'channels', 'action' => 'schedule')) . '?id=' . $id);
	}
}