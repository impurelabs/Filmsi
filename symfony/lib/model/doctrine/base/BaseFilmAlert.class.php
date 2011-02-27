<?php

/**
 * BaseFilmAlert
 * 
 * 
 * @package    filmsi
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseFilmAlert extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('film_alert');

        $this->hasColumn('user_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('film_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('cinema', 'bool', null, array(
             'type' => 'bool',
             ));
        $this->hasColumn('stire', 'bool', null, array(
             'type' => 'bool',
             ));
        $this->hasColumn('dbo', 'bool', null, array(
             'type' => 'bool',
             ));
        $this->hasColumn('tv', 'bool', null, array(
             'type' => 'bool',
             ));

        $this->option('symfony', array(
             'filter' => false,
             ));
        $this->option('charset', 'utf8');
    }

    public function setUp()
    {
        parent::setUp();

        $this->hasOne('sfGuardUser as User', array(
             'local' => 'user_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));
        $this->hasOne('Film', array(
             'local' => 'film_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));
    }
}