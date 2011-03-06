<?php

abstract class BasePageGadget extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('page_gadget');
        $this->hasColumn('page', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('gadget', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));

        $this->option('symfony', array(
             'form' => false,
             'filter' => false,
             ));
        $this->option('charset', 'utf8');
    }
}