<?php
class ImdbComPerson
{
	protected $params = array(
		'name' => '',
		'roles' => array(),
		'filename-source' => '',
		'date_of_birth_year' => '',
		'date_of_birth_month' => '',
		'date_of_birth_day' => '',
		'date_of_death_year' => '',
		'date_of_death_month' => '',
		'date_of_death_day' => '',
		'place_of_birth' => '',
		'bio' => '',
	  'acted_films' => array(),
	  'directed_films' => array(),
	  'produced_films' => array(),
	  'written_films' => array(),
	  'awards' => array(),
	);
	protected $imdbCode;

	protected $photos = array();
	
	
	public function __construct($imdbCode)
	{		
		$this->imdbCode = $imdbCode;
	}

	public function parseNamePage()
	{
		$handle = curl_init('http://www.imdb.com/name/' . $this->imdbCode . '/');
		curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);
		
		/* Get the HTML or whatever is linked in $url. */
		$response = curl_exec($handle);
		
		/* Check for 404 (file not found). */
		$httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
		if($httpCode != 200) {
		    throw new ImdbComPersonException('The page for the person is missing');
		}
		curl_close($handle);
		
		
  	$html = str_replace(array("\r", "\r\n", "\n"), '', $response);
	$html = str_replace('  ', ' ', $html);
  	
  	
  	preg_match('/<h1 class="header">(.*?)</i', $html, $matches);
  	if (isset($matches[1])){
  		$this->params['name'] = htmlentities(trim($matches[1]));
  	}
  	unset($matches);
  	
  	preg_match('/<div class="infobar">(.*?)<\/div>/i', $html, $matches);
  	preg_match_all('/<a\b[^>]*>(.*?)<\/a>/i', $matches[1], $matches);
  	if (isset($matches[1])){
  		$this->params['roles'] = $matches[1];
  	}
  	unset($matches);
  	
  	preg_match('/<td id="img_primary" rowspan="2">(.*?)<\/td>/i', $html, $matches);
  	preg_match('/src="([^"]*)"/i', $matches[1], $matches);
  	if (isset($matches[1])){
  		$this->params['filename-source'] = trim($matches[1]);
  	}
  	unset($matches);
  	
  	/* All films the person directed */ 
  	preg_match('/<div id="filmo-head-Director.*?<div style="display:none;">(<div class="filmo-row[^>]*>(.*?)<div class="clear"\/>&nbsp;<\/div><\/div>)<\/div>/i', $html, $matches);
  	preg_match_all('/href="\/title\/(.*?)\/"/i', $matches[0], $matches);
  	if (isset($matches[1])){
  		$this->params['directed_films'] = $matches[1];
  	}
  	unset($matches);

  	/* All films the person acted in*/
  	preg_match('/<div id="filmo-head-Actor.*?(<div class="filmo-row[^>]*>(.*?)<div class="clear"\/>&nbsp;<\/div><\/div>)<\/div>/i', $html, $matches);
	if(!isset($matches[0])){
		preg_match('/<div id="filmo-head-Actress.*?(<div class="filmo-row[^>]*>(.*?)<div class="clear"\/>&nbsp;<\/div><\/div>)<\/div>/i', $html, $matches);
	}
	//die('este:' . $matches[0]);
  	preg_match_all('/href="\/title\/(.*?)\/"/i', $matches[0], $matches);
  	if (isset($matches[1])){
  		$this->params['acted_films'] = $matches[1];
  	}
	//echo '<pre>'; var_dump($this->params['acted_films']); exit;
  	unset($matches);

  	/* All films the person was thanked in add to actors*/
  	preg_match('/<div id="filmo-head-Thanks.*?(<div class="filmo-row[^>]*>(.*?)<div class="clear"\/>&nbsp;<\/div><\/div>)<\/div>/i', $html, $matches);
	//die('este:' . $matches[0]);
  	preg_match_all('/href="\/title\/(.*?)\/"/i', $matches[0], $matches);
  	if (isset($matches[1])){
  		$this->params['acted_films'] = array_merge($this->params['acted_films'], $matches[1]);
  	}
	//echo '<pre>'; var_dump($this->params['acted_films']); exit;
  	unset($matches);

  	/* All films the person was him/herself in add to actors*/
  	preg_match('/<div id="filmo-head-Self.*?(<div class="filmo-row[^>]*>(.*?)<div class="clear"\/>&nbsp;<\/div><\/div>)<\/div>/i', $html, $matches);
	//die('este:' . $matches[0]);
  	preg_match_all('/href="\/title\/(.*?)\/"/i', $matches[0], $matches);
  	if (isset($matches[1])){
  		$this->params['acted_films'] = array_merge($this->params['acted_films'], $matches[1]);
  	}
	//echo '<pre>'; var_dump($this->params['acted_films']); exit;
  	unset($matches);
  	
  	/* All films the person produced */ 
  	preg_match('/<div id="filmo-head-Producer.*?<div style="display:none;">(<div class="filmo-row[^>]*>(.*?)<div class="clear"\/>&nbsp;<\/div><\/div>)<\/div>/i', $html, $matches);
  	preg_match_all('/href="\/title\/(.*?)\/"/i', $matches[0], $matches);
  	if (isset($matches[1])){
  		$this->params['produced_films'] = $matches[1];
  	}
  	unset($matches);
  	
