<div class="left" style="width: 200px">
	<p style="color: #ffffff">Bun venit, <br /> <span style="font-size: 18px"><?php echo $sf_user->getName();?></span></p>
	<br />
	<button class="user-menubutton" id="user-details-button"><span class="icon-user-personal"></span> Detalii personale</button>
	<br />
	<button class="user-menubutton-selected"><span class="icon-user-alerts"></span> Alerte informative</button>
</div> <!-- user menu -->
<div id="user-content" style=" background: #f4f4f4;">
	<div class="right"><button id="user-closer"></button></div>
	<p style="font-size: 30px; color:#4db35b; margin-bottom: 10px">Alerte informative</p>
	<div>
		<div>
			<div class="left" id="alert-cinema-trigger-container">
				<a href="javascript: void(0)" id="alert-cinema-trigger"><span class="icon-bigcheckbox<?php if($sf_user->getGuardUser()->getAlertCinema() == '1') echo '-checked';?>"></span></a>
			</div>
			<div class="green strong" style="font-size: 18px; background: #ebebeb; margin-left: 42px; padding: 5px 10px">
				<a href="javascript: void(0)" id="alert-cinema-opener"  class="right mt-1"><span class="icon-bluearrow-right"></span></a>
				FilmSi Cinema
			</div>
			<div class="clear"></div>
			<div id="alert-cinema-content" style="display: none; margin-left: 45px; background: #f5f4e0; border: 1px solid #e6e4d5; padding: 10px"></div>
		</div>
		<br />
		<div>
			<div class="left" id="alert-dbo-trigger-container">
				<a href="javascript: void(0)" id="alert-dbo-trigger"><span class="icon-bigcheckbox<?php if($sf_user->getGuardUser()->getAlertDbo() == '1') echo '-checked';?>"></span></a>
			</div>
			<div class="green strong" style="font-size: 18px; background: #ebebeb; margin-left: 42px; padding: 5px 10px">
				<a href="javascript: void(0)" id="alert-dbo-opener"  class="right mt-1"><span class="icon-bluearrow-right"></span></a>
				FilmSi Dvd &amp; Bluray
			</div>
			<div class="clear"></div>

			<div id="alert-dbo-content" style="display: none; margin-left: 45px; background: #f5f4e0; border: 1px solid #e6e4d5; padding: 10px"></div>

		</div>
		<br />
		<div>
			<div class="left" id="alert-tv-trigger-container">
				<a href="javascript: void(0)" id="alert-tv-trigger"><span class="icon-bigcheckbox<?php if($sf_user->getGuardUser()->getAlertTv() == '1') echo '-checked';?>"></span></a>
			</div>
			<div class="green strong" style="font-size: 18px; background: #ebebeb; margin-left: 42px; padding: 5px 10px">
				<a href="javascript: void(0)" id="alert-tv-opener"  class="right mt-1"><span class="icon-bluearrow-right"></span></a>
				FilmSi Tv
			</div>
			<div class="clear"></div>
			<div id="alert-tv-content" style="display: none; margin-left: 45px; background: #f5f4e0; border: 1px solid #e6e4d5; padding: 10px"></div>

		</div>
		<br />
		<div>
			<div class="left" id="alert-stire-trigger-container">
				<a href="javascript: void(0)" id="alert-stire-trigger"><span class="icon-bigcheckbox<?php if($sf_user->getGuardUser()->getAlertStire() == '1') echo '-checked';?>"></span></a>
			</div>
			<div class="green strong" style="font-size: 18px; background: #ebebeb; margin-left: 42px; padding: 5px 10px">
				<a href="javascript: void(0)" id="alert-stire-opener" class="right mt-1"><span class="icon-bluearrow-right"></span></a>
				FilmSi Stiri
			</div>
			<div class="clear"></div>
			<div id="alert-stire-content" style="display: none; margin-left: 45px; background: #f5f4e0; border: 1px solid #e6e4d5; padding: 10px"></div>
		</div>
	</div>
</div><!-- user-content end -->

<div class="clear"></div>

