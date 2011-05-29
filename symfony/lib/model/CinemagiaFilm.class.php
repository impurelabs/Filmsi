<?php

class CinemagiaFilm
{
	private $imdb = null;
	private $filmPullAid = null;
	
	
	public function __construct($filmPullAid) {
		$this->filmPullAid = $filmPullAid;
	}
	
	public function getImdb()
	{
		if (isset($this->imdb)){
			return $this->imdb;
		}
		
		$handle = curl_init('http://www.cinemagia.ro/filme/aa-' . $this->filmPullAid . '/');
		curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($handle, CURLOPT_FOLLOWLOCATION, TRUE);
		
		/* Get the HTML or whatever is linked in $url. */
		$html = curl_exec($handle);
		
		
		/* Check for 404 (file not found). */
		$httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
		
		if($httpCode != 200) {
		    throw new sfException('Nu s-a gasit pagina pe cinemagia.ro pentru codul: ' . $this->filmPullAid);
		}
		curl_close($handle);
		
		$html = str_replace(array("\r", "\r\n", "\n"), '', $html);
		$html = str_replace('  ', '', $html);
		
		if (0 == preg_match('/http:\/\/www.imdb.com\/title\/(.*?)\//i', $html, $matches)){
			return false;
		} else {
			return $matches[1];
		}	
	}
}