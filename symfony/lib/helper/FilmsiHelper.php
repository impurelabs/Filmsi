<?php

function filmsiPhoto($sourceimage)
{
	return sfConfig::get('app_photos_path_for_web') . '/' . $sourceimage;
}

function filmsiPhotoThumb($sourceimage)
{
  return sfConfig::get('app_photos_path_for_web') . '/t-' . $sourceimage;
}

function filmsiPhotoThumbS($sourceimage)
{
  return sfConfig::get('app_photos_path_for_web') . '/ts-' . $sourceimage;
}

function filmsiState($stateCode)
{
	switch ($stateCode){
		case '-1': return 'draft'; break;
		case '0': return 'pending'; break;
		case '1': return 'activ'; break;
	}
}

function filmsiVideoThumb($code)
{
	return 'http://img.youtube.com/vi/' . $code . '/default.jpg';
}

function filmsiVideo($code)
{
	return <<<FILMSI
<object width="640" height="385"><param name="movie" value="http://www.youtube.com/v/$code?fs=1&amp;hl=en_US"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube.com/v/$code?fs=1&amp;hl=en_US" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="640" height="385"></embed></object>
	
FILMSI;
}

function filmsiPersonPhoto($sourceimage)
{
	return sfConfig::get('app_person_path_for_web') . '/' . $sourceimage;
}

function filmsiPersonPhotoThumb($sourceimage)
{
  return sfConfig::get('app_person_path_for_web') . '/t-' . $sourceimage;
}

function filmsiPersonPhotoThumbS($sourceimage)
{
  return sfConfig::get('app_person_path_for_web') . '/ts-' . $sourceimage;
}

function filmsiFilmBackground($sourceimage)
{
	return sfConfig::get('app_film_background_path_for_web') . '/' . $sourceimage;
}

function filmsiFilmPhoto($sourceimage)
{
	return sfConfig::get('app_film_path_for_web') . '/' . $sourceimage;
}

function filmsiFilmPhotoThumb($sourceimage)
{
  return sfConfig::get('app_film_path_for_web') . '/t-' . $sourceimage;
}

function filmsiFilmPhotoThumbS($sourceimage)
{
  return sfConfig::get('app_film_path_for_web') . '/ts-' . $sourceimage;
}

function filmsiFestivalEditionPhoto($sourceimage)
{
	return sfConfig::get('app_festival_edition_path_for_web') . '/' . $sourceimage;
}

function filmsiFestivalEditionPhotoThumb($sourceimage)
{
  return sfConfig::get('app_festival_edition_path_for_web') . '/t-' . $sourceimage;
}

function filmsiFestivalEditionPhotoThumbS($sourceimage)
{
  return sfConfig::get('app_festival_edition_path_for_web') . '/ts-' . $sourceimage;
}

function filmsiCinemaPhoto($sourceimage)
{
	return sfConfig::get('app_cinema_path_for_web') . '/' . $sourceimage;
}

function filmsiCinemaPhotoThumb($sourceimage)
{
  return sfConfig::get('app_cinema_path_for_web') . '/t-' . $sourceimage;
}

function filmsiCinemaPhotoThumbS($sourceimage)
{
  return sfConfig::get('app_cinema_path_for_web') . '/ts-' . $sourceimage;
}

function filmsiCinemaPromotionPhoto($sourceimage)
{
	return sfConfig::get('app_cinemapromotion_path_for_web') . '/' . $sourceimage;
}

function filmsiCinemaPromotionPhotoThumb($sourceimage)
{
  return sfConfig::get('app_cinemapromotion_path_for_web') . '/t-' . $sourceimage;
}

function filmsiCinemaPromotionPhotoThumbS($sourceimage)
{
  return sfConfig::get('app_cinemapromotion_path_for_web') . '/ts-' . $sourceimage;
}

function filmsiArticlePhoto($sourceimage)
{
	return sfConfig::get('app_article_path_for_web') . '/' . $sourceimage;
}

function filmsiArticlePhotoThumb($sourceimage)
{
  return sfConfig::get('app_article_path_for_web') . '/t-' . $sourceimage;
}

function filmsiArticlePhotoThumbS($sourceimage)
{
  return sfConfig::get('app_article_path_for_web') . '/ts-' . $sourceimage;
}

