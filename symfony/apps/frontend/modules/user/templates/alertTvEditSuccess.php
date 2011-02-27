<form id="alert-channel-items"></form>
<br />
<div id="alert-channel-items-buttons">
	<button type="button" id="alert-channel-save">Salveaza</button>
</div>

<script type="text/javascript">
$(document).ready(function(){
		var channels = new Array();
		<?php foreach ($channels as $channel):?>
			channels[<?php echo $channel['id'];?>] = '<?php echo $channel['name'];?>';
		<?php endforeach;?>

	var currentChannelIds = new Array();
	<?php foreach($currentChannelIds as $key => $currentChannelId):?>
		currentChannelIds[<?php echo $key;?>] = '<?php echo $currentChannelId;?>';
	<?php endforeach;?>

	/* Display the current channels */
	for (i in channels){
		if ($.inArray( i, currentChannelIds ) != -1){
			$('#alert-channel-items').append('<input type="checkbox" class="ml-2" name="cid[]" value="' + i + '" checked="checked" /> ' + channels[i]);
		} else {
			$('#alert-channel-items').append('<input type="checkbox" class="ml-2" name="cid[]" value="' + i + '" /> ' + channels[i]);
		}
	}

	$('#alert-channel-save').click(function(){
		$('#alert-channel-items-buttons').html('<img src="<?php echo image_path('indicator.gif');?>" /> Se salveaza');
		$.ajax({
			'url': '<?php echo url_for('@default?module=user&action=alertTvEdit');?>',
			'type': 'post',
			data: $('#alert-channel-items').serialize(),
			success: function(response){
				$('#alert-channel-list').slideUp('fast', function(){
					$('#alert-channel-list').html(response).slideDown('fast', function(){
						$('#alert-channel-edit').show();
					});
				});
			}
		});
	});
});
</script>