<?php
/**
 * Description of Gadget
 *
 * @author Iulian Manea
 */
class Gadget {
    const MOST_READ_ARTICLES = 0;
    const MOST_COMMENTED_ARTICLES = 1;
    const NOW_ON_DBO = 2;
    const CINEMA_RESERVATIONS = 3;
    const BOX_OFFICE_RO = 4;
    const BOX_OFFICE_US = 5;
    const NOW_ON_TV = 6;
    const SHOPS = 7;
    const NEWEST_TRAILERS = 8;
    const NEWEST_PHOTOS = 9;
    const NEWEST_ARTICLES = 10;
    const NEWEST_STIRES = 11;
    const MOST_READ_STIRES = 12;
    const MOST_COMMENTED_STIRES = 13;

	static public function getNameById($id)
	{
		switch ($id){
			case self::MOST_READ_ARTICLES: return 'Cele mai citite articole'; break;
			case self::MOST_COMMENTED_ARTICLES: return 'Cele mai comentate articole'; break;
			case self::NOW_ON_DBO: return 'Acum pe DVD si Bluray'; break;
			case self::CINEMA_RESERVATIONS: return 'Rezervari cinema'; break; 
			case self::BOX_OFFICE_RO: return 'Box Office RO'; break;
			case self::BOX_OFFICE_US: return 'Box Office US'; break;
			case self::NOW_ON_TV: return 'Acum la tv'; break;
			case self::SHOPS: return 'Magazine'; break;
			case self::NEWEST_TRAILERS: return 'Cele mai noi trailere'; break;
			case self::NEWEST_PHOTOS: return 'Cele mai noi fotografii'; break;
			case self::NEWEST_ARTICLES: return 'Cele mai noi articole'; break;
			case self::NEWEST_STIRES: return 'Cele mai noi stiri'; break;
			case self::MOST_READ_STIRES: return 'Cele mai citite stiri'; break;
			case self::MOST_COMMENTED_STIRES: return 'Cele mai comentate stiri'; break;
		}
	}

	static public function getHeightById($id)
	{
		switch ($id){
			case self::MOST_READ_ARTICLES: return 345; break;
			case self::MOST_COMMENTED_ARTICLES: return 345; break;
			case self::NOW_ON_DBO: return 590; break;
			case self::CINEMA_RESERVATIONS: return 125; break;
			case self::BOX_OFFICE_RO: return 300; break;
			case self::BOX_OFFICE_US: return 300; break;
			case self::NOW_ON_TV: return 530; break;
			case self::SHOPS: return 282; break;
			case self::NEWEST_TRAILERS: return 405; break;
			case self::NEWEST_PHOTOS: return 210; break;
			case self::NEWEST_ARTICLES: return 345; break;
			case self::NEWEST_STIRES: return 345; break;
			case self::MOST_READ_STIRES: return 345; break;
			case self::MOST_COMMENTED_STIRES: return 345; break;
		}
	}
}
?>
