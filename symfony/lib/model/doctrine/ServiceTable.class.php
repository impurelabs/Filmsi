<?php

/**
 * ServiceTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class ServiceTable extends Doctrine_Table
{
	public function getAllOrdered()
	{
		return Doctrine_Query::create()	
			->from('Service s')
			->orderBy('s.name ASC')
			->execute();
	}
}