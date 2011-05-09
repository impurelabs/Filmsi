<?php slot('backgroundTag');?>
<div style="width: <?php echo $backgroundWidth;?>px; margin: 0 auto; background: url('<?php echo filmsiFilmBackground($film->getBackgroundFilename());?>') top no-repeat">
<?php end_slot();?>

<h2><a href="<?php echo url_for('@film?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>"><?php echo $film->getNameRo();?> <?php if ($film->getNameEn() != ''):?><span class="black">(<?php echo $film->getNameEn();?>)</span><?php endif;?></a></h2>

<div class="spacer-bottom-m">
	<a href="<?php echo url_for('@homepage');?>" class="black-link">Home</a> &raquo;
	<a href="<?php echo url_for('@film?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>" class="black-link"><?php echo $film->getName();?></a>
</div>




<div class="cell-container6"> <!-- left column start -->


    <div class="cell spacer-bottom-m">
        <div class="cell-hd">
            <h5><a href="<?php echo url_for('@film?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>">Detalii <span class="black">film</span></a></h5>
        </div>
        <div class="cell-bd" style="padding:0">
        	<ul class="filterlist spacer-bottom-m">
            	<li onclick="location.href='<?php echo url_for('@film_buy?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>'"><a href="<?php echo url_for('@film_buy?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>">Cumpara DVD & Bluray<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@film_cast?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>'"><a href="<?php echo url_for('@film_cast?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>">Actori & echipa<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@film_sinopsis?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>'"><a href="<?php echo url_for('@film_sinopsis?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>">Sinopsis<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@film_awards?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>'"><a href="<?php echo url_for('@film_awards?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>">Premii<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@film_articles?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>'"><a href="<?php echo url_for('@film_articles?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>">Articole despre film<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@film_comments?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>'"><a href="<?php echo url_for('@film_comments?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>">Comentariile publicului<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@film_photos?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>'"><a href="<?php echo url_for('@film_photos?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>">Fotografii din film<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@film_redcarpet?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>'"><a href="<?php echo url_for('@film_redcarpet?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>">Fotografii de la premiera<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@film_videos?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>'"><a href="<?php echo url_for('@film_videos?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>">Trailere si clipuri<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@film_stiri?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>'"><a href="<?php echo url_for('@film_stiri?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>">Stiri<span class="filter-cioc"></span></a></li>
            </ul>
        </div>
    </div>


</div> <!-- left column end -->




