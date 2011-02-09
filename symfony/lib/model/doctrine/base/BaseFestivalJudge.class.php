<?php

/**
 * BaseFestivalJudge
 * 
 * @package    filmsi
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseFestivalJudge extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('festival_judge');
        $this->hasColumn('festival_edition_id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('person_id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->option('symfony', array(
             'filter' => false,
             ));
        $this->option('charset', 'utf8');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('FestivalEdition', array(
             'local' => 'festival_edition_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('Person', array(
             'local' => 'person_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));
    }
}