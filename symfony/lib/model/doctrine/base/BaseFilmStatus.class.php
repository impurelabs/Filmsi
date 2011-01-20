<?php

/**
 * BaseFilmStatus
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $film_id
 * @property bool $in_production
 * @property bool $cinema_status
 * @property integer $cinema_year
 * @property integer $cinema_month
 * @property integer $cinema_day
 * @property bool $dvd_status
 * @property integer $dvd_year
 * @property integer $dvd_month
 * @property integer $dvd_day
 * @property bool $bluray_status
 * @property integer $bluray_year
 * @property integer $bluray_month
 * @property integer $bluray_day
 * @property bool $online_status
 * @property integer $online_year
 * @property integer $online_month
 * @property integer $online_day
 * @property Film $Film
 * 
 * @method integer    getFilmId()        Returns the current record's "film_id" value
 * @method bool       getInProduction()  Returns the current record's "in_production" value
 * @method bool       getCinemaStatus()  Returns the current record's "cinema_status" value
 * @method integer    getCinemaYear()    Returns the current record's "cinema_year" value
 * @method integer    getCinemaMonth()   Returns the current record's "cinema_month" value
 * @method integer    getCinemaDay()     Returns the current record's "cinema_day" value
 * @method bool       getDvdStatus()     Returns the current record's "dvd_status" value
 * @method integer    getDvdYear()       Returns the current record's "dvd_year" value
 * @method integer    getDvdMonth()      Returns the current record's "dvd_month" value
 * @method integer    getDvdDay()        Returns the current record's "dvd_day" value
 * @method bool       getBlurayStatus()  Returns the current record's "bluray_status" value
 * @method integer    getBlurayYear()    Returns the current record's "bluray_year" value
 * @method integer    getBlurayMonth()   Returns the current record's "bluray_month" value
 * @method integer    getBlurayDay()     Returns the current record's "bluray_day" value
 * @method bool       getOnlineStatus()  Returns the current record's "online_status" value
 * @method integer    getOnlineYear()    Returns the current record's "online_year" value
 * @method integer    getOnlineMonth()   Returns the current record's "online_month" value
 * @method integer    getOnlineDay()     Returns the current record's "online_day" value
 * @method Film       getFilm()          Returns the current record's "Film" value
 * @method FilmStatus setFilmId()        Sets the current record's "film_id" value
 * @method FilmStatus setInProduction()  Sets the current record's "in_production" value
 * @method FilmStatus setCinemaStatus()  Sets the current record's "cinema_status" value
 * @method FilmStatus setCinemaYear()    Sets the current record's "cinema_year" value
 * @method FilmStatus setCinemaMonth()   Sets the current record's "cinema_month" value
 * @method FilmStatus setCinemaDay()     Sets the current record's "cinema_day" value
 * @method FilmStatus setDvdStatus()     Sets the current record's "dvd_status" value
 * @method FilmStatus setDvdYear()       Sets the current record's "dvd_year" value
 * @method FilmStatus setDvdMonth()      Sets the current record's "dvd_month" value
 * @method FilmStatus setDvdDay()        Sets the current record's "dvd_day" value
 * @method FilmStatus setBlurayStatus()  Sets the current record's "bluray_status" value
 * @method FilmStatus setBlurayYear()    Sets the current record's "bluray_year" value
 * @method FilmStatus setBlurayMonth()   Sets the current record's "bluray_month" value
 * @method FilmStatus setBlurayDay()     Sets the current record's "bluray_day" value
 * @method FilmStatus setOnlineStatus()  Sets the current record's "online_status" value
 * @method FilmStatus setOnlineYear()    Sets the current record's "online_year" value
 * @method FilmStatus setOnlineMonth()   Sets the current record's "online_month" value
 * @method FilmStatus setOnlineDay()     Sets the current record's "online_day" value
 * @method FilmStatus setFilm()          Sets the current record's "Film" value
 * 
 * @package    filmsi
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseFilmStatus extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('film_status');
        $this->hasColumn('film_id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('in_production', 'bool', null, array(
             'type' => 'bool',
             ));
        $this->hasColumn('cinema_status', 'bool', null, array(
             'type' => 'bool',
             ));
        $this->hasColumn('cinema_year', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('cinema_month', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('cinema_day', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('dvd_status', 'bool', null, array(
             'type' => 'bool',
             ));
        $this->hasColumn('dvd_year', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('dvd_month', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('dvd_day', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('bluray_status', 'bool', null, array(
             'type' => 'bool',
             ));
        $this->hasColumn('bluray_year', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('bluray_month', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('bluray_day', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('online_status', 'bool', null, array(
             'type' => 'bool',
             ));
        $this->hasColumn('online_year', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('online_month', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('online_day', 'integer', null, array(
             'type' => 'integer',
             ));

        $this->option('symfony', array(
             'filter' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Film', array(
             'local' => 'film_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE',
             'onUpdate' => 'CASCADE'));
    }
}