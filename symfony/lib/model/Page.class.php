<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Page
 *
 * @author Iulian Manea
 */
class Page {
    const FILM = 0;
    const TRAILERS = 1;
    const ARTICLE = 2;
    const ARTICLES = 3;
    const STIRE = 4;
    const STIRES = 5;
    const STIRE_PUBLISH = 6;
    const CINEMA = 7;
    const CINEMAS = 8;
    const AWARD = 9;
    const AWARDS = 10;
    const IN_CINEMA = 11;
    const ON_DVD = 12;
    const PERSONS = 13;
    const PERSON = 14;
    const SEARCH_RESULTS = 15;
    const OTHER = 16;

	static public function getNameById($id)
	{
		switch ($id){
			case self::FILM: return 'Pagina Film'; break;
			case self::TRAILERS: return 'Trailere'; break;
			case self::ARTICLE: return 'Pagina Articol'; break;
			case self::ARTICLES: return 'Articole'; break;
			case self::STIRE: return 'Pagina stire'; break;
			case self::STIRES: return 'Stiri'; break;
			case self::STIRE_PUBLISH: return 'Publica stire'; break;
			case self::CINEMA: return 'Pagina cinematograf'; break;
			case self::CINEMAS: return 'Cinematografe'; break;
			case self::AWARD: return 'Pagina festival'; break;
			case self::AWARDS: return 'Festivaluri'; break;
			case self::IN_CINEMA: return 'In cinema'; break;
			case self::ON_DVD: return 'Pe DVD si Bluray'; break;
			case self::PERSONS: return 'Actori si regizori'; break;
			case self::PERSON: return 'Persoana'; break;
			case self::SEARCH_RESULTS: return 'Rezultate cautare'; break;
			case self::OTHER: return 'Altele'; break;
		}
	}
}
?>
