<div class="normalcell">
	<button class="alert-film-trigger announcement spacer-bottom" style="cursor: pointer"></button><br />
	<p><span class="icon-checkbox-checked"></span> <a href="" class="explanation-link">Cand se lanseaza in cinema</a></p>
	<p><span class="icon-checkbox-checked"></span> <a href="" class="explanation-link">Cand se lanseaza pe DVD</a></p>
	<p><span class="icon-checkbox"></span> <a href="" class="explanation-link">Cand apar stiri noi</a></p>
	<p><span class="icon-checkbox"></span> <a href="" class="explanation-link">Cand vine la TV</a></p>
	<div id="film-alert-container"></div>
</div>

<script type="text/javascript">
$(document).ready(function(){
	$('.alert-film-trigger').click(function(){
		$('#film-alert-container').dialog({
        show: 'clip',
        hide: 'clip',
        modal: false,
        width: 300,
        height: 250,
        closeOnEscape: false,
        resizable: false,
        title: '<?php echo __('Anunta-ma')?>',
        open: function(){
                // Before requesting the content of the dialog, ad the indicator
                $('#film-alert-container').html('<div class="align-center"><br /><br /><br /><img src="<?php echo image_path('indicator.gif');?>" /></div>');
                $('#film-alert-container').load('<?php echo url_for('@default?module=films&action=alertAdd');?>?id=<?php echo $filmId;?>');
              }
		});
	});
});
</script>