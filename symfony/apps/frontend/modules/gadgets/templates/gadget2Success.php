<?php use_helper('Text');?>
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo stylesheet_path('main.css', true);?>" />
<div class="cell" style="height:570px"> 
	<div class="cell-hd">
		<h5>Acum pe <span class="black">DVD &amp; Bluray</span></h5>
	</div>
	<div class="cell-bd">
		<?php foreach($films as $film):?>
			<div class="mb-3 details-container">
				<div class="inline-block spacer-right-s" style="vertical-align:top"><a href="<?php echo url_for('@film?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>"><img src="<?php echo filmsiFilmPhotoThumbS($film->getFilename());?>" style="width: 50px;" /></a></div>
				<div class="inline-block cell-separator-dotted-bottom" style="width: 200px"> <a href="<?php echo url_for('@film?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>" class="important-link"><?php echo $film->getNameRo();?></a><br />
				  <?php if ($film->getNameEn() != ''):?><em>(<?php echo $film->getNameEn();?>)</em><?php endif;?>&nbsp;
				  <div class="spacer-top-sm explanation-small">Cu:
					  <?php foreach ($film->getBestActors(3) as $person):?>
						<a href="<?php echo url_for('@person?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>" class="explanation-link"><?php echo $person->getName();?></a>,
					<?php endforeach;?>
				  </div>
				</div>
				<!-- details end -->
			</div>
			<?php endforeach;?>
		<div class="clear"></div>
	</div>
	<span class="more-cell"><a target="_parent" href="<?php echo url_for('@film_now_on_dvd', true);?>" class="smallwhite-link">vezi mai multe &raquo;</a></span>
</div>