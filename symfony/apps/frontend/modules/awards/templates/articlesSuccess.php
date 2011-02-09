<?php slot('festivals_layout');?>
<style type="text/css">html{ background-color: #000000 }</style>
<?php end_slot();?>

<h2>Premii si <span class="white">si festivaluri</span></h2>

<div class="spacer-bottom-m">
	<a href="<?php echo url_for('@homepage');?>" class="white-link">Home</a> <span class="white">&raquo;</span>
	<a href="<?php echo url_for('@festivals');?>" class="white-link">Festivaluri</a><span class="white">&raquo;</span>
	<a href="<?php echo url_for('@festival_edition?id=' . $edition->getId() . '&key=' . $edition->getUrlKey());?>" class="white-link"><?php echo $edition->getFestival()->getName() . ' - ' . $edition->getEdition();?></a> <span class="white">&raquo;</span>
	<a href="<?php echo url_for('@festival_edition_articles?id=' . $edition->getId() . '&key=' . $edition->getUrlKey());?>" class="white-link">Articole</a>
</div>


<div class="cell-container8"> <!-- content column start -->



	<h2 class="spacer-bottom"><span class="white"><?php echo $edition->getFestival()->getName();?> - <?php echo $edition->getEdition();?></span></h2>


    <div class="cell-container6"> <!-- left column start -->

        <div class="cell spacer-bottom-m">
            <div class="cell-hd">
                <h4>Detalii</h4>
            </div>
            <div class="cell-bd" style="padding:0">
                <ul class="filterlist spacer-bottom-m">
                <li onclick="location.href='<?php echo url_for('@festival_edition_stiri?id=' . $edition->getId() . '&key=' . $edition->getUrlKey());?>'"><a href="<?php echo url_for('@festival_edition_stiri?id=' . $edition->getId() . '&key=' . $edition->getUrlKey());?>">Stiri<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@festival_edition_winners?id=' . $edition->getId() . '&key=' . $edition->getUrlKey());?>'"><a href="<?php echo url_for('@festival_edition_winners?id=' . $edition->getId() . '&key=' . $edition->getUrlKey());?>">Castigatori &amp; nominalizati<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@festival_edition_photos?id=' . $edition->getId() . '&key=' . $edition->getUrlKey());?>'"><a href="<?php echo url_for('@festival_edition_photos?id=' . $edition->getId() . '&key=' . $edition->getUrlKey());?>">Pe covorul rosu<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@festival_edition_videos?id=' . $edition->getId() . '&key=' . $edition->getUrlKey());?>'"><a href="<?php echo url_for('@festival_edition_videos?id=' . $edition->getId() . '&key=' . $edition->getUrlKey());?>">Trailere si clipuri<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@festival_edition_judges?id=' . $edition->getId() . '&key=' . $edition->getUrlKey());?>'"><a href="<?php echo url_for('@festival_edition_judges?id=' . $edition->getId() . '&key=' . $edition->getUrlKey());?>">Juriu<span class="filter-cioc"></span></a></li>
                </ul>
            </div>
        </div>



    </div> <!-- left column end -->




    <div class="cell-container5 spacer-left"> <!-- content column start -->
	<?php foreach ($articles as $article):?>



		<?php if ($article->getFilenameIsTall()):?>


			<div class="cell spacer-bottom">
				<div class="cell-hd">
					<p class="explanation-xs"><?php echo format_date($article->getPublishDate(), 'D', 'ro');?></p>
					<div class="cell-separator-dotted-bottom innerspacer-bottom-s">
						<a href="<?php echo url_for('@article?id=' . $article->getId() . '&key=' . $article->getUrlKey());?>" class="bigblue-link"><?php echo $article->getName();?></a>
					</div>

					<div class="inline-block spacer-bottom innerspacer-top-s spacer-right innerspacer-right cell-separator-dotted-right">
						<span class="explanation-xs">Autor: <?php echo $article->getAuthor()->getName();?></span>
					</div>
				</div>

				<div class="cell-bd" style="padding: 7px;">
					<div class="right spacer-left">
						<a href="<?php echo url_for('@article?id=' . $article->getId() . '&key=' . $article->getUrlKey());?>">
							<img src="<?php echo filmsiArticlePhotoThumb($article->getFilename());?>" />
						</a>
					</div>

					<div>
						<div class="innerspacer-bottom spacer-bottom">
							<?php echo $article->getContentTeaser();?>

							<div class="align-right"><span class="more-cell-static"><a href="<?php echo url_for('@article?id=' . $article->getId() . '&key=' . $article->getUrlKey());?>" class="smallwhite-link">afla tot &raquo;</a></span></div>
						</div>

						<div>
							<?php foreach ($article->getFilm() as $articleFilm): ?>
								<a href="<?php echo url_for('@film?id=' . $articleFilm->getId() . '&key=' . $articleFilm->getUrlKey());?>"
								   class="xs-link"><?php echo $articleFilm->getNameRo();?></a>,
							<?php endforeach;?>
							<?php foreach ($article->getPerson() as $articlePerson): ?>
								<a href="<?php echo url_for('@person?id=' . $articlePerson->getId() . '&key=' . $articlePerson->getUrlKey());?>"
								   class="xs-link"><?php echo $articlePerson->getName();?></a>,
							<?php endforeach;?>
							<?php foreach ($article->getCinema() as $articleCinema): ?>
								<a href="<?php echo url_for('@cinema?id=' . $articleCinema->getId() . '&key=' . $articleCinema->getUrlKey());?>"
								   class="xs-link"><?php echo $articleCinema->getName();?></a>,
							<?php endforeach;?>
							<?php foreach ($article->getFestivalEdition() as $articleFestivalEdition): ?>
								<a href="<?php echo url_for('@festivaledition?id=' . $articleFestivalEdition->getId() . '&key=' . $articleFestivalEdition->getUrlKey());?>"
								   class="xs-link"><?php echo $articleFestivalEdition->getName();?></a>,
							<?php endforeach;?>
						</div>


					</div>

					<div class="clear"></div>

					<div class="cell-separator-dotted-top innerspacer-top spacer-top">
                                            <span class="st_email" st_title="<?php echo urlencode($article->getName());?>" ></span>
                                            <span class="st_facebook" st_title="<?php echo urlencode('testare mare');?>"></span>
                                            <span class="st_twitter" st_title="<?php echo urlencode($article->getName());?>"></span>
                                            <div class="inline-block"><a href="<?php echo url_for('@article?id=' . $article->getId() . '&key=' . $article->getUrlKey());?>#comments">16 comentarii</a></div>
					</div>
				</div>
			</div> <!-- article item -->





		<?php else: ?>




			<div class="cell spacer-bottom">
				<div class="cell-hd" style="padding: 7px;">
					<p class="explanation-xs"><?php echo format_date($article->getPublishDate(), 'D', 'ro');?></p>
					<div class="cell-separator-dotted-bottom innerspacer-bottom-s">
						<a href="<?php echo url_for('@article?id=' . $article->getId() . '&key=' . $article->getUrlKey());?>" class="bigblue-link"><?php echo $article->getName();?></a>
					</div>

					<div class="inline-block spacer-bottom innerspacer-top-s spacer-right innerspacer-right cell-separator-dotted-right">
						<span class="explanation-xs">Autor: <?php echo $article->getAuthor()->getName();?></span>
					</div>
				</div>

				<div class="cell-bd" style="padding: 7px;">
					<div class="align-center spacer-bottom-s">
						<a href="<?php echo url_for('@article?id=' . $article->getId() . '&key=' . $article->getUrlKey());?>">
							<img src="<?php echo filmsiArticlePhotoThumb($article->getFilename());?>" />
						</a>
					</div>

					<div class="innerspacer-bottom spacer-bottom">
						<?php echo $article->getContentTeaser();?>
					</div>

					<div class="cell-separator-dotted-bottom innerspacer-bottom spacer-bottom">
						<?php foreach ($article->getPerson() as $articlePerson): ?>
							<a href="<?php echo url_for('@person?id=' . $articlePerson->getId() . '&key=' . $articlePerson->getUrlKey());?>"
							   class="xs-link"><?php echo $articlePerson->getName();?></a>,
						<?php endforeach;?>
						<?php foreach ($article->getFilm() as $articleFilm): ?>
							<a href="<?php echo url_for('@film?id=' . $articleFilm->getId() . '&key=' . $articleFilm->getUrlKey());?>"
							   class="xs-link"><?php echo $articleFilm->getNameRo();?></a>,
						<?php endforeach;?>
							<?php foreach ($article->getCinema() as $articleCinema): ?>
								<a href="<?php echo url_for('@cinema?id=' . $articleCinema->getId() . '&key=' . $articleCinema->getUrlKey());?>"
								   class="xs-link"><?php echo $articleCinema->getName();?></a>,
							<?php endforeach;?>
							<?php foreach ($article->getFestivalEdition() as $articleFestivalEdition): ?>
								<a href="<?php echo url_for('@festivaledition?id=' . $articleFestivalEdition->getId() . '&key=' . $articleFestivalEdition->getUrlKey());?>"
								   class="xs-link"><?php echo $articleFestivalEdition->getName();?></a>,
							<?php endforeach;?>
					</div>

					<div class="right"><span class="more-cell-static"><a href="<?php echo url_for('@article?id=' . $article->getId() . '&key=' . $article->getUrlKey());?>" class="smallwhite-link">afla tot &raquo;</a></span></div>

					<span class="st_email" st_title="<?php echo urlencode($article->getName());?>" ></span>
					<span class="st_facebook" st_title="<?php echo urlencode('testare mare');?>"></span>
					<span class="st_twitter" st_title="<?php echo urlencode($article->getName());?>"></span>
					<div class="inline-block"><a href="<?php echo url_for('@article?id=' . $article->getId() . '&key=' . $article->getUrlKey());?>#comments"><?php echo $article->getCountComments();?> comentarii</a></div>

					<div class="clear"></div>
				</div>
			</div> <!-- article item -->

		<?php endif;?>


	<?php endforeach;?>








    <div class="cell-separator-dotted-top cell-separator-dotted-bottom innerspacer-bottom innerspacer-top"> <!-- page navigator start -->
		<div class="inline-block spacer-left-m spacer-right-l">Articolele <?php echo $firstArticleCount;?>-<?php echo $lastArticleCount;?></div>

        <?php if($currentPage > 1):?>
			<a href="<?php echo url_for('@festival_edition_articles?id=' . $edition->getId() . '&key=' . $edition->getUrlKey());?>p=<?php echo $currentPage - 1;?>"><span class="pagenav-back"></span></a>
		<?php endif;?>
		<?php for ($i = 1; $i <= $pageCount; $i++):?>
			<a href="<?php echo url_for('@festival_edition_articles?id=' . $edition->getId() . '&key=' . $edition->getUrlKey());?>?p=<?php echo $i;?>"><span class="<?php echo $i == $currentPage ? 'pagenav-active' : 'pagenav';?>"><?php echo $i;?></span></a>
		<?php endfor;?>
		<?php if($currentPage < $pageCount):?>
		<a href="<?php echo url_for('@festival_edition_articles?id=' . $edition->getId() . '&key=' . $edition->getUrlKey());?>?p=<?php echo $currentPage + 1;?>"><span class="pagenav-forward"></span></a>
		<?php endif;?>


        <div class="inline-block spacer-left-l">din <?php echo $articleCount;?> articole</div>
    </div><!-- page navigator end -->

</div> <!-- content column end -->

</div><!-- container 8 end -->





<div class="cell-container7 spacer-left"> <!-- right column start -->
	this is the right column
</div> <!-- right column end -->