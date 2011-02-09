<?php slot('festivals_layout');?>
<style type="text/css">html{ background-color: #000000 }</style>
<?php end_slot();?>

<h2>Premii si <span class="white">si festivaluri</span></h2>

<div class="spacer-bottom-m">
	<a href="<?php echo url_for('@homepage');?>" class="white-link">Home</a> <span class="white">&raquo;</span>
	<a href="<?php echo url_for('@festivals');?>" class="white-link">Festivaluri</a><span class="white">&raquo;</span>
	<a href="<?php echo url_for('@festival_edition?id=' . $edition->getId() . '&key=' . $edition->getUrlKey());?>" class="white-link"><?php echo $edition->getFestival()->getName() . ' - ' . $edition->getEdition();?></a>
</div>


<div class="cell-container8"> <!-- content column start -->

	<div class="normalcell spacer-bottom">
    	<div class="left" style="width: 40px"><h5>Buzz</h5></div>
        <ul class="list2 left spacer-left-m" style="width: 390px">
			<?php foreach($edition->getRelatedStires(3) as $stire):?>
				<li><a href="<?php echo url_for('@stire?id=' . $stire['id'] . '&key=' . $stire['url_key']);?>" class="black-link"><?php echo $stire['name'];?></a></li>
			<?php endforeach;?>
        </ul>
        <div class="clear"></div>
    </div>



	<h2 class="spacer-bottom"><span class="white"><?php echo $edition->getFestival()->getName();?></span></h2>

	<img src="<?php echo filmsiFestivalEditionPhoto($edition->getFilename());?>" class="spacer-bottom" />


    <div class="normalcell innerspacer-bottom-l">
        <table class="spacer-bottom">
        	<tr><td><h4 class="black spacer-right" style="white-space:nowrap">Editia <?php echo $edition->getEdition();?></h4></td><td width="100%"><div class="cell-separator-double"></div></td></tr>
        </table>

		<?php foreach($edition->getFestivalSections() as $section):?>
			<div class="inline-block mb-4 mr-1 ml-1" style="width:200px; vertical-align: top">
				<p class="explanation-small cell-separator-dotted-bottom spacer-bottom"><?php echo $section->getName();?></p>
				<?php foreach ($section->getWinners() as $winner):?>
					<a href="<?php echo url_for('@film?id=' . $winner['film']['id'] . '&key=' . $winner['film']['url_key']);?>" class="important-link"><?php echo $winner['film']['name_ro'];?></a>
							<?php if (isset($winner['persons'])):?>
								<br />
								<?php foreach($winner['persons'] as $person):?>
									<a href="<?php echo url_for('@person?id=' . $person['id'] . '&key=' . $person['url_key']);?>" class="small-link"><?php echo $person['first_name'] . ' ' . $person['last_name'];?></a>,
								<?php endforeach;?>
							<?php endif;?>
				<?php endforeach;?>
			</div>
		<?php endforeach;?>

    </div>
    <div class="spacer-bottom" style="background-color:#e7e7e7">
		<div style="width: 640px; position: relative; margin-left: 20px">

			<ul id="edition-carousel">
				<?php foreach ($editions as $relatedEdition):?>
					<li><a href="<?php echo url_for('@festival_edition?id=' . $relatedEdition->getId() . '&key=' . $relatedEdition->getUrlKey());?>"><span class="yearpicker-year<?php if($relatedEdition->getId() == $edition->getId()) echo '-active';?> left innerspacer-right-s innerspacer-left-s"><?php echo $relatedEdition->getEdition();?></span></a></li>
				<?php endforeach;?>
			</ul>
		</div>
		<style type="text/css">
			.jcarousel-next-horizontal {position: absolute; top: 0px; right: -22px; width: 20px; height: 22px; background-image:url('/images/elements.png'); background-position: -67px -651px; background-color:transparent; cursor: pointer}
			.jcarousel-prev-horizontal {position: absolute; top: 0px; left: -22px; width: 20px; height: 22px; background-image:url('/images/elements.png'); background-position: -36px -651px; background-color:transparent; cursor: pointer}
		</style>

			<script type="text/javascript">

				$(document).ready(function() {
					$('#edition-carousel').jcarousel({
					});
				});

			</script>

			<div class="clear"></div>
    </div>









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














        <div class="normalcell spacer-bottom">
        	<p class="bigstronggreen spacer-bottom">Scurta prezentare</p>
            <?php echo $edition->getDescriptionTeaser();?>
        </div>







        <div class="normalcell spacer-bottom">
            <div class="left" style="width: 200px">Spune si prietenilor tai pe:</div>

            <div class="left spacer-left-l">
                <div class="inline-block cell-separator-dotted-right innerspacer-right spacer-right"><a href=""><span class="icon-twitter-m"></span></a></div>
                <div class="inline-block cell-separator-dotted-right innerspacer-right spacer-right"><a href=""><span class="icon-facebook-m"></span></a></div>
                <div class="inline-block innerspacer-right spacer-right"><a href=""><span class="icon-email-m"></span></a></div>
            </div>

            <div class="clear"></div>
        </div>




        <div class="cell spacer-bottom-m">
        <div class="cell-hd"><h5>Fotografii</h5></div>
        <div class="cell-bd innerspacer-bottom-m">
            <?php foreach($edition->getFirstPhotos(3) as $photo):?>
            <div class="inline-block align-center spacer-bottom-m ml-3" style="width: 125px; vertical-align: middle">
                <a href="<?php echo url_for('@festival_edition_photos?id=' . $edition->getId() . '&key=' . $edition->getUrlKey());?>?pid=<?php echo $photo->getPosition();?>"><img src="<?php echo filmsiPhotoThumbS($photo->getFilename());?>" /></a> <br />
                <a href="<?php echo url_for('@festival_edition_photos?id=' . $edition->getId() . '&key=' . $edition->getUrlKey());?>?pid=<?php echo $photo->getPosition();?>" class="black-link"><?php echo $photo->getDescription();?></a> <br />
            </div>
            <?php endforeach;?>
        </div>

		<span class="more-cell"><a href="<?php echo url_for('@festival_edition_photos?id=' . $edition->getId() . '&key=' . $edition->getUrlKey());?>" class="smallwhite-link">vezi mai multe &raquo;</a></span>
    </div>

	<div class="cell spacer-bottom-m">
        <h5>Trailere <span class="black">si clipuri video</span></h5>
        <div class="cell-bd innerspacer-bottom-m">
            <?php foreach($edition->getFirstVideos(3) as $video):?>
            <div class="inline-block align-center spacer-bottom-m ml-3" style="width: 125px; vertical-align: middle">
                <a href="<?php echo url_for('@festival_edition_videos?id=' . $edition->getId() . '&key=' . $edition->getUrlKey());?>?vid=<?php echo $video->getPosition();?>"><img src="<?php echo filmsiVideoThumb($video->getCode());?>" /></a> <br />
                <a href="<?php echo url_for('@festival_edition_videos?id=' . $edition->getId() . '&key=' . $edition->getUrlKey());?>?vid=<?php echo $video->getPosition();?>" class="black-link"><?php echo $video->getName();?></a> <br />
            </div>
            <?php endforeach;?>
        </div>

		<span class="more-cell"><a href="<?php echo url_for('@festival_edition_videos?id=' . $edition->getId() . '&key=' . $edition->getUrlKey());?>" class="smallwhite-link">vezi mai multe &raquo;</a></span>
    </div>




    <div class="cell spacer-bottom-m">
        <div class="cell-hd">
            <h4>Cele mai noi <span class="black">articole</span></h4>
        </div>

        <div class="cell-bd">
        	<ul class="spacer-bottom-m">
				<?php foreach($edition->getNewestArticles(3) as $article):?>
            	<li class="cell-separator-dotted-bottom innerspacer-bottom-s spacer-bottom-s">
                    <p class="explanation spacer-bottom-s"><a href="<?php echo url_for('@article?id=' . $article->getId() . '&key=' . $article->getUrlKey());?>" class="important-link"><?php echo $article->getName();?></a></p>
                    <p class="spacer-left-m"><?php echo $article->getContentTeaser();?></p>
                </li>
				<?php endforeach;?>
            </ul>
        </div>

        <div class="more-cell"><a href="<?php echo url_for('@festival_edition_articles?id=' . $edition->getId() . '&key=' . $edition->getUrlKey());?>" class="smallwhite-link">afla mai multe &raquo;</a></div>
    </div>







        <?php include_partial('comments/formAndList', array(
			'form' => $commentForm,
			'comments' => $comments,
			'action' => url_for('@festival_edition?id=' . $edition->getId() . '&key=' . $edition->getUrlKey())
		));?>

    </div> <!-- content column end -->

</div><!-- container 8 end -->





<div class="cell-container7 spacer-left"> <!-- right column start -->
	this is the right column
</div> <!-- right column end -->