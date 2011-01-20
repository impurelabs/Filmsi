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
	<p style="font-size: 40px; color:#4db35b; margin-bottom: 10px">Schimbare parola</p>

	<form id="user-change-form" method="post">
		<p>Salut <?php echo $user->getName();?>. Pentru a schimba parola completeaza formularul de mai jos:</p><br />
		<?php echo $form->renderHiddenFields();?>
		<?php echo $form->renderGlobalErrors();?>

		<span class="smalltext">Noua parola</span><br />
		<?php echo $form['password']->render(array('class' => 'inpttxt0', 'style' => 'width: 300px'));?><br />
		<?php echo $form['password']->renderError();?><br />

		<span class="smalltext">Confirma noua parola</span><br />
		<?php echo $form['password_again']->render(array('class' => 'inpttxt0', 'style' => 'width: 300px'));?><br />
		<?php echo $form['password_again']->renderError();?><br />

		<div id="user-buttons-container">
			<div id="user-buttons">
				<a href="javascript: void(0)" id="change-button" class="whitebutton-small-link">Trimite</a>
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

	$('#change-button').click(function(){
		$('#user-buttons').hide();
		$('#user-buttons-container').prepend('<div id="user-indicator"><img src="<?php echo image_path('indicator.gif');?>" /> Se trimite cererea ...</div>');

		$.ajax({
			url: '<?php echo url_for('@default?module=user&action=changePassword');?>?unique_key=<?php echo $sf_request->getParameter('unique_key') ?>',
			type: 'post',
			data: {
				'<?php echo $form->getName();?>[_csrf_token]': $('#<?php echo $form->getName();?>__csrf_token').val(),
				'<?php echo $form->getName();?>[id]': $('#<?php echo $form->getName();?>_id').val(),
				'<?php echo $form->getName();?>[password]': $('#<?php echo $form->getName();?>_password').val(),
				'<?php echo $form->getName();?>[password_again]': $('#<?php echo $form->getName();?>_password_again').val()
			},
			dataType: 'json',
			success: function(response){
				if (response.status == true){
					$('#user-change-form').remove();
					$('<h5>Parola a fost schimbata cu succes</h5><br /><p>Click <a href="<?php echo url_for('@homepage');?>?lo=1">AICI</a> pentru a intra in cont.</p><br /><br /><br /><br />').appendTo('#user-content');
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