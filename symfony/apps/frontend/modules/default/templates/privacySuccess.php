<h2>Politica de confidentialitate</h2>

<div class="spacer-bottom-m" style="margin-top: 15px">
	<a href="<?php echo url_for('@homepage');?>" class="black-link">Home</a> &raquo;
	<a href="<?php echo url_for('@default?module=default&action=terms');?>" class="black-link">Termeni si conditii</a>
</div>


<div class="cell-container8"> <!-- content column start -->

	<div class="normalcell tinyMce">
		<?php echo $sf_data->getRaw('content')->getContent();?>
	</div>

</div> <!-- content column end -->

<div class="cell-container7 spacer-left"> <!-- right column start -->
	<?php include_component('default', 'rightColumn', array('page' => Page::OTHER));?>
</div> <!-- right column end -->