<br />
<form id="alert-person-add-form" class="display-none">
	<?php echo $form->renderGlobalErrors();?>
	<?php echo $form->renderHiddenFields();?>
	<?php echo $form['cinema']->render(array('checked' => 'checked'));?>
	<?php echo $form['dbo']->render(array('checked' => 'checked'));?>
	<?php echo $form['stire']->render(array('checked' => 'checked'));?>
	<?php echo $form['tv']->render(array('checked' => 'checked'));?>
</form>

<div class="normalcell ml-3">
	<p id="alert-person-cinema-trigger"><span class="icon-checkbox-checked" style="cursor: pointer"></span> <a href="javascript: void(0)" class="explanation-link">Cand se lanseaza in cinema</a></p>
	<p id="alert-person-dbo-trigger"><span class="icon-checkbox-checked" style="cursor: pointer"></span> <a href="javascript: void(0)" class="explanation-link">Cand se lanseaza pe DVD</a></p>
	<p id="alert-person-stire-trigger"><span class="icon-checkbox-checked" style="cursor: pointer"></span> <a href="javascript: void(0)" class="explanation-link">Cand apar stiri noi</a></p>
	<p id="alert-person-tv-trigger"><span class="icon-checkbox-checked" style="cursor: pointer"></span> <a href="javascript: void(0)" class="explanation-link">Cand vine la TV</a></p><br />
	<div id="alert-person-save-container">
		<button id="alert-person-save" style="cursor: pointer" class="alert-person-trigger announcement spacer-bottom"></button>
	</div>
	<br />
</div>

<script type="text/javascript">
$(document).ready(function(){
	$('#alert-person-cinema-trigger').click(function(){
		if ($('#person_alert_cinema').is(':checked')){
			$('#person_alert_cinema').removeAttr('checked');
			$('#alert-person-cinema-trigger > span').removeClass('icon-checkbox-checked').removeClass('icon-checkbox').addClass('icon-checkbox');
		} else {
			$('#person_alert_cinema').attr('checked', 'checked');
			$('#alert-person-cinema-trigger > span').removeClass('icon-checkbox-checked').removeClass('icon-checkbox').addClass('icon-checkbox-checked');
		}
	});
	$('#alert-person-dbo-trigger').click(function(){
		if ($('#person_alert_dbo').is(':checked')){
			$('#person_alert_dbo').removeAttr('checked');
			$('#alert-person-dbo-trigger > span').removeClass('icon-checkbox-checked').removeClass('icon-checkbox').addClass('icon-checkbox');
		} else {
			$('#person_alert_dbo').attr('checked', 'checked');
			$('#alert-person-dbo-trigger > span').removeClass('icon-checkbox-checked').removeClass('icon-checkbox').addClass('icon-checkbox-checked');
		}
	});
	$('#alert-person-stire-trigger').click(function(){
		if ($('#person_alert_stire').is(':checked')){
			$('#person_alert_stire').removeAttr('checked');
			$('#alert-person-stire-trigger > span').removeClass('icon-checkbox-checked').removeClass('icon-checkbox').addClass('icon-checkbox');
		} else {
			$('#person_alert_stire').attr('checked', 'checked');
			$('#alert-person-stire-trigger > span').removeClass('icon-checkbox-checked').removeClass('icon-checkbox').addClass('icon-checkbox-checked');
		}
	});
	$('#alert-person-tv-trigger').click(function(){
		if ($('#person_alert_tv').is(':checked')){
			$('#person_alert_tv').removeAttr('checked');
			$('#alert-person-tv-trigger > span').removeClass('icon-checkbox-checked').removeClass('icon-checkbox').addClass('icon-checkbox');
		} else {
			$('#person_alert_tv').attr('checked', 'checked');
			$('#alert-person-tv-trigger > span').removeClass('icon-checkbox-checked').removeClass('icon-checkbox').addClass('icon-checkbox-checked');
		}
	});

	$('#alert-person-save').click(function(){
		$('#alert-person-save-container').html('<img src="<?php echo image_path('indicator.gif');?>" /> Se salveaza');
		$.ajax({
			type: 'post',
			url: '<?php echo url_for('@default?module=persons&action=alertAdd');?>?id=<?php echo $person->getId();?>',
			data: $('#alert-person-add-form').serialize(),
			dataType: 'json',
			success: function(response){
				$('#person-alert-container').html('');
				$('#person-alert-container').dialog('close');
			}
		});
	});
	
});
</script>