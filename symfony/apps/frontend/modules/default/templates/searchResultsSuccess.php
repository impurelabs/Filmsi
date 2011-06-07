<h2>Rezultate cautare: <span class="black"><?php echo $sf_request->getParameter('q');?></span></h2>

<div class="spacer-bottom-m" style="margin-top: 15px">
	<a href="<?php echo url_for('@homepage');?>" class="black-link">Home</a> &raquo;
	<a href="<?php echo url_for('@default?module=default&action=search');?>?q=<?php echo urlencode($sf_request->getParameter('q'));?>" class="black-link">Rezultate cautare</a>
</div>


<div class="cell-container8"> <!-- content column start -->

	
	
	
	 <?php if(count($videos)):?>
     <div class="normalcell right ml-2">
		<?php foreach ($videos as $video):?>
		 <div class="inline-block align-center" style="width: 138px; vertical-align: middle">
			<a href="<?php echo $video->getUrlInParentGallery();?>">
			<img src="<?php echo filmsiVideoThumb($video->getCode());?>" style="height: 83px" />
		 </a>
		</div>
		<?php endforeach;?>
     </div>
	 <?php endif;?>
	
	<?php if(count($photos)):?>

     <div class="normalcell left">
		<?php foreach ($photos as $photoId => $photo):?>
			<a href="<?php echo $photo->getUrlInParentGallery();?>" class="mr-2">
				<img src="<?php echo filmsiPhotoThumbS($photo->getFilename());?>" style="height: 83px" />
			 </a>
		<?php endforeach;?>
     </div>
	 <?php endif;?>
	
	


	<div class="clear"></div>

	<?php if(count($films)):?>
     <h5 class="ml-2">Filme</h5>

     <div class="normalcell">
		<?php foreach ($films as $film):?>
		 <div class="cell-separator-dotted-bottom pb-2 pt-2">
			<div class="left"><a href="<?php echo url_for('@film?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>"><img src="<?php echo filmsiFilmPhotoThumbS($film->getFilename());?>" /></a></div>
			<div class="left spacer-left" style="width: 540px">
				<a href="<?php echo url_for('@film?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>" class="bigblue-link">
					<?php echo $film->getNameRo();?>
					<?php if($film->getYear() != ''):?>(<?php echo $film->getYear();?>)<?php endif;?>
				</a><br />
				<?php if ($film->getNameEn() != ''):?><p><em>(<?php echo $film->getNameEn();?>)</em></p><?php else:?> <p><em>&nbsp;</em></p> <?php endif;?>
				<p class="explanation-small mt-1">
					Cu:
					<?php foreach ($film->getBestActors(3) as $actor):?>
						<a href="<?php echo url_for('@person?id=' . $actor->getId() . '&key=' . $actor->getUrlKey());?>" class="small-link"><?php echo $actor->getName();?></a>,
					<?php endforeach;?>
				</p>
				<p class="explanation-small">
					Regia:
					<?php foreach ($film->getBestDirectors(3) as $director):?>
						<a href="<?php echo url_for('@person?id=' . $director->getId() . '&key=' . $director->getUrlKey());?>" class="small-link"><?php echo $director->getName();?></a>,
					<?php endforeach;?>
				</p>
			</div>
			<div class="clear"></div>
		</div>
		<?php endforeach;?>
     </div>
	<?php endif;?>


	<?php if(count($persons)):?>
     <h5 class="ml-2">Actori, regizori, scenaristi, producatori</h5>

     <div class="normalcell">
		<?php foreach ($persons as $person):?>
		 <div class="cell-separator-dotted-bottom pb-2 pt-2">
			<div class="left"><a href="<?php echo url_for('@person?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>"><img src="<?php echo filmsiPersonPhotoThumb($person->getFilename());?>" height="73" /></a></div>
			<div class="left spacer-left" style="width: 540px">
				<a href="<?php echo url_for('@person?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>" class="bigblue-link"><?php echo $person->getName();?></a><br />
				<p class="mb-3"><em>Nascut pe: <?php echo format_date($person->getDateOfBirth(), 'D', 'ro');?></em></p>
				<?php $actedFilms = $person->getMostViewedFilmsByRole(3, 'actor');?>
				<?php if (count($actedFilms) > 0):?>
					<p class="explanation-small">
						A jucat in:
						<?php foreach ($actedFilms as $actedFilm):?>
							<a href="<?php echo url_for('@film?id=' . $actedFilm['id'] . '&key=' . $actedFilm['url_key']);?>" class="small-link"><?php echo $actedFilm['name_ro'];?></a>,
						<?php endforeach;?>
					</p>
				<?php endif;?>
					
				<?php $directedFilms = $person->getMostViewedFilmsByRole(3, 'director');?>
				<?php if (count($directedFilms) > 0):?>
					<p class="explanation-small">
						A regizat:
						<?php foreach ($directedFilms as $directedFilm):?>
							<a href="<?php echo url_for('@film?id=' . $directedFilm['id'] . '&key=' . $directedFilm['url_key']);?>" class="small-link"><?php echo $directedFilm['name_ro'];?></a>,
						<?php endforeach;?>
					</p>
				<?php endif;?>
			</div>
			<div class="clear"></div>
		</div>
		<?php endforeach;?>
     </div>
	 <?php endif;?>



	 <?php if(count($articles)):?>
     <h5 class="ml-2">Articole</h5>

     <div class="normalcell">
		<?php foreach ($articles as $article):?>
		 <p class="spacer-bottom"><a href="<?php echo url_for('@article?id=' . $article->getId() . '&key=' . $article->getUrlKey());?>" class="important-link"><?php echo $article->getName();?></a></p>
		<?php endforeach;?>
     </div>
	 <?php endif;?>
	 
	 
	 
	 <?php if(count($cinemas)):?>
     <h5 class="ml-2">Cinematografe</h5>

     <div class="normalcell">
		<?php foreach ($cinemas as $cinema):?>
		 <p class="spacer-bottom"><a href="<?php echo url_for('@cinema?id=' . $cinema->getId() . '&key=' . $cinema->getUrlKey());?>" class="important-link"><?php echo $cinema->getName();?></a></p>
		<?php endforeach;?>
     </div>
	 <?php endif;?>
	 
	 

	 <?php if(count($stires)):?>
     <h5 class="ml-2">Stiri</h5>

     <div class="normalcell">
		<?php foreach ($stires as $stire):?>
		 <p class="spacer-bottom"><a href="<?php echo url_for('@stire?id=' . $stire->getId() . '&key=' . $stire->getUrlKey());?>" class="important-link"><?php echo $stire->getName();?></a></p>
		<?php endforeach;?>
     </div>
	 <?php endif;?>

     
</div> <!-- content column end -->

<div class="cell-container7 spacer-left"> <!-- right column start -->
	<?php include_component('default', 'rightColumn', array('page' => Page::SEARCH_RESULTS));?>
</div> <!-- right column end -->