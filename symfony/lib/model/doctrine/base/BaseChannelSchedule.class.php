<?php

/**
 * BaseChannelSchedule
 * 
 
 */
abstract class BaseChannelSchedule extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('channel_schedule');
        $this->hasColumn('channel_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('film_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('day', 'date', null, array(
             'type' => 'date',
             'notnull' => true,
             ));
        $this->hasColumn('time_from', 'string', 250, array(
             'type' => 'string',
             'length' => 250,
             ));
        $this->hasColumn('time_to', 'string', 250, array(
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
        $this->hasOne('Channel', array(
             'local' => 'channel_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE',
             'onUpdate' => 'CASCADE'));

        $this->hasOne('Film', array(
             'local' => 'film_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE',
             'onUpdate' => 'CASCADE'));
    }
}