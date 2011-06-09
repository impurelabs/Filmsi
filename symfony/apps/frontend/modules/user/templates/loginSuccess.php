<div class="left" style="width: 200px">
	<br /><br />
	<br />
	<button class="user-menubutton-selected">Intra in cont</button>
	<br /><br />
	<button class="user-menubutton" id="user-register-button">Creeaza cont</button>
	<br />
</div> <!-- user menu -->
<div id="user-content" style="background: #f4f4f4">
	<div class="right"><button class="user-closer" id="user-closer"></button></div>
	<p style="font-size: 40px; color:#4db35b; margin-bottom: 10px">Intra in cont</p>
	<form id="user-login-form" method="post">
		<?php echo $form->renderHiddenFields();?>
		<?php echo $form->renderGlobalErrors();?>

		<span class="smalltext">Username</span><br />
		<?php echo $form['username']->render(array('class' => 'inpttxt0', 'style' => 'width: 300px'));?><br />
		<?php echo $form['username']->renderError();?><br />

		<span class="smalltext">Parola</span><br />
		<?php echo $form['password']->render(array('class' => 'inpttxt0', 'style' => 'width: 300px'));?><br />
		<?php echo $form['password']->renderError();?><br />

		<?php echo $form['remember']->render();?> tine-ma minte<br />
		<?php echo $form['remember']->renderError();?><br />

		<div id="user-buttons-container">
			<div id="user-buttons">
				<a href="javascript: void(0)" id="login-submit-button" class="whitebutton-small-link">Intra in cont</a>
				<a href="javascript: void(0)" class="user-forgot ml-3">Am uitat parola!</a>
				
				<a href="javascript: void(0)" style="margin-left: 300px" id="fb-button"><img src="<?php echo image_path('fb-button.png');?>" /></a>
			</div>
		</div><br /><br />

	</form>

</div><!-- user-content end -->

<div class="clear"></div>

<script src="http://connect.facebook.net/en_US/all.js"></script>
<script type="text/javascript">
FB.init({ 
	appId:'207943125913396', cookie:true, 
	status:true, xfbml:true 
 });
		
$(document).ready(function(){
	$('#fb-button').click(function(){
		alert('aaa');
		
	});
	
	$('#user-register-button').click(function(){
		$('#user-container').slideUp('fast')
			.load('<?php echo url_for('@default?module=user&action=register');?>', function(){
				$(this).slideDown('fast');
			});
	});

	$('.user-forgot').click(function(){
		$('#user-container').slideUp('fast')
			.load('<?php echo url_for('@default?module=user&action=forgotPassword');?>', function(){
				$(this).slideDown('fast');
			});
	});

	$('.user-closer').click(function(){
		$('#user-container').slideUp('fast');
	});

	$('#login-submit-button').click(function(){
		$('#user-buttons').hide();
		$('#user-buttons-container').prepend('<div id="user-indicator"><img src="<?php echo image_path('indicator.gif');?>" /> Se intra in cont ...</div>');

		$.ajax({
			url: '<?php echo url_for('@login');?>',
			type: 'post',
			data: {
				'<?php echo $form->getName();?>[_csrf_token]': $('#<?php echo $form->getName();?>__csrf_token').val(),
				'<?php echo $form->getName();?>[username]': $('#<?php echo $form->getName();?>_username').val(),
				'<?php echo $form->getName();?>[password]': $('#<?php echo $form->getName();?>_password').val(),
				'<?php echo $form->getName();?>[remember]': $('#<?php echo $form->getName();?>_remember').val()
			},
			dataType: 'json',
			success: function(response){
				if (response.status == true){
					if (location.href.indexOf('?') == -1){
						url = location.href + '?sc=1' ;
					} else {
						url = location.href + '&sc=1' ;
					}
					location.replace(url);
				} else {
					/* Remove previous errors */
					$('.error_list').remove();

					for (i in response.errors){
						$('<div class="error_list">' + response.errors[i] + '</div>').insertAfter('#<?php echo $form->getName();?>_' + i);
					}
					/* Put back the buttons and remove the indicator */
					$('#user-indicator').remove();
					$('#user-buttons').show();
				}
			}

		});
	});



});
</script>