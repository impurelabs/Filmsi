<div class="normalcell">
	<p class="spacer-bottom"><a href="javascript: void(0)" class="alert-person-trigger greenbutton-l-link"><span class="icon-bulletarrow-white"></span> Anunta-ma</a></p>
	<p class="spacer-bottom-s"><span class="icon-checkbox-checked"></span> <a href="" class="explanation-link">Cand apare pe DVD</a></p>
	<p><span class="icon-checkbox-checked"></span> <a href="" class="explanation-link">Cand apare pe Bluray</a></p>
	<div id="person-alert-container"></div>
</div>


<script type="text/javascript">
$(document).ready(function(){
	$('.alert-person-trigger').click(function(){
		$('#person-alert-container').dialog({
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
                $('#person-alert-container').html('<div class="align-center"><br /><br /><br /><img src="<?php echo image_path('indicator.gif');?>" /></div>');
                $('#person-alert-container').load('<?php echo url_for('@default?module=persons&action=alertAdd');?>?id=<?php echo $personId;?>');
              }
		});
	});
});
</script>