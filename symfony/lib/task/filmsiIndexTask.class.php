<?php
class filmsiIndexTask extends sfBaseTask
{
    protected $dbConnection;


    public function configure()
    {
        $this->namespace = 'filmsi';
        $this->name = 'index';
        $this->briefDescription = "Updates the index for search.";

        
    }

    public function execute($arguments = array(), $options = array())
    {
		set_time_limit(100);
        $databaseManager = new sfDatabaseManager($this->configuration);
        $this->dbConnection = Doctrine_Manager::connection($databaseManager->getDatabase('doctrine')->getConnection());

		$this->logSection('building', 'Building all');
        $this->dbConnection->getTable('SearchIndex')->buildAll();

        $this->logBlock('filmsi:visits task completed succesfully!', 'INFO');
    }
}