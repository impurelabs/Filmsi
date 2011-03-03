<h2>Publicitate</h2>

<div class="spacer-bottom-m">
	<a href="<?php echo url_for('@homepage');?>" class="black-link">Home</a> &raquo;
	<a href="<?php echo url_for('@default?module=default&action=publicitate');?>" class="black-link">Termeni si conditii</a>
</div>


<div class="cell-container8"> <!-- content column start -->

	<div class="normalcell">
		<?php echo $sf_data->getRaw('content')->getContent();?>
	</div>

</div> <!-- content column end -->

<div class="cell-container7 spacer-left"> <!-- right column start -->
	this is the right column
</div> <!-- right column end -->