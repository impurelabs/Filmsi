<?php
class ContactEmail extends Swift_Message
{
	public function __construct($to, $body, $fromName)
	{
		parent::__construct('Contact Filmsi.ro', $body);

		$this->setContentType('text/html');
		$this->setFrom('noreply@filmsi.ro', $fromName);
		$this->setTo($to);
	}
}