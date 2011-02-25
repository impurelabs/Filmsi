<?php

/**
 * BaseChannel
 *
 * @package    filmsi
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseChannel extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('channel');
        $this->hasColumn('name', 'string', 250, array(
             'type' => 'string',
             'length' => 250,
             ));
        $this->hasColumn('filename', 'string', 250, array(
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

        $this->hasMany('ChannelSchedule as Schedule', array(
             'local' => 'id',
             'foreign' => 'channel_id'));
    }
}