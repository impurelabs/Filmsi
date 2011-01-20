<?php
class ImdbComFilm
{
	protected $params = array(
		'name_ro' => '',
		'name_en' => '',
		'year' => '',
		'sinopsis' => '',
		'duration' => '',
		'filename-source' => '',
		'genres' => array(),
		'directors' => array(),
		'actors' => array(),
		'writers' => array(),
		'producers' => array(),
		'awards' => array()
	);
	protected $imdbCode;
	
	protected $genres = array(
		'Action' => 'Actiune',
		'Adventure' => 'Aventura',
		'Animation' => 'Desene animate',
		'Biography' => 'Biografic',
		'Comedy' => 'Comedie',
		'Crime' => 'Crima',
		'Documentary' => 'Documentar',
		'Drama' => 'Drama',
		'Family' => 'Pentru Familie',
		'Fantasy' => 'Fantastic',
		'Film-Noir' => 'Film-Noir',
		'Game-Show' => 'Jocuri TV',
		'History' => 'Istoric',
		'Horror' => 'Horror',
		'Music' => 'Muzica',
		'Musical' => 'Musical',
		'Mystery' => 'Mister',
		'News' => 'Actualitate',
		'Reality-TV' => 'Reality Show',
		'Romance' => 'Romantic',
		'Sci-Fi' => 'Science-Fiction',
		'Sport' => 'Sport',
		'Talk-Show' => 'Talk-Show',
		'Thriller' => 'Thriller',
		'War' => 'Razboi',
		'Western' => 'Western'
	);
	
	
	public function __construct($imdbCode)
	{		
		$this->imdbCode = $imdbCode;
		$this->parseTitlePage();
		$this->parseCastPage();
		$this->parseAwardsPage();
	}
	
	public function getImdb()
	{
		return $this->imdbCode;
	}
	
	public function getNameRo()
	{
		return $this->params['name_ro'];
	}
	
	public function getNameEn()
	{
		return $this->params['name_en'];
	}
	
	public function getYear()
	{
		return $this->params['year'];
	}
	
	public function getSinopsis()
	{
		return $this->params['sinopsis'];
	}
	
	public function getDuration()
	{
		return $this->params['duration'];
	}
	
	public function getFilenameSource()
	{
		return $this->params['filename-source'];
	}
	
	public function getFilenameExtension()
	{
		$pieces = explode('.', $this->params['filename-source']);
		return array_pop($pieces);
	}
	
	public function getGenres()
	{
		return $this->params['genres'];
	}
	
	public function getDirectors()
	{
		return $this->params['directors'];
	}
	
	public function getActors()
	{
		return $this->params['actors'];
	}
	
	public function getWriters()
	{
		return $this->params['writers'];
	}
	
	public function getProducers()
	{
		return $this->params['producers'];
	}

	public function getAwards()
	{
		return $this->params['awards'];
	}

	private function parseTitlePage()
	{
		$handle = curl_init('http://www.imdb.com/title/' . $this->imdbCode . '/');
		curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);
		
		/* Get the HTML or whatever is linked in $url. */
		$response = curl_exec($handle);
		
		
		/* Check for 404 (file not found). */
		$httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
		
		if($httpCode != 200) {
		    throw new ImdbComFilmException('Nu s-a gasit pagina pe Imdb.com pentru codul: ' . $this->imdbCode);
		}
		curl_close($handle);

		
		
  	$html = str_replace(array("\r", "\r\n", "\n"), '', $response);
	$html = str_replace('  ', '', $html);
  	
  	$matches = array();
  	preg_match('/<h1 class="header">(.*?)<\/h1>/i', $html, $matches);
  	$inWorkParagraph = $matches[1];
  	
  	preg_match('/^(.*)<span>/i', $inWorkParagraph, $matches);
  	if (isset($matches[1])){
  		$this->params['name_ro'] = htmlentities(trim($matches[1]));
  	}
  	unset($matches);
  	
  	preg_match('/<span class="title-extra">(.*)<i>/i', $inWorkParagraph, $matches);
  	if (isset($matches[1])){
  		$this->params['name_en'] = htmlentities(trim($matches[1]));
  	}
  	unset($matches);
  	
