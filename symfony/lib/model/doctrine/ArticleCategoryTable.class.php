<?php

/**
 * ArticleCategoryTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class ArticleCategoryTable extends Doctrine_Table
{
	public function deleteByCategoryId($categoryId)
	{
		return Doctrine_Query::create()
			->delete('ArticleCategory ac')
			->where('ac.category_id = ?', $categoryId)
			->execute();
	}

	public function getList()
	{
		return Doctrine_Query::create()
			->from('Category c')
			->orderBy('c.name ASC')
			->execute();
	}
}