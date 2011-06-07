<ul class="filterlist spacer-bottom-m">
	<?php if (isset($displayBuy) && $displayBuy):?>
	<li onclick="location.href='<?php echo url_for('@film_buy?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>'"<?php if ($current == 'buy') echo ' class="active"';?>>
		<a href="<?php echo url_for('@film_buy?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>">Cumpara DVD & Bluray<span class="filter-cioc"></span></a>
	</li>
	<?php endif;?>
	<?php if (isset($displayTickets) && $displayTickets):?>
	<li onclick="location.href='<?php echo url_for('@film_tickets?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>'"<?php if ($current == 'tickets') echo ' class="active"';?>>
		<a href="<?php echo url_for('@film_tickets?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>">Rezerva bilete<span class="filter-cioc"></span></a>
	</li>
	<?php endif;?>
	<li onclick="location.href='<?php echo url_for('@film_cast?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>'"<?php if ($current == 'cast') echo ' class="active"';?>>
		<a href="<?php echo url_for('@film_cast?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>">Actori & echipa<span class="filter-cioc"></span></a>
	</li>
	<li onclick="location.href='<?php echo url_for('@film_sinopsis?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>'"<?php if ($current == 'synopsis') echo ' class="active"';?>>
		<a href="<?php echo url_for('@film_sinopsis?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>">Sinopsis<span class="filter-cioc"></span></a>
	</li>
	<li onclick="location.href='<?php echo url_for('@film_awards?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>'"<?php if ($current == 'awards') echo ' class="active"';?>>
		<a href="<?php echo url_for('@film_awards?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>">Premii<span class="filter-cioc"></span></a>
	</li>
	<li onclick="location.href='<?php echo url_for('@film_articles?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>'"<?php if ($current == 'articles') echo ' class="active"';?>>
		<a href="<?php echo url_for('@film_articles?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>">Articole despre film<span class="filter-cioc"></span></a>
	</li>
	<li onclick="location.href='<?php echo url_for('@film_comments?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>'"<?php if ($current == 'comments') echo ' class="active"';?>>
		<a href="<?php echo url_for('@film_comments?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>">Comentariile publicului<span class="filter-cioc"></span></a>
	</li>
	<?php if ($displayPhotos):?>
	<li onclick="location.href='<?php echo url_for('@film_photos?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>'"<?php if ($current == 'photos') echo ' class="active"';?>>
		<a href="<?php echo url_for('@film_photos?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>">Fotografii din film<span class="filter-cioc"></span></a>
	</li>
	<?php endif;?>
	<?php if ($displayRedcarpet):?>
	<li onclick="location.href='<?php echo url_for('@film_redcarpet?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>'"<?php if ($current == 'redcarpet') echo ' class="active"';?>>
		<a href="<?php echo url_for('@film_redcarpet?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>">Fotografii de la premiera<span class="filter-cioc"></span></a>
	</li>
	<?php endif;?>
	<li onclick="location.href='<?php echo url_for('@film_videos?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>'"<?php if ($current == 'videos') echo ' class="active"';?>>
		<a href="<?php echo url_for('@film_videos?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>">Trailere si clipuri<span class="filter-cioc"></span></a>
	</li>
	<li onclick="location.href='<?php echo url_for('@film_stiri?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>'"<?php if ($current == 'stires') echo ' class="active"';?>>
		<a href="<?php echo url_for('@film_stiri?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>">Stiri<span class="filter-cioc"></span></a>
	</li>
</ul>