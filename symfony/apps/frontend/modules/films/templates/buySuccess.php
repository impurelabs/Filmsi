<?php slot('backgroundTag');?>
<div style="width: <?php echo $backgroundWidth;?>px; margin: 0 auto; background: url('<?php echo filmsiFilmBackground($film->getBackgroundFilename());?>') top no-repeat">
<?php end_slot();?>

<h2><a href="<?php echo url_for('@film?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>"><?php echo $film->getNameRo();?><span class="black"> - <?php echo $film->getYear();?> <?php if ($film->getNameEn() != ''):?>(<?php echo $film->getNameEn();?>)<?php endif;?></span></a></h2>

<div class="spacer-bottom-m">
	<a href="<?php echo url_for('@homepage');?>" class="black-link">Home</a> &raquo;
	<a href="<?php echo url_for('@film?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>" class="black-link"><?php echo $film->getName();?></a> &raquo;
    <a href="<?php echo url_for('@film_buy?id=' . $film->getId() . '&key=' . $film->getUrlKey() . ($sf_request->hasParameter('p') ? '&p=' . $sf_request->getParameter('p') : ''));?>" class="black-link">Cumpara pe DVD &amp; Bluray</a>
</div>


<div class="cell-container6"> <!-- left column start -->
    <div class="cell spacer-bottom-m">
        <div class="cell-hd">
            <h5><a href="<?php echo url_for('@film?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>">Detalii <span class="black">film</span></a></h5>
        </div>
        <div class="cell-bd" style="padding:0">
        	<?php include_component('films', 'menu', array('film' => $film, 'current' => 'buy')); ?>
        </div>
    </div>
</div> <!-- left column end -->




<div class="cell-container5 spacer-left"> <!-- content column start -->


    <div class="normalcell spacer-bottom">
        <h4 class="spacer-bottom-m">Cumpara pe DVD &amp Bluray</h4>
		<br />

		<?php if (count($shops['dvd']) > 0):?>
			<h6 class="mb-2">Pe DVD</h6>
			<?php foreach ($shops['dvd'] as $shop):?>
				<div class="left spacer-bottom-m align-center ml-2 mr-2" style="width: 100px">
					<div style="display: table-cell; height: 100px; width: 100px; vertical-align: middle">
						<a href="<?php echo $shop['film_url'];?>" target="_blank"><img src="<?php echo filmsiShopPhotoThumb($shop['filename']);?>"  /></a>
					</div>
				<a href="<?php echo $shop['film_url'];?>" target="_blank"><?php echo $shop['name'];?></a>
			</div>
			<?php endforeach;?>
			<div class="clear"></div><br />
		<?php endif;?>

		<?php if (count($shops['bluray']) > 0):?>
			<h6 class="mb-2">Pe Bluray</h6>
			<?php foreach ($shops['bluray'] as $shop):?>
				<div class="left spacer-bottom-m align-center ml-2 mr-2" style="width: 100px">
					<div style="display: table-cell; height: 100px; width: 100px; vertical-align: middle">
						<a href="<?php echo $shop['film_url'];?>" target="_blank"><img src="<?php echo filmsiShopPhotoThumb($shop['filename']);?>"  /></a>
					</div>
				<a href="<?php echo $shop['film_url'];?>" target="_blank"><?php echo $shop['name'];?></a>
			</div>
			<?php endforeach;?>
			<div class="clear"></div><br />
		<?php endif;?>

		<?php if (count($shops['online']) > 0):?>
			<h6 class="mb-2">Online</h6>
			<?php foreach ($shops['online'] as $shop):?>
				<div class="left spacer-bottom-m align-center ml-2 mr-2" style="width: 100px">
					<div style="display: table-cell; height: 100px; width: 100px; vertical-align: middle">
						<a href="<?php echo $shop['film_url'];?>" target="_blank"><img src="<?php echo filmsiShopPhotoThumb($shop['filename']);?>"  /></a>
					</div>
				<a href="<?php echo $shop['film_url'];?>" target="_blank"><?php echo $shop['name'];?></a>
			</div>
			<?php endforeach;?>
			<div class="clear"></div><br />
		<?php endif;?>


        
    </div>

</div> <!-- content column end -->





<div class="cell-container7 spacer-left"> <!-- right column start -->
	<?php include_component('default', 'rightColumn', array('page' => Page::FILM));?>
</div> <!-- right column end -->