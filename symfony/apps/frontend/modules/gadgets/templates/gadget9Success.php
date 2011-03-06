<?php use_helper('Text');?>
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo stylesheet_path('main.css', true);?>" />
<div class="cell" style="height:333px">
	<div class="cell-hd">
		<h5>Cele mai noi <span class="black">fotografii</span></h5>
	</div>
	<div class="cell-bd">
		<?php foreach($photos  as $photo):?>
			<div class="inline-block align-center spacer-bottom ml-1" style="width: 85px; vertical-align: top">
				<a target="_parent" href="<?php echo url_for('@' . $photo['parent_type'] . '_photos?id=' . $photo['parent_id'] . '&key=' . $photo['parent_url_key']);?>?pid=<?php echo $photo['position'];?>">
					<img width="80" src="<?php echo filmsiPhotoThumb($photo['filename']);?>" />
				</a>
			</div>
		<?php endforeach;?>
		<div class="clear"></div>
	</div>
</div>