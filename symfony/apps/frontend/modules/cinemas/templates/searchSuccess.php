<h2>Programul <span class="black">cinematografelor</span></h2>

<div class="spacer-bottom-m">
	<a href="<?php echo url_for('@homepage');?>" class="black-link">Home</a> &raquo;
	<a href="<?php echo url_for('@cinema_search');?>" class="black-link">Programul cinematografelor</a>
</div>




<div class="cell-container9"> <!-- content column start -->
	<div class="left" style="width:490px">
        <div class="greencell spacer-bottom-m">
            <div class="normalcell">Foloseste aplicatia de Rezervari Bilete FilmSi! Vei constata cate este de utila! <br /><br /> Acum ai cel mai simplu mod de a afla programul cinematografelor!  Afla la care cinematograf se difuzeaza filmul tau preferat! <br /><br />Rezerva online sau telefonic bilete la filmul preferat si la cinematograful favorit!</div>
        </div>

	    <h6 class="spacer-bottom-s">Vrei la film? <span class="black">Afla acum ce filme se difuzeaza la Cinema in orasul tau!</span></h6>
	</div>

    <div class="left spacer-left" style="width:490px; position:relative">
    	<h1 style="font-size: 45px">Alege ziua in care vrei sa mergi la film</h1>
        <img src="images/cinema-arrow.png" style="position:absolute; top: 70px; left: 300px" />
    </div>

    <div class="clear"></div>


    <div>
    	<div class="left" style="width:490px;">
            <select id="location-selector" style="width: 225px" class="normalselect" 
					onchange="location.href='<?php echo url_for('@cinema_search');?>?l=' + $('#location-selector option:selected').val() + '<?php if(isset($currentFilm)) echo '&f=' . $currentFilm;?><?php if(isset($currentDay)) echo '&d=' . $currentDay;?>'">
				<option value="">Selecteaza oras</option>
				<?php foreach($locations as $key => $location):?>
					<option value="<?php echo $key;?>"<?php if (isset($currentLocation) && $currentLocation == $key) echo ' selected="selected"';?>><?php echo $location;?></option>
				<?php endforeach;?>
			</select>
            <select id="film-selector" style="width: 225px" class="normalselect spacer-left-s"
					onchange="location.href='<?php echo url_for('@cinema_search');?>?f=' + $('#film-selector option:selected').val() + '<?php if(isset($currentLocation)) echo '&l=' . $currentLocation;?><?php if(isset($currentDay)) echo '&d=' . $currentDay;?>'">
				<option value="">Selecteaza film</option>
				<?php foreach($filmsInCinema as $key => $filmInCinema):?>
					<option value="<?php echo $filmInCinema['id'];?>"<?php if (isset($currentFilm) && $currentFilm == $filmInCinema['id']) echo ' selected="selected"';?>><?php echo $filmInCinema['name_ro'];?></option>
				<?php endforeach;?>
			</select>
        </div>

        <div class="left" style="margin-left: 15px">
        	<span class="daypicker-today<?php if($currentDay == date('Y-m-d')) echo '-active';?>"
				  onclick="location.href='<?php echo url_for('@cinema_search');?>?d=<?php echo date('Y-m-d');?><?php if(isset($currentFilm)) echo '&f=' . $currentFilm;?><?php if(isset($currentLocation)) echo '&l=' . $currentLocation;?>'">Astazi</span>
            <span class="daypicker-day<?php if($currentDay == $currentWeekDays[1]) echo '-active';?>"
				  onclick="location.href='<?php echo url_for('@cinema_search');?>?d=<?php echo $currentWeekDays[1];?><?php if(isset($currentFilm)) echo '&f=' . $currentFilm;?><?php if(isset($currentLocation)) echo '&l=' . $currentLocation;?>'">L</span>
            <span class="daypicker-day<?php if($currentDay == $currentWeekDays[2]) echo '-active';?>"
				  onclick="location.href='<?php echo url_for('@cinema_search');?>?d=<?php echo $currentWeekDays[2];?><?php if(isset($currentFilm)) echo '&f=' . $currentFilm;?><?php if(isset($currentLocation)) echo '&l=' . $currentLocation;?>'">M</span>
            <span class="daypicker-day<?php if($currentDay == $currentWeekDays[3]) echo '-active';?>"
				  onclick="location.href='<?php echo url_for('@cinema_search');?>?d=<?php echo $currentWeekDays[3];?><?php if(isset($currentFilm)) echo '&f=' . $currentFilm;?><?php if(isset($currentLocation)) echo '&l=' . $currentLocation;?>'">M</span>
            <span class="daypicker-day<?php if($currentDay == $currentWeekDays[4]) echo '-active';?>"
				  onclick="location.href='<?php echo url_for('@cinema_search');?>?d=<?php echo $currentWeekDays[4];?><?php if(isset($currentFilm)) echo '&f=' . $currentFilm;?><?php if(isset($currentLocation)) echo '&l=' . $currentLocation;?>'">J</span>
            <span class="daypicker-day<?php if($currentDay == $currentWeekDays[5]) echo '-active';?>"
				  onclick="location.href='<?php echo url_for('@cinema_search');?>?d=<?php echo $currentWeekDays[5];?><?php if(isset($currentFilm)) echo '&f=' . $currentFilm;?><?php if(isset($currentLocation)) echo '&l=' . $currentLocation;?>'">V</span>
            <span class="daypicker-day<?php if($currentDay == $currentWeekDays[6]) echo '-active';?>"
				  onclick="location.href='<?php echo url_for('@cinema_search');?>?d=<?php echo $currentWeekDays[6];?><?php if(isset($currentFilm)) echo '&f=' . $currentFilm;?><?php if(isset($currentLocation)) echo '&l=' . $currentLocation;?>'">S</span>
            <span class="daypicker-day<?php if($currentDay == $currentWeekDays[7]) echo '-active';?>"
				  onclick="location.href='<?php echo url_for('@cinema_search');?>?d=<?php echo $currentWeekDays[7];?><?php if(isset($currentFilm)) echo '&f=' . $currentFilm;?><?php if(isset($currentLocation)) echo '&l=' . $currentLocation;?>'">D</span>
            <span class="daypicker-week">Saptamana asta</span>
        </div>

        <div class="clear"></div>






        <div class="normalcell">
			
			<?php foreach ($films as $film):?>
        	<div class="left cell-separator-dotted-right" style="width:480px">
                <a href="<?php echo url_for('@film?id=' . $film['film']->getId() . '&key=' . $film['film']->getUrlKey());?>" class="left"><img src="<?php echo filmsiFilmPhotoThumb($film['film']->getFilename());?>" /></a>

                <div class="left spacer-left" style="width: 320px">
                	<a href="<?php echo url_for('@film?id=' . $film['film']->getId() . '&key=' . $film['film']->getUrlKey());?>" class="bigblue-link"><?php echo $film['film']->getNameRo();?></a> (<?php echo $film['film']->getYear();?>) <br />
                    <?php if($film['film']->getNameEn() != ''):?><em>(<?php echo $film['film']->getNameEn();?>)</em><?php endif;?>

                    <hr class="cell-separator-double spacer-top spacer-bottom" />

                    <p class="explanation-small spacer-bottom">
						Cu:
						<?php foreach ($film['film']->getBestActors('3') as $actor): ?>
							<a href="<?php echo url_for('@person?id=' . $actor->getId() . '&key=' . $actor->getUrlKey());?>" class="small-link"><?php echo $actor->getName();?></a>,
						<?php endforeach;?>
					</p>
                    <p class="explanation-small spacer-bottom-l">
						Regia:
						<?php foreach ($film['film']->getBestDirectors() as $director): ?>
							<a href="<?php echo url_for('@person?id=' . $director->getId() . '&key=' . $director->getUrlKey());?>" class="small-link"><?php echo $director->getName();?></a>,
						<?php endforeach;?>
					</p>

                    <a href="<?php echo url_for('@film_videos?id=' . $film['film']->getId() . '&key=' . $film['film']->getUrlKey());?>" class="important-link">Trailere</a>
                </div>
            </div>

            <div class="left spacer-left" style="450px">
                <table>
                    <tr class="cell-separator-dotted-bottom">
						<td class="explanation-small" style="width: 220px">Cinematograf</td>
                        <td class="explanation-small" style="width: 80px">Rezerva bilete online</td>
                        <td class="explanation-small" style="width: 110px">Rezerve bilete telefonic</td>
                    </tr>
					<?php foreach($film['cinemas'] as $key => $cinema):?>
                    <tr<?php if ($key % 2 == 0) echo ' class="odd-row"';?>>
                        <td style="padding:5px 10px">
							<a href="<?php echo url_for('@cinema?id=' . $cinema->getId() . '&key=' . $cinema->getUrlKey());?>" class="important-link"><?php echo $cinema->getName();?></a>
						</td>
                        <td style="padding:5px 10px">
							<?php if ($cinema->getReservationUrl() != ''):?>
								<a href="<?php echo $cinema->getReservationUrl();?>" class="greenbutton-s-link" target="_blank">Rezerva</a>
							<?php endif;?>
						</td>
                        <td style="padding:5px 10px">
							<?php echo $cinema->getPhone();?>
						</td>
                    </tr>
					<?php endforeach?>
                </table>
            </div>

        	<div class="clear"></div>

            <hr class="cell-separator-double mt-3 mb-3" />
			<?php endforeach;?>
        </div>
    </div>







</div> <!-- content column end -->

