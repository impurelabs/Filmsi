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
				$this->getPartial('user/send_request', array('user' => $this->form->user, 'forgot_password' => $forgotPassword))));

				return $this->renderText(json_encode(array('status' => true)));
			} else {
				return $this->renderText(json_encode(array('status' => false)));
			}
		}
	}

	public function executeChangePassword($request)
	{
		$this->forgotPassword = Doctrine_Core::getTable('sfGuardForgotPassword')->findOneByUniqueKey($request->getParameter('unique_key'));
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

	private function _deleteOldUserForgotPasswordRecords()
	{
		Doctrine_Core::getTable('sfGuardForgotPassword')
		->createQuery('p')
		->delete()
		->where('p.user_id = ?', $this->user->id)
		->execute();
	}
}
