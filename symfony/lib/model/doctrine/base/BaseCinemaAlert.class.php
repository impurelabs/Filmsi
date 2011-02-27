<?php

/**
 * BaseCinemaAlert
 * 
 * 
 * @package    filmsi
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseCinemaAlert extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('cinema_alert');

        $this->hasColumn('user_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('cinema_id', 'integer', null, array(
             'type' => 'integer',
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
        $this->hasOne('Cinema', array(
             'local' => 'cinema_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));
    }
}