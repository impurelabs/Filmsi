<?php

/**
 * ImdbFilmPhotoKeyTable
 * 
 */
class ImdbFilmPhotoKeyTable extends Doctrine_Table
{
    public static function getInstance()
    {
        return Doctrine_Core::getTable('ImdbFilmPhotoKey');
    }

	public function countByFilm($imdb)
	{
		$q = Doctrine_Query::create()
			->select('count(*) count')
			->from('ImdbFilmPhotoKey k')
			->where('k.imdb = ?', $imdb)
			->fetchOne(array(), Doctrine_Core::HYDRATE_ARRAY);

		return $q['count'];
	}

	public function deleteByFilm($imdb)
	{
		return Doctrine_Query::create()
			->delete('ImdbFilmPhotoKey k')
			->where('k.imdb = ?', $imdb)
			->execute();
	}
}