<?php

/**
 * ImdbPersonPhotoKeyTable
 * 
 */
class ImdbPersonPhotoKeyTable extends Doctrine_Table
{
    public static function getInstance()
    {
        return Doctrine_Core::getTable('ImdbPersonPhotoKey');
    }

	public function countByPerson($imdb)
	{
		$q = Doctrine_Query::create()
			->select('count(*) count')
			->from('ImdbPersonPhotoKey k')
			->where('k.imdb = ?', $imdb)
			->fetchOne(array(), Doctrine_Core::HYDRATE_ARRAY);

		return $q['count'];
	}

	public function deleteByPerson($imdb)
	{
		return Doctrine_Query::create()
			->delete('ImdbPersonPhotoKey k')
			->where('k.imdb = ?', $imdb)
			->execute();
	}
}