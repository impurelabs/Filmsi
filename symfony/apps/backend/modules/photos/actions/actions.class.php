<?php

class photosActions extends sfActions
{
	public function executeNewObject(sfWebRequest $request)
	{	 
		$this->form = new PhotoAlbumForm();
		 
		if ($request->isMethod('post')){
			$this->form->bind($request->getParameter($this->form->getName()));

			if($this->form->isValid()){
				$this->form->save();
					
				$this->redirect($this->generateUrl('default', array('module' => 'photos', 'action' => 'view')) . '?lid=' . $this->form->getObject()->getLibraryId());					
			}
		}
	}
	
	public function executeView(sfWebRequest $request)
	{
		$this->album = Doctrine_Core::getTable('PhotoAlbum')->findOneByLibraryId($request->getParameter('lid'));
		$this->photos = Doctrine_Core::getTable('Photo')->getListForView($this->album->getId());		
	}

	public function executePhotoAdd(sfWebRequest $request)
	{
		$this->album = Doctrine_Core::getTable('PhotoAlbum')->findOneById($request->getParameter('aid'));
		 
		if ($request->isMethod('post')){
			$photoCounter = count($request->getParameter('description'));
			$i = 1;

			foreach($request->getParameter('description') as $photoId => $description){
				$photo = Doctrine_Core::getTable('Photo')->findOneById($photoId);
				$photo->setDescription($description);
				$photo->save();		
			}

			$this->redirect($this->generateUrl('default', array('module' => 'photos', 'action' => 'view')) . '?lid=' . $this->album->getLibraryId());
		}

		$this->form = new PhotoUploadForm();
		$this->form->setDefault('album_id', $this->album->getId());
	}

	public function executePhotoAddFinish(sfWebRequest $request)
	{
		$this->addedPhotos = Doctrine_Core::getTable('Plugin_Photos_Photo')->getByIds($request->getParameter('addedIds'));
	}

	public function executePhotoUpload(sfWebRequest $request)
	{
		$this->forward404Unless($request->isMethod('post'));
		 
		$this->form = new PhotoUploadForm();

		if (isset($_FILES['file'])){
			$_FILES['photo'] = array(
				'name' => array('file' => $_FILES['file']['name']),
				'type' => array('file' => $_FILES['file']['type']),
				'tmp_name' => array('file' => $_FILES['file']['tmp_name']),
				'error' => array('file' => $_FILES['file']['error']),
				'size' => array('file' => $_FILES['file']['size'])
			);
			unset($_FILES['file']);
		}

		$this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
		
		if($this->form->isValid()){
			$this->form->save();
      
			$this->getContext()->getConfiguration()->loadHelpers('Filmsi');
				
			die(json_encode(array(
				'isOk' => true, 
				'id' => $this->form->getObject()->getId(),
				'src' => filmsiPhotoThumb($this->form->getObject()->getFilename())
			)));
		}
		 
	}

	public function executeDeletePhoto(sfWebRequest $request)
	{
		$photo = Doctrine_Core::getTable('Photo')->findOneById($request->getParameter('pid'));
		
		$photo->delete();

		$this->redirect($request->getReferer());
	}
	
	public function executeMoveUp(sfWebRequest $request)
	{
		$photo = Doctrine_Core::getTable('Photo')->findOneById($request->getParameter('pid'));
		
		$photo->promote();

		$this->redirect($request->getReferer());
	}
	
	public function executeMoveDown(sfWebRequest $request)
	{
		$photo = Doctrine_Core::getTable('Photo')->findOneById($request->getParameter('pid'));
		
		$photo->demote();

		$this->redirect($request->getReferer());
	}

	public function executeEditPhoto(sfWebRequest $request)
	{
		$this->photo = Doctrine_Core::getTable('Photo')->findOneById($request->getParameter('pid'));
		
		$this->form = new PhotoDescriptionEditForm($this->photo);
		
		if ($request->isMethod('post')){
			$this->form->bind($request->getParameter($this->form->getName()));

			if ($this->form->isValid()){
				$this->form->save();

				$this->redirect($this->generateUrl('default', array('module' => 'photos', 'action' => 'view')) . '?lid=' . $this->photo->getAlbum()->getLibraryId());
			}
		}
	}
	
	public function executeEditAlbum(sfWebRequest $request)
	{
		$this->album = Doctrine_Core::getTable('PhotoAlbum')->findOneById($request->getParameter('aid'));
		
		$this->form = new PhotoAlbumEditForm($this->album);
		
		
		if ($request->isMethod('post')){
			$this->form->bind($request->getParameter($this->form->getName()));

			if ($this->form->isValid()){
				$this->form->save();

				$this->redirect($this->generateUrl('default', array('module' => 'photos', 'action' => 'view')) . '?lid=' . $this->album->getLibraryId());
			}
		}
	}

	public function executeApi(sfWebRequest $request)
	{
		$this->setLayout(false);
		$this->getResponse()->setContentType('application/json');

		return $this->renderText(json_encode(Doctrine_Core::getTable('PhotoAlbum')->getForApi($request->getParameter('term'))));
	}
	

}