<?php
class ForgotPasswordRequestEmail extends Swift_Message
{
	public function __construct($to, $body)
	{
		parent::__construct('Cerere resetare parola', $body);

		$this->setContentType('text/html');
		$this->setFrom('noreply@filmsi.ro', 'Echipa Filmsi.Ro');
		$this->setTo($to);
	}
}