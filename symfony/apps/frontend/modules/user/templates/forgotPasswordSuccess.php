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
	<p style="font-size: 40px; color:#4db35b; margin-bottom: 10px">Am uitat parola</p>
	
	<form id="user-forgot-form" method="post">
		<p>Pentru a o schimba, completeaza formularul de mai jos:</p><br />
		<?php echo $form->renderHiddenFields();?>
		<?php echo $form->renderGlobalErrors();?>

		<span class="smalltext">Email</span><br />
		<?php echo $form['email_address']->render(array('class' => 'inpttxt0', 'style' => 'width: 300px'));?><br />
		<?php echo $form['email_address']->renderError();?><br />

		<div id="user-buttons-container">
			<div id="user-buttons">
				<a href="javascript: void(0)" id="forgot-button" class="whitebutton-small-link">Trimite</a>
				<a href="javascript: void(0)" id="cancel-link" class="ml-3">Anuleaza</a>
			</div>
		</div><br /><br />

	</form>

</div><!-- user-content end -->

<div class="clear"></div>

<script type="text/javascript">
$(document).ready(function(){
	$('#user-register-button').click(function(){
		$('#user-container').slideUp('fast')
			.load('<?php echo url_for('@default?module=user&action=register');?>', function(){
				$(this).slideDown('fast');
			});
	});
	$('#cancel-link').click(function(){
		$('#user-container').slideUp('fast')
			.load('<?php echo url_for('@default?module=user&action=login');?>', function(){
				$(this).slideDown('fast');
			});
	});

	$('.user-closer').click(function(){
		$('#user-container').slideUp('fast');
	});

	$('#forgot-button').click(function(){
		$('#user-buttons').hide();
		$('#user-buttons-container').prepend('<div id="user-indicator"><img src="<?php echo image_path('indicator.gif');?>" /> Se trimite cererea ...</div>');

		$.ajax({
			url: '<?php echo url_for('@default?module=user&action=forgotPassword');?>',
			type: 'post',
			data: {
				'<?php echo $form->getName();?>[_csrf_token]': $('#<?php echo $form->getName();?>__csrf_token').val(),
				'<?php echo $form->getName();?>[email_address]': $('#<?php echo $form->getName();?>_email_address').val(),
			},
			dataType: 'json',
			success: function(response){
				if (response.status == true){
					$('#user-forgot-form').remove();
					$('<br /><h5>Modalitatea de a va reseta parola v-a fost trimisa prin email.</h5><br /><br /><br /><br />').appendTo('#user-content');
				} else {
					$('<div class="error_list">Adresa de email este invalida</div>').insertAfter('#<?php echo $form->getName();?>_email_address');
					/* Put back the buttons and remove the indicator */
					$('#user-indicator').remove();
					$('#user-buttons').show();
				}
			}

		});
	});



});
</script>