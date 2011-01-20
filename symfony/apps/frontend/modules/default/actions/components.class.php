<?php
class defaultComponents extends sfComponents
{
	public function executeVisitHistory()
	{
		$this->visits = Doctrine_Core::getTable('Visit')->getLatestByIp($_SERVER['REMOTE_ADDR'], 5);
	}
}