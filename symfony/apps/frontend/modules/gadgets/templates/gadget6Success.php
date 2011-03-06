<?php use_helper('Text');?>
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo stylesheet_path('main.css', true);?>" />
<div class="cell" style="height:518px">
	<div class="cell-hd">
		<h5>Acum la <span class="black">Tv</span></h5>
	</div>
	<div class="cell-bd">
		<?php foreach ($films as $film):?>
		  <div class="mb-3 details-container">
			<div class="inline-block spacer-right-s" style="vertical-align:top"><a href="<?php echo url_for('@film?id=' . $film->getFilm()->getId() . '&key=' . $film->getFilm()->getUrlKey());?>"><img src="<?php echo filmsiFilmPhotoThumbS($film->getFilm()->getFilename());?>" /></a></div>
			<div class="inline-block cell-separator-dotted-bottom" style="width: 210px"> <a href="<?php echo url_for('@film?id=' . $film->getFilm()->getId() . '&key=' . $film->getFilm()->getUrlKey());?>" class="important-link"><?php echo $film->getFilm()->getNameRo();?></a><br />
			  <?php if ($film->getFilm()->getNameEn() != ''):?><em>(<?php echo $film->getFilm()->getNameEn();?>)</em><?php endif;?>&nbsp;
			  <div class="mt-3">
				<a target="_parent" href="<?php echo url_for('@film_on_tv');?>?c=<?php echo $film->getChannel()->getId();?>" class="explanation-link">
					<?php echo $film->getChannel()->getName();?>
				</a>
			  </div>
			</div>
		  </div>
		<?php endforeach;?>
		<div class="clear"></div>
	</div>
	<span class="more-cell"><a target="_parent" href="<?php echo url_for('@film_on_tv', true);?>" class="smallwhite-link">vezi mai multe &raquo;</a></span>
</div>