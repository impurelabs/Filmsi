<?php

/**
 * BaseLibrary
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 *
 * @property integer $visit_count
 * @property string $type
 * @property string $imdb
 * @property string $name
 * @property date $publish_date
 * @property string $category
 * @property integer $user_id
 * @property enum $state
 * @property integer $photo_album_id
 * @property integer $video_album_id
 * @property sfGuardUser $Author
 * @property PhotoAlbum $PhotoAlbum
 * @property VideoAlbum $VideoAlbum
 *
 * @method integer     getVisitCount()     Returns the current record's "visit_count" value
 * @method string      getType()           Returns the current record's "type" value
 * @method string      getImdb()           Returns the current record's "imdb" value
 * @method string      getName()           Returns the current record's "name" value
 * @method date        getPublishDate()    Returns the current record's "publish_date" value
 * @method string      getCategory()       Returns the current record's "category" value
 * @method integer     getUserId()         Returns the current record's "user_id" value
 * @method enum        getState()          Returns the current record's "state" value
 * @method integer     getPhotoAlbumId()   Returns the current record's "photo_album_id" value
 * @method integer     getVideoAlbumId()   Returns the current record's "video_album_id" value
 * @method sfGuardUser getAuthor()         Returns the current record's "Author" value
 * @method PhotoAlbum  getPhotoAlbum()     Returns the current record's "PhotoAlbum" value
 * @method VideoAlbum  getVideoAlbum()     Returns the current record's "VideoAlbum" value
 * @method Library     setType()           Sets the current record's "type" value
 * @method Library     setImdb()           Sets the current record's "imdb" value
 * @method Library     setName()           Sets the current record's "name" value
 * @method Library     setPublishDate()    Sets the current record's "publish_date" value
 * @method Library     setCategory()       Sets the current record's "category" value
 * @method Library     setUserId()         Sets the current record's "user_id" value
 * @method Library     setState()          Sets the current record's "state" value
 * @method Library     setPhotoAlbumId()   Sets the current record's "photo_album_id" value
 * @method Library     setVideoAlbumId()   Sets the current record's "video_album_id" value
 * @method Library     setAuthor()         Sets the current record's "Author" value
 * @method Library     setPhotoAlbum()     Sets the current record's "PhotoAlbum" value
 * @method Library     setVideoAlbum()     Sets the current record's "VideoAlbum" value
 * 
 * @package    filmsi
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseLibrary extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('library');
        $this->hasColumn('visit_count', 'integer', null, array(
             'type' => 'integer'
             ));
        $this->hasColumn('search_count', 'integer', null, array(
             'type' => 'integer'
             ));
        $this->hasColumn('type', 'string', 250, array(
             'type' => 'string',
             'length' => 250,
             ));
        $this->hasColumn('imdb', 'string', 250, array(
             'type' => 'string',
             'length' => 250,
             ));
        $this->hasColumn('name', 'string', 250, array(
             'type' => 'string',
             'length' => 250,
             ));
        $this->hasColumn('publish_date', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('category', 'string', 250, array(
             'type' => 'string',
             'length' => 250,
             ));
        $this->hasColumn('user_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('state', 'enum', null, array(
             'type' => 'enum',
             'values' => 
             array(
              0 => '-1',
              1 => '0',
              2 => '1',
             ),
             ));
        $this->hasColumn('photo_album_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('video_album_id', 'integer', null, array(
             'type' => 'integer',
             ));

        $this->option('symfony', array(
             'filter' => false,
             'form' => false,
             ));
        $this->option('charset', 'utf8');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('sfGuardUser as Author', array(
             'local' => 'user_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('PhotoAlbum', array(
             'local' => 'id',
             'foreign' => 'library_id'));

        $this->hasOne('VideoAlbum', array(
             'local' => 'id',
             'foreign' => 'library_id'));

        $timestampable0 = new Doctrine_Template_Timestampable(array(
             ));
        $this->actAs($timestampable0);
    }
}