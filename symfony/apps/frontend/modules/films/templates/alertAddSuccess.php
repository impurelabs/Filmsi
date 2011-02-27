<br />
<form id="alert-film-add-form" class="display-none">
	<?php echo $form->renderGlobalErrors();?>
	<?php echo $form->renderHiddenFields();?>
	<?php echo $form['cinema']->render(array('checked' => 'checked'));?>
	<?php echo $form['dbo']->render(array('checked' => 'checked'));?>
	<?php echo $form['stire']->render(array('checked' => 'checked'));?>
	<?php echo $form['tv']->render(array('checked' => 'checked'));?>
</form>

<div class="normalcell ml-3">
	<p id="alert-film-cinema-trigger"><span class="icon-checkbox-checked" style="cursor: pointer"></span> <a href="javascript: void(0)" class="explanation-link">Cand se lanseaza in cinema</a></p>
	<p id="alert-film-dbo-trigger"><span class="icon-checkbox-checked" style="cursor: pointer"></span> <a href="javascript: void(0)" class="explanation-link">Cand se lanseaza pe DVD</a></p>
	<p id="alert-film-stire-trigger"><span class="icon-checkbox-checked" style="cursor: pointer"></span> <a href="javascript: void(0)" class="explanation-link">Cand apar stiri noi</a></p>
	<p id="alert-film-tv-trigger"><span class="icon-checkbox-checked" style="cursor: pointer"></span> <a href="javascript: void(0)" class="explanation-link">Cand vine la TV</a></p><br />
	<div id="alert-film-save-container">
		<button id="alert-film-save" style="cursor: pointer" class="alert-film-trigger announcement spacer-bottom"></button>
	</div>
	<br />
</div>

<script type="text/javascript">
$(document).ready(function(){
	$('#alert-film-cinema-trigger').click(function(){
		if ($('#film_alert_cinema').is(':checked')){
			$('#film_alert_cinema').removeAttr('checked');
			$('#alert-film-cinema-trigger > span').removeClass('icon-checkbox-checked').removeClass('icon-checkbox').addClass('icon-checkbox');
		} else {
			$('#film_alert_cinema').attr('checked', 'checked');
			$('#alert-film-cinema-trigger > span').removeClass('icon-checkbox-checked').removeClass('icon-checkbox').addClass('icon-checkbox-checked');
		}
	});
	$('#alert-film-dbo-trigger').click(function(){
		if ($('#film_alert_dbo').is(':checked')){
			$('#film_alert_dbo').removeAttr('checked');
			$('#alert-film-dbo-trigger > span').removeClass('icon-checkbox-checked').removeClass('icon-checkbox').addClass('icon-checkbox');
		} else {
			$('#film_alert_dbo').attr('checked', 'checked');
			$('#alert-film-dbo-trigger > span').removeClass('icon-checkbox-checked').removeClass('icon-checkbox').addClass('icon-checkbox-checked');
		}
	});
	$('#alert-film-stire-trigger').click(function(){
		if ($('#film_alert_stire').is(':checked')){
			$('#film_alert_stire').removeAttr('checked');
			$('#alert-film-stire-trigger > span').removeClass('icon-checkbox-checked').removeClass('icon-checkbox').addClass('icon-checkbox');
		} else {
			$('#film_alert_stire').attr('checked', 'checked');
			$('#alert-film-stire-trigger > span').removeClass('icon-checkbox-checked').removeClass('icon-checkbox').addClass('icon-checkbox-checked');
		}
	});
	$('#alert-film-tv-trigger').click(function(){
		if ($('#film_alert_tv').is(':checked')){
			$('#film_alert_tv').removeAttr('checked');
			$('#alert-film-tv-trigger > span').removeClass('icon-checkbox-checked').removeClass('icon-checkbox').addClass('icon-checkbox');
		} else {
			$('#film_alert_tv').attr('checked', 'checked');
			$('#alert-film-tv-trigger > span').removeClass('icon-checkbox-checked').removeClass('icon-checkbox').addClass('icon-checkbox-checked');
		}
	});

	$('#alert-film-save').click(function(){
		$('#alert-film-save-container').html('<img src="<?php echo image_path('indicator.gif');?>" /> Se salveaza');
		$.ajax({
			type: 'post',
			url: '<?php echo url_for('@default?module=films&action=alertAdd');?>?id=<?php echo $film->getId();?>',
			data: $('#alert-film-add-form').serialize(),
			dataType: 'json',
			success: function(response){
				$('#film-alert-container').html('');
				$('#film-alert-container').dialog('close');
			}
		});
	});
	
});
</script>