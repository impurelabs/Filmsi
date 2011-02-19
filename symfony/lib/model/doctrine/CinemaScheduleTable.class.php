<?php

/**
 * CinemaScheduleTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class CinemaScheduleTable extends Doctrine_Table
{
	public static function getInstance()
	{
		return Doctrine_Core::getTable('CinemaSchedule');
	}

	public function getDetailedByCinema($cinemaId)
	{
		$scheduleBrutes = Doctrine_Query::create()
			->from('CinemaSchedule cs')
			->innerJoin('cs.Film f')
			->innerJoin('cs.Cinema c')
			->where('cs.cinema_id = ?', $cinemaId)
			->orderBy('cs.day ASC')
			->execute();
			
		$schedules = array();
		foreach ($scheduleBrutes as $scheduleBrute){
			$schedules[$scheduleBrute->getDay()][] = array(
				'id' => $scheduleBrute->getId(),
				'film' => $scheduleBrute->getFilm()->getName(),
				'schedule' => $scheduleBrute->getSchedule(),
				'format' => $scheduleBrute->getFormat()
			);
		}
		
		return $schedules;
	}

	public function getScheduledFilmsByDays($cinemaId, $days, $limit = null)
	{
		$schedules = Doctrine_Query::create()
			->from('CinemaSchedule s')
			->innerJoin('s.Cinema c')
			->innerJoin('s.Film f')
			->where('f.state = 1 AND c.state = 1')
			->andWhere('c.id = ?', $cinemaId)
			->andWhereIn('s.day', $days)
			->orderBy('s.day ASC')
			->execute(array(), Doctrine_Core::HYDRATE_ARRAY);
		
		$films = array();
		foreach($schedules as $schedule){
			$films[$schedule['Film']['id']]['film'] = $schedule['Film'];
			$films[$schedule['Film']['id']]['schedules'][] = array(
				'day' => $schedule['day'],
				'schedule' => $schedule['schedule'],
				'format' => $schedule['format']
			);
		}

		if (isset($limit)){
			return array_splice($films, 0, $limit);
		} else {
			return $films;
		}
	}

	public function getAllScheduledFilmsFromWeekStart($cinemaId, $weekFirstDay)
	{
		$schedules = Doctrine_Query::create()
			->from('CinemaSchedule s')
			->innerJoin('s.Cinema c')
			->innerJoin('s.Film f')
			->where('f.state = 1 AND c.state = 1')
			->andWhere('c.id = ?', $cinemaId)
			->andWhere('s.day >= ?', $weekFirstDay)
			->orderBy('s.day ASC')
			->execute(array(), Doctrine_Core::HYDRATE_ARRAY);

		$films = array();
		foreach($schedules as $schedule){
			$films[$schedule['Film']['id']]['film'] = $schedule['Film'];
			$films[$schedule['Film']['id']]['schedules'][] = array(
				'day' => $schedule['day'],
				'schedule' => $schedule['schedule'],
				'format' => $schedule['format']
			);
		}

		if (isset($limit)){
			return array_splice($films, 0, $limit);
		} else {
			return $films;
		}
	}

	/* Get the list of films that are playing in a cinema after a certain date that aren't playing yet */
	public function getFutureFilms($cinemaId, $date, $currentFilmIds, $limit)
	{
		$schedules = Doctrine_Query::create()
			->from('CinemaSchedule s')
			->innerJoin('s.Cinema c')
			->innerJoin('s.Film f')
			->where('f.state = 1 AND c.state = 1')
			->andWhere('c.id = ?', $cinemaId)
			->andWhere('s.day > ?', $date)
			->andWhereNotIn('f.id', $currentFilmIds)
			->orderBy('s.day ASC')
			->execute(array(), Doctrine_Core::HYDRATE_ARRAY);

		$films = array();
		foreach($schedules as $schedule){
			$films[$schedule['Film']['id']]['film'] = $schedule['Film'];
			$films[$schedule['Film']['id']]['schedules'][] = array(
				'day' => $schedule['day'],
				'schedule' => $schedule['schedule'],
				'format' => $schedule['format']
			);
		}

		if (isset($limit)){
			return array_splice($films, 0, $limit);
		} else {
			return $films;
		}
	}
}