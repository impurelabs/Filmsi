<?php use_helper('Text');?>
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo stylesheet_path('main.css', true);?>" />
<div class="cell">
      <div class="cell-hd">
        <h4>BoxOffice <span class="black">US</span></h4>
      </div>
      <div class="cell-bd">
        <div class="spacer-bottom">
          <div class="inline-block spacer-right-s" style="vertical-align:top">
			  <a target="_parent" href="<?php echo url_for('@film?id=' . $films['Film1']['id'] . '&key=' . $films['Film1']['url_key']);?>">
				  <img src="<?php echo filmsiFilmPhotoThumbS($films['Film1']['filename']);?>" />
			  </a>
		  </div>
          <div class="inline-block cell-separator-dotted-bottom" style="width: 210px; height: 73px">
			  <a target="_parent" href="<?php echo url_for('@film?id=' . $films['Film1']['id'] . '&key=' . $films['Film1']['url_key']);?>" class="important-link">
				  <?php echo $films['Film1']['name_ro'];?>
			  </a><br />
            <?php if ($films['Film1']['name_en'] != ''):?><em>(<?php echo $films['Film1']['name_en'];?>)</em><?php endif;?> &nbsp;
		  </div>
        </div>
        <ol class="list3">
          <li class="display-none"></li>
          <li>
			  <a target="_parent" href="<?php echo url_for('@film?id=' . $films['Film2']['id'] . '&key=' . $films['Film2']['url_key']);?>" class="important-link"><?php echo $films['Film2']['name_ro'];?></a><br />
            <?php if ($films['Film2']['name_en'] != ''):?><em>(<?php echo $films['Film2']['name_en'];?>)</em><?php endif;?> &nbsp;
		  </li>
          <li>
			  <a target="_parent" href="<?php echo url_for('@film?id=' . $films['Film3']['id'] . '&key=' . $films['Film3']['url_key']);?>" class="important-link"><?php echo $films['Film3']['name_ro'];?></a><br />
            <?php if ($films['Film3']['name_en'] != ''):?><em>(<?php echo $films['Film3']['name_en'];?>)</em><?php endif;?> &nbsp;
		  </li>
          <li>
			  <a target="_parent" href="<?php echo url_for('@film?id=' . $films['Film4']['id'] . '&key=' . $films['Film4']['url_key']);?>" class="important-link"><?php echo $films['Film4']['name_ro'];?></a><br />
            <?php if ($films['Film4']['name_en'] != ''):?><em>(<?php echo $films['Film4']['name_en'];?>)</em><?php endif;?> &nbsp;
		  </li>
          <li>
			  <a target="_parent" href="<?php echo url_for('@film?id=' . $films['Film5']['id'] . '&key=' . $films['Film5']['url_key']);?>" class="important-link"><?php echo $films['Film5']['name_ro'];?></a><br />
            <?php if ($films['Film5']['name_en'] != ''):?><em>(<?php echo $films['Film5']['name_en'];?>)</em><?php endif;?> &nbsp;
		  </li>
        </ol>

	  </div>
    </div>