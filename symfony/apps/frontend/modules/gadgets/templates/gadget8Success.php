<?php use_helper('Text');?>
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo stylesheet_path('main.css', true);?>" />
<div class="cell" style="height:393px">
	<div class="cell-hd">
		<h5>Cele mai noi <span class="black">trailere</span></h5>
	</div>
	<div class="cell-bd">
		<?php foreach ($videos as $key => $video):?>
			<div class="cell-separator-dotted-bottom pb-2 mb-1" style="width: 280px; vertical-align: top">
				<?php if($key == 0):?>
				<a target="_parent" href="<?php echo url_for('@film_videos?id=' . $video->getAlbum()->getFilm()->getId() . '&key=' . $video->getAlbum()->getFilm()->getUrlKey());?>?vid=<?php echo $video->getPosition();?>"><img width="280" src="<?php echo filmsiVideoThumb0($video->getCode());?>" /></a> <br />
				<?php endif;?>
				<a target="_parent" href="<?php echo url_for('@film_videos?id=' . $video->getAlbum()->getFilm()->getId() . '&key=' . $video->getAlbum()->getFilm()->getUrlKey());?>?vid=<?php echo $video->getPosition();?>" class="important-link"><?php echo $video->getAlbum()->getFilm()->getNameRo();?></a> <br />
				<?php if($video->getAlbum()->getFilm()->getNameEn() != ''):?><em>(<?php echo $video->getAlbum()->getFilm()->getNameEn();?>)</em><?php endif;?>&nbsp;
			</div>
		<?php endforeach;?>
		<div class="clear"></div>
	</div>
	<span class="more-cell"><a target="_parent" href="<?php echo url_for('@trailers');?>" class="smallwhite-link">vezi mai multe &raquo;</a></span>
</div>