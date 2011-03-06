<h2><?php echo $cinema->getName();?></h2>

<div class="spacer-bottom-m">
	<a href="<?php echo url_for('@homepage');?>" class="black-link">Home</a> &raquo;
	<a href="<?php echo url_for('@cinemas');?>" class="black-link">Cinematografe</a> &raquo;
	<a href="<?php echo url_for('@cinema?id=' . $cinema->getId() . '&key=' . $cinema->getUrlKey());?>" class="black-link"><?php echo $cinema->getName();?></a>
</div>




<div class="cell-container6"> <!-- left column start -->


    <div class="cell spacer-bottom-m">
        <div class="cell-hd">
            <h5>Detalii <span class="black">cinema</span></h5>
        </div>
        <div class="cell-bd" style="padding:0">
        	<ul class="filterlist spacer-bottom-m">
                <li onclick="location.href='<?php echo url_for('@cinema_description?id=' . $cinema->getId() . '&key=' . $cinema->getUrlKey());?>'"><a href="<?php echo url_for('@cinema_description?id=' . $cinema->getId() . '&key=' . $cinema->getUrlKey());?>">Prezentare<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@cinema_schedule?id=' . $cinema->getId() . '&key=' . $cinema->getUrlKey());?>'"><a href="<?php echo url_for('@cinema_schedule?id=' . $cinema->getId() . '&key=' . $cinema->getUrlKey());?>">Program<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@cinema_tickets?id=' . $cinema->getId() . '&key=' . $cinema->getUrlKey());?>'"><a href="<?php echo url_for('@cinema_tickets?id=' . $cinema->getId() . '&key=' . $cinema->getUrlKey());?>">Pret bilete<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@cinema_promotions?id=' . $cinema->getId() . '&key=' . $cinema->getUrlKey());?>'"><a href="<?php echo url_for('@cinema_promotions?id=' . $cinema->getId() . '&key=' . $cinema->getUrlKey());?>">Promotii<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@cinema_stiri?id=' . $cinema->getId() . '&key=' . $cinema->getUrlKey());?>'"><a href="<?php echo url_for('@cinema_stiri?id=' . $cinema->getId() . '&key=' . $cinema->getUrlKey());?>">Noutati<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@cinema_photos?id=' . $cinema->getId() . '&key=' . $cinema->getUrlKey());?>'"><a href="<?php echo url_for('@cinema_photos?id=' . $cinema->getId() . '&key=' . $cinema->getUrlKey());?>">Fotografii<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@cinema_comments?id=' . $cinema->getId() . '&key=' . $cinema->getUrlKey());?>'"><a href="<?php echo url_for('@cinema_comments?id=' . $cinema->getId() . '&key=' . $cinema->getUrlKey());?>">Parerea publicului<span class="filter-cioc"></span></a></li>
            </ul>
        </div>
    </div>


</div> <!-- left column end -->



