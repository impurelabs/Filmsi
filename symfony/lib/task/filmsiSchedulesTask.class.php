<?php
class filmsiSchedulesTask extends sfBaseTask
{
    protected $dbConnection;


    public function configure()
    {
        $this->namespace = 'filmsi';
        $this->name = 'schedules';
        $this->briefDescription = "Does cinema and channel meintenance. See options for details.";        
    }

    public function execute($arguments = array(), $options = array())
    {
        $databaseManager = new sfDatabaseManager($this->configuration);
        $this->dbConnection = Doctrine_Manager::connection($databaseManager->getDatabase('doctrine')->getConnection());

		if (false === $this->resetSchedules()){
			$this->logBlock('filmsi:schedules task was NOT completed succesfully!', 'ERROR');
		} else {
			$this->logBlock('filmsi:schedules task completed succesfully!', 'INFO');
		}
    }

    protected function resetSchedules()
    {
        $this->logSection('resetting', 'Deleting cinema schedules older then today.');
        $this->dbConnection->getTable('CinemaSchedule')->deleteOlderThan(8);

        $this->logSection('resetting', 'Deleting channel schedules older then today.');
        $this->dbConnection->getTable('ChannelSchedule')->deleteOlderThan(8);

		return true;
    }
}