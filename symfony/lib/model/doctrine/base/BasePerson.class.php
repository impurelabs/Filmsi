<?php

/**
 * BasePerson
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $first_name
 * @property string $last_name
 * @property date $date_of_birth
 * @property date $date_of_death
 * @property string $place_of_birth
 * @property string $filename
 * @property string $biography_teaser
 * @property text $biography_content
 * @property string $meta_description
 * @property string $meta_keywords
 * @property string $url_key
 * @property enum $state
 * @property string $imdb
 * @property bool $is_actor
 * @property bool $is_director
 * @property bool $is_scriptwriter
 * @property bool $is_producer
 * @property date $publish_date
 * @property integer $user_id
 * @property integer $library_id
 * @property integer $photo_album_id
 * @property integer $video_album_id
 * @property PhotoAlbum $PhotoAlbum
 * @property VideoAlbum $VideoAlbum
 * @property Doctrine_Collection $Films
 * @property sfGuardUser $Author
 * @property Doctrine_Collection $Article
 * @property Doctrine_Collection $FilmPerson
 * @property Doctrine_Collection $FestivalSection
 * @property Doctrine_Collection $FestivalSectionPerson
 * @property Doctrine_Collection $PersonArticle
 * @property Doctrine_Collection $Stires
 * @property Doctrine_Collection $PersonStire
 * 
 * @method string              getFirstName()             Returns the current record's "first_name" value
 * @method string              getLastName()              Returns the current record's "last_name" value
 * @method date                getDateOfBirth()           Returns the current record's "date_of_birth" value
 * @method date                getDateOfDeath()           Returns the current record's "date_of_death" value
 * @method string              getPlaceOfBirth()          Returns the current record's "place_of_birth" value
 * @method string              getFilename()              Returns the current record's "filename" value
 * @method string              getBiographyTeaser()       Returns the current record's "biography_teaser" value
 * @method text                getBiographyContent()      Returns the current record's "biography_content" value
 * @method string              getMetaDescription()       Returns the current record's "meta_description" value
 * @method string              getMetaKeywords()          Returns the current record's "meta_keywords" value
 * @method string              getUrlKey()                Returns the current record's "url_key" value
 * @method enum                getState()                 Returns the current record's "state" value
 * @method string              getImdb()                  Returns the current record's "imdb" value
 * @method bool                getIsActor()               Returns the current record's "is_actor" value
 * @method bool                getIsDirector()            Returns the current record's "is_director" value
 * @method bool                getIsScriptwriter()        Returns the current record's "is_scriptwriter" value
 * @method bool                getIsProducer()            Returns the current record's "is_producer" value
 * @method date                getPublishDate()           Returns the current record's "publish_date" value
 * @method integer             getUserId()                Returns the current record's "user_id" value
 * @method integer             getLibraryId()             Returns the current record's "library_id" value
 * @method integer             getPhotoAlbumId()          Returns the current record's "photo_album_id" value
 * @method integer             getVideoAlbumId()          Returns the current record's "video_album_id" value
 * @method PhotoAlbum          getPhotoAlbum()            Returns the current record's "PhotoAlbum" value
 * @method VideoAlbum          getVideoAlbum()            Returns the current record's "VideoAlbum" value
 * @method Doctrine_Collection getFilms()                 Returns the current record's "Films" collection
 * @method sfGuardUser         getAuthor()                Returns the current record's "Author" value
 * @method Doctrine_Collection getArticle()               Returns the current record's "Article" collection
 * @method Doctrine_Collection getFilmPerson()            Returns the current record's "FilmPerson" collection
 * @method Doctrine_Collection getFestivalSection()       Returns the current record's "FestivalSection" collection
 * @method Doctrine_Collection getFestivalSectionPerson() Returns the current record's "FestivalSectionPerson" collection
 * @method Doctrine_Collection getPersonArticle()         Returns the current record's "PersonArticle" collection
 * @method Doctrine_Collection getStires()                Returns the current record's "Stires" collection
 * @method Doctrine_Collection getPersonStire()           Returns the current record's "PersonStire" collection
 * @method Person              setFirstName()             Sets the current record's "first_name" value
 * @method Person              setLastName()              Sets the current record's "last_name" value
 * @method Person              setDateOfBirth()           Sets the current record's "date_of_birth" value
 * @method Person              setDateOfDeath()           Sets the current record's "date_of_death" value
 * @method Person              setPlaceOfBirth()          Sets the current record's "place_of_birth" value
 * @method Person              setFilename()              Sets the current record's "filename" value
 * @method Person              setBiographyTeaser()       Sets the current record's "biography_teaser" value
 * @method Person              setBiographyContent()      Sets the current record's "biography_content" value
 * @method Person              setMetaDescription()       Sets the current record's "meta_description" value
 * @method Person              setMetaKeywords()          Sets the current record's "meta_keywords" value
 * @method Person              setUrlKey()                Sets the current record's "url_key" value
 * @method Person              setState()                 Sets the current record's "state" value
 * @method Person              setImdb()                  Sets the current record's "imdb" value
 * @method Person              setIsActor()               Sets the current record's "is_actor" value
 * @method Person              setIsDirector()            Sets the current record's "is_director" value
 * @method Person              setIsScriptwriter()        Sets the current record's "is_scriptwriter" value
 * @method Person              setIsProducer()            Sets the current record's "is_producer" value
 * @method Person              setPublishDate()           Sets the current record's "publish_date" value
 * @method Person              setUserId()                Sets the current record's "user_id" value
 * @method Person              setLibraryId()             Sets the current record's "library_id" value
 * @method Person              setPhotoAlbumId()          Sets the current record's "photo_album_id" value
 * @method Person              setVideoAlbumId()          Sets the current record's "video_album_id" value
 * @method Person              setPhotoAlbum()            Sets the current record's "PhotoAlbum" value
 * @method Person              setVideoAlbum()            Sets the current record's "VideoAlbum" value
 * @method Person              setFilms()                 Sets the current record's "Films" collection
 * @method Person              setAuthor()                Sets the current record's "Author" value
 * @method Person              setArticle()               Sets the current record's "Article" collection
 * @method Person              setFilmPerson()            Sets the current record's "FilmPerson" collection
 * @method Person              setFestivalSection()       Sets the current record's "FestivalSection" collection
 * @method Person              setFestivalSectionPerson() Sets the current record's "FestivalSectionPerson" collection
 * @method Person              setPersonArticle()         Sets the current record's "PersonArticle" collection
 * @method Person              setStires()                Sets the current record's "Stires" collection
 * @method Person              setPersonStire()           Sets the current record's "PersonStire" collection
 * 
 * @package    filmsi
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasePerson extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('person');
        $this->hasColumn('visit_count', 'integer', null, array(
             'type' => 'integer'
             ));
        $this->hasColumn('first_name', 'string', 250, array(
             'type' => 'string',
             'length' => 250,
             ));
        $this->hasColumn('last_name', 'string', 250, array(
             'type' => 'string',
             'length' => 250,
             ));
        $this->hasColumn('date_of_birth', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('date_of_death', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('place_of_birth', 'string', 250, array(
             'type' => 'string',
             'length' => 250,
             ));
        $this->hasColumn('filename', 'string', 250, array(
             'type' => 'string',
             'length' => 250,
             ));
        $this->hasColumn('biography_teaser', 'string', 250, array(
             'type' => 'string',
             'length' => 250,
             ));
        $this->hasColumn('biography_content', 'text', null, array(
             'type' => 'text',
             ));
        $this->hasColumn('meta_description', 'string', 250, array(
             'type' => 'string',
             'length' => 250,
             ));
        $this->hasColumn('meta_keywords', 'string', 250, array(
             'type' => 'string',
             'length' => 250,
             ));
        $this->hasColumn('url_key', 'string', 250, array(
             'type' => 'string',
             'length' => 250,
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
        $this->hasColumn('imdb', 'string', 250, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 250,
             ));
        $this->hasColumn('is_actor', 'bool', null, array(
             'type' => 'bool',
             ));
        $this->hasColumn('is_director', 'bool', null, array(
             'type' => 'bool',
             ));
        $this->hasColumn('is_scriptwriter', 'bool', null, array(
             'type' => 'bool',
             ));
        $this->hasColumn('is_producer', 'bool', null, array(
             'type' => 'bool',
             ));
        $this->hasColumn('publish_date', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('user_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('library_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('photo_album_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('video_album_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('no_display', 'bool', null, array(
             'type' => 'bool',
             ));

        $this->option('symfony', array(
             'filter' => false,
             ));
        $this->option('charset', 'utf8');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('PhotoAlbum', array(
             'local' => 'photo_album_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('VideoAlbum', array(
             'local' => 'video_album_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasMany('Film as Films', array(
             'refClass' => 'FilmPerson',
             'local' => 'person_id',
             'foreign' => 'film_id'));

        $this->hasOne('sfGuardUser as Author', array(
             'local' => 'user_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasMany('Article', array(
             'refClass' => 'PersonArticle',
             'local' => 'person_id',
             'foreign' => 'article_id'));

        $this->hasMany('FilmPerson', array(
             'local' => 'id',
             'foreign' => 'person_id'));

        $this->hasMany('FestivalJudge', array(
             'local' => 'id',
             'foreign' => 'person_id'));

        $this->hasMany('FestivalEdition as FestivalEditions', array(
             'refClass' => 'FestivalJudge',
             'local' => 'person_id',
             'foreign' => 'festival_edition_id'));

        $this->hasMany('FestivalSection', array(
             'refClass' => 'FestivalSectionPerson',
             'local' => 'person_id',
             'foreign' => 'festival_section_id'));

        $this->hasMany('FestivalSectionPerson', array(
             'local' => 'id',
             'foreign' => 'person_id'));

        $this->hasMany('PersonArticle', array(
             'local' => 'id',
             'foreign' => 'person_id'));

        $this->hasMany('Stire as Stires', array(
             'refClass' => 'PersonStire',
             'local' => 'person_id',
             'foreign' => 'stire_id'));

        $this->hasMany('PersonStire', array(
             'local' => 'id',
             'foreign' => 'person_id'));

        $inlibrary0 = new inLibrary(array(
             'type_key' => 'Person',
             'has_imdb' => true,
             'has_category' => false,
             'has_photo' => true,
             'has_video' => true,
             ));
        $this->actAs($inlibrary0);

		$timestampable0 = new Doctrine_Template_Timestampable(array(
             ));
        $this->actAs($timestampable0);
    }
}