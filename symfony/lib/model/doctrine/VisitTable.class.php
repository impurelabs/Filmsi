<?php

/**
 * VisitTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class VisitTable extends Doctrine_Table
{
        /**
         * Returns an instance of this class.
         *
         * @return object VisitTable
         */
        public static function getInstance()
        {
            return Doctrine_Core::getTable('Visit');
        }

	public function getLatestByIp($ip, $limit)
	{
            return Doctrine_Query::create()
                ->from('Visit v')
                ->where('v.ip = ?', $ip)
                ->orderBy('v.created_at DESC')
                ->limit($limit)
                ->groupBy('v.url')
                ->execute();
	}

        public function deleteOlderThan($days)
        {
            Doctrine_Query::create()
                ->delete('Visit v')
                ->where('v.created_at < date_sub(NOW(), interval ? day)', $days)
                ->execute();
        }

        public function updateVisitCount()
        {
            $libraryVisits =  Doctrine_Query::create()
                ->select('COUNT(v.id) count, v.library_id')
                ->from('Visit v')
                ->groupBy('v.library_id')
                ->execute(array(), Doctrine_Core::HYDRATE_ARRAY);

            /* Reset to 0 the visit_count field for all the elements in the library */
            $q = Doctrine_Query::create()
                ->update('Library l')
                ->set('l.visit_count', '0')
                ->execute();

            /* Reset to 0 the visit_count field for all the elements in the Person */
            $q = Doctrine_Query::create()
                ->update('Film f')
                ->set('f.visit_count', '0')
                ->execute();

            /* Reset to 0 the visit_count field for all the elements in the Person */
            $q = Doctrine_Query::create()
                ->update('Person p')
                ->set('p.visit_count', '0')
                ->execute();
			
			
            $q = Doctrine_Query::create()
                ->update('FestivalEdition e')
                ->set('e.visit_count', '0')
                ->execute();

            /* Reset to 0 the visit_count field for all the elements in the Person */
            $q = Doctrine_Query::create()
                ->update('Stire s')
                ->set('s.visit_count', '0')
                ->execute();

            /* Reset to 0 the visit_count field for all the elements in the Person */
            $q = Doctrine_Query::create()
                ->update('Article a')
                ->set('a.visit_count', '0')
                ->execute();




            /* Update the visit_count field in the library, with the new values */
            foreach ($libraryVisits as $libraryVisit){
                Doctrine_Query::create()
                    ->update('Library l')
                    ->set('l.visit_count', '?', $libraryVisit['count'])
                    ->where('l.id = ?', $libraryVisit['library_id'])
                    ->execute();
            }


            /* Get all elements in the Library, which have visit_count larger then 0. */
            $libraryElems = Doctrine_Query::create()
                ->select('l.id, l.visit_count, l.type')
                ->from('Library l')
                ->where('l.visit_count > 0')
                ->execute(array(), Doctrine_Core::HYDRATE_ARRAY);
                
            /* For each element, update the element's Model with the new visit count */
            foreach ($libraryElems as $libraryElem){
                $q = Doctrine_Query::create()
                    ->update($libraryElem['type'] . ' m')
                    ->set('m.visit_count', '?', $libraryElem['visit_count'])
                    ->where('m.library_id = ?', $libraryElem['id'])
                    ->execute();
                
            }
        }

}