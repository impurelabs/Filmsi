<?php
class filmsiVisitsTask extends sfBaseTask
{
    protected $dbConnection;


    public function configure()
    {
        $this->namespace = 'filmsi';
        $this->name = 'visits';
        $this->briefDescription = "Does visits meintenance. See options for details.";
        

        $this->addOptions(array(
            'count' => new sfCommandOption('count', null, sfCommandOption::PARAMETER_OPTIONAL | sfCommandOption::IS_ARRAY, 'Use to update the visit_count field in the Location model.'),
            'reset' => new sfCommandOption('reset', null, sfCommandOption::PARAMETER_OPTIONAL | sfCommandOption::IS_ARRAY, 'Use to delete all the visits older then the value specified. If set to 0 or default, the value will be taken from app_visit_life_time')
        ));

        
    }

    public function execute($arguments = array(), $options = array())
    {
        $databaseManager = new sfDatabaseManager($this->configuration);
        $this->dbConnection = Doctrine_Manager::connection($databaseManager->getDatabase('doctrine')->getConnection());

        if (count($options['reset'])){
            $this->resetVisits();
        }
        
        if (count($options['count'])){
            $this->countVisits();
        }

        $this->logBlock('filmsi:visits task completed succesfully! (memory total: ' . memory_get_peak_usage(true) . ')', 'INFO');
    }

    protected function countVisits()
    {
        $this->logSection('counting', 'Counting started');
        $this->dbConnection->getTable('Visit')->updateVisitCount();
    }

    protected function resetVisits()
    {
        $this->logSection('resetting', 'Reseting visits older then 30 days.');
        $this->dbConnection->getTable('Visit')->deleteOlderThan(30);
    }
}