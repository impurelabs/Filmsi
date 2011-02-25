<?php

/**
 * BaseSearchIndex
 * 
 * 
 * @property text $content
 * @property string $type
 * @property text $params
 * 
 * @package    filmsi
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseSearchIndex extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('search_index');
        $this->hasColumn('content', 'text', null, array(
             'type' => 'text',
             ));
        $this->hasColumn('model', 'string', 45, array(
             'type' => 'string',
             'length' => 45,
             'primary' => true,
             ));
        $this->hasColumn('model_id', 'string', 45, array(
             'type' => 'string',
             'length' => 250,
             'primary' => true,
             ));

        $this->option('symfony', array(
             'filter' => false,
             ));
        $this->option('charset', 'utf8');
        $this->option('type', 'MyISAM');
		$this->index('content', array(
			'fields' => array('content'),
			'type' => 'fulltext'
		));
    }
}