<script type="text/javascript">
$(document).ready(function(){
	$('#user-details-button').click(function(){
		$('#user-container').slideUp('fast')
			.load('<?php echo url_for('@default?module=user&action=details');?>', function(){
				$(this).slideDown('fast');
			});
	});

	$('#user-closer').click(function(){
		$('#user-container').slideUp('fast');
	});

	$('#alert-cinema-trigger').click(function(){
		$('#alert-cinema-trigger').hide();
		$('#alert-cinema-trigger-container').append('<img src="<?php echo image_path('indicator.gif');?>" />');

		$.ajax({
			'url': '<?php echo url_for('@default?module=user&action=alertCinemaStatusEdit');?>',
			'type': 'post',
			'dataType': 'json',
			success: function(response){
				$('#alert-cinema-trigger-container > img').remove();
				$('#alert-cinema-trigger > span')
					.removeClass('icon-bigcheckbox')
					.removeClass('icon-bigcheckbox-checked');
				if (response['status'] == '1'){
					$('#alert-cinema-trigger > span').addClass('icon-bigcheckbox-checked');
				} else {
					$('#alert-cinema-trigger > span').addClass('icon-bigcheckbox');
				}

				$('#alert-cinema-trigger').show();
			}
		});
	});

	$('#alert-dbo-trigger').click(function(){
		$('#alert-dbo-trigger').hide();
		$('#alert-dbo-trigger-container').append('<img src="<?php echo image_path('indicator.gif');?>" />');

		$.ajax({
			'url': '<?php echo url_for('@default?module=user&action=alertDboStatusEdit');?>',
			'type': 'post',
			'dataType': 'json',
			success: function(response){
				$('#alert-dbo-trigger-container > img').remove();
				$('#alert-dbo-trigger > span')
					.removeClass('icon-bigcheckbox')
					.removeClass('icon-bigcheckbox-checked');
				if (response['status'] == '1'){
					$('#alert-dbo-trigger > span').addClass('icon-bigcheckbox-checked');
				} else {
					$('#alert-dbo-trigger > span').addClass('icon-bigcheckbox');
				}

				$('#alert-dbo-trigger').show();
			}
		});
	});

	$('#alert-tv-trigger').click(function(){
		$('#alert-tv-trigger').hide();
		$('#alert-tv-trigger-container').append('<img src="<?php echo image_path('indicator.gif');?>" />');

		$.ajax({
			'url': '<?php echo url_for('@default?module=user&action=alertTvStatusEdit');?>',
			'type': 'post',
			'dataType': 'json',
			success: function(response){
				$('#alert-tv-trigger-container > img').remove();
				$('#alert-tv-trigger > span')
					.removeClass('icon-bigcheckbox')
					.removeClass('icon-bigcheckbox-checked');
				if (response['status'] == '1'){
					$('#alert-tv-trigger > span').addClass('icon-bigcheckbox-checked');
				} else {
					$('#alert-tv-trigger > span').addClass('icon-bigcheckbox');
				}

				$('#alert-tv-trigger').show();
			}
		});
	});

	$('#alert-stire-trigger').click(function(){
		$('#alert-stire-trigger').hide();
		$('#alert-stire-trigger-container').append('<img src="<?php echo image_path('indicator.gif');?>" />');

		$.ajax({
			'url': '<?php echo url_for('@default?module=user&action=alertStireStatusEdit');?>',
			'type': 'post',
			'dataType': 'json',
			success: function(response){
				$('#alert-stire-trigger-container > img').remove();
				$('#alert-stire-trigger > span')
					.removeClass('icon-bigcheckbox')
					.removeClass('icon-bigcheckbox-checked');
				if (response['status'] == '1'){
					$('#alert-stire-trigger > span').addClass('icon-bigcheckbox-checked');
				} else {
					$('#alert-stire-trigger > span').addClass('icon-bigcheckbox');
				}

				$('#alert-stire-trigger').show();
			}
		});
	});

	$('#alert-cinema-opener').click(function(){
		if ($('#alert-cinema-content').is(':visible')){
			$('#alert-cinema-content').slideUp();
			$('#alert-cinema-opener > span').removeClass('icon-bluearrow-down').addClass('icon-bluearrow-right');
		} else {
			$('#alert-cinema-opener > span').removeClass('icon-bluearrow-right');
			$('#alert-cinema-opener > span').html('<img src="<?php echo image_path('indicator.gif');?>" />');
			$.ajax({
				'url': '<?php echo url_for('@default?module=user&action=alertCinema');?>',
				success: function(response){
					$('#alert-cinema-content').html(response).slideDown('fast', function(){
						$('#alert-cinema-opener > span > img').remove();
						$('#alert-cinema-opener > span').addClass('icon-bluearrow-down');
					});
				}
			});
		}
	});

	$('#alert-dbo-opener').click(function(){
		if ($('#alert-dbo-content').is(':visible')){
			$('#alert-dbo-content').slideUp();
			$('#alert-dbo-opener > span').removeClass('icon-bluearrow-down').addClass('icon-bluearrow-right');
		} else {
			$('#alert-dbo-opener > span').removeClass('icon-bluearrow-right');
			$('#alert-dbo-opener > span').html('<img src="<?php echo image_path('indicator.gif');?>" />');
			$.ajax({
				'url': '<?php echo url_for('@default?module=user&action=alertDbo');?>',
				success: function(response){
					$('#alert-dbo-content').html(response).slideDown('fast', function(){
						$('#alert-dbo-opener > span > img').remove();
						$('#alert-dbo-opener > span').addClass('icon-bluearrow-down');
					});
				}
			});
		}
	});

	$('#alert-stire-opener').click(function(){
		if ($('#alert-stire-content').is(':visible')){
			$('#alert-stire-content').slideUp();
			$('#alert-stire-opener > span').removeClass('icon-bluearrow-down').addClass('icon-bluearrow-right');
		} else {
			$('#alert-stire-opener > span').removeClass('icon-bluearrow-right');
			$('#alert-stire-opener > span').html('<img src="<?php echo image_path('indicator.gif');?>" />');
			$.ajax({
				'url': '<?php echo url_for('@default?module=user&action=alertStire');?>',
				success: function(response){
					$('#alert-stire-content').html(response).slideDown('fast', function(){
						$('#alert-stire-opener > span > img').remove();
						$('#alert-stire-opener > span').addClass('icon-bluearrow-down');
					});
				}
			});
		}
	});

	$('#alert-tv-opener').click(function(){
		if ($('#alert-tv-content').is(':visible')){
			$('#alert-tv-content').slideUp();
			$('#alert-tv-opener > span').removeClass('icon-bluearrow-down').addClass('icon-bluearrow-right');
		} else {
			$('#alert-tv-opener > span').removeClass('icon-bluearrow-right');
			$('#alert-tv-opener > span').html('<img src="<?php echo image_path('indicator.gif');?>" />');
			$.ajax({
				'url': '<?php echo url_for('@default?module=user&action=alertTv');?>',
				success: function(response){
					$('#alert-tv-content').html(response).slideDown('fast', function(){
						$('#alert-tv-opener > span > img').remove();
						$('#alert-tv-opener > span').addClass('icon-bluearrow-down');
					});
				}
			});
		}
	});

});
</script>