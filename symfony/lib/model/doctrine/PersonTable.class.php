<?php

/**
 * PersonTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class PersonTable extends Doctrine_Table
{
	public static function getInstance()
	{
		return Doctrine_Core::getTable('Person');
	}

	public function allow($libraryId)
	{
		$album = Doctrine_Core::getTable('Person')->findOneByLibraryId($libraryId);
		
		/* Update album state*/
		$album->setState(Library::STATE_ACTIVE);
		$album->save();
	}

	public function cloneObject($libraryId)
	{
		$person = Doctrine_Core::getTable('Person')->findOneByLibraryId($libraryId);
		
		/* Cloning the object */
		$newPerson = new Person();
		$newPerson->setFirstName($person->getFirstName());
		$newPerson->setLastName($person->getLastName() . ' - clone');
		$newPerson->setDateOfBirth($person->getDateOfBirth());
		$newPerson->setDateOfDeath($person->getDateOfDeath());
		$newPerson->setPlaceOfBirth($person->getPlaceOfBirth());
		$newPerson->setFilename($person->getFilename());
		$newPerson->setBiographyTeaser($person->getBiographyTeaser());
		$newPerson->setBiographyContent($person->getBiographyContent());
		$newPerson->setState($person->getState());
		$newPerson->setImdb($person->getImdb());
		$newPerson->setIsActor($person->getIsActor());
		$newPerson->setIsDirector($person->getIsDirector());
		$newPerson->setIsScriptwriter($person->getIsScriptwriter());
		$newPerson->setIsProducer($person->getIsProducer());
		$newPerson->setPublishDate($person->getPublishDate());
		$newPerson->setUserId(sfContext::getInstance()->getUser()->getGuardUser()->getId());
		
		
		$pieces = explode('.', $person->getFilename());
		$extension = $pieces[1];
		$newFilename = md5(time() . rand(0, 999999)) . '.' . $extension;
			
		/* Copying the photo files */
		copy(sfConfig::get('app_person_path') . '/' . $person->getFilename(), sfConfig::get('app_person_path') . '/' . $newFilename);
		copy(sfConfig::get('app_person_path') . '/t-' . $person->getFilename(), sfConfig::get('app_person_path') . '/t-' . $newFilename);
		copy(sfConfig::get('app_person_path') . '/ts-' . $person->getFilename(), sfConfig::get('app_person_path') . '/ts-' . $newFilename);
		
		$newPerson->setFilename($newFilename);
		$newPerson->save();
	}

	public function getForApi($term)
	{
		$term = '(^| |-)' . $term ;
		
		$brutePersons = Doctrine_Query::create()
			->from('Person p')
			->andWhere('p.state = 1')
			->andWhere('p.first_name REGEXP ? OR p.last_name REGEXP ?', array($term, $term))
			->orderBy('p.last_name ASC')
			->limit(50)
			->execute();

		$persons = array();
		foreach ($brutePersons as $key => $brutePerson){
			$persons[$key]['value'] = $brutePerson->getId();
			$persons[$key]['label'] = $brutePerson->getName();
		}
		
		return $persons;
	}

	public function getForApiImdb($term)
	{
		$term = '(^| |-)' . $term ;

		$brutePersons = Doctrine_Query::create()
			->from('Person p')
			->andWhere('p.state = 1')
			->andWhere('p.first_name REGEXP ? OR p.last_name REGEXP ?', array($term, $term))
			->orderBy('p.last_name ASC')
			->limit(50)
			->execute();

		$persons = array();
		foreach ($brutePersons as $key => $brutePerson){
			$persons[$key]['value'] = $brutePerson->getImdb();
			$persons[$key]['label'] = $brutePerson->getName();
		}

		return $persons;
	}

        public function getBestAlphabetically($type = array())
        {
            if (!is_array($type)){
                $type = array($type);
            }

            $persons = array();

            $q = Doctrine_Query::create()
                ->from('Person p')
                ->where('p.last_name LIKE ? AND p.state = 1')
                ->orderBy('p.visit_count DESC')
                ->limit(10);

            
            $queryString = '';
            for ($i = 0; $i <= count($type) - 1; $i++){
                $queryString .= 'is_' . $type[$i] . ' = 1';
                
                if ($i < count($type) - 1){
                    $queryString .= ' OR ';
                }
            }
            if ($queryString != ''){
                $q->addWhere($queryString);
            }

            
            $letter = 'a'; $persons [$letter] = $q->execute(array($letter . '%'));
            $letter = 'b'; $persons [$letter] = $q->execute(array($letter . '%'));
            $letter = 'c'; $persons [$letter] = $q->execute(array($letter . '%'));
            $letter = 'd'; $persons [$letter] = $q->execute(array($letter . '%'));
            $letter = 'e'; $persons [$letter] = $q->execute(array($letter . '%'));
            $letter = 'f'; $persons [$letter] = $q->execute(array($letter . '%'));
            $letter = 'g'; $persons [$letter] = $q->execute(array($letter . '%'));
            $letter = 'h'; $persons [$letter] = $q->execute(array($letter . '%'));
            $letter = 'i'; $persons [$letter] = $q->execute(array($letter . '%'));
            $letter = 'j'; $persons [$letter] = $q->execute(array($letter . '%'));
            $letter = 'k'; $persons [$letter] = $q->execute(array($letter . '%'));
            $letter = 'l'; $persons [$letter] = $q->execute(array($letter . '%'));
            $letter = 'm'; $persons [$letter] = $q->execute(array($letter . '%'));
            $letter = 'n'; $persons [$letter] = $q->execute(array($letter . '%'));
            $letter = 'o'; $persons [$letter] = $q->execute(array($letter . '%'));
            $letter = 'p'; $persons [$letter] = $q->execute(array($letter . '%'));
            $letter = 'q'; $persons [$letter] = $q->execute(array($letter . '%'));
            $letter = 'r'; $persons [$letter] = $q->execute(array($letter . '%'));
            $letter = 's'; $persons [$letter] = $q->execute(array($letter . '%'));
            $letter = 't'; $persons [$letter] = $q->execute(array($letter . '%'));
            $letter = 'u'; $persons [$letter] = $q->execute(array($letter . '%'));
            $letter = 'v'; $persons [$letter] = $q->execute(array($letter . '%'));
            $letter = 'w'; $persons [$letter] = $q->execute(array($letter . '%'));
            $letter = 'x'; $persons [$letter] = $q->execute(array($letter . '%'));
            $letter = 'y'; $persons [$letter] = $q->execute(array($letter . '%'));
            $letter = 'z'; $persons [$letter] = $q->execute(array($letter . '%'));

            return $persons;
        }

        public function getAllByLetter($limit, $page, $letter, $type = null)
        {
            $q = Doctrine_Query::create()
                ->from('Person p')
                ->where('p.last_name LIKE ? AND p.state = 1', $letter . '%')
                ->orderBy('p.last_name, p.first_name ASC');
            
            switch ($type){
                case 'actor':
                    $q->addWhere('is_actor = 1');
                    break;
                case 'director':
                    $q->addWhere('is_director = 1');
                    break;
            }

            if (!empty ($limit)){
                    $q->limit($limit);
            }

            if (!empty ($page)){
                    $q->offset(($page - 1) * $limit );
            }

            return $q->execute();

        }

        public function getCount($letter = null, $type = null)
	{
            $q = Doctrine_Query::create()
                    ->select('COUNT(p.id)')
                    ->from('Person p')
                    ->where('p.state = 1');

            switch ($type){
                case 'actor':
                    $q->addWhere('is_actor = 1');
                    break;
                case 'director':
                    $q->addWhere('is_director = 1');
                    break;
            }

            if (isset($letter)){
                $q->addWhere('p.last_name LIKE ?', $letter . '%');
            }

            $count = $q->fetchOne(array(), Doctrine_Core::HYDRATE_ARRAY);

            return $count['COUNT'];
    }
}