  	/* All films the person wrote */ 
  	preg_match('/<div id="filmo-head-Writer.*?<div style="display:none;">(<div class="filmo-row[^>]*>(.*?)<div class="clear"\/>&nbsp;<\/div><\/div>)<\/div>/i', $html, $matches);
  	preg_match_all('/href="\/title\/(.*?)\/"/i', $matches[0], $matches);
  	if (isset($matches[1])){
  		$this->params['written_films'] = $matches[1];
  	}
  	unset($matches);
	}
	
	public function parseBioPage()
	{
		$handle = curl_init('http://www.imdb.com/name/' . $this->imdbCode . '/bio');
		curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);
		
		/* Get the HTML or whatever is linked in $url. */
		$response = curl_exec($handle);
		
		/* Check for 404 (file not found). */
		$httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
		if($httpCode != 200) {
		    return;
		}
		curl_close($handle);
		
		
		
		
		
		
  	$html = str_replace(array("\r", "\r\n", "\n"), '', $response);
	$html = str_replace('  ', ' ', $html);
  	
  	
  	preg_match('/<h5>Date of Birth<\/h5><a href="\/date\/(\d*?)-(\d*?)\/">/i', $html, $matches);
  	if (isset($matches[1])){
	  	$this->params['date_of_birth_month'] = htmlentities(trim($matches[1]));
	  	$this->params['date_of_birth_day'] = trim($matches[2]);
  	}
  	unset($matches);
  	
  	preg_match('/<a href="\/search\/name\?birth_year=(\d*)">/i', $html, $matches);
  	if (isset($matches[1])){
  		$this->params['date_of_birth_year'] = trim($matches[1]);
  	}
  	unset($matches);
  	
  	preg_match('/<h5>Date of Death<\/h5><a href="\/date\/(\d*?)-(\d*?)\/">/i', $html, $matches);
  	if (isset($matches[1])){
	  	$this->params['date_of_death_month'] = trim($matches[1]);
	  	$this->params['date_of_death_day'] = trim($matches[2]);
  	}
  	unset($matches);
  	
  	preg_match('/<a href="\/search\/name\?death_date=(\d*)">/i', $html, $matches);
  	if (isset($matches[1])){
  		$this->params['date_of_death_year'] = trim($matches[1]);
  	}
  	unset($matches);
  	
  	preg_match('/<a href="\/search\/name\?birth_place=.*?">(.*?)<\/a>/i', $html, $matches);
  	if (isset($matches[1])){
  		$this->params['place_of_birth'] = htmlentities(trim($matches[1]));
  	}
  	
  	unset($matches);
  	
  	preg_match('/<h5>Mini Biography<\/h5>(.*?)<b>IMDb Mini Biography By/i', $html, $matches);
	
  	if (isset($matches[1])){
  		$this->params['bio'] = utf8_encode($matches[1]);
  	}
  	unset($matches);
	}

	public function parseAwardsPage()
	{
		$handle = curl_init('http://www.imdb.com/name/' . $this->imdbCode . '/awards');
		curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);

		/* Get the HTML or whatever is linked in $url. */
		$response = curl_exec($handle);

		/* Check for 404 (file not found). */
		$httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
		if($httpCode != 200) {
		    return;
		}
		curl_close($handle);





		$html = str_replace(array("\r", "\r\n", "\n"), '', $response);
		$html = str_replace('  ', '', $html);

		/* Get the content of the awards table */
		if (0 == preg_match('/<table cellspacing="2" cellpadding="2" border="1">(.*?)<\/table>/i', $html, $matches)){
			return;
		}

		/* Create an array with all the rows */
		preg_match_all('/<tr>(.*?)<\/tr>/i', $matches[0], $matches);
		$rows = $matches[1];

		$result = array(
			'imdbKey' => '',
			'festivalEdition' => '', // the year
			'status' => '', // nominated or won
			'festivalSection' => '',
			'filmImdbs' => array()
		);
		foreach ($rows as $row){
			$row = trim($row);

			/* Check if this is the big row */
			if (0 != preg_match('/<big><a href="\/Sections\/Awards\/(.*?)\//i', $row, $matches)){
				$result['imdbKey'] = $matches[1];
				continue;
			}

			if (0 != preg_match('/<th>/i', $row)){
				continue;
			}

			if (0 != preg_match('/<td colspan="4">&nbsp;<\/td>/i', $row)){
				continue;
			}


			/* Check if this is the primary main row - that also contains the year */
			if (preg_match('/<a href="\/Sections\/Awards\/' . $result['imdbKey'] . '\/(.*?)"/i', $row, $matches)){
				$result['festivalEdition'] = $matches[1];
			}

			if (preg_match('/<b>(Won|Nominated)<\/b>/i', $row, $matches)){
				$result['status'] = $matches[1];
			}

			/* Set the participnts */
			preg_match('/<td valign="top">(.*?)<\/td>/i', $row, $matches);
			/* Take out the <small> tag */
			$participantsHtml = preg_replace('/<small>.*?<\/small>/i', '', $matches[1]);

			preg_match_all('/<a href="\/title\/(.*?)\/">/i', $participantsHtml, $matches);
			$result['filmImdbs'] = $matches[1];

			/* Take out all the <a>, <b>for:</b>, <br> of the participants */
			$participantsHtml = preg_replace('/<a.*?>.*?<\/a>/i', '', $participantsHtml);
			$participantsHtml = preg_replace('/<b>for:<\/b>/i', '', $participantsHtml);
			$participantsHtml = preg_replace('/<br>|<br \/>/i', '', $participantsHtml);
			$participantsHtml = preg_replace('/\(.*?\)[\.*]/i', '', $participantsHtml);
			$participantsHtml = preg_replace('/\(.*?\)/i', '', $participantsHtml);

			$result['festivalSection'] = trim($participantsHtml);

			/* Add the result */
			$this->params['awards'][] = $result;

		}
	}

	/**
	 * Parses the page with thte photo gallery
	 */
	public function parsePhotosPage()
		{
		$handle = curl_init('http://www.imdb.com/name/' . $this->imdbCode . '/mediaindex');
		curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);

		/* Get the HTML or whatever is linked in $url. */
		$response = curl_exec($handle);

		/* Check for 404 (file not found). */
		$httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
		if($httpCode != 200) {
		    return;
		}
		curl_close($handle);

		$html = str_replace(array("\r", "\r\n", "\n"), '', $response);
		$html = str_replace('  ', '', $html);




		preg_match_all('/href="\/rg\/mediaindex\/unknown-thumbnail\/media\/(.*?)\/' . $this->imdbCode . '"/i', $html, $photoPageKeys);
		$photoPageKeys = $photoPageKeys[1];
		//echo '<pre>'; var_dump($photoPageKeys);exit;

		/* Import only the first 10 film photos */
		for ($i = 0; $i <= 9; $i++){
			$photoUrl = $this->parsePhotoPage($photoPageKeys[$i]);
			if ($photoUrl) {
				$this->photos[] = $photoUrl;
			}
		}
	}

	/**
	 * Parses the page where the actual big photo is located at. Returns the url to the actual image.
	 */
	private function parsePhotoPage($photoUrlKey)
	{
		$handle = curl_init('http://www.imdb.com/media/' . $photoUrlKey . '/' . $this->imdbCode);
		curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);

		/* Get the HTML or whatever is linked in $url. */
		$response = curl_exec($handle);

		/* Check for 404 (file not found). */
		$httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
		if($httpCode != 200) {
		    return;
		}
		curl_close($handle);

		$html = str_replace(array("\r", "\r\n", "\n"), '', $response);
		$html = str_replace('  ', '', $html);

		preg_match('/id="primary-img"(.*?)src="(.*?)"/i', $html, $matches);

		return $matches[2];
	}

	public function getImdb()
	{
		return $this->imdbCode;
	}

	public function getFirstName()
	{
		$pieces = explode(' ', $this->params['name']);
		array_pop($pieces);

		return implode(' ', $pieces);
	}

	public function getLastName()
	{
		$pieces = explode(' ', $this->params['name']);
		return array_pop($pieces);
	}

	public function getIsActor()
	{
		return (in_array('Actor', $this->params['roles']) or in_array('Actress', $this->params['roles']))  ? '1' : null;
	}

	public function getIsDirector()
	{
		return in_array('Director', $this->params['roles']) ? '1' : null;
	}

	public function getIsProducer()
	{
		return in_array('Producer', $this->params['roles']) ? '1' : null;
	}

	public function getIsScriptwriter()
	{
		return in_array('Writer', $this->params['roles']) ? '1' : null;
	}

	public function getFilenameSource()
	{
		return $this->params['filename-source'];
	}

	public function getDateOfBirth()
	{
		if ($this->params['date_of_birth_year'] != '' && $this->params['date_of_birth_month'] != '' && $this->params['date_of_birth_day'] != '') {
			return $this->params['date_of_birth_year'] . '-' .
				$this->params['date_of_birth_month'] . '-' .
				$this->params['date_of_birth_day'];
		} else {
			return null;
		}
	}

	public function getDateOfDeath()
	{
		if ($this->params['date_of_death_year'] != '' && $this->params['date_of_death_month'] != '' && $this->params['date_of_death_day'] != '') {
			return $this->params['date_of_death_year'] . '-' .
				$this->params['date_of_death_month'] . '-' .
				$this->params['date_of_death_day'];
		} else {
			return null;
		}
	}

	public function getPlaceOfBirth()
	{
		return $this->params['place_of_birth'];
	}

	public function getBio()
	{
		return $this->params['bio'];
	}

	public function getActedFilms()
	{
		return $this->params['acted_films'];
	}

	public function getDirectedFilms()
	{
		return $this->params['directed_films'];
	}

	public function getProducedFilms()
	{
		return $this->params['produced_films'];
	}

	public function getWrittenFilms()
	{
		return $this->params['written_films'];
	}

	public function getPhotos()
	{
		return $this->photos;
	}
}