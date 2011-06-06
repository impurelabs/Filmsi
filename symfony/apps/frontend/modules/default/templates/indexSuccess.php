<?php slot('backgroundTag');?>
<div style="width: <?php echo $width;?>px; margin: 0 auto; background: url('<?php echo filmsiHomepageBackground($homepage->getBackgroundFilename());?>') top no-repeat">
<?php end_slot();?>

<div>
  <div class="cell-container1">
    <div class="spacer-bottom">
      <h2>Buzz</h2>
    </div>
    <div class="cell spacer-bottom-m">
      <div class="cell-hd">
        <h4>Stiri</h4>
      </div>
      <div class="cell-bd"> 
		<?php foreach($stires as $key => $stire):?>
			<?php if ($key == 0):?>
				<a href="<?php echo url_for('@stire?id=' . $stire->getId() . '&key=' . $stire->getUrlKey());?>"><img width="190" src="<?php echo filmsiStirePhoto($stire->getFilename());?>" /></a><br />
				<a href="<?php echo url_for('@stire?id=' . $stire->getId() . '&key=' . $stire->getUrlKey());?>" class="importantblack-link"><?php echo $stire->getName();?></a><br />
				<hr class="cell-separator-dotted-bottom mb-1 mt-1" />
			<?php else:?>
				<ul class="list2">
				  <li>
					  <a href="<?php echo url_for('@stire?id=' . $stire->getId() . '&key=' . $stire->getUrlKey());?>" class="black-link strong"><?php echo $stire->getName();?></a>
				  </li>
				</ul>
				<?php if($key < count($stires) - 1):?>
					<hr class="cell-separator-dotted-bottom mb-1" />
				<?php else:?>
					<div class="mb-1"></div>
				<?php endif;?>
			<?php endif;?>
		<?php endforeach;?>
        
        <span class="more-cell"><a href="<?php echo url_for('@stires');?>" class="smallwhite-link">afla mai multe &raquo;</a></span> </div>
    </div>
    <!-- stiri cell end -->

	<?php if (count($starStires) > 0):?>
		<div class="cell spacer-bottom-m">
		  <div class="cell-hd">
			<h4>Vedete</h4>
		  </div>
		  <div class="cell-bd"> <?php foreach($starStires as $key => $starStire):?>
				<?php if ($key == 0):?>
					<a href="<?php echo url_for('@stire?id=' . $starStire->getId() . '&key=' . $starStire->getUrlKey());?>"><img width="190" src="<?php echo filmsiStirePhotoThumb($starStire->getFilename());?>" /></a><br />
					<a href="<?php echo url_for('@stire?id=' . $starStire->getId() . '&key=' . $starStire->getUrlKey());?>" class="importantblack-link"><?php echo $starStire->getName();?></a><br />
					<hr class="cell-separator-dotted-bottom mb-1 mt-1" />
				<?php else:?>
					<ul class="list2">
					  <li>
						  <a href="<?php echo url_for('@stire?id=' . $starStire->getId() . '&key=' . $starStire->getUrlKey());?>" class="black-link strong"><?php echo $starStire->getName();?></a>
					  </li>
					</ul>
					<?php if($key < count($starStires) - 1):?>
						<hr class="cell-separator-dotted-bottom mb-1" />
					<?php else:?>
						<div class="mb-1"></div>
					<?php endif;?>
				<?php endif;?>
			<?php endforeach;?>
		</div>
		<!-- vedete cell end -->

	  </div>
	<?php endif;?>

    <div class="cell">
      <div class="cell-bd align-center">
        <h5>Aici este locul in care tu faci stirile</h5>
        <span style="float: right; font-family: Georgia, 'Times New Roman', Times, serif; font-size:52px">?</span>
        <p style="text-align: left; margin-top: 15px">Ai ceva de spus despre un film <br />
          Ai gasit o stire interesanta</p>
        <br />
        <a href="<?php echo url_for('@stire_publish');?>" class="greenbutton-link">Spune-le tuturor</a> </div>
		<br />
    </div>
    <!-- vedete cell end -->

  </div><!-- cell-container1 end -->

  <div class="cell-container2 spacer-left">
    <div class="align-center spacer-bottom">
      <h2>Filmele care ruleaza <span class="black">acum</span></h2>
    </div>
    <div class="cell-container3">
      <div class="cell">
        <div class="cell-hd" style="padding-left: 52px">
          <div class="right spacer-top-s"><a href="javascript: void(0)"><span class="icon-rss"></span></a></div>
          <span class="icon-popcorn"></span>
          <h4>La cinema</h4>
        </div>
        <div class="cell-bd" style="height: 500px">
			<?php foreach ($filmsNowInCinema as $filmNowInCinema):?>
				<div class="mb-3" style="position: relative">
					<div class="inline-block spacer-right-s details-container" style="vertical-align:top">
						<a href="<?php echo url_for('@film?id=' . $filmNowInCinema->getId() . '&key=' . $filmNowInCinema->getUrlKey());?>"><img src="<?php echo filmsiFilmPhotoThumbS($filmNowInCinema->getFilename());?>" style="width: 49px" /></a>
						<div class="detailscell" id="detailscell1-<?php echo $filmNowInCinema->getId();?>"> <a href="<?php echo url_for('@film?id=' . $filmNowInCinema->getId() . '&key=' . $filmNowInCinema->getUrlKey());?>" class="left"><img width="100" src="<?php echo filmsiFilmPhotoThumb($filmNowInCinema->getFilename());?>" /></a>
						  <div class="details-content"> <a href="<?php echo url_for('@film?id=' . $filmNowInCinema->getId() . '&key=' . $filmNowInCinema->getUrlKey());?>" class="bigblack-link"><?php echo $filmNowInCinema->getNameRo();?></a> <br />
							<?php if($filmNowInCinema->getNameEn() != ''):?><em>(<?php echo $filmNowInCinema->getNameEn();?>)</em><?php endif;?>
							<hr class="cell-separator1 spacer-top spacer-bottom" />
							<?php if (count($filmNowInCinema->getBestDirectors()) > 0):?>
							<span class="explanation-small">Regia:</span>
								<?php foreach ($filmNowInCinema->getBestDirectors() as $person):?>
									<a href="<?php echo url_for('@person?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>" class="explanation-link"><?php echo $person->getName();?></a>,
								<?php endforeach;?>
							<?php endif;?>
							<span class="explanation-small">Cu:</span>
								<?php foreach ($filmNowInCinema->getBestActors(3) as $person):?>
									<a href="<?php echo url_for('@person?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>" class="explanation-link"><?php echo $person->getName();?></a>,
								<?php endforeach;?>
							<hr class="cell-separator1 spacer-top spacer-bottom" />
							<a href="<?php echo url_for('@cinema_search');?>?f=<?php echo $filmNowInCinema->getId();?>" class="whitebutton-small-link">rezerva bilet&raquo;</a>
							<a href="<?php echo url_for('@film_videos?id=' . $filmNowInCinema->getId() . '&key=' . $filmNowInCinema->getUrlKey());?>" class="whitebutton-small-link spacer-left">vezi trailer &raquo;</a> </div>
						  <span class="details-cioc"></span> 
						</div><!-- details end -->
					</div>
				<div class="inline-block cell-separator-dotted-bottom" style="width: 200px"> <a href="<?php echo url_for('@film?id=' . $filmNowInCinema->getId() . '&key=' . $filmNowInCinema->getUrlKey());?>" class="important-link"><?php echo $filmNowInCinema->getNameRo();?></a><br />
				  <?php if($filmNowInCinema->getNameEn() != ''):?><em>(<?php echo $filmNowInCinema->getNameEn();?>)</em><?php endif;?>
				  <div class="spacer-top-sm explanation-small">Cu: 
					  <?php foreach ($filmNowInCinema->getBestActors(3) as $person):?>
						<a href="<?php echo url_for('@person?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>" class="explanation-link"><?php echo $person->getName();?></a>,
					<?php endforeach;?>
				  </div>
				</div>
				</div>
			<?php endforeach;?>
        </div>
      </div>
      <!-- cell 3 end -->

      <a href="<?php echo url_for('@film_now_in_cinema');?>" class="whitebutton-link spacer-top" style="width: 255px"><span class="icon-calendar7"></span> Vezi filmele saptamanii in cinema</a> </div>
    <!-- cell-container 3 end -->

    <div class="cell-container3 spacer-left">
      <div class="cell">
        <div class="cell-hd" style="padding-left: 62px">
          <div class="right spacer-top-s"><a href="javascript: void(0)"><span class="icon-rss"></span></a></div>
          <span class="icon-dvd"></span>
          <h4>Dvd <span class="black">&amp;</span> Bluray</h4>
        </div>
        <div class="cell-bd" style="height: 500px">
			<?php foreach($filmsNowDbo as $filmNowDbo):?>
			<div class="mb-3" style="position: relative">
				<div class="inline-block spacer-right-s details-container" style="vertical-align:top">
					<a href="<?php echo url_for('@film?id=' . $filmNowDbo->getId() . '&key=' . $filmNowDbo->getUrlKey());?>">
						<img src="<?php echo filmsiFilmPhotoThumbS($filmNowDbo->getFilename());?>" style="width: 49px" />
					</a>
					<div class="detailscell" id="detailscell2-<?php echo $filmNowDbo->getId();?>"> <a href="<?php echo url_for('@film?id=' . $filmNowDbo->getId() . '&key=' . $filmNowDbo->getUrlKey());?>" class="left"><img width="100" src="<?php echo filmsiFilmPhotoThumb($filmNowDbo->getFilename());?>" /></a>
					  <div class="details-content"> <a href="<?php echo url_for('@film?id=' . $filmNowDbo->getId() . '&key=' . $filmNowDbo->getUrlKey());?>" class="bigblack-link"><?php echo $filmNowDbo->getNameRo();?></a> <br />
						<?php if ($filmNowDbo->getNameEn() != ''):?><em>(<?php echo $filmNowDbo->getNameEn();?>)</em><?php endif;?>
						<hr class="cell-separator1 spacer-top spacer-bottom" />
						<?php if (count($filmNowDbo->getBestDirectors()) > 0):?>
						<span class="explanation-small">Regia:</span>
							<?php foreach ($filmNowDbo->getBestDirectors() as $person):?>
								<a href="<?php echo url_for('@person?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>" class="explanation-link"><?php echo $person->getName();?></a>,
							<?php endforeach;?>
						<?php endif;?>
						<span class="explanation-small">Cu:</span>
							<?php foreach ($filmNowDbo->getBestActors(3) as $person):?>
								<a href="<?php echo url_for('@person?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>" class="explanation-link"><?php echo $person->getName();?></a>,
							<?php endforeach;?>
						<hr class="cell-separator1 spacer-top spacer-bottom" />
						<a href="<?php echo url_for('@film_buy?id=' . $filmNowDbo->getId() . '&key=' . $filmNowDbo->getUrlKey());?>" class="whitebutton-small-link">cumpara&raquo;</a> <a href="<?php echo url_for('@film_videos?id=' . $filmNowDbo->getId() . '&key=' . $filmNowDbo->getUrlKey());?>" class="whitebutton-small-link spacer-left">vezi trailer &raquo;</a> </div>
					  <span class="details-cioc"></span> 
					</div><!-- details end -->
				</div>
				<div class="inline-block cell-separator-dotted-bottom" style="width: 200px"> <a href="<?php echo url_for('@film?id=' . $filmNowDbo->getId() . '&key=' . $filmNowDbo->getUrlKey());?>" class="important-link"><?php echo $filmNowDbo->getNameRo();?></a><br />
				  <?php if ($filmNowDbo->getNameEn() != ''):?><em>(<?php echo $filmNowDbo->getNameEn();?>)</em><?php endif;?>
				  <div class="spacer-top-sm explanation-small">Cu:
					  <?php foreach ($filmNowDbo->getBestActors(3) as $person):?>
						<a href="<?php echo url_for('@person?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>" class="explanation-link"><?php echo $person->getName();?></a>,
					<?php endforeach;?>
				  </div>
				</div>
			</div>
			<?php endforeach;?>
          
        </div>
      </div>
      <a href="<?php echo url_for('@film_now_on_dvd');?>" class="whitebutton-link spacer-top" style="width: 255px"><span class="icon-dvdbluray"></span> Afla tot ce e nou pe DVD & Bluray</a> </div>
    <!-- cell-container 3 end -->

    <div class="cell-container1 spacer-left">
      <div class="cell">
        <div class="cell-hd" style="padding-left: 67px">
          <div class="right spacer-top-s"><a href="javascript: void(0)"><span class="icon-rss"></span></a></div>
          <span class="icon-tv"></span>
          <h4>La TV</h4>
        </div>
        <div class="cell-bd" style="height: 500px">
			<?php foreach ($filmsNowTv as $filmNowTv):?>
			  <div class="mb-3" style="position: relative">
				<div class="inline-block spacer-right-s details-container" style="vertical-align:top">
					<a href="<?php echo url_for('@film?id=' . $filmNowTv->getFilm()->getId() . '&key=' . $filmNowTv->getFilm()->getUrlKey());?>"><img src="<?php echo filmsiFilmPhotoThumbS($filmNowTv->getFilm()->getFilename());?>" style="width: 49px" /></a>
					<div class="detailscell" id="detailscell3-<?php echo $filmNowTv->getId();?>"> <a href="<?php echo url_for('@film?id=' . $filmNowTv->getFilm()->getId() . '&key=' . $filmNowTv->getFilm()->getUrlKey());?>" class="left"><img width="100" src="<?php echo filmsiFilmPhotoThumb($filmNowTv->getFilm()->getFilename());?>" /></a>
					  <div class="details-content"> <a href="<?php echo url_for('@film?id=' . $filmNowTv->getFilm()->getId() . '&key=' . $filmNowTv->getFilm()->getUrlKey());?>" class="bigblack-link"><?php echo $filmNowTv->getFilm()->getNameRo();?></a> <br />
						<?php if ($filmNowTv->getFilm()->getNameEn() != ''):?><em>(<?php echo $filmNowTv->getFilm()->getNameEn();?>)</em><?php endif;?>
						<hr class="cell-separator1 spacer-top spacer-bottom" />
						<?php if (count($filmNowTv->getFilm()->getBestDirectors()) > 0):?>
						<span class="explanation-small">Regia:</span>
							<?php foreach ($filmNowTv->getFilm()->getBestDirectors() as $person):?>
								<a href="<?php echo url_for('@person?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>" class="explanation-link"><?php echo $person->getName();?></a>,
							<?php endforeach;?>
						<?php endif;?>
						<span class="explanation-small">Cu:</span>
							<?php foreach ($filmNowTv->getFilm()->getBestActors(3) as $person):?>
								<a href="<?php echo url_for('@person?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>" class="explanation-link"><?php echo $person->getName();?></a>,
							<?php endforeach;?>
						<hr class="cell-separator1 spacer-top spacer-bottom" />
						<a href="<?php echo url_for('@film_videos?id=' . $filmNowTv->getFilm()->getId() . '&key=' . $filmNowTv->getFilm()->getUrlKey());?>" class="whitebutton-small-link spacer-left">vezi trailer &raquo;</a> </div>
					  <span class="details-cioc"></span> </div>
					<!-- details end -->
				</div>
				<div class="inline-block cell-separator-dotted-bottom" style="width: 135px"> <a href="<?php echo url_for('@film?id=' . $filmNowTv->getFilm()->getId() . '&key=' . $filmNowTv->getFilm()->getUrlKey());?>" class="important-link"><?php echo $filmNowTv->getFilm()->getNameRo();?></a><br />
				  <?php if ($filmNowTv->getFilm()->getNameEn() != ''):?><em>(<?php echo $filmNowTv->getFilm()->getNameEn();?>)</em><?php endif;?>
				  <div class="spacer-top-ml"><a href="<?php echo url_for('@film?id=' . $filmNowTv->getFilm()->getId() . '&key=' . $filmNowTv->getFilm()->getUrlKey());?>" class="explanation-link">Pro TV</a></div>
				</div>
			  </div>
			<?php endforeach;?>
        </div>
      </div>
      <a href="<?php echo url_for('@film_on_tv');?>" class="whitebutton-link spacer-top" style="width: 185px"><span class="icon-today"></span> Vezi filmele de azi de la TV</a> </div>
    <!-- cell-container 3 end -->

    <div class="clear"></div>
    <div class="mt-4 spacer-bottom greencell pl-2">
      <div class="left" style="width: 260px"> <span style="font-size: 23px; color: #000000">Vrei la cinematograf?</span> <br />
        <span style="font-size: 17px; color: #ffffff">Afla chiar acum ce filme sunt la cinematograf in orasul tau.</span> </div>
      <div class="left spacer-top-m spacer-left-xxl">
        <select id="cinema-city-selector" class="cinema-city" style="width: 350px" onchange="location.href='<?php echo url_for('@cinema_search');?>?l=' + $('#cinema-city-selector > option:selected').val()">
          <option value="0">Alege orasul</option>
		  <?php foreach($cinemaLocations as $locationId => $cinemaLocation):?>
			<option value="<?php echo $locationId;?>"><?php echo $cinemaLocation;?></option>
		  <?php endforeach;?>
        </select>
      </div>
      <div class="clear"></div>
    </div>
    <div class="align-center mb-4">
      <h2>Filmele ce vor rula <span class="black">in curand</span></h2>
    </div>
    <div class="cell-container3">
      <div class="cell">
        <div class="cell-hd" style="padding-left: 52px">
          <div class="right spacer-top-s"><a href="javascript: void(0)"><span class="icon-rss"></span></a></div>
          <span class="icon-popcorn"></span>
          <h4>La cinema</h4>
        </div>
        <div class="cell-bd" style="height: 470px">
          <?php foreach ($filmsSoonInCinema as $filmSoonInCinema):?>
				<div class="inline-block cell-separator-dotted-bottom mb-1"> 
					<a href="<?php echo url_for('@film?id=' . $filmSoonInCinema->getId() . '&key=' . $filmSoonInCinema->getUrlKey());?>" class="important-link"><?php echo $filmSoonInCinema->getNameRo();?></a><br />
				  <?php if($filmSoonInCinema->getNameEn() != ''):?><em>(<?php echo $filmSoonInCinema->getNameEn();?>)</em><?php endif;?>
				  <div class="explanation-small">Cu:
					  <?php foreach ($filmSoonInCinema->getBestActors(3) as $person):?>
						<a href="<?php echo url_for('@person?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>" class="explanation-link"><?php echo $person->getName();?></a>,
					<?php endforeach;?>
				  </div>
				</div>
			<?php endforeach;?>
        </div>
      </div>
      <!-- cell 3 end -->

      <a href="<?php echo url_for('@film_soon_in_cinema');?>" class="whitebutton-link spacer-top" style="width: 255px"><span class="icon-calendar30"></span> Vezi toate filmele ce ruleaza in curand</a> </div>
    <!-- cell-container 3 end -->

    <div class="cell-container3 spacer-left">
      <div class="cell">
        <div class="cell-hd" style="padding-left: 62px">
          <div class="right spacer-top-s"><a href="javascript: void(0)"><span class="icon-rss"></span></a></div>
          <span class="icon-dvd"></span>
          <h4>Dvd <span class="black">&amp;</span> Bluray</h4>
        </div>
        <div class="cell-bd" style="height: 470px">
          <?php foreach($filmsSoonDbo as $filmSoonDbo):?>
			<div class="inline-block cell-separator-dotted-bottom mb-1"> <a href="<?php echo url_for('@film?id=' . $filmSoonDbo->getId() . '&key=' . $filmSoonDbo->getUrlKey());?>" class="important-link"><?php echo $filmSoonDbo->getNameRo();?></a><br />
			  <?php if ($filmSoonDbo->getNameEn() != ''):?><em>(<?php echo $filmSoonDbo->getNameEn();?>)</em><?php endif;?>
			  <div class="spacer-top-sm explanation-small">Cu:
				  <?php foreach ($filmSoonDbo->getBestActors(3) as $person):?>
					<a href="<?php echo url_for('@person?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>" class="explanation-link"><?php echo $person->getName();?></a>,
				<?php endforeach;?>
			  </div>
			</div>
			<?php endforeach;?>
        </div>
      </div>
		<a href="<?php echo url_for('@film_soon_on_dvd');?>" class="whitebutton-link spacer-top" style="width: 250px"><span class="icon-dvdbluray"></span> Toate filmele ce se lanseaza in curand</a>
    </div>
    <!-- cell-container 3 end -->

    <div class="cell-container1 spacer-left">
      <div class="cell">
        <div class="cell-hd" style="padding-left: 67px">
          <div class="right spacer-top-s"><a href="javascript: void(0)"><span class="icon-rss"></span></a></div>
          <span class="icon-tv"></span>
          <h4>La TV</h4>
        </div>
        <div class="cell-bd" style="height: 470px">
          <?php foreach ($filmsSoonTv as $filmSoonTv):?>
			  <div class="mb-3" style="position: relative">
				<div class="inline-block spacer-right-s details-container" style="vertical-align:top">
					<a href="<?php echo url_for('@film?id=' . $filmSoonTv->getId() . '&key=' . $filmSoonTv->getUrlKey());?>"><img src="<?php echo filmsiFilmPhotoThumbS($filmSoonTv->getFilename());?>" style="width: 49px" /></a>
					<div class="detailscell" id="detailscell6-<?php echo $filmSoonTv->getId();?>"> <a href="<?php echo url_for('@film?id=' . $filmSoonTv->getId() . '&key=' . $filmSoonTv->getUrlKey());?>" class="left"><img width="100" src="<?php echo filmsiFilmPhotoThumb($filmSoonTv->getFilename());?>" /></a>
					  <div class="details-content"> <a href="<?php echo url_for('@film?id=' . $filmSoonTv->getId() . '&key=' . $filmSoonTv->getUrlKey());?>" class="bigblack-link"><?php echo $filmSoonTv->getNameRo();?></a> <br />
						<?php if ($filmSoonTv->getNameEn() != ''):?><em>(<?php echo $filmSoonTv->getNameEn();?>)</em><?php endif;?>
						<hr class="cell-separator1 spacer-top spacer-bottom" />
						<?php if (count($filmSoonTv->getBestDirectors()) > 0):?>
						<span class="explanation-small">Regia:</span>
							<?php foreach ($filmSoonTv->getBestDirectors() as $person):?>
								<a href="<?php echo url_for('@person?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>" class="explanation-link"><?php echo $person->getName();?></a>,
							<?php endforeach;?>
						<?php endif;?>
						<span class="explanation-small">Cu:</span>
							<?php foreach ($filmSoonTv->getBestActors(3) as $person):?>
								<a href="<?php echo url_for('@person?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>" class="explanation-link"><?php echo $person->getName();?></a>,
							<?php endforeach;?>
						<hr class="cell-separator1 spacer-top spacer-bottom" />
						<a href="<?php echo url_for('@film_videos?id=' . $filmSoonTv->getId() . '&key=' . $filmSoonTv->getUrlKey());?>" class="whitebutton-small-link spacer-left">vezi trailer &raquo;</a> </div>
					  <span class="details-cioc"></span> </div>
					<!-- details end -->
				</div>
				<div class="inline-block cell-separator-dotted-bottom" style="width: 135px"> <a href="<?php echo url_for('@film?id=' . $filmSoonTv->getId() . '&key=' . $filmSoonTv->getUrlKey());?>" class="important-link"><?php echo $filmSoonTv->getNameRo();?></a><br />
				  <?php if ($filmSoonTv->getNameEn() != ''):?><em>(<?php echo $filmSoonTv->getNameEn();?>)</em><?php endif;?>
				  <div class="spacer-top-ml"><a href="<?php echo url_for('@film?id=' . $filmSoonTv->getId() . '&key=' . $filmSoonTv->getUrlKey());?>" class="explanation-link">Pro TV</a></div>
				</div>
			  </div>
			<?php endforeach;?>
        </div>
      </div>
      </div>
    <!-- cell-container 3 end -->

  </div>
  <!-- cell-container2 end -->
  <div class="clear"></div>
  <div class="spacer-top-m spacer-bottom-m align-center"> <img src="images/temp/adsense1.png" /> </div>
  <div class="cell-container1">
    <div class="cell spacer-bottom-m">
      <div class="cell-hd">
        <h4>BoxOffice <span class="black">RO</span></h4>
      </div>
      <div class="cell-bd">
        <div class="spacer-bottom">
          <div class="inline-block spacer-right-s" style="vertical-align:top">
			  <a href="<?php echo url_for('@film?id=' . $boxRoFilms['Film1']['id'] . '&key=' . $boxRoFilms['Film1']['url_key']);?>">
				  <img src="<?php echo filmsiFilmPhotoThumbS($boxRoFilms['Film1']['filename']);?>" style="width: 49px" />
			  </a>
		  </div>
          <div class="inline-block cell-separator-dotted-bottom" style="width: 135px; height: 73px">
			  <a href="<?php echo url_for('@film?id=' . $boxRoFilms['Film1']['id'] . '&key=' . $boxRoFilms['Film1']['url_key']);?>" class="important-link">
				  <?php echo $boxRoFilms['Film1']['name_ro'];?>
			  </a><br />
            <?php if ($boxRoFilms['Film1']['name_en'] != ''):?><em>(<?php echo $boxRoFilms['Film1']['name_en'];?>)</em><?php endif;?>
		  </div>
        </div>
        <ol class="list3">
          <li class="display-none"></li>
          <li>
			  <a href="<?php echo url_for('@film?id=' . $boxRoFilms['Film2']['id'] . '&key=' . $boxRoFilms['Film2']['url_key']);?>" class="important-link"><?php echo $boxRoFilms['Film2']['name_ro'];?></a><br />
            <?php if ($boxRoFilms['Film2']['name_en'] != ''):?><em>(<?php echo $boxRoFilms['Film2']['name_en'];?>)</em><?php endif;?>
		  </li>
          <li>
			  <a href="<?php echo url_for('@film?id=' . $boxRoFilms['Film3']['id'] . '&key=' . $boxRoFilms['Film3']['url_key']);?>" class="important-link"><?php echo $boxRoFilms['Film3']['name_ro'];?></a><br />
            <?php if ($boxRoFilms['Film3']['name_en'] != ''):?><em>(<?php echo $boxRoFilms['Film3']['name_en'];?>)</em><?php endif;?>
		  </li>
          <li>
			  <a href="<?php echo url_for('@film?id=' . $boxRoFilms['Film4']['id'] . '&key=' . $boxRoFilms['Film4']['url_key']);?>" class="important-link"><?php echo $boxRoFilms['Film4']['name_ro'];?></a><br />
            <?php if ($boxRoFilms['Film4']['name_en'] != ''):?><em>(<?php echo $boxRoFilms['Film4']['name_en'];?>)</em><?php endif;?>
		  </li>
          <li>
			  <a href="<?php echo url_for('@film?id=' . $boxRoFilms['Film5']['id'] . '&key=' . $boxRoFilms['Film5']['url_key']);?>" class="important-link"><?php echo $boxRoFilms['Film5']['name_ro'];?></a><br />
            <?php if ($boxRoFilms['Film5']['name_en'] != ''):?><em>(<?php echo $boxRoFilms['Film5']['name_en'];?>)</em><?php endif;?>
		  </li>
        </ol>

	  </div>
    </div>
    <!-- boxoffice ro cell end -->

    <div class="cell spacer-bottom-m">
      <div class="cell-hd">
        <h4>BoxOffice <span class="black">USA</span></h4>
      </div>
      <div class="cell-bd">
        <div class="spacer-bottom">
          <div class="inline-block spacer-right-s" style="vertical-align:top">
			  <a href="<?php echo url_for('@film?id=' . $boxUsFilms['Film1']['id'] . '&key=' . $boxUsFilms['Film1']['url_key']);?>">
				  <img src="<?php echo filmsiFilmPhotoThumbS($boxUsFilms['Film1']['filename']);?>" style="width: 49px" />
			  </a>
		  </div>
          <div class="inline-block cell-separator-dotted-bottom" style="width: 135px; height: 73px">
			  <a href="<?php echo url_for('@film?id=' . $boxUsFilms['Film1']['id'] . '&key=' . $boxUsFilms['Film1']['url_key']);?>" class="important-link">
				  <?php echo $boxUsFilms['Film1']['name_ro'];?>
			  </a><br />
            <?php if ($boxUsFilms['Film1']['name_en'] != ''):?><em>(<?php echo $boxUsFilms['Film1']['name_en'];?>)</em><?php endif;?>
		  </div>
        </div>
        <ol class="list3">
          <li class="display-none"></li>
          <li>
			  <a href="<?php echo url_for('@film?id=' . $boxUsFilms['Film2']['id'] . '&key=' . $boxUsFilms['Film2']['url_key']);?>" class="important-link"><?php echo $boxUsFilms['Film2']['name_ro'];?></a><br />
            <?php if ($boxUsFilms['Film2']['name_en'] != ''):?><em>(<?php echo $boxUsFilms['Film2']['name_en'];?>)</em><?php endif;?>
		  </li>
          <li>
			  <a href="<?php echo url_for('@film?id=' . $boxUsFilms['Film3']['id'] . '&key=' . $boxUsFilms['Film3']['url_key']);?>" class="important-link"><?php echo $boxUsFilms['Film3']['name_ro'];?></a><br />
            <?php if ($boxUsFilms['Film3']['name_en'] != ''):?><em>(<?php echo $boxUsFilms['Film3']['name_en'];?>)</em><?php endif;?>
		  </li>
          <li>
			  <a href="<?php echo url_for('@film?id=' . $boxUsFilms['Film4']['id'] . '&key=' . $boxUsFilms['Film4']['url_key']);?>" class="important-link"><?php echo $boxUsFilms['Film4']['name_ro'];?></a><br />
            <?php if ($boxUsFilms['Film4']['name_en'] != ''):?><em>(<?php echo $boxUsFilms['Film4']['name_en'];?>)</em><?php endif;?>
		  </li>
          <li>
			  <a href="<?php echo url_for('@film?id=' . $boxUsFilms['Film5']['id'] . '&key=' . $boxUsFilms['Film5']['url_key']);?>" class="important-link"><?php echo $boxUsFilms['Film5']['name_ro'];?></a><br />
            <?php if ($boxUsFilms['Film5']['name_en'] != ''):?><em>(<?php echo $boxUsFilms['Film5']['name_en'];?>)</em><?php endif;?>
		  </li>
        </ol>
        
	  </div>
    </div>
    <!-- boxoffice USA cell end -->

  </div>
  <!-- cell-container1 end -->

  <div class="cell-container4 spacer-left">
    <div class="cell spacer-bottom-m">
      <div class="cell-hd">
        <h4>Cele mai noi <span class="black">trailere</span></h4>
      </div>
      <div class="cell-bd pl-2">
		<?php foreach ($latestTrailers as $latestTrailer):?>
			<div class="inline-block spacer-bottom align-center" style="width: 173px; vertical-align: top">
				<a href="<?php echo url_for('@film_videos?id=' . $latestTrailer->getAlbum()->getFilm()->getId() . '&key=' . $latestTrailer->getAlbum()->getFilm()->getUrlKey());?>?vid=<?php echo $latestTrailer->getPosition();?>"><img src="<?php echo filmsiVideoThumb($latestTrailer->getCode());?>" /></a> <br />
				<a href="<?php echo url_for('@film_videos?id=' . $latestTrailer->getAlbum()->getFilm()->getId() . '&key=' . $latestTrailer->getAlbum()->getFilm()->getUrlKey());?>?vid=<?php echo $latestTrailer->getPosition();?>" class="important-link"><?php echo $latestTrailer->getAlbum()->getFilm()->getNameRo();?></a> <br />
				<?php if($latestTrailer->getAlbum()->getFilm()->getNameEn() != ''):?><em>(<?php echo $latestTrailer->getAlbum()->getFilm()->getNameEn();?>)</em><?php endif;?>
			</div>
		<?php endforeach;?>
      </div>
      <span class="more-cell"><a href="<?php echo url_for('@trailers');?>" class="smallwhite-link">vezi mai multe &raquo;</a></span> </div>
    <!-- cele mai noi trailere end -->

	<?php if(count($personsBorn) > 0):?>
		<div class="cell spacer-bottom-m">
		  <div class="cell-hd">
			<h4>Nascuti <span class="black">azi</span></h4>
		  </div>
		  <div class="cell-bd">
			  <?php foreach($personsBorn as $personBorn):?>
				<div class="inline-block align-center spacer-bottom spacer-left" style="width: 95px; vertical-align: top;">
					<a href="<?php echo url_for('@person?id=' . $personBorn->getId() . '&key=' . $personBorn->getUrlKey());?>"><img src="<?php echo filmsiPersonPhotoThumb($personBorn->getFilename());?>" /></a> <br />
					<a href="<?php echo url_for('@person?id=' . $personBorn->getId() . '&key=' . $personBorn->getUrlKey());?>" class="black-link"><?php echo $personBorn->getName();?></a> <br />
				</div>
			  <?php endforeach;?>
		  </div>
		</div>
		<!-- nascuti azi end -->
	<?php endif;?>

    <div class="cell spacer-bottom-m">
      <div class="cell-hd">
        <h4>Cei mai populari <span class="black">actori</span></h4>
      </div>
      <div class="cell-bd">
		  <?php foreach($bestActors as $bestActor):?>
			<div class="inline-block align-center spacer-bottom spacer-left" style="width: 95px; vertical-align: top"> <a href="<?php echo url_for('@person?id=' . $bestActor->getId() . '&key=' . $bestActor->getUrlKey());?>"><img src="<?php echo filmsiPersonPhotoThumb($bestActor->getFilename());?>" /></a> <br />
			  <a href="<?php echo url_for('@person?id=' . $bestActor->getId() . '&key=' . $bestActor->getUrlKey());?>" class="black-link"><?php echo $bestActor->getName();?></a> <br />
			</div>
		  <?php endforeach;?>
      </div>
      <span class="more-cell"><a href="<?php echo url_for('@actors');?>" class="smallwhite-link">afla mai multe &raquo;</a></span> </div>
    <!--cei mai populari end -->

  </div>
  <!-- cell container 4 -->

  <div class="cell-container1 spacer-left">
    <div class="cell spacer-bottom-m">
      <div class="cell-hd">
        <h4>Festival de film</h4>
      </div>
      <div class="cell-bd">
        <ul class="list4 spacer-bottom">
			<?php foreach($latestAwards as $latestAward):?>
          <li>
			  <a href="<?php echo url_for('@festival_edition?id=' . $latestAward->getId() . '&key=' . $latestAward->getUrlKey());?>" class="black-link"><?php echo $latestAward->getFestival()->getName();?> <?php echo $latestAward->getEdition();?></a> <br />
				<a href="<?php echo url_for('@festival_edition?id=' . $latestAward->getId() . '&key=' . $latestAward->getUrlKey());?>" class="explanation-link">(<?php echo format_date($latestAward->getPublishDate(), 'D', 'ro');?></a>
		  </li>
		  <?php endforeach;?>
        </ul>
        <span class="more-cell"><a href="<?php echo url_for('@festivals');?>" class="smallwhite-link">afla mai multe &raquo;</a></span> </div>
    </div>
    <div class="cell spacer-bottom-m" style="border:0; background-color: transparent">
      <div class="cell-hd">
        <div style="background-color: #ffffff; width: 205px; height: 11px; position: absolute; top:0; left: 0"></div>
        <h5>Parerea publicului</h5>
      </div>
      <div class="cell-bd" style="background-color: transparent">
        <ul class="list5 spacer-bottom">
			<?php foreach($latestComments as $comment):?>
          <li> 
			  <span class="normal"><?php echo $comment->getName();?></span> - <span class="explanation"><?php echo format_date($comment->getCreatedAt(), 'D', 'ro');?></span> <br />
			  <div class="quotecell spacer-top-s">
				  <a href="<?php echo url_for('@film?id=' . $comment->getFilm()->getId() . '&key=' . $comment->getFilm()->getUrlKey());?>" class="important-link"><?php echo $comment->getFilm()->getNameRo();?></a> <br />
				<?php echo $comment->getContent();?>
			  </div>
          </li>
          <?php endforeach;?>
        </ul>
      </div>
    </div>
  </div>
</div>
<!-- container 2 end -->

<div class="clear"></div>
<div class="align-center spacer-bottom">
  <h2>Fotografii</h2>
</div>
<div class="cell-container5">
  <div class="cell spacer-bottom-m">
    <div class="cell-hd">
      <h4>Fotografii <span class="black">din filme</span></h4>
    </div>
    <div class="cell-bd" style="height: 162px">
		<?php foreach($filmPhotos  as $filmPhoto):?>
			<div class="inline-block align-center spacer-bottom ml-1" style="width: 85px; vertical-align: top">
				<a href="<?php echo url_for('@film_photos?id=' . $filmPhoto->getAlbum()->getFilm()->getId() . '&key=' . $filmPhoto->getAlbum()->getFilm()->getUrlKey());?>?pid=<?php echo $filmPhoto->getPosition();?>">
					<img width="80" src="<?php echo filmsiPhotoThumb($filmPhoto->getFilename());?>" />
				</a> <br />
				<a href="<?php echo url_for('@film_photos?id=' . $filmPhoto->getAlbum()->getFilm()->getId() . '&key=' . $filmPhoto->getAlbum()->getFilm()->getUrlKey());?>?pid=<?php echo $filmPhoto->getPosition();?>" class="black-link">
					<?php echo $filmPhoto->getAlbum()->getFilm()->getNameRo();?>
				</a> <br />
			</div>
		<?php endforeach;?>
    </div>
  </div>
</div>
<!-- container 5 end fotografii fin filme -->

<div class="cell-container5 spacer-left-m">
  <div class="cell spacer-bottom-m">
    <div class="cell-hd">
      <h4>Corespondent <span class="black">la premiera</span></h4>
    </div>
    <div class="cell-bd" style="height: 162px">
      <?php foreach($redcarpetPhotos  as $redcarpetPhoto):?>
			<div class="inline-block align-center spacer-bottom ml-1" style="width: 85px; vertical-align: top">
				<a href="<?php echo url_for('@film_redcarpet?id=' . $redcarpetPhoto->getAlbum()->getFilm()->getId() . '&key=' . $redcarpetPhoto->getAlbum()->getFilm()->getUrlKey());?>?pid=<?php echo $redcarpetPhoto->getPosition();?>">
					<img width="80" src="<?php echo filmsiPhotoThumb($redcarpetPhoto->getFilename());?>" />
				</a> <br />
				<a href="<?php echo url_for('@film_redcarpet?id=' . $redcarpetPhoto->getAlbum()->getFilm()->getId() . '&key=' . $redcarpetPhoto->getAlbum()->getFilm()->getUrlKey());?>?pid=<?php echo $redcarpetPhoto->getPosition();?>" class="black-link">
					<?php echo $redcarpetPhoto->getDescription();?>
				</a> <br />
			</div>
		<?php endforeach;?>
    </div>
  </div>
</div>
<!-- container 5 end Corespondent la premiera -->

<div class="clear"></div>
<div class="align-center spacer-bottom spacer-top-m">
  <h2>Urmareste FilmSi si pe</h2>
</div>
<div class="cell-container5">
  <div class="cell spacer-bottom-m">
    <div class="cell-hd">
      <h4>FilmSi <span class="black">newsletter</span></h4>
    </div>
		<div class="cell-bd">
			<?php if(!$newsletterSaved):?>
			  <form action="<?php echo url_for('@homepage');?>" method="post" class="mt-1">
				  <?php echo $newsletterForm->renderGlobalErrors();?>
				  <?php echo $newsletterForm->renderHiddenFields();?>

				  <?php echo $newsletterForm['email']->render(array('class' => 'inpttxt1'));?>
				  <button type="submit" class="normalbutton spacer-left">INSCRIE-MA</button><br />

				  <?php echo $newsletterForm['email']->renderError();?>
			  </form>
			  <p class="spacer-top explanation spacer-bottom"> Aboneaza-te la newsletterul FIlmSi pentru a primi pe e-mail stirile care te intereseaza.<br />
				Nici noua nu ne place spamul, asa ca iti garantam ca nu vom da email-ul tau altora. </p>
			<?php else:?>
			  <div class="align-center strong"><br />Ai fost abonat cu succes!</div><br />
			<?php endif;?>
		</div>
  </div>
</div>
<!-- container 5 end fotografii fin filme -->

<div class="cell-container5 spacer-left-m">
  <div class="cell spacer-bottom-m">
    <div class="cell-hd">
      <h4>FilmSi <span class="black">pe retele sociale</span></h4>
    </div>
    <div class="cell-bd"> <br />
      <a href="javascript: void(0)" class="spacer-right-l spacer-left-l"><span class="icon-twitter"></span></a> <a href="javascript: void(0)" class="spacer-right-l"><span class="icon-facebook"></span></a> <a href="javascript: void(0)"><span class="icon-bigrss"></span></a> <br />
      <br />
    </div>
  </div>
</div>