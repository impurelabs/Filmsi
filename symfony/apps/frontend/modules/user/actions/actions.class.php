<?php

/**
 * user actions.
 *
 * @package    filmsi
 * @subpackage user
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class userActions extends sfActions
{
	public function executeLogin($request)
	{
		$user = $this->getUser();
		if ($user->isAuthenticated()){
			return $this->redirect('@homepage');
		}

		$class = sfConfig::get('app_sf_guard_plugin_signin_form', '');
		$this->form = new sfGuardFormSignin();

		if ($request->isMethod('post')){
			$this->form->bind($request->getParameter('signin'));
			if ($this->form->isValid()){
				$this->getUser()->getGuardUser();
				$values = $this->form->getValues();
				$this->getUser()->signin($values['user'], array_key_exists('remember', $values) ? $values['remember'] : false);

				return $this->renderText(json_encode(array('status' => true)));
			} else {
				$errors = array();
				foreach($this->form->getErrorSchema()->getErrors() as $key => $error){
					$errors[$key] = $error->getMessage();
				}

				return $this->renderText(json_encode(array(
					'status' => false,
					'errors' => $errors
				)));
			}
		}
	}
	
	public function executeFbLogin($request)
	{
		$this->forward404If(!$request->isMethod('post'));
		
		$fbParams = $request->getParameter('fb');
		
		if (false === $user = Doctrine_Core::getTable('sfGuardUser')->findOneByFbId($fbParams['id'])){
			if (false === $user = Doctrine_Core::getTable('sfGuardUser')->findOneByEmailAddress($fbParams['id'])){
				$user = new sfGuardUser();
				$user->setFirstName($sfParams['first_name']);
				$user->setLastName($sfParams['last_name']);
				
				$birthday = explode('/', $fbParams['birthday']);
				$user->setDob($birthday[2] . '-' . $birthday[0] . '-' . $birthday[1]);
				$user->setGender($fbParams['gender'] == 'male' ? 0 : 1);
				$user->setFbId($fbParams['id']);
				$user->setEmailAddress($fbParams['email']);
				$user->setUsername(Doctrine_Core::getTable('sfGuardUser')->getNewUserByNames($fbParams['first_name'], $fbParams['first_name']));
				$user->setPassword(rand(0, 100000));
				$user->setIsActive('1');
				$user->save();
			} else {
				$user->setFbId($fbParams['id']);
				$user->save();
			}
		}
		
		$this->getUser()->signIn($user, true);
		
		$this->renderText(json_encode(array('status' => true)));
	}

	public function executeLogout($request)
	{
		$this->getUser()->signOut();

		$signoutUrl = sfConfig::get('app_sf_guard_plugin_success_signout_url', $request->getReferer());

		$this->redirect('' != $signoutUrl ? $signoutUrl : '@homepage');
	}

	public function executeSecure($request)
	{
		$this->getResponse()->setStatusCode(403);
	}

	public function executeRegister($request)
	{
		$this->form = new ClientForm();
  	
		if ($request->isMethod('post'))
		{
			$this->form->bind($request->getParameter($this->form->getName()));

			if ($this->form->isValid()){
				$this->form->save();

				return $this->renderText(json_encode(array('status' => true)));
			} else {
				$errors = array();
				foreach($this->form->getErrorSchema()->getErrors() as $key => $error){
					$errors[$key] = $error->getMessage();
				}

				return $this->renderText(json_encode(array(
					'status' => false,
					'errors' => $errors
				)));
			}
		}
	}

	public function executeCover($request)
	{

	}

	public function executeAlerts($request)
	{
	}

	public function executeDetails($request)
	{

	}

	public function executeEdit($request)
	{
		$user = $this->getUser()->getGuardUser();
		$this->form = new ClientEditForm($user);

		if ($request->isMethod('post')){
			$this->form->bind($request->getParameter($this->form->getName()));

			if($this->form->isValid()){
				$this->form->save();

				$this->getUser()->signOut();
				$this->getUser()->signin($user);

				return $this->renderText(json_encode(array('status' => true)));
			} else {
				$errors = array();
				foreach($this->form->getErrorSchema()->getErrors() as $key => $error){
					$errors[$key] = $error->getMessage();
				}

				return $this->renderText(json_encode(array(
					'status' => false,
					'errors' => $errors
				)));
			}
		}
	}

	public function executeForgotPassword($request)
	{
		$this->form = new sfGuardRequestForgotPasswordForm();

		if ($request->isMethod('post')){
			$this->form->bind($request->getParameter($this->form->getName()));
			if ($this->form->isValid()){
				$this->user = $this->form->user;

				$this->_deleteOldUserForgotPasswordRecords();

				$forgotPassword = new sfGuardForgotPassword();
				$forgotPassword->user_id = $this->form->user->id;
				$forgotPassword->unique_key = md5(rand() + time());
				$forgotPassword->expires_at = new Doctrine_Expression('NOW()');
				$forgotPassword->save();

				$this->getMailer()->send(new ForgotPasswordRequestEmail(
                                    $this->form->user->email_address,
                                    $this->getPartial('user/send_request', array('user' => $this->form->user, 'forgot_password' => $forgotPassword))
                                ));

				return $this->renderText(json_encode(array('status' => true)));
			} else {
				return $this->renderText(json_encode(array('status' => false)));
			}
		}
	}

	public function executeChangePassword($request)
	{
		if (false === $this->forgotPassword = Doctrine_Core::getTable('sfGuardForgotPassword')->findOneByUniqueKey($request->getParameter('unique_key'))){
                    $this->setTemplate('changePasswordExpired');

                    return sfView::SUCCESS;
                }

		$this->user = $this->forgotPassword->getUser();
		$this->form = new sfGuardChangeUserPasswordForm($this->user);

		if ($request->isMethod('post')){
			$this->form->bind($request->getParameter($this->form->getName()));
			if ($this->form->isValid()){
				$this->form->save();

				$this->_deleteOldUserForgotPasswordRecords();

				return $this->renderText(json_encode(array('status' => true)));
			} else {
				$errors = array();
				foreach($this->form->getErrorSchema()->getErrors() as $key => $error){
					$errors[$key] = $error->getMessage();
				}

				return $this->renderText(json_encode(array(
					'status' => false,
					'errors' => $errors
				)));
			}
		}
	}

	public function executeAlertCinemaStatusEdit(sfWebRequest $request)
	{
		$user = $this->getUser()->getGuardUser();

		if ($user->getAlertCinema() == '1'){
			$status = '0';
		} else {
			$status = '1';
		}

		$user->setAlertCinema($status);
		$user->save();

		return $this->renderText(json_encode(array('status' => $status)));
	}

	public function executeAlertDboStatusEdit(sfWebRequest $request)
	{
		$user = $this->getUser()->getGuardUser();

		if ($user->getAlertDbo() == '1'){
			$status = '0';
		} else {
			$status = '1';
		}

		$user->setAlertDbo($status);
		$user->save();

		return $this->renderText(json_encode(array('status' => $status)));
	}

	public function executeAlertTvStatusEdit(sfWebRequest $request)
	{
		$user = $this->getUser()->getGuardUser();

		if ($user->getAlertTv() == '1'){
			$status = '0';
		} else {
			$status = '1';
		}

		$user->setAlertTv($status);
		$user->save();

		return $this->renderText(json_encode(array('status' => $status)));
	}

	public function executeAlertStireStatusEdit(sfWebRequest $request)
	{
		$user = $this->getUser()->getGuardUser();

		if ($user->getAlertStire() == '1'){
			$status = '0';
		} else {
			$status = '1';
		}

		$user->setAlertStire($status);
		$user->save();

		return $this->renderText(json_encode(array('status' => $status)));
	}

	public function executeAlertCinema(sfWebRequest $request)
	{
		$this->cinemas = CinemaAlertTable::getInstance()->getByUser($this->getUser()->getGuardUser()->getId());
	}

	public function executeAlertCinemaEdit(sfWebRequest $request)
	{
		$this->cinemaLocations = CinemaTable::getInstance()->getGroupedByLocations();
		$currentCinemas = CinemaAlertTable::getInstance()->getByUser($this->getUser()->getGuardUser()->getId());
		if (count($currentCinemas) > 0){
			$this->currentLocationId = $currentCinemas[0]['location_id'];
		} else {
			$this->currentLocationId = '';
		}
		$this->currentCinemaIds = array();
		foreach ($currentCinemas as $currentCinema){
			$this->currentCinemaIds[] = $currentCinema['cinema_id'];
		}

		$this->locations = array();
		foreach ($this->cinemaLocations as $locationId => $cinema){
			$this->locations[$locationId] = $cinema['location_name'];
		}

		if ($request->isMethod('post')){
			CinemaAlertTable::getInstance()->updateCinemasForUser($this->getUser()->getGuardUser()->getId(), $request->getParameter('cid'));


			$this->newCinemas = array();
			if (count($request->getParameter('cid')) > 0){
				foreach (CinemaTable::getInstance()->getMultipleByIds($request->getParameter('cid')) as $cinema){
					$this->newCinemas[] = array(
						'id' => $cinema['id'],
						'name' => $cinema['name'],
						'url_key' => $cinema['url_key']
					);
				}
			}

			$this->setTemplate('alertCinemaPostEdit');
		}
	}

	public function executeAlertDbo(sfWebRequest $request)
	{
	}

	public function executeAlertStire(sfWebRequest $request)
	{
	}

	public function executeAlertTv(sfWebRequest $request)
	{
		$this->channels = ChannelAlertTable::getInstance()->getByUser($this->getUser()->getGuardUser()->getId());
	}

	public function executeAlertTvEdit(sfWebRequest $request)
	{
		$this->channels = ChannelTable::getInstance()->getAll();
		$currentChannels = ChannelAlertTable::getInstance()->getByUser($this->getUser()->getGuardUser()->getId());
		$this->currentChannelIds = array();
		
		foreach ($currentChannels as $currentChannel){
			$this->currentChannelIds[] = $currentChannel['channel_id'];
		}

		if ($request->isMethod('post')){
			ChannelAlertTable::getInstance()->updateChannelsForUser($this->getUser()->getGuardUser()->getId(), $request->getParameter('cid'));

			$this->newChannels = array();
			if (count($request->getParameter('cid')) > 0){
				foreach (ChannelTable::getInstance()->getMultipleByIds($request->getParameter('cid')) as $channel){
					$this->newChannels[] = array(
						'id' => $channel['id'],
						'name' => $channel['name']
					);
				}
			}

			$this->setTemplate('alertTvPostEdit');
		}
	}

	private function _deleteOldUserForgotPasswordRecords()
	{
		Doctrine_Core::getTable('sfGuardForgotPassword')
		->createQuery('p')
		->delete()
		->where('p.user_id = ?', $this->user->id)
		->execute();
	}
}
