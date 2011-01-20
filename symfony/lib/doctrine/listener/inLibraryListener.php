<?php
class inLibraryListener extends Doctrine_Record_Listener
{
	/**
	 * array(
	 *   'type_key' => string,
	 *   'has_imdb' => boolean,
	 *   'has_category' => boolean,
	 *   'has_photo' => boolean,
	 *   'has_video' => boolean
	 * )
	 * @var array
	 */
	protected $_options = array();

	public function __construct(array $options)
	{
		$this->_options = $options;
	}


	
	public function postInsert(Doctrine_Event $event)
	{
	if (sfContext::getInstance()->getUser()->hasCredential(array('Fara_moderare', 'Moderator'), false)){
  		$event->getInvoker()->setState(Library::STATE_ACTIVE);
  	} else {
  		$event->getInvoker()->setState(Library::STATE_PENDING);
  	}
		
		$library = new Library();
		
		if($this->_options['has_imdb']){
			$library->setImdb($event->getInvoker()->getImdb());	
		}

		if($this->_options['has_category']){
			$categoryNames = array();
			foreach ($event->getInvoker()->getCategory() as $category){
				$categoryNames[] = $category->getName();
			}
			$library->setCategory(implode(', ', $categoryNames));
		}

		if($this->_options['has_photo']){
			$library->setPhotoAlbumId($event->getInvoker()->getPhotoAlbumId());
		}

		if($this->_options['has_video']){
			$library->setVideoAlbumId($event->getInvoker()->getVideoAlbumId());
		}
		
  	$library->setName($event->getInvoker()->getName());
  	$library->setPublishDate($event->getInvoker()->getPublishDate());
  	$library->setType($this->_options['type_key']);
  	$library->setUserId($event->getInvoker()->getUserId());
  	$library->setState($event->getInvoker()->getState());
  	$library->save();
  	
  	$event->getInvoker()->setLibraryId($library->getId());
  	$event->getInvoker()->save();
	}
	
  public function postUpdate(Doctrine_Event $event)
	{
		if (sfContext::getInstance()->getUser()->hasCredential(array('Fara_moderare', 'Moderator'), false)){
  		$event->getInvoker()->setState(Library::STATE_ACTIVE);	
  	}
		
		$library = Doctrine_Core::getTable('Library')->findOneById($event->getInvoker()->getLibraryId());
	
		if($this->_options['has_imdb']){
			$library->setImdb($event->getInvoker()->getImdb());	
		}
		
		
		if($this->_options['has_category']){
			$categoryNames = array();
			foreach ($event->getInvoker()->getCategory() as $category){
				$categoryNames[] = $category->getName();
			}
			
			$library->setCategory(implode(', ', $categoryNames));
		}

		if($this->_options['has_photo']){
			$library->setPhotoAlbumId($event->getInvoker()->getPhotoAlbumId());
		}

		if($this->_options['has_video']){
			$library->setVideoAlbumId($event->getInvoker()->getVideoAlbumId());
		}
		
  	$library->setName($event->getInvoker()->getName());
  	$library->setPublishDate($event->getInvoker()->getPublishDate());
  	$library->setType($this->_options['type_key']);
  	$library->setUserId($event->getInvoker()->getUserId());
  	$library->setState($event->getInvoker()->getState());
  	$library->save();
  	
  	$event->getInvoker()->setLibraryId($library->getId());
	}
}