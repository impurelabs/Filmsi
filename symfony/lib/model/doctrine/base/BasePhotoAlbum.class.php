<?php

/**
 * BasePhotoAlbum
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $name
 * @property integer $library_id
 * @property enum $state
 * @property date $publish_date
 * @property integer $user_id
 * @property sfGuardUser $Author
 * @property Library $Library
 * @property Doctrine_Collection $Photos
 * @property Person $Person
 * @property Film $Film
 * @property FestivalEdition $FestivalEdition
 * @property Article $Article
 * @property Stire $Stire
 * 
 * @method string              getName()            Returns the current record's "name" value
 * @method integer             getLibraryId()       Returns the current record's "library_id" value
 * @method enum                getState()           Returns the current record's "state" value
 * @method date                getPublishDate()     Returns the current record's "publish_date" value
 * @method integer             getUserId()          Returns the current record's "user_id" value
 * @method sfGuardUser         getAuthor()          Returns the current record's "Author" value
 * @method Library             getLibrary()         Returns the current record's "Library" value
 * @method Doctrine_Collection getPhotos()          Returns the current record's "Photos" collection
 * @method Person              getPerson()          Returns the current record's "Person" value
 * @method Film                getFilm()            Returns the current record's "Film" value
 * @method FestivalEdition     getFestivalEdition() Returns the current record's "FestivalEdition" value
 * @method Article             getArticle()         Returns the current record's "Article" value
 * @method Stire               getStire()           Returns the current record's "Stire" value
 * @method PhotoAlbum          setName()            Sets the current record's "name" value
 * @method PhotoAlbum          setLibraryId()       Sets the current record's "library_id" value
 * @method PhotoAlbum          setState()           Sets the current record's "state" value
 * @method PhotoAlbum          setPublishDate()     Sets the current record's "publish_date" value
 * @method PhotoAlbum          setUserId()          Sets the current record's "user_id" value
 * @method PhotoAlbum          setAuthor()          Sets the current record's "Author" value
 * @method PhotoAlbum          setLibrary()         Sets the current record's "Library" value
 * @method PhotoAlbum          setPhotos()          Sets the current record's "Photos" collection
 * @method PhotoAlbum          setPerson()          Sets the current record's "Person" value
 * @method PhotoAlbum          setFilm()            Sets the current record's "Film" value
 * @method PhotoAlbum          setFestivalEdition() Sets the current record's "FestivalEdition" value
 * @method PhotoAlbum          setArticle()         Sets the current record's "Article" value
 * @method PhotoAlbum          setStire()           Sets the current record's "Stire" value
 * 
 * @package    filmsi
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasePhotoAlbum extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('photo_album');
        $this->hasColumn('name', 'string', 250, array(
             'type' => 'string',
             'length' => 250,
             ));
        $this->hasColumn('library_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('state', 'enum', null, array(
             'type' => 'enum',
             'values' => 
             array(
              0 => -1,
              1 => 0,
              2 => 1,
             ),
             ));
        $this->hasColumn('publish_date', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('user_id', 'integer', null, array(
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
        $this->hasOne('sfGuardUser as Author', array(
             'local' => 'user_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('Library', array(
             'local' => 'library_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasMany('Photo as Photos', array(
             'local' => 'id',
             'foreign' => 'album_id'));

        $this->hasOne('Person', array(
             'local' => 'id',
             'foreign' => 'photo_album_id'));

        $this->hasOne('Film', array(
             'local' => 'id',
             'foreign' => 'photo_album_id'));

        $this->hasOne('FestivalEdition', array(
             'local' => 'id',
             'foreign' => 'photo_album_id'));

        $this->hasOne('Article', array(
             'local' => 'id',
             'foreign' => 'photo_album_id'));

        $this->hasOne('Cinema', array(
             'local' => 'id',
             'foreign' => 'photo_album_id'));

        $this->hasOne('Stire', array(
             'local' => 'id',
             'foreign' => 'photo_album_id'));

        $inlibrary0 = new inLibrary(array(
             'type_key' => 'PhotoAlbum',
             'has_imdb' => false,
             'has_category' => false,
             'has_photo' => false,
             'has_video' => false,
             ));
        $this->actAs($inlibrary0);
    }
}