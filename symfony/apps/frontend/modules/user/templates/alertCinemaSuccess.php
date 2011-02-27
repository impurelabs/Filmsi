<p>Ai selectat sa primesti programul pentru urmatoarele cinematografe:</p>
<br />
<div id="alert-cinema-list">
<?php foreach ($cinemas as $cinema):?>
<a href="<?php echo url_for('@cinema?id=' . $cinema['cinema_id'] . '&key=' . $cinema['cinema_url_key']);?>" target="_blank" class="important-link"><?php echo $cinema['cinema_name'];?></a>,
<?php endforeach;?>
</div>

<br />
<div id="alert-cinema-list-button-container">
<a href="javascript: void(0)" id="alert-cinema-edit">editeaza lista</a>
</div>

<script type="text/javascript">
$(document).ready(function(){
	$('#alert-cinema-edit').click(function(){
		$('#alert-cinema-edit').hide();
		$('#alert-cinema-list-button-container').append('<img src="<?php echo image_path('indicator.gif');?>" />');

		$('#alert-cinema-list').slideUp('fast', function(){
			$.ajax({
				'url': '<?php echo url_for('@default?module=user&action=alertCinemaEdit');?>',
				'type': 'get',
				success: function(response){
					$('#alert-cinema-list').html(response).slideDown();
					$('#alert-cinema-list-button-container > img').hide();
				}
			});
		});
	});
});
</script>