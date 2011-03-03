<div class="align-center spacer-bottom spacer-top-m"><h2>Cele mai populare</h2></div>


 <div class="normalcell">
	<div class="inline-block align-center spacer-bottom spacer-left-m" style="width: 83px; vertical-align: top">
		<a href="<?php echo url_for('@' . strtolower($bestItems[0]['type']) . '?id=' . $bestItems[0]['id'] . '&key=' . $bestItems[0]['url_key']);?>"><img src="<?php $helper = 'filmsi' . $bestItems[0]['type'] . 'PhotoThumb'; echo $helper($bestItems[0]['filename']);?>" width="77" /></a> <br />
		<a href="<?php echo url_for('@' . strtolower($bestItems[0]['type']) . '?id=' . $bestItems[0]['id'] . '&key=' . $bestItems[0]['url_key']);?>" class="black-link"><?php echo $bestItems[0]['name'];?></a> <br />
	</div>
	<div class="inline-block align-center spacer-bottom spacer-left-m" style="width: 83px; vertical-align: top">
		<a href="<?php echo url_for('@' . strtolower($bestItems[1]['type']) . '?id=' . $bestItems[1]['id'] . '&key=' . $bestItems[1]['url_key']);?>"><img src="<?php $helper = 'filmsi' . $bestItems[1]['type'] . 'PhotoThumb'; echo $helper($bestItems[1]['filename']);?>" width="77" /></a> <br />
		<a href="<?php echo url_for('@' . strtolower($bestItems[1]['type']) . '?id=' . $bestItems[1]['id'] . '&key=' . $bestItems[1]['url_key']);?>" class="black-link"><?php echo $bestItems[1]['name'];?></a> <br />
	</div>
	<div class="inline-block spacer-left" style="width: 250px">
		<h5 class="spacer-bottom">Buzz</h5>
		<ul class="list4">
			<?php foreach ($bestStires as $bestStire):?>
				<li>
					<a href="<?php echo url_for('@stire?id=' . $bestStire->getId() . '&key=' . $bestStire->getUrlKey());?>" class="black-link">
						<?php echo $bestStire->getName();?>
					</a>
				</li>
			<?php endforeach;?>
		</ul>
	</div>
	<div class="inline-block align-center spacer-bottom spacer-left-m" style="width: 83px; vertical-align: top">
		<a href="<?php echo url_for('@' . strtolower($bestItems[2]['type']) . '?id=' . $bestItems[2]['id'] . '&key=' . $bestItems[2]['url_key']);?>"><img src="<?php $helper = 'filmsi' . $bestItems[2]['type'] . 'PhotoThumb'; echo $helper($bestItems[2]['filename']);?>" width="77" /></a> <br />
		<a href="<?php echo url_for('@' . strtolower($bestItems[2]['type']) . '?id=' . $bestItems[2]['id'] . '&key=' . $bestItems[2]['url_key']);?>" class="black-link"><?php echo $bestItems[2]['name'];?></a> <br />
	</div>
	<div class="inline-block align-center spacer-bottom spacer-left-m" style="width: 83px; vertical-align: top">
		<a href="<?php echo url_for('@' . strtolower($bestItems[3]['type']) . '?id=' . $bestItems[3]['id'] . '&key=' . $bestItems[3]['url_key']);?>"><img src="<?php $helper = 'filmsi' . $bestItems[3]['type'] . 'PhotoThumb'; echo $helper($bestItems[3]['filename']);?>" width="77" /></a> <br />
		<a href="<?php echo url_for('@' . strtolower($bestItems[3]['type']) . '?id=' . $bestItems[3]['id'] . '&key=' . $bestItems[3]['url_key']);?>" class="black-link"><?php echo $bestItems[3]['name'];?></a> <br />
	</div>
	<div class="inline-block align-center spacer-bottom spacer-left-m" style="width: 83px; vertical-align: top">
		<a href="<?php echo url_for('@' . strtolower($bestItems[4]['type']) . '?id=' . $bestItems[4]['id'] . '&key=' . $bestItems[4]['url_key']);?>"><img src="<?php $helper = 'filmsi' . $bestItems[4]['type'] . 'PhotoThumb'; echo $helper($bestItems[4]['filename']);?>" width="77" /></a> <br />
		<a href="<?php echo url_for('@' . strtolower($bestItems[4]['type']) . '?id=' . $bestItems[4]['id'] . '&key=' . $bestItems[4]['url_key']);?>" class="black-link"><?php echo $bestItems[4]['name'];?></a> <br />
	</div>
	<div class="inline-block align-center spacer-bottom spacer-left-m" style="width: 83px; vertical-align: top">
		<a href="<?php echo url_for('@' . strtolower($bestItems[5]['type']) . '?id=' . $bestItems[5]['id'] . '&key=' . $bestItems[5]['url_key']);?>"><img src="<?php $helper = 'filmsi' . $bestItems[5]['type'] . 'PhotoThumb'; echo $helper($bestItems[5]['filename']);?>" width="77" /></a> <br />
		<a href="<?php echo url_for('@' . strtolower($bestItems[5]['type']) . '?id=' . $bestItems[5]['id'] . '&key=' . $bestItems[5]['url_key']);?>" class="black-link"><?php echo $bestItems[5]['name'];?></a> <br />
	</div>

 </div>