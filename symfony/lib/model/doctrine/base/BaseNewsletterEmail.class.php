<?php


abstract class BaseNewsletterEmail extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('newsletter_email');
        $this->hasColumn('email', 'string', 250, array(
             'type' => 'string',
             'length' => 250,
             ));

        $this->option('symfony', array(
             'filter' => false,
             ));
        $this->option('charset', 'utf8');
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}