<div class="cell-container5 spacer-left"> <!-- content column start -->

	<div class="normalcell spacer-bottom-m" style="padding:0">
		<a href="<?php echo url_for('@cinema_photos?id=' . $cinema->getId() . '&key=' . $cinema->getUrlKey());?>"><img src="<?php echo filmsiCinemaPhoto($cinema->getFilename());?>" /></a><br /><br />
        <span class="more-cell"><a href="<?php echo url_for('@cinema_photos?id=' . $cinema->getId() . '&key=' . $cinema->getUrlKey());?>" class="smallwhite-link">vezi mai multe fotografii &raquo;</a></span>
    </div>


    <div class="normalcell spacer-bottom">
    	<p class="bigtext spacer-bottom">Da o nota cinematografului <strong><?php echo $cinema->getName();?></strong></p>

        <div class="left innerspacer-top" style="width: 260px">
			<?php if ($cinema->checkIfIpVotedToday($_SERVER['REMOTE_ADDR'])):?>
								
				<p class="spacer-bottom-s"><strong>Ai votat deja azi pentru acest cinematograf!</strong></p>
			<?php else:?>
				<a href="" class="icon-votestar votetrigger" id="votestar-1"></a>
				<a href="" class="icon-votestar votetrigger" id="votestar-2"></a>
				<a href="" class="icon-votestar votetrigger" id="votestar-3"></a>
				<a href="" class="icon-votestar votetrigger" id="votestar-4"></a>
				<a href="" class="icon-votestar votetrigger" id="votestar-5"></a>
				<a href="" class="icon-votestar votetrigger" id="votestar-6"></a>
				<a href="" class="icon-votestar votetrigger" id="votestar-7"></a>
				<a href="" class="icon-votestar votetrigger" id="votestar-8"></a>
				<a href="" class="icon-votestar votetrigger" id="votestar-9"></a>
				<a href="" class="icon-votestar votetrigger" id="votestar-10"></a>
				<form id="vote_form" method="post" action="<?php echo url_for('@cinema_vote');?>">
					<input type="hidden" name="cinema_id" value="<?php echo $cinema->getId();?>" />
					<input type="hidden" id="vote_grade" name="grade" value="" />
				</form>

				<script type="text/javascript">
						$(document).ready(function(){
							$('.votetrigger').mouseover(function(){
								id = parseInt($(this).attr('id').substr(9));

								for (i = 1; i <= id; i++){
									$('#votestar-' + i).removeClass('icon-votestar').addClass('icon-votestar-active');
								}
							});

							$('.votetrigger').mouseout(function(){
								$('.votetrigger').removeClass('icon-votestar-active').addClass('icon-votestar');
							});

							$('.votetrigger').click(function(){
								$('#vote_grade').val($(this).attr('id').substr(9));
								$('#vote_form').submit();
							});
						});
					</script>
			<?php endif;?>
        </div> <!-- vote stars end -->

        <div class="left innerspacer-left-l cell-separator-dotted-left">
			<p class="hugegreen"><?php echo format_number(number_format($cinema->getVoteScore(), 2), 'ro');?></p>din <?php echo $cinema->getVoteCount();?> voturi
		</div>

        <div class="clear"></div>
    </div>








    <div class="normalcell spacer-bottom">

        <div class="left innerspacer-top cell-separator-dotted-right" style="width: 260px">
        	<p class="bigstronggreen spacer-bottom-s">Adresa</p>
            <p class="spacer-bottom-s"><?php echo $cinema->getAddress();?></p>
            <p class="spacer-bottom"><a href="<?php echo $cinema->getWebsite();?>" class="important-link"><?php echo $cinema->getWebsite();?></a></p>
        </div>

        <div class="left spacer-left-s">
            <p class="bigstronggreen spacer-bottom-s">Telefon</p>
            <p class="spacer-bottom-s"><?php echo $cinema->getPhone();?></p>
        </div>

        <div class="clear"></div>

		<div id="map_canvas" style="height: 200px"></div>
    </div>

    <div class="normalcell spacer-bottom" style="padding: 5px 0">

        <div class="left bigstronggreen spacer-left cell-separator-dotted-right" style="width: 100px">Capacitate</div>
        <div class="left bigstronggreen spacer-left cell-separator-dotted-right" style="width: 50px">Sali</div>
        <div class="left bigstronggreen spacer-left cell-separator-dotted-right" style="width: 90px">Sunet</div>
        <div class="left bigstronggreen spacer-left" style="width: 150px">Facilitati</div>

        <div class="clear"></div>

        <hr class="cell-separator2 spacer-top-s spacer-bottom-s" />

        <div class="left spacer-left" style="width: 100px"><strong><?php echo $cinema->getSeats();?></strong></div>
        <div class="left spacer-left" style="width: 50px"><strong><?php echo $cinema->getRoomCount();?></strong></div>
        <div class="left spacer-left" style="width: 90px"><strong><?php echo $cinema->getSound();?></strong></div>
        <div class="left spacer-left" style="width: 150px">
			<ul>
				<?php foreach($cinema->getService() as $service):?>
            	<li><span class="icon-checkbullet"></span> <?php echo $service->getName();?></li>
				<?php endforeach;?>
            </ul>
        </div>
        <div class="clear"></div>
    </div>

    <div class="normalcell mb-3">
        <?php echo $cinema->getDescriptionTeaser();?>
		<span class="more-cell"><a href="<?php echo url_for('@cinema_description?id=' . $cinema->getId() . '&key=' . $cinema->getUrlKey());?>" class="smallwhite-link">citeste mai mult &raquo;</a></span>
    </div>

    <div class="normalcell spacer-top spacer-bottom">
    	<div>
            <div class="right innerspacer-right spacer-right-m"><span class="st_email_large" st_title="" ></span></div>
            <div class="right innerspacer-right spacer-right-m"><span class="st_facebook_large" st_title=""></span></div>
            <div class="right innerspacer-right spacer-right-m"><span class="st_twitter_large" st_title=""></span></div>

            <div class="inline-block spacer-right-l">Spune si prietenilor tai pe</div>

            <div class="clear"></div>
        </div>
    </div>







	<div class="cell spacer-bottom-m">
        <div class="cell-hd">
            <h5>Program <span class="black">in saptamana <?php echo $firstDay;?>-<?php echo $lastDay;?> <?php echo format_date(date('Y-m-d'), 'M', 'ro');?></span></h5>
        </div>

        <div class="cell-bd">
			<?php foreach ($currentFilms as $currentFilm):?>
				<div class="left" style="width: 230px">
					<a href="<?php echo url_for('@film?id=' . $currentFilm['film']['id'] . '&key=' . $currentFilm['film']['url_key']);?>">
						<img src="<?php echo filmsiFilmPhotoThumbS($currentFilm['film']['filename']);?>" class="left" />
					</a>
					<div class="left spacer-left">
						<a href="<?php echo url_for('@film?id=' . $currentFilm['film']['id'] . '&key=' . $currentFilm['film']['url_key']);?>" class="important-link"><?php echo $currentFilm['film']['name_ro'];?></a> <br />
						<?php if ($currentFilm['film']['name_en'] != ''): ?><em>(<?php echo $currentFilm['film']['name_en'];?>)</em><?php endif;?>
					</div>
				</div>

				<div class="left innerspacer-left cell-separator-dotted-left" style="width: 220px">
					<table>
						<tr>
							<td class="explanation-small" style="width: 30px">Zile</td>
							<td class="explanation-small" style="width: 110px">Ore</td>
							<td class="explanation-small" style="width: 50px">Rezerve bilete</td>
						</tr>
						<?php foreach ($currentFilm['schedules'] as $schedule):?>
							<tr>
								<td style="padding:5px 10px"><strong><?php echo filmsiDayOfWeek(date('N', strtotime($schedule['day'])));?></strong></td>
								<td style="padding:5px 10px"><span class="smalltext"><?php echo $schedule['schedule'];?></span></td>
								<td style="padding:5px 10px"><a href="<?php echo $cinema->getReservationUrl();?>" class="greenbutton-s-link" target="_blank">Rezerva</a></td>
							</tr>
						<?php endforeach;?>

					</table>

				</div>

				<div class="clear"></div>

				<hr class="cell-separator-double spacer-top spacer-bottom" />
			<?php endforeach;?>

            
        </div>

        <span class="more-cell"><a href="<?php echo url_for('@cinema_schedule?id=' . $cinema->getId() . '&key=' . $cinema->getUrlKey());?>" class="smallwhite-link">vezi tot programul &raquo;</a></span>
    </div> <!-- program in saptamana end -->







	<?php if(count($futureFilms) > 0):?>
    <div class="cell spacer-bottom-m">
        <div class="cell-hd">
            <h5>In curand</h5>
        </div>

        <div class="cell-bd">
        	<?php foreach ($futureFilms as $futureFilm):?>
				<div class="left" style="width: 230px">
					<a href="<?php echo url_for('@film?id=' . $futureFilm['film']['id'] . '&key=' . $futureFilm['film']['url_key']);?>">
						<img src="<?php echo filmsiFilmPhotoThumbS($futureFilm['film']['filename']);?>" class="left" />
					</a>
					<div class="left spacer-left">
						<a href="<?php echo url_for('@film?id=' . $futureFilm['film']['id'] . '&key=' . $futureFilm['film']['url_key']);?>" class="important-link"><?php echo $futureFilm['film']['name_ro'];?></a> <br />
						<?php if ($futureFilm['film']['name_en'] != ''): ?><em>(<?php echo $futureFilm['film']['name_en'];?>)</em><?php endif;?>
					</div>
				</div>

				<div class="left innerspacer-left cell-separator-dotted-left" style="width: 220px">
					<table>
						<tr>
							<td class="explanation-small" style="width: 30px">Zile</td>
							<td class="explanation-small" style="width: 110px">Ore</td>
							<td class="explanation-small" style="width: 50px">Rezerve bilete</td>
						</tr>
						<?php foreach ($futureFilm['schedules'] as $schedule):?>
							<tr>
								<td style="padding:5px 10px"><strong><?php echo filmsiDayOfWeek(date('N', strtotime($schedule['day'])));?></strong></td>
								<td style="padding:5px 10px"><span class="smalltext"><?php echo $schedule['schedule'];?></span></td>
								<td style="padding:5px 10px"><a href="<?php echo $cinema->getReservationUrl();?>" class="greenbutton-s-link" target="_blank">Rezerva</a></td>
							</tr>
						<?php endforeach;?>

					</table>

				</div>

				<div class="clear"></div>

				<hr class="cell-separator-double spacer-top spacer-bottom" />
			<?php endforeach;?>









        </div>

        <span class="more-cell"><a href="<?php echo url_for('@cinema_schedule?id=' . $cinema->getId() . '&key=' . $cinema->getUrlKey());?>" class="smallwhite-link">vezi tot programul &raquo;</a></span>
    </div><!-- program in curand -->
	<?php endif;?>







    <div class="cell spacer-bottom-m innerspacer-bottom-m">
        <div class="cell-hd">
            <h4>Promotii la <span class="black"><?php echo $cinema->getName();?></span></h4>
        </div>

		<?php foreach ($sf_data->getRaw('cinema')->getPromotions() as $promotion):?>
			<div class="cell-bd">
				<h6><?php echo $promotion->getName();?></h6><br />
				<?php echo $promotion->getContent();?> <br /><br />
				<img src="<?php echo filmsiCinemaPromotionPhoto($promotion->getFilename());?>" />
			</div>
		<?php endforeach;?>
    </div>




    <?php include_partial('comments/formAndList', array(
		'form' => $commentForm,
		'comments' => $comments,
		'action' => url_for('@cinema?id=' . $cinema->getId() . '&key=' . $cinema->getUrlKey())
	));?>

</div> <!-- content column end -->









<div class="cell-container7 spacer-left"> <!-- right column start -->
	<?php include_component('default', 'rightColumn', array('page' => Page::CINEMA));?>
</div> <!-- right column end -->


<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
	var map;
	var marker;

	$(document).ready(function(){
		initializeMap();
	});

function initializeMap()
{
    var latlng = new google.maps.LatLng(<?php echo $cinema->getLat();?>, <?php echo $cinema->getLng();?>);
    var myOptions = {
      zoom: <?php echo $cinema->getMapZoom();?>,
      center: latlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

	marker = new google.maps.Marker({
		map: map,
		position: latlng
	});

	google.maps.event.addListener(marker, 'drag', function() {
		$('#cinema_lat').attr('value',marker.getPosition().lat());
		$('#cinema_lng').attr('value', marker.getPosition().lng());
	});
}
</script>