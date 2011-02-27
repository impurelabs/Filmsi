<?php

/**
 * BaseChannelAlert
 * 
 * 
 * @package    filmsi
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseChannelAlert extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('channel_alert');

        $this->hasColumn('user_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('channel_id', 'integer', null, array(
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
        $this->hasOne('Channel', array(
             'local' => 'channel_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));
    }
}