function filmsiStirePhoto($sourceimage)
{
	return sfConfig::get('app_stire_path_for_web') . '/' . $sourceimage;
}

function filmsiStirePhotoThumb($sourceimage)
{
  return sfConfig::get('app_stire_path_for_web') . '/t-' . $sourceimage;
}

function filmsiStirePhotoThumbS($sourceimage)
{
  return sfConfig::get('app_stire_path_for_web') . '/ts-' . $sourceimage;
}

function filmsiShopPhoto($sourceimage)
{
	return sfConfig::get('app_shop_path_for_web') . '/' . $sourceimage;
}

function filmsiShopPhotoThumb($sourceimage)
{
  return sfConfig::get('app_shop_path_for_web') . '/t-' . $sourceimage;
}

function filmsiShopPhotoThumbS($sourceimage)
{
  return sfConfig::get('app_shop_path_for_web') . '/ts-' . $sourceimage;
}

function filmsiStatusCinemaExplained($film)
{
	if (!$film->getStatusCinema()){
		return 'nu';
	}
	
	if ($film->getStatusCinemaYear() != '0' && $film->getStatusCinemaMonth() != '0' && $film->getStatusCinemaDay() != '0'){
		return 'din ' . format_date($film->getStatusCinemaYear() . '-' . $film->getStatusCinemaMonth() . '-' . $film->getStatusCinemaDay(), 'D', 'ro');
	}
	
	if ($film->getStatusCinemaYear() != '0' && $film->getStatusCinemaMonth() != '0'){
		return 'din ' .  format_date($film->getStatusCinemaYear() . '-' . $film->getStatusCinemaMonth(), 'Y', 'ro');
	}
	
	return 'in curand';
}

function filmsiStatusDvdExplained($film)
{
	if (!$film->getStatusDvd()){
		return 'nu';
	}
	
	if ($film->getStatusDvdYear() != '0' && $film->getStatusDvdMonth() != '0' && $film->getStatusDvdDay() != '0'){
		return 'din ' . format_date($film->getStatusDvdYear() . '-' . $film->getStatusDvdMonth() . '-' . $film->getStatusDvdDay(), 'D', 'ro');
	}
	
	if ($film->getStatusDvdYear() != '0' && $film->getStatusDvdMonth() != '0'){
		return 'din ' .  format_date($film->getStatusDvdYear() . '-' . $film->getStatusDvdMonth(), 'Y', 'ro');
	}
	
	return 'in curand';
}

function filmsiStatusBlurayExplained($film)
{
	if (!$film->getStatusBluray()){
		return 'nu';
	}
	
	if ($film->getStatusBlurayYear() != '0' && $film->getStatusBlurayMonth() != '0' && $film->getStatusBlurayDay() != '0'){
		return 'din ' . format_date($film->getStatusBlurayYear() . '-' . $film->getStatusBlurayMonth() . '-' . $film->getStatusBlurayDay(), 'D', 'ro');
	}
	
	if ($film->getStatusBlurayYear() != '0' && $film->getStatusBlurayMonth() != '0'){
		return 'din ' .  format_date($film->getStatusBlurayYear() . '-' . $film->getStatusBlurayMonth(), 'Y', 'ro');
	}
	
	return 'in curand';
}

function filmsiStatusOnlineExplained($film)
{
	if (!$film->getStatusOnline()){
		return 'nu';
	}
	
	if ($film->getStatusOnlineYear() != '0' && $film->getStatusOnlineMonth() != '0' && $film->getStatusOnlineDay() != '0'){
		return 'din ' . format_date($film->getStatusOnlineYear() . '-' . $film->getStatusOnlineMonth() . '-' . $film->getStatusOnlineDay(), 'D', 'ro');
	}
	
	if ($film->getStatusOnlineYear() != '0' && $film->getStatusOnlineMonth() != '0'){
		return 'din ' .  format_date($film->getStatusOnlineYear() . '-' . $film->getStatusOnlineMonth(), 'Y', 'ro');
	}
	
	return 'in curand';
}

function filmsiContentLocationName($contentId)
{
	return sfConfig::get('app_content_name_' . $contentId);
}

function filmsiContentLocationWidth($contentId)
{
	return sfConfig::get('app_content_width_' . $contentId);
}

function filmsiHomepageBackground($sourceimage)
{
	return sfConfig::get('app_homepage_background_path_for_web') . '/' . $sourceimage;
}