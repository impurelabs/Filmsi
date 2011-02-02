<?php

/**
 * films actions.
 *
 * @package    filmsi
 * @subpackage persons
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class filmsActions extends sfActions
{

	public function executeView(sfWebRequest $request)
	{
		$this->film = FilmTable::getInstance()->findOneById($request->getParameter('id'));

		$this->getResponse()->setTitle($this->film->getName() . ' - Filmsi.ro');
		$this->getResponse()->addMeta('keywords', $this->film->getMetaKeywords());
		$this->getResponse()->addMeta('description', $this->film->getMetaDescription());

		$this->getContext()->getConfiguration()->loadHelpers('Date');
		$this->statuses = array();
		$this->isInCinema = false;

		if ($this->film->getStatusInProduction() == '1'){
			$this->statuses[] = 'IN PRODUCTIE';
		} else {
			/* Set the cinema status */
			if ($this->film->getStatusCinema() == '1'){
				if ($this->film->getStatusCinemaYear() != '0' && $this->film->getStatusCinemaMonth() != '0' && $this->film->getStatusCinemaDay() != '0'){
					if(strtotime($this->film->getStatusCinemaYear() . '-' . $this->film->getStatusCinemaMonth() . '-01') < time()){
						$this->statuses[] = 'ACUM in cinema';
						$this->isInCinema = true;
					} else {
						$this->statuses[] = 'DIN ' . strtoupper(format_date($this->film->getStatusCinemaYear() . '-' . $this->film->getStatusCinemaMonth() . '-' . $this->film->getStatusCinemaDay(),'D', 'ro')) . ' in cinema';
					}
				} elseif ($this->film->getStatusCinemaYear() != '0' && $this->film->getStatusCinemaMonth() != '0') {
					$this->statuses[] = 'DIN ' . strtoupper(format_date($this->film->getStatusCinemaYear() . '-' . $this->film->getStatusCinemaMonth() . '-01', 'M', 'ro')) . ' in cinema';
				} else {
					$this->statuses[] = 'IN CURAND in cinema';
				}
			}

			/* Set the DVD status */
			if ($this->film->getStatusDvd() == '1'){
				if ($this->film->getStatusDvdYear() != '0' && $this->film->getStatusDvdMonth() != '0' && $this->film->getStatusDvdDay() != '0'){
					if(strtotime($this->film->getStatusDvdYear() . '-' . $this->film->getStatusDvdMonth() . '-01') < time()){
						$this->statuses[] = 'ACUM pe DVD';
					} else {
						$this->statuses[] = 'DIN ' . strtoupper(format_date($this->film->getStatusDvdYear() . '-' . $this->film->getStatusDvdMonth() . '-' . $this->film->getStatusDvdDay(),'D', 'ro')) . ' pe DVD';
					}
				} elseif ($this->film->getStatusDvdYear() != '0' && $this->film->getStatusDvdMonth() != '0') {
					$this->statuses[] = 'DIN ' . strtoupper(format_date($this->film->getStatusDvdYear() . '-' . $this->film->getStatusDvdMonth() . '-01', 'M', 'ro')) . ' pe DVD';
				} else {
					$this->statuses[] = 'IN CURAND pe DVD';
				}
			}

			/* Set the Bluray status */
			if ($this->film->getStatusBluray() == '1'){
				if ($this->film->getStatusBlurayYear() != '0' && $this->film->getStatusBlurayMonth() != '0' && $this->film->getStatusBlurayDay() != '0'){
					if(strtotime($this->film->getStatusBlurayYear() . '-' . $this->film->getStatusBlurayMonth() . '-01') < time()){
						$this->statuses[] = 'ACUM pe Blu-ray';
					} else {
						$this->statuses[] = 'DIN ' . strtoupper(format_date($this->film->getStatusBlurayYear() . '-' . $this->film->getStatusBlurayMonth() . '-' . $this->film->getStatusBlurayDay(),'D', 'ro')) . ' pe Blu-ray';
					}
				} elseif ($this->film->getStatusBlurayYear() != '0' && $this->film->getStatusBlurayMonth() != '0') {
					$this->statuses[] = 'DIN ' . strtoupper(format_date($this->film->getStatusBlurayYear() . '-' . $this->film->getStatusBlurayMonth() . '-01', 'M', 'ro')) . ' pe Blu-ray';
				} else {
					$this->statuses[] = 'IN CURAND pe Blu-ray';
				}
			}

			/* Set the Online status */
			if ($this->film->getStatusOnline() == '1'){
				if ($this->film->getStatusOnlineYear() != '0' && $this->film->getStatusOnlineMonth() != '0' && $this->film->getStatusOnlineDay() != '0'){
					if(strtotime($this->film->getStatusOnlineYear() . '-' . $this->film->getStatusOnlineMonth() . '-01') < time()){
						$this->statuses[] = 'ACUM online';
					} else {
						$this->statuses[] = 'DIN ' . strtoupper(format_date($this->film->getStatusOnlineYear() . '-' . $this->film->getStatusOnlineMonth() . '-' . $this->film->getStatusOnlineDay(),'D', 'ro')) . ' online';
					}
				} elseif ($this->film->getStatusOnlineYear() != '0' && $this->film->getStatusOnlineMonth() != '0') {
					$this->statuses[] = 'DIN ' . strtoupper(format_date($this->film->getStatusOnlineYear() . '-' . $this->film->getStatusOnlineMonth() . '-01', 'M', 'ro')) . ' online';
				} else {
					$this->statuses[] = 'IN CURAND online';
				}
			}
		}


		$this->actors = FilmPersonTable::getInstance()->getBestActorsByFilm($this->film->getId(), 3);
		$this->directors = FilmPersonTable::getInstance()->getBestDirectorsByFilm($this->film->getId());


		$this->commentForm = new CommentForm(null, array(
			'state' => 1,
			'ip' => $_SERVER['REMOTE_ADDR'],
			'model' => 'Film',
                        'model_library_id' => $this->film->getLibraryId(),
                        'model_name' => $this->film->getName()
		));
		if ($this->getUser()->isAuthenticated()){
			$user = $this->getUser()->getGuardUser();
			$this->commentForm->setDefaults(array(
				'name' => $user->getName(),
				'email' => $user->getEmailAddress()
			));
		}
		if ($request->isMethod('post')){
			$this->commentForm->bind($request->getParameter($this->commentForm->getName()));

			if ($this->commentForm->isValid()){
				$this->commentForm->save();

                                $this->redirect($this->generateUrl('film', array('id' => $this->film->getId(), 'key' => $this->film->getUrlKey())) . '#comments');
			}
		}

		$this->comments = Doctrine_Core::getTable('Comment')->getActiveByModel('film', $this->film->getLibraryId(), $_SERVER['REMOTE_ADDR']);

		/* Add the visit */
		$visit = new Visit();
		$visit->setLibraryId($this->film->getLibraryId());
		$visit->setUrl($this->generateUrl('film', array('id' => $this->film->getId(), 'key' => $this->film->getUrlKey())));
		$visit->setName($this->film->getNameRo());
		$visit->setIp($_SERVER['REMOTE_ADDR']);
		$visit->save();
	}

	public function executeVote(sfWebRequest $request)
	{
		$this->forward404If(!$request->isMethod('post'));

		$vote = new FilmVote();
		$vote->setFilmId($request->getParameter('film_id'));
		$vote->setGrade($request->getParameter('grade'));
		$vote->setIp($_SERVER['REMOTE_ADDR']);
		$vote->save();

		$this->redirect($request->getReferer());
	}
}
