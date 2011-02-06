<?php

/**
 * trailers actions.
 *
 * @package    filmsi
 * @subpackage trailers
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class trailersActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
	$this->getResponse()->setTitle('Trailere');
	$this->getResponse()->addMeta('keywords', '');
	$this->getResponse()->addMeta('description', '');

	$this->currentPage = (int)$request->getParameter('p', 1);
	$this->listQuery = FilmTable::getInstance()->getTrailersQuery(sfConfig::get('app_trailer_page_limit'), $this->currentPage);
	$this->countQuery = FilmTable::getInstance()->countTrailersQuery();

	if($request->hasParameter('acum-in-cinema')){
		$whereString = <<<EOF
f.status_cinema = 1 AND
f.status_cinema_year IS NOT NULL AND f.status_cinema_year != 0 AND
f.status_cinema_month IS NOT NULL AND f.status_cinema_month != 0 AND
f.status_cinema_day IS NOT NULL AND f.status_cinema_day != 0 AND
concat(f.status_cinema_year, '-', f.status_cinema_month, '-', f.status_cinema_day) < NOW()
EOF;
		$this->trailers = $this->listQuery->andWhere($whereString)->execute(array(), Doctrine_Core::HYDRATE_ARRAY);
		$this->trailerCount = $this->countQuery->andWhere($whereString)->fetchOne(array(), Doctrine_Core::HYDRATE_ARRAY);

	} elseif ($request->hasParameter('in-curand-in-cinema')) {
		$whereString = <<<EOF
f.status_cinema = 1 AND
(
	(
		f.status_cinema_year IS NOT NULL AND f.status_cinema_year != 0 AND
		f.status_cinema_month IS NOT NULL AND f.status_cinema_month != 0 AND
		f.status_cinema_day IS NOT NULL AND f.status_cinema_day != 0 AND
		concat(f.status_cinema_year, '-', f.status_cinema_month, '-', f.status_cinema_day) > NOW()
	) OR (
		f.status_cinema_year IS NOT NULL AND f.status_cinema_year != 0 AND
		f.status_cinema_month IS NOT NULL AND f.status_cinema_month != 0 AND
		(f.status_cinema_day IS NULL OR f.status_cinema_day = 0) AND
		concat(f.status_cinema_year, '-', f.status_cinema_month, '-01') > NOW()
	)
)
EOF;
		$this->trailers = $this->listQuery->andWhere($whereString)->execute(array(), Doctrine_Core::HYDRATE_ARRAY);
		$this->trailerCount = $this->countQuery->andWhere($whereString)->fetchOne(array(), Doctrine_Core::HYDRATE_ARRAY);

	} elseif ($request->hasParameter('acum-pe-dvd-bluray')) {
		$whereString = <<<EOF
(
	f.status_dvd = 1 AND
	f.status_dvd_year IS NOT NULL AND f.status_dvd_year != 0 AND
	f.status_dvd_month IS NOT NULL AND f.status_dvd_month != 0 AND
	f.status_dvd_day IS NOT NULL AND f.status_dvd_day != 0 AND
	concat(f.status_dvd_year, '-', f.status_dvd_month, '-', f.status_dvd_day) < NOW()
) OR (
	f.status_bluray = 1 AND
	f.status_bluray_year IS NOT NULL AND f.status_dvd_year != 0 AND
	f.status_bluray_month IS NOT NULL AND f.status_dvd_month != 0 AND
	f.status_bluray_day IS NOT NULL AND f.status_dvd_day != 0 AND
	concat(f.status_bluray_year, '-', f.status_bluray_month, '-', f.status_bluray_day) < NOW()
)
EOF;
		$this->trailers = $this->listQuery->andWhere($whereString)->execute(array(), Doctrine_Core::HYDRATE_ARRAY);
		$this->trailerCount = $this->countQuery->andWhere($whereString)->fetchOne(array(), Doctrine_Core::HYDRATE_ARRAY);

	} elseif ($request->hasParameter('la-tv')){
		$whereString = <<<EOF
f.status_tv = 1 AND
f.status_tv_year IS NOT NULL AND f.status_tv_year != 0 AND
f.status_tv_month IS NOT NULL AND f.status_tv_month != 0 AND
f.status_tv_day IS NOT NULL AND f.status_tv_day != 0 AND
concat(f.status_tv_year, '-', f.status_tv_month, '-', f.status_tv_day) < NOW()
EOF;
		$this->trailers = $this->listQuery->andWhere($whereString)->execute(array(), Doctrine_Core::HYDRATE_ARRAY);
		$this->trailerCount = $this->countQuery->andWhere($whereString)->fetchOne(array(), Doctrine_Core::HYDRATE_ARRAY);

	} else {
		$this->trailers = $this->listQuery->execute(array(), Doctrine_Core::HYDRATE_ARRAY);
		$this->trailerCount = $this->countQuery->fetchOne(array(), Doctrine_Core::HYDRATE_ARRAY);
	}

	
	
	$this->pageCount = ceil($this->trailerCount['count'] / sfConfig::get('app_trailer_page_limit'));
	$this->firstTrailerCount = sfConfig::get('app_trailer_page_limit') * ($this->currentPage - 1) + 1;
	$this->lastTrailerCount = $this->firstTrailerCount + count($this->trailers) - 1;
	if ($this->pageCount <= 5) {
		$this->navStart = 1;
		$this->navEnd = $this->pageCount;
	} else {
		$this->navStart = $this->currentPage - 2;
		$this->navEnd = $this->currentPage - 2;

		if ($this->navStart <= 0){
			$this->navStart = 1;
			$this->navEnd = 5;
		}

		if ($this->navEnd >= $this->pageCount){
			$this->navStart = $this->pageCount - 4;
			$this->navEnd = $this->pageCount;
		}
	}

	if ($request->hasParameter('id')){
		if (false == $this->currentTrailer = FilmTable::getInstance()->getTrailerByVideoId($request->getParameter('id'))){
			$this->redirect404();
		} else {
			$this->actors = FilmPersonTable::getInstance()->getBestActorsByFilm($this->currentTrailer['id'], 3);
			$this->directors = FilmPersonTable::getInstance()->getBestDirectorsByFilm($this->currentTrailer['id']);
		}
	}
  }

}