  	preg_match('/<a\b[^>]*>(.*?)<\/a>/i', $inWorkParagraph, $matches);
  	if (isset($matches[1])){
  		$this->params['year'] = htmlentities(trim($matches[1]));
  	}
  	unset($matches);
  	
  	preg_match('/<td id="overview-top">(.*)<\/td>/i', $html, $matches);
  	$inWorkParagraph = $matches[1];
  	
  	preg_match('/<p><p>(.*?)<\/p><\/p>/i', $inWorkParagraph, $matches);
  	if (isset($matches[1])){
  		$this->params['sinopsis'] = trim($matches[1]);
  	}
  	unset($matches);
  	
  	preg_match('/<h4 class="inline">Runtime:<\/h4>([^<]*)</i', $html, $matches);
  	if (isset($matches[1])){
  		$this->params['duration'] = htmlentities(trim($matches[1]));
  	}
  	unset($matches);
  	
  	preg_match('/<td rowspan="2" id="img_primary">(.*)<\/td>/i', $html, $matches);
  	$inWorkParagraph = $matches[1];
  	
  	preg_match('/src="([^"]*)"/i', $inWorkParagraph, $matches);
  	if (isset($matches[1])){
  		$this->params['filename-source'] = $matches[1];
  	}
  	unset($matches);
  	
  	preg_match('/<h4 class="inline">Genres:<\/h4>(.*?)<\/div>/i', $html, $matches);
  	preg_match_all('/<a\b[^>]*>(.*?)<\/a>/i', $matches[1], $matches);
  	if (isset($matches[1])){
  		$this->setGenres($matches[1]);
  	}
  	unset($matches);
	}
	
	private function parseCastPage()
	{
		$handle = curl_init('http://www.imdb.com/title/' . $this->imdbCode . '/fullcredits');
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
  	
  	preg_match('/name="directors"(.*?)<\/table>/i', $html, $matches);
  	preg_match_all('/<a href="\/name\/(.*?)\/">(.*?)<\/a>/i', $matches[0], $matches);
  	$this->params['directors'] = $matches[1];
  	
  	preg_match('/name="producers"(.*?)<\/table>/i', $html, $matches);
  	preg_match_all('/<a href="\/name\/(.*?)\/">(.*?)<\/a>/i', $matches[0], $matches);
  	$this->params['producers'] = $matches[1];
  	
  	preg_match('/name="writers"(.*?)<\/table>/i', $html, $matches);
  	preg_match_all('/<a href="\/name\/(.*?)\/">(.*?)<\/a>/i', $matches[0], $matches);
  	$this->params['writers'] = $matches[1];
  	
  	preg_match_all('/<td class="nm"><a href="\/name\/(.*?)\/"/i', $html, $matches);
  	$this->params['actors'] = $matches[1];

	//echo '<pre>'; var_dump($this->params['actors']); exit;
	}

	public function parseAwardsPage()
	{
		$handle = curl_init('http://www.imdb.com/title/' . $this->imdbCode . '/awards');
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
		if (0 == preg_match('/<table style="margin-top: 8px; margin-bottom: 8px" cellspacing="2" cellpadding="2" border="1">(.*?)<\/table>/i', $html, $matches)){
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
			'personImdbs' => array()
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

			preg_match_all('/<a href="\/name\/(.*?)\/">/i', $participantsHtml, $matches);
			$result['personImdbs'] = $matches[1];

			/* Take out all the <a> of the participants */
			$participantsHtml = preg_replace('/<a.*?>.*?<\/a>/i', '', $participantsHtml);
			$participantsHtml = preg_replace('/<br>(.*)/i', '', $participantsHtml);
			$participantsHtml = preg_replace('/<br \/>(.*)/i', '', $participantsHtml);

			$result['festivalSection'] = trim($participantsHtml);

			/* Add the result */
			$this->params['awards'][] = $result;

		}
	}

	private function setGenres($genreCodes)
	{
		foreach ($genreCodes as $genreCode){
			$this->params['genres'][] = $this->genres[$genreCode];
		}
	}
}