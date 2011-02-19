<?php

/**
 * BaseCinemaVote
 * 
 * @package    cinemasi
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseCinemaVote extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('cinema_vote');
        $this->hasColumn('cinema_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('grade', 'enum', null, array(
             'type' => 'enum',
             'values' =>
             array(
              0 => 1, 1 => 2, 2 => 3, 3 => 4, 4 => 5, 5 => 6, 6 => 7, 7 => 8, 8 => 9, 9 => 10
             ),
             ));
        $this->hasColumn('ip', 'string', 100, array(
             'type' => 'string',
             'length' => 100,
             ));

        $this->option('symfony', array(
             'filter' => false,
             ));
        $this->option('charset', 'utf8');
    }

    public function setUp()
    {
        parent::setUp();
        $timestampable0 = new Doctrine_Template_Timestampable(array(
             'updated' => 
             array(
              'disabled' => true,
             ),
             ));
        $this->actAs($timestampable0);
    }
}