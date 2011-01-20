<?php

class videosActions extends sfActions
{
	public function executeNewObject(sfWebRequest $request)
	{	 
		$this->form = new VideoAlbumForm();
		 
		if ($request->isMethod('post')){
			$this->form->bind($request->getParameter($this->form->getName()));

			if($this->form->isValid()){
				$this->form->save();
					
				$this->redirect($this->generateUrl('default', array('module' => 'videos', 'action' => 'view')) . '?lid=' . $this->form->getObject()->getLibraryId());					
			}
		}
	}
	

	public function executeView(sfWebRequest $request)
	{
		$this->album = Doctrine_Core::getTable('VideoAlbum')->findOneByLibraryId($request->getParameter('lid'));
		$this->videos = Doctrine_Core::getTable('Video')->getListForView($this->album->getId());		
	}

	public function executeVideoAdd(sfWebRequest $request)
	{
		$this->album = Doctrine_Core::getTable('VideoAlbum')->findOneById($request->getParameter('aid'));
		 
		if ($request->isMethod('post')){
			$videoCodes = $request->getParameter('video_code');
			$videoNames = $request->getParameter('video_name');
			
			foreach ($videoCodes as $key => $videoCode){
				if (isset($videoCode) && $videoCode !== ''){
					$video = new Video();
					$video->setAlbumId($this->album->getId());
					$video->setName($videoNames[$key]);
					$video->setCode($videoCodes[$key]);
					$video->save();
				}
			}

			$this->redirect($this->generateUrl('default', array('module' => 'videos', 'action' => 'view')) . '?lid=' . $this->album->getLibraryId());
		}
	}

	public function executeDeleteVideo(sfWebRequest $request)
	{
		$video = Doctrine_Core::getTable('Video')->findOneById($request->getParameter('id'));
		
		$video->delete();

		$this->redirect($request->getReferer());
	}
	
	public function executeMoveUp(sfWebRequest $request)
	{
		$video = Doctrine_Core::getTable('Video')->findOneById($request->getParameter('id'));
		
		$video->promote();

		$this->redirect($request->getReferer());
	}
	
	public function executeMoveDown(sfWebRequest $request)
	{
		$video = Doctrine_Core::getTable('Video')->findOneById($request->getParameter('id'));
		
		$video->demote();

		$this->redirect($request->getReferer());
	}

	public function executeEditVideo(sfWebRequest $request)
	{
		$this->video = Doctrine_Core::getTable('Video')->findOneById($request->getParameter('id'));
		
		$this->form = new VideoNameEditForm($this->video);
		
		if ($request->isMethod('post')){
			$this->form->bind($request->getParameter($this->form->getName()));

			if ($this->form->isValid()){
				$this->form->save();

				$this->redirect($this->generateUrl('default', array('module' => 'videos', 'action' => 'view')) . '?lid=' . $this->video->getAlbum()->getLibraryId());
			}
		}
	}
	
	public function executeEditAlbum(sfWebRequest $request)
	{
		$this->album = Doctrine_Core::getTable('VideoAlbum')->findOneById($request->getParameter('aid'));
		
		$this->form = new VideoAlbumEditForm($this->album);
		
		
		if ($request->isMethod('post')){
			$this->form->bind($request->getParameter($this->form->getName()));

			if ($this->form->isValid()){
				$this->form->save();

				$this->redirect($this->generateUrl('default', array('module' => 'videos', 'action' => 'view')) . '?lid=' . $this->album->getLibraryId());
			}
		}
	}

	public function executeApi(sfWebRequest $request)
	{
		$this->setLayout(false);
		$this->getResponse()->setContentType('application/json');

		return $this->renderText(json_encode(Doctrine_Core::getTable('VideoAlbum')->getForApi($request->getParameter('term'))));
	}

}