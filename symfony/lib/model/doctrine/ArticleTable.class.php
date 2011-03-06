<?php

/**
 * ArticleTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class ArticleTable extends Doctrine_Table
{
	public static function getInstance()
	{
		return Doctrine_Core::getTable('Article');
	}

	public function allow($libraryId)
	{
		$album = Doctrine_Core::getTable('Article')->findOneByLibraryId($libraryId);
		
		/* Update album state*/
		$album->setState(Library::STATE_ACTIVE);
		$album->save();
	}

	public function cloneObject($libraryId)
	{
		return;
	}

	public function getList($categoryId = null, $limit = null, $page = null)
	{
		$q = Doctrine_Query::create()
			->from('Article a')
			->where('a.state = 1 AND a.publish_date IS NOT NULL AND a.publish_date <= NOW() AND (a.expiration_date IS NULL OR a.expiration_date > NOW())')
			->orderBy('a.publish_date, a.id DESC');

		if (!empty($categoryId)){
			$q->innerJoin('a.ArticleCategory ac')
				->addWhere('ac.category_id = ?', $categoryId);
		}

		if (!empty ($limit)){
			$q->limit($limit);
		}

		if (!empty ($page)){
			$q->offset(($page - 1) * $limit );
		}

		return $q->execute();
	}

	public function getListByFilm($filmId, $limit = null, $page = null)
	{
		$q = Doctrine_Query::create()
			->from('Article a')
			->where('a.state = 1 AND a.publish_date IS NOT NULL AND a.publish_date <= NOW() AND (a.expiration_date IS NULL OR a.expiration_date > NOW())')
			->orderBy('a.publish_date, a.id DESC')
			->innerJoin('a.FilmArticle fa')
			->addWhere('fa.film_id = ?', $filmId);

		if (!empty ($limit)){
			$q->limit($limit);
		}

		if (!empty ($page)){
			$q->offset(($page - 1) * $limit );
		}

		return $q->execute();
	}

	public function countByCategory($categoryId = null)
	{
		$q = Doctrine_Query::create()
			->select('COUNT(a.id)')
			->from('Article a')
			->where('a.state = 1 AND a.publish_date IS NOT NULL AND a.publish_date <= NOW() AND (a.expiration_date IS NULL OR a.expiration_date > NOW())');

		if (!empty($categoryId)){
			$q->innerJoin('a.ArticleCategory ac')
				->addWhere('ac.category_id = ?', $categoryId);
		}

		$count = $q->fetchOne(array(), Doctrine_Core::HYDRATE_ARRAY);

		return $count['COUNT'];
	}

	public function countByFilm($filmId)
	{
		$q = Doctrine_Query::create()
			->select('COUNT(a.id)')
			->from('Article a')
			->where('a.state = 1 AND a.publish_date IS NOT NULL AND a.publish_date <= NOW() AND (a.expiration_date IS NULL OR a.expiration_date > NOW())')
			->innerJoin('a.FilmArticle fa')
			->addWhere('fa.film_id = ?', $filmId);
		

		$count = $q->fetchOne(array(), Doctrine_Core::HYDRATE_ARRAY);

		return $count['COUNT'];
	}

	public function findLatestByIds($count, $articleIds)
	{
            if (count($articleIds) == 0){
                return array();
            }

            return Doctrine_Query::create()
                    ->from('Article a')
                    ->where('a.state = 1 AND a.publish_date IS NOT NULL AND a.publish_date <= NOW() AND (a.expiration_date IS NULL OR a.expiration_date > NOW())')
                    ->andWhereIn('a.id', $articleIds)
                    ->limit($count)
                    ->orderBy('a.publish_date, a.id DESC')
                    ->execute();
	}

	public function getMostVisited($limit)
	{
		return Doctrine_Query::create()
			->from('Article a')
			->where('a.state = 1 AND a.publish_date IS NOT NULL AND a.publish_date <= NOW() AND (a.expiration_date IS NULL OR a.expiration_date > NOW())')
			->orderBy('a.visit_count DESC')
			->limit($limit)
			->execute();
	}

	public function getNewestByFilm($filmId, $limit = null)
	{
		return Doctrine_Query::create()
			->from('Article a')
			->innerJoin('a.FilmArticle fa')
			->limit($limit)
			->where('fa.film_id = ?', $filmId)
			->andWhere('a.state = 1 AND a.publish_date IS NOT NULL AND a.publish_date <= NOW() AND (a.expiration_date IS NULL OR a.expiration_date > NOW())')
			->orderBy('a.publish_date, a.id DESC')
			->execute();
	}

	public function getNewestByFestivalEdition($festivalEditionId, $limit = null)
	{
		return Doctrine_Query::create()
			->from('Article a')
			->innerJoin('a.FestivalEditionArticle fa')
			->limit($limit)
			->where('fa.festival_edition_id = ?', $festivalEditionId)
			->andWhere('a.state = 1 AND a.publish_date IS NOT NULL AND a.publish_date <= NOW() AND (a.expiration_date IS NULL OR a.expiration_date > NOW())')
			->orderBy('a.publish_date, a.id DESC')
			->execute();
	}

	public function countByFestivalEdition($festivalEditionId)
	{
		$q = Doctrine_Query::create()
			->select('COUNT(a.id)')
			->from('Article a')
			->where('a.state = 1 AND a.publish_date IS NOT NULL AND a.publish_date <= NOW() AND (a.expiration_date IS NULL OR a.expiration_date > NOW())')
			->innerJoin('a.FestivalEditionArticle fa')
			->addWhere('fa.festival_edition_id = ?', $festivalEditionId);


		$count = $q->fetchOne(array(), Doctrine_Core::HYDRATE_ARRAY);

		return $count['COUNT'];
	}

	public function getListByFestivalEdition($festivalEditionId, $limit = null, $page = null)
	{
		$q = Doctrine_Query::create()
			->from('Article a')
			->where('a.state = 1 AND a.publish_date IS NOT NULL AND a.publish_date <= NOW() AND (a.expiration_date IS NULL OR a.expiration_date > NOW())')
			->orderBy('a.publish_date, a.id DESC')
			->innerJoin('a.FestivalEditionArticle fa')
			->addWhere('fa.festival_edition_id = ?', $festivalEditionId);

		if (!empty ($limit)){
			$q->limit($limit);
		}

		if (!empty ($page)){
			$q->offset(($page - 1) * $limit );
		}

		return $q->execute();
	}

	public function getNewest($limit = null)
	{
		return Doctrine_Query::create()
			->from('Article a')
			->limit($limit)
			->andWhere('a.state = 1 AND a.publish_date IS NOT NULL AND a.publish_date <= NOW() AND (a.expiration_date IS NULL OR a.expiration_date > NOW())')
			->orderBy('a.publish_date, a.id DESC')
			->execute();
	}

	public function getMostCommented($limit)
	{
		return Doctrine_Query::create()
			->select('a.id, a.url_key, a.name, a.content_teaser, a.filename, COUNT(c.id) comment_count')
			->from('Article a')
			->leftJoin('a.Comment c')
			->groupBy('c.model_library_id')
			->where('a.state = 1 AND a.publish_date IS NOT NULL AND a.publish_date <= NOW() AND (a.expiration_date IS NULL OR a.expiration_date > NOW())')
			->andWhere('c.model = "Article"')
			->orderBy('comment_count DESC')
			->limit($limit)
			->execute(array(), Doctrine_Core::HYDRATE_ARRAY);
	}
}