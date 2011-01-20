<?php

/**
 * Article
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    articlesi
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Article extends BaseArticle
{
	public function preDelete($event)
	{
		// Delete the big file and the thumbnail
		unlink(sfConfig::get('app_article_path') . '/' . $event->getInvoker()->getFilename());
		unlink(sfConfig::get('app_article_path') . '/t-' . $event->getInvoker()->getFilename());
		unlink(sfConfig::get('app_article_path') . '/ts-' . $event->getInvoker()->getFilename());

		return parent::preDelete($event);
	}
	
	public function createFile()
	{
		$sourceFile = sfConfig::get('app_article_path') . '/' . $this->getFilename();
		
		if (!file_exists($sourceFile)){
			throw new sfException('Source file not available: ' . $sourceFile);
		}

		/* Create the big file */
		$photo = new sfThumbnail(null, sfConfig::get('app_article_sourceimage_size'));
		$photo->loadFile($sourceFile);
		$photo->save(sfConfig::get('app_article_path') . '/' . $this->getFilename());

		/* Create the thumbnail */
		$thumb = new sfThumbnail(null, sfConfig::get('app_article_thumbnail_size'));
		$thumb->loadFile($sourceFile);
		$thumb->save(sfConfig::get('app_article_path') . '/t-' . $this->getFilename());

		/* Create the small thumbnail */
		$thumb = new sfThumbnail(null, sfConfig::get('app_article_thumbnail_small_size'));
		$thumb->loadFile($sourceFile);
		$thumb->save(sfConfig::get('app_article_path') . '/ts-' . $this->getFilename());
	}

	public function getFilenameIsTall()
	{
		$size = getimagesize(sfConfig::get('app_article_path') . '/' . $this->getFilename());

		if ($size[1] > $size[0]){
			return true;
		} else {
			return false;
		}
	}

	public function getRelated($count)
	{
		/* Get the id of the articles related to any of the films */
		$filmArticles = Doctrine_Core::getTable('FilmArticle')->getRelatedArticles($this->getId());
		/* Get the id of the articles related to any of the persons */
		$personArticles = Doctrine_Core::getTable('PersonArticle')->getRelatedArticles($this->getId());
		/* Get the id of the articles related to any of the cinemas */
		$cinemaArticles = Doctrine_Core::getTable('CinemaArticle')->getRelatedArticles($this->getId());
		/* Get the id of the articles related to any of the festival editions */
		$festivalEditionArticles = Doctrine_Core::getTable('FestivalEditionArticle')->getRelatedArticles($this->getId());

		$articleIds = array_merge($filmArticles, $personArticles, $cinemaArticles, $festivalEditionArticles);
		return Doctrine_Core::getTable('Article')->findLatestByIds($count, $articleIds);
	}

	public function getCountComments()
	{
		return Doctrine_Core::getTable('Comment')->getCountByEntity('Article:' . $this->getId());
	}
}