<div class="cell-container5 spacer-left"> <!-- content column start -->

	<div class="left" style="width:185px">
    	<img src="<?php echo filmsiFilmPhotoThumb($film->getFilename());?>" class="spacer-bottom" width="185" />

        <?php include_partial('films/alert', array('filmId' => $film->getId()));?>
    </div>


    <div class="normalcell left spacer-left" style="width:273px; padding:10px 5px">
    	<p class="incinema spacer-bottom-s">
			<?php foreach($statuses as $status):?>
			<?php echo $status;?><br />
			<?php endforeach;?>
		</p>
    	<div class="cell-separator-double spacer-bottom"></div>

        <div class="left" style="width: 190px">
			<?php if ($film->checkIfIpVotedToday($_SERVER['REMOTE_ADDR'])):?>
				<br />
				<p class="spacer-bottom-s"><strong>Ai votat deja azi pentru acest film!</strong></p>
			<?php else:?>
				<p class="spacer-bottom-s"><strong>Voteaza acest film</strong></p>

				<a href="javascript: void(0)" class="icon-votestar-s votetrigger" id="votestar-1"></a>
				<a href="javascript: void(0)" class="icon-votestar-s votetrigger" id="votestar-2"></a>
				<a href="javascript: void(0)" class="icon-votestar-s votetrigger" id="votestar-3"></a>
				<a href="javascript: void(0)" class="icon-votestar-s votetrigger" id="votestar-4"></a>
				<a href="javascript: void(0)" class="icon-votestar-s votetrigger" id="votestar-5"></a>
				<a href="javascript: void(0)" class="icon-votestar-s votetrigger" id="votestar-6"></a>
				<a href="javascript: void(0)" class="icon-votestar-s votetrigger" id="votestar-7"></a>
				<a href="javascript: void(0)" class="icon-votestar-s votetrigger" id="votestar-8"></a>
				<a href="javascript: void(0)" class="icon-votestar-s votetrigger" id="votestar-9"></a>
				<a href="javascript: void(0)" class="icon-votestar-s votetrigger" id="votestar-10"></a>
				<form id="vote_form" method="post" action="<?php echo url_for('@film_vote');?>">
					<input type="hidden" name="film_id" value="<?php echo $film->getId();?>" />
					<input type="hidden" id="vote_grade" name="grade" value="" />
				</form>
				<script type="text/javascript">
					$(document).ready(function(){
						$('.votetrigger').mouseover(function(){
							id = parseInt($(this).attr('id').substr(9));

							for (i = 1; i <= id; i++){
								$('#votestar-' + i).removeClass('icon-votestar-s').addClass('icon-votestar-s-active');
							}
						});

						$('.votetrigger').mouseout(function(){
							$('.votetrigger').removeClass('icon-votestar-s-active').addClass('icon-votestar-s');
						});

						$('.votetrigger').click(function(){
							$('#vote_grade').val($(this).attr('id').substr(9));
							$('#vote_form').submit();
						});
					});
				</script>
			<?php endif;?>
        </div>

        <div class="left cell-separator-dotted-left" style="width: 70px; padding-left:5px; margin-left:5px">
			<span class="hugegreen"><?php echo format_number(number_format($film->getVoteScore(), 2), 'ro');?></span><br />
            <span class="smalltext"><?php echo $film->getVoteCount();?> voturi</span>
        </div>

        <div class="clear"></div>

        <div class="cell-separator-double spacer-bottom spacer-top"></div>
        <strong>Sinopsis</strong><br />
        <?php echo $film->getDescriptionTeaser();?>

        <div class="align-right"><a href="<?php echo url_for('@film_sinopsis?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>" class="small-link">citeste intreg sinopsisul &raquo;</a></div>
        <br />
        <div class="cell-separator-double spacer-bottom"></div>

        <strong>Cu</strong><br />

        <p class="spacer-left">
			<?php foreach($actors as $actor):?>
			<a href="<?php echo url_for('@person?id=' . $actor->getId() . '&key=' . $actor->getUrlKey());?>" class="small-link"><?php echo $actor->getName();?></a>,
			<?php endforeach;?>
		</p>
        <div class="align-right spacer-bottom"><a href="<?php echo url_for('@film_cast?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>" class="small-link">vezi toti actorii &raquo;</a></div>

        <div class="cell-separator-double spacer-bottom"></div>

        <div class="inline-block spacer-bottom" style="width:130px">
        	<strong>Regia</strong><br />
            <div class="spacer-left">
				<?php foreach($directors as $director):?>
				<a href="<?php echo url_for('@person?id=' . $director->getId() . '&key=' . $director->getUrlKey());?>" class="small-link"><?php echo $director->getName();?></a>,
				<?php endforeach;?>
			</div>
        </div>

        <div class="inline-block spacer-bottom" style="width:130px">
        	<strong>Distribuitor</strong><br />
            <div class="spacer-left"><?php echo $film->getDistribuitor();?></div>
        </div>

        <div class="inline-block spacer-bottom" style="width:130px">
        	<strong>Gen</strong><br />
            <div class="spacer-left">
				<?php foreach($film->getGenres() as $genre):?>
				<a href="" class="small-link"><?php echo $genre->getName();?></a>,
				<?php endforeach;?>
			</div>
        </div>

        <div class="inline-block spacer-bottom" style="width:130px">
        	<strong>An</strong><br />
            <div class="spacer-left smalltext"><?php echo $film->getYear();?></div>
        </div>

        <div class="inline-block spacer-bottom" style="width:130px">
        	<strong>Rating</strong><br />
            <div class="spacer-left"><a href="" class="small-link"><?php echo $film->getRating();?></a></div>
        </div>

        <div class="inline-block spacer-bottom" style="width:130px">
        	<strong>Durata</strong><br />
            <div class="spacer-left smalltext"><?php echo $film->getDuration();?></div>
        </div>

    </div>

    <div class="clear"></div>

    <div class="normalcell spacer-top spacer-bottom">
    	<div>
            <div class="right innerspacer-right spacer-right-m"><span class="st_email_large" st_title="" ></span></div>
            <div class="right innerspacer-right spacer-right-m"><span class="st_facebook_large" st_title=""></span></div>
            <div class="right innerspacer-right spacer-right-m"><span class="st_twitter_large" st_title=""></span></div>

            <div class="inline-block spacer-right-l">Spune si prietenilor tai pe</div>

            <div class="clear"></div>
        </div>
    </div>


	<?php if($isInCinema):?>
    <div class="cell innerspacer-bottom spacer-bottom-m">
        <h5 class="innerspacer cell-separator2 spacer-bottom">Cauta cinema unde ruleaza filmul <span class="black">in orasul tau</span></h5>

        <select class="cinema-city spacer-left" style="width: 350px"><option>Selecteaza orasul tau</option></select><button class="cinema-searchbutton spacer-left"></button>
    </div>
	<?php endif;?>

    <!--
    <div class="greencell spacer-bottom-m">
    	<div class="left" style="width: 200px"><span class="hugewhite">CUMPARA</span><br /><span class="bigstrong">Intalnire exploziva</span></div>
        <div class="left innerspacer-top">
            <button class="normalbutton spacer-right-m"><span class="icon-buttonbullet-green"></span> Pe DVD</button>
            <button class="normalbutton "><span class="icon-buttonbullet-green"></span> Pe Bluray</button>
		</div>

        <div class="clear"></div>
    </div>
    -->

	<?php if(count($film->getFirstPhotos(3)) > 0):?>
	<div class="cell spacer-bottom-m">
        <div class="cell-hd"><h5>Fotografii</h5></div>
        <div class="cell-bd innerspacer-bottom-m">
            <?php foreach($film->getFirstPhotos(3) as $photo):?>
            <div class="inline-block align-center spacer-bottom-m ml-3" style="width: 125px; vertical-align: middle">
                <a href="<?php echo url_for('@film_photos?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>?pid=<?php echo $photo->getPosition();?>"><img src="<?php echo filmsiPhotoThumbS($photo->getFilename());?>" /></a> <br />
                <a href="<?php echo url_for('@film_photos?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>?pid=<?php echo $photo->getPosition();?>" class="black-link"><?php echo $photo->getDescription();?></a> <br />
            </div>
            <?php endforeach;?>
        </div>

		<span class="more-cell"><a href="<?php echo url_for('@film_photos?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>" class="smallwhite-link">vezi mai multe &raquo;</a></span>
    </div>
	<?php endif;?>

	<?php if ($film->getIsSeries() == '1'):?><a name="episodes"></a>
	<div class="cell spacer-bottom-m">
        <div class="cell-hd"><h5>Episoade <span class="black">Sezonul <?php echo $selectedSeason;?></span></h5></div>
        <div class="cell-bd innerspacer-bottom-m">
            <div class="left explanation-small" style="width: 50px">Sezon</div>
			<div class="left explanation-small" style="width: 400px">Episodul</div>
			<div class="clear"></div>
			<div class=" cell-separator-dotted-bottom mt-1 mb-2"></div>

			<div class="left" style="width: 50px">
				<?php foreach($seasons as $season):?>
					<div class="picker-vert<?php if($selectedSeason == $season['season']) echo '-active';?>" onclick="location.href='<?php echo url_for('@film?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>?s=<?php echo $season['season'];?>#episodes'"><?php echo $season['season'];?></div>
				<?php endforeach;?>
			</div>
			<div class="left" style="width: 400px">
				<?php foreach($episodes as $episode):?>
					<div class="mb-2">
						<span class="explanation">Episodul <?php echo $episode['number'];?>.</span> <strong><?php echo $episode['name'];?></strong>
					</div>
				<?php endforeach;?>
			</div>
			<div class="clear"></div>
        </div>
    </div>
	<?php endif;?>

	<?php if (count($film->getFirstVideos(3)) > 0):?>
	<div class="cell spacer-bottom-m">
        <h5>Trailere <span class="black">si clipuri video</span></h5>
        <div class="cell-bd innerspacer-bottom-m">
            <?php foreach($film->getFirstVideos(3) as $video):?>
            <div class="inline-block align-center spacer-bottom-m ml-3" style="width: 125px; vertical-align: middle">
                <a href="<?php echo url_for('@film_videos?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>?vid=<?php echo $video->getPosition();?>"><img src="<?php echo filmsiVideoThumb($video->getCode());?>" /></a> <br />
                <a href="<?php echo url_for('@film_videos?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>?vid=<?php echo $video->getPosition();?>" class="black-link"><?php echo $video->getName();?></a> <br />
            </div>
            <?php endforeach;?>
        </div>

		<span class="more-cell"><a href="<?php echo url_for('@film_videos?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>" class="smallwhite-link">vezi mai multe &raquo;</a></span>
    </div>
	<?php endif;?>


	<?php if (count($film->getNewestArticles(3)) > 0):?>
    <div class="cell spacer-bottom-m">
        <div class="cell-hd">
            <h4>Cele mai noi <span class="black">articole</span></h4>
        </div>

        <div class="cell-bd">
        	<ul class="spacer-bottom-m">
				<?php foreach($film->getNewestArticles(3) as $article):?>
            	<li class="cell-separator-dotted-bottom innerspacer-bottom-s spacer-bottom-s">
                    <p class="explanation spacer-bottom-s"><a href="<?php echo url_for('@article?id=' . $article->getId() . '&key=' . $article->getUrlKey());?>" class="important-link"><?php echo $article->getName();?></a></p>
                    <p class="spacer-left-m"><?php echo $article->getContentTeaser();?></p>
                </li>
				<?php endforeach;?>
            </ul>
        </div>

        <div class="more-cell"><a href="<?php echo url_for('@film_articles?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>" class="smallwhite-link">afla mai multe &raquo;</a></div>
    </div>
	<?php endif;?>


    <?php include_partial('comments/formAndList', array(
		'form' => $commentForm,
		'comments' => $comments,
		'action' => url_for('@film?id=' . $film->getId() . '&key=' . $film->getUrlKey())
	));?>



</div> <!-- content column end -->





<div class="cell-container7 spacer-left"> <!-- right column start -->
	<?php include_component('default', 'rightColumn', array('page' => Page::FILM));?>
</div> <!-- right column end -->