<?php use_helper('Text');?>
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo stylesheet_path('main.css', true);?>" />
<div class="cell" style="height:333px">
	<div class="cell-hd">
		<h5>Cele mai <span class="black">comentate</span></h5>
	</div>
	<div class="cell-bd">
		<?php foreach ($stires as $stire):?>
		<div class="left" style="width: 55px">
			<a target="_parent" href="<?php echo url_for('@stire?id=' . $stire['id'] . '&key=' . $stire['url_key']);?>">
				<img src="<?php echo filmsiStirePhotoThumb($stire['filename']);?>" width="55" />
			</a>
		</div>
		<div class="left ml-2 cell-separator-dotted-bottom mb-1 pb-1" style="width: 220px;">
			<div class="mb-1">
				<a target="_parent" href="<?php echo url_for('@stire?id=' . $stire['id'] . '&key=' . $stire['url_key']);?>" class="important-link"><?php echo truncate_text($stire['name'], 50, '...');?></a>
			</div>
			<div>
				<?php echo truncate_text($stire['content_teaser'], '75');?>
				<a target="_parent" href="<?php echo url_for('@stire?id=' . $stire['id'] . '&key=' . $stire['url_key']);?>" class="important-link">citeste tot</a>
			</div>
		</div>
		<div class="clear"></div>
		<?php endforeach;?>
		<div class="clear"></div>
	</div>
	<span class="more-cell"><a target="_parent" href="<?php echo url_for('@stires');?>" class="smallwhite-link">vezi mai multe &raquo;</a></span> </div>
</div>