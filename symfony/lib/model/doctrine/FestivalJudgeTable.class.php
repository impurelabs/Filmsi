<?php

class FestivalJudgeTable extends Doctrine_Table
{
	public static function getInstance()
	{
		return Doctrine_Core::getTable('FilmPerson');
	}

	public function deleteByEditionAndPerson($editionId, $personId)
	{
		return Doctrine_Query::create()
			->delete('FestivalJudge j')
			->where('j.festival_edition_id = ? AND j.person_id = ?', array($editionId, $personId))
			->execute();
	}
	

}