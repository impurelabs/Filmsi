<?php

/**
 * BaseImdbPersonPhotoKey
 * 
 * 
 * @package    filmsi
 * @subpackage model
 * @author     Your name here
 */
abstract class BaseImdbPersonPhotoKey extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('imdb_person_photo_key');

        $this->hasColumn('imdb', 'string', 50, array(
             'type' => 'string',
			 'length' => 50
        ));
        $this->hasColumn('photo_key', 'string', 50, array(
             'type' => 'string',
			 'length' => 50
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