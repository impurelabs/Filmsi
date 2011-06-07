<?php slot('backgroundTag');?>
<div style="width: <?php echo $backgroundWidth;?>px; margin: 0 auto; background: url('<?php echo filmsiFilmBackground($film->getBackgroundFilename());?>') top no-repeat">
<?php end_slot();?>

<h2><a href="<?php echo url_for('@film?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>"><?php echo $film->getNameRo();?><span class="black"> - <?php echo $film->getYear();?> <?php if ($film->getNameEn() != ''):?>(<?php echo $film->getNameEn();?>)<?php endif;?></span></a></h2>

<div class="spacer-bottom-m" style="margin-top: 15px">
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

		<div style="display: inline-block; width: 140px" class="explanation-small">Magazin</div>
		<div class="ml-2 explanation-small" style="display: inline-block; width: 150px; vertical-align: top; text-align: right"></div>
		<div class="ml-2 explanation-small" style="display: inline-block; width: 130px; vertical-align: top; text-align: right">Vezi Online/Cumpara</div>
		
		<hr class="cell-separator-double mb-2 mt-1" />
		
		<?php foreach($film->getShops() as $shop):?>
			<div style="display: inline-block; width: 140px; vertical-align: top">
				<a href="<?php echo $shop['name'];?>" target="_blank"><?php echo $shop['name'];?></a>
			</div>
			<div class="ml-2" style="display: inline-block; width: 150px; vertical-align: top; text-align: center">
				<a href="<?php echo $shop['name'];?>" target="_blank"><img src="<?php echo filmsiShopPhotoThumbS($shop['filename']);?>" /></a>
			</div>
			<div class="ml-2" style="display: inline-block; width: 130px; vertical-align: top; text-align: right">
				<?php foreach($shop['ShopFilm'] as $shopFilm):?>
					<a href="<?php echo $shopFilm['url'];?>">
						<?php if ($shopFilm['format'] == 'dvd'):?>Cumpara DVD<?php endif;?>
						<div class="mb-1"></div>
						<?php if ($shopFilm['format'] == 'bluray'):?>Cumpara Bluray<?php endif;?>
						<div class="mb-1"></div>
						<?php if ($shopFilm['format'] == 'online'):?>Vezi Online<?php endif;?>
						<div class="mb-1"></div>
					</a>
				<?php endforeach;?>
			</div>
		<div class="mb-2"></div>
		<?php endforeach;?>        
    </div>

</div> <!-- content column end -->





<div class="cell-container7 spacer-left"> <!-- right column start -->
	<?php include_component('default', 'rightColumn', array('page' => Page::FILM));?>
</div> <!-- right column end -->