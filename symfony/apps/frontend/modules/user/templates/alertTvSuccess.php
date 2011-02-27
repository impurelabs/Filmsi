<p>Ai selectat sa primesti programul pentru urmatoarele posturi:</p>
<br />
<div id="alert-channel-list">
<?php foreach ($channels as $channel):?>
	<strong><?php echo $channel['channel_name'];?></strong>,
<?php endforeach;?>
</div>

<br />
<div id="alert-channel-list-button-container">
<a href="javascript: void(0)" id="alert-channel-edit">editeaza lista</a>
</div>

<script type="text/javascript">
$(document).ready(function(){
	$('#alert-channel-edit').click(function(){
		$('#alert-channel-edit').hide();
		$('#alert-channel-list-button-container').append('<img src="<?php echo image_path('indicator.gif');?>" />');

		$('#alert-channel-list').slideUp('fast', function(){
			$.ajax({
				'url': '<?php echo url_for('@default?module=user&action=alertTvEdit');?>',
				'type': 'get',
				success: function(response){
					$('#alert-channel-list').html(response).slideDown();
					$('#alert-channel-list-button-container > img').hide();
				}
			});
		});
	});
});
</script>