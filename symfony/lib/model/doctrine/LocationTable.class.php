<?php

/**
 * LocationTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class LocationTable extends Doctrine_Table
{
	public $citiesByRegion = array(
		'bucuresti' => array(),
		'alba' => array(),
		'arad' => array(),
		'arges' => array(),
		'bacau' => array(),
		'bihor' => array(),
		'bistritanasaud' => array(),
		'botosani' => array(),
		'brasov' => array(),
		'braila' => array(),
		'buzau' => array(),
		'carasseverin' => array(),
		'calarasi' => array(),
		'cluj' => array(),
		'constanta' => array(),
		'covasna' => array(),
		'dambovita' => array(),
		'dolj' => array(),
		'galati' => array(),
		'giurgiu' => array(),
		'gorj' => array(),
		'harghita' => array(),
		'hunedoara' => array(),
		'ialomita' => array(),
		'iasi' => array(),
		'ilfov' => array(),
		'maramures' => array(),
		'mehedinti' => array(),
		'mures' => array(),
		'neamt' => array(),
		'olt' => array(),
		'prahova' => array(),
		'satumare' => array(),
		'salaj' => array(),
		'sibiu' => array(),
		'suceava' => array(),
		'teleorman' => array(),
		'timis' => array(),
		'tulcea' => array(),
		'vaslui' => array(),
		'valcea' => array(),
		'vrancea' => array()
	);

	public static function getInstance()
	{
		return Doctrine_Core::getTable('Location');
	}

	public static function getCityIdsByRegionKey()
	{

	}

	public function getForApi($term)
	{
		$term = '(^| |-)' . $term ;
		
		$bruteLocations = Doctrine_Query::create()
			->from('Location l')
			->andWhere('l.city REGEXP ?', $term)
			->orderBy('l.city ASC')
			->limit(50)
			->execute();

    $locations = array();					              
		foreach ($bruteLocations as $key => $bruteLocation){
			$locations[$key]['value'] = $bruteLocation->getId();
			$locations[$key]['label'] = $bruteLocation->getCity() . ', ' . $bruteLocation->getRegion();
		}
		
		return $locations;
	}
}