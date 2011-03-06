<?php use_helper('Text');?>
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo stylesheet_path('main.css', true);?>" />
<div class="cell" style="height:278px">
	<div class="cell-hd">
		<h5>Magazine <span class="black">partenere</span></h5>
	</div>
	<div class="cell-bd">
		<?php foreach ($shops as $shop):?>
			<div class="inline-block spacer-bottom align-center" style="width: 142px; vertical-align: middle">
				<a target="_blank" href="<?php echo $shop->getUrl();?>"><img src="<?php echo filmsiShopPhotoThumb($shop->getFilename());?>" /></a>
			</div>
		<?php endforeach;?>
		<div class="clear"></div>
	</div>
</div>