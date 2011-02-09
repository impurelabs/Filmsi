<?php

/**
 * FestivalEditionTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class FestivalEditionTable extends Doctrine_Table
{
	public static function getInstance()
	{
		return Doctrine_Core::getTable('FestivalEdition');
	}

	public function unsetFestival($festivalId)
	{
		return Doctrine_Query::create()
			->update('FestivalEdition fe')
			->set('fe.festival_id', 'NULL')
			->where('fe.festival_id = ?', $festivalId)
			->execute();
	}
	
	public function allow($libraryId)
	{
		$album = Doctrine_Core::getTable('FestivalEdition')->findOneByLibraryId($libraryId);
		
		/* Update album state*/
		$album->setState(Library::STATE_ACTIVE);
		$album->save();
	}

	public function cloneObject($libraryId)
	{
		return;
	}

	public function getForApi($term)
	{
		$term = '(^| |-)' . $term ;
		
		$bruteFestivalEditions = Doctrine_Query::create()
			->from('FestivalEdition fe')
			->innerJoin('fe.Festival f')
			->andWhere('fe.state = 1')
			->andWhere('fe.edition REGEXP ? OR f.name REGEXP ?', array($term, $term))
			->orderBy('f.name ASC')
			->limit(50)
			->execute();

    $festivalEditions = array();					              
		foreach ($bruteFestivalEditions as $key => $bruteFestivalEdition){
			$festivalEditions[$key]['value'] = $bruteFestivalEdition->getId();
			$festivalEditions[$key]['label'] = $bruteFestivalEdition->getFestival()->getName() . ' - ' . $bruteFestivalEdition->getEdition();
		}
		
		return $festivalEditions;
	}

	public function getByEditionAndFestival($edition, $festivalId)
	{
		return Doctrine_Query::create()
			->from('FestivalEdition fe')
			->where('fe.edition = ? AND fe.festival_id = ?', array($edition, $festivalId))
			->fetchOne();
	}

	public function getList($festivalId = null, $limit = null, $page = null)
	{
		$q = Doctrine_Query::create()
			->from('FestivalEdition e')
			->where('e.state = 1 AND e.publish_date IS NOT NULL AND e.publish_date <= NOW()')
			->orderBy('e.edition DESC');

		if (!empty($festivalId)){
			$q->addWhere('e.festival_id = ?', $festivalId);
		}

		if (!empty ($limit)){
			$q->limit($limit);
		}

		if (!empty ($page)){
			$q->offset(($page - 1) * $limit );
		}

		return $q->execute();
	}

	public function countByFestival($festivalId = null)
	{
		$q = Doctrine_Query::create()
			->select('COUNT(e.id)')
			->from('FestivalEdition e')
			->where('e.state = 1 AND e.publish_date IS NOT NULL AND e.publish_date <= NOW()');

		if (!empty($festivalId)){
			$q->addWhere('e.festival_id = ?', $festivalId);
		}

		$count = $q->fetchOne(array(), Doctrine_Core::HYDRATE_ARRAY);

		return $count['COUNT'];
	}

	public function getEditionsIdsByFestival($festivalId)
	{
		return Doctrine_Query::create()
			->from('FestivalEdition e')
			->where('e.state = 1 AND e.publish_date IS NOT NULL AND e.publish_date <= NOW()')
			->addWhere('e.festival_id = ?', $festivalId)
			->orderBy('e.edition DESC')
			->execute();
	}
}