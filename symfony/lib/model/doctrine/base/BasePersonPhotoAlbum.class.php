<?php

/**
 * BasePersonPhotoAlbum
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $person_id
 * @property integer $album_id
 * @property Person $Person
 * @property PhotoAlbum $PhotoAlbum
 * 
 * @method integer          getPersonId()   Returns the current record's "person_id" value
 * @method integer          getAlbumId()    Returns the current record's "album_id" value
 * @method Person           getPerson()     Returns the current record's "Person" value
 * @method PhotoAlbum       getPhotoAlbum() Returns the current record's "PhotoAlbum" value
 * @method PersonPhotoAlbum setPersonId()   Sets the current record's "person_id" value
 * @method PersonPhotoAlbum setAlbumId()    Sets the current record's "album_id" value
 * @method PersonPhotoAlbum setPerson()     Sets the current record's "Person" value
 * @method PersonPhotoAlbum setPhotoAlbum() Sets the current record's "PhotoAlbum" value
 * 
 * @package    filmsi
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasePersonPhotoAlbum extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('person_photo_album');
        $this->hasColumn('person_id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('album_id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));

        $this->option('symfony', array(
             'form' => false,
             'filter' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Person', array(
             'local' => 'person_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('PhotoAlbum', array(
             'local' => 'album_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));
    }
}