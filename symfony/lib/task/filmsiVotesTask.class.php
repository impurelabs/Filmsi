<?php
class filmsiVotesTask extends sfBaseTask
{
    protected $dbConnection;


    public function configure()
    {
        $this->namespace = 'filmsi';
        $this->name = 'votes';
        $this->briefDescription = "Does vote meintenance. See options for details.";
        

        $this->addOptions(array(
            'reset' => new sfCommandOption('reset', null, sfCommandOption::PARAMETER_OPTIONAL | sfCommandOption::IS_ARRAY, 'Use to delete all the votes older then the value specified in the --reset option. ex --reset=30')
        ));

        
    }

    public function execute($arguments = array(), $options = array())
    {
        $databaseManager = new sfDatabaseManager($this->configuration);
        $this->dbConnection = Doctrine_Manager::connection($databaseManager->getDatabase('doctrine')->getConnection());

        if (count($options['reset'])){
            if (false === $this->resetVotes($options['reset'][0])){
				$this->logBlock('filmsi:votes task was NOT completed succesfully!', 'ERROR');
			} else {
				$this->logBlock('filmsi:votes task completed succesfully!', 'INFO');
			}
        }
    }

    protected function resetVotes($days)
    {
		if ((int)$days <= 0){
			return false;
		}

        $this->logSection('resetting', 'Deleting film votes older then ' . $days . ' days.');
        $this->dbConnection->getTable('FilmVote')->deleteOlderThan($days);

        $this->logSection('resetting', 'Deleting cinema votes older then ' . $days . ' days.');
        $this->dbConnection->getTable('CinemaVote')->deleteOlderThan($days);

		return true;
    }
}