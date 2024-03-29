<?php

/**
 * BaseFestivalSectionFilm
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $festival_section_id
 * @property integer $film_id
 * @property bool $is_nominee
 * @property bool $is_winner
 * @property FestivalSection $FestivalSection
 * @property Film $Film
 * 
 * @method integer             getFestivalSectionId()   Returns the current record's "festival_section_id" value
 * @method integer             getFilmId()              Returns the current record's "film_id" value
 * @method bool                getIsNominee()           Returns the current record's "is_nominee" value
 * @method bool                getIsWinner()            Returns the current record's "is_winner" value
 * @method FestivalSection     getFestivalSection()     Returns the current record's "FestivalSection" value
 * @method Film                getFilm()                Returns the current record's "Film" value
 * @method FestivalSectionFilm setFestivalSectionId()   Sets the current record's "festival_section_id" value
 * @method FestivalSectionFilm setFilmId()              Sets the current record's "film_id" value
 * @method FestivalSectionFilm setIsNominee()           Sets the current record's "is_nominee" value
 * @method FestivalSectionFilm setIsWinner()            Sets the current record's "is_winner" value
 * @method FestivalSectionFilm setFestivalSection()     Sets the current record's "FestivalSection" value
 * @method FestivalSectionFilm setFilm()                Sets the current record's "Film" value
 * 
 * @package    filmsi
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseFestivalSectionFilm extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('festival_section_film');
        $this->hasColumn('festival_section_id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('film_id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('is_nominee', 'bool', null, array(
             'type' => 'bool',
             ));
        $this->hasColumn('is_winner', 'bool', null, array(
             'type' => 'bool',
             ));

        $this->option('symfony', array(
             'form' => false,
             'filter' => false,
             ));
        $this->option('charset', 'utf8');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('FestivalSection', array(
             'local' => 'festival_section_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('Film', array(
             'local' => 'film_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));
    }
}