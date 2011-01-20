<div class="left" style="width: 200px">
	<br /><br />
	<br />
	<button class="user-menubutton" id="user-login-button">Intra in cont</button>
	<br /><br />
	<button class="user-menubutton-selected">Creeaza cont</button>
	<br />
</div> <!-- user menu -->
<div id="user-content" style="background: #f4f4f4">
	<div class="right"><button class="user-closer" id="user-closer"></button></div>
	<p style="font-size: 40px; color:#4db35b; margin-bottom: 10px">Creeaza cont</p>
	<form id="user-register-form" method="post">
		<?php echo $form->renderHiddenFields();?>
		<?php echo $form->renderGlobalErrors();?>

		<div class="left" style="width: 350px;">
			<span class="smalltext">Prenume</span><br />
			<?php echo $form['first_name']->render(array('class' => 'inpttxt0', 'style' => 'width: 300px'));?><br />
			<?php echo $form['first_name']->renderError();?><br />

			<span class="smalltext">Nume</span><br />
			<?php echo $form['last_name']->render(array('class' => 'inpttxt0', 'style' => 'width: 300px'));?><br />
			<?php echo $form['last_name']->renderError();?><br />

			<span class="smalltext">Oras</span><br />
			<?php echo $form['location']->render(array('class' => 'inpttxt0', 'style' => 'width: 300px'));?><br /><br />

			<span class="smalltext">Data nasterii</span><br />
			<?php echo $form['dob']->render(array('class' => 'inpttxt0'));?><br />
			<div id="<?php echo $form->getName();?>_dob"></div>
			<?php echo $form['dob']->renderError();?><br />

			<span class="smalltext">Sex</span><br />
			<?php echo $form['gender']->render(array('class' => 'inpttxt0', 'style' => 'width: 300px'));?><br />
			<?php echo $form['gender']->renderError();?><br />

			<div id="user-buttons-container">
				<div id="user-buttons">
					<a href="javascript: void(0)" id="register-submit-button" class="whitebutton-small-link">Creeaza cont</a>
					<a href="javascript: void(0)" class="user-closer ml-3">Anuleaza</a>
				</div>
			</div>
		</div>

		<div class="left" style="width: 350px; margin-left: 20px">
			<span class="smalltext">Email</span><br />
			<?php echo $form['email_address']->render(array('class' => 'inpttxt0', 'style' => 'width: 300px'));?><br />
			<?php echo $form['email_address']->renderError();?><br />

			<span class="smalltext">Username</span><br />
			<?php echo $form['username']->render(array('class' => 'inpttxt0', 'style' => 'width: 300px'));?><br />
			<?php echo $form['username']->renderError();?><br />

			<span class="smalltext">Parola</span><br />
			<?php echo $form['password']->render(array('class' => 'inpttxt0', 'style' => 'width: 300px'));?><br />
			<?php echo $form['password']->renderError();?><br />

			<span class="smalltext">Confirma parola</span><br />
			<?php echo $form['password_again']->render(array('class' => 'inpttxt0', 'style' => 'width: 300px'));?><br />
			<?php echo $form['password_again']->renderError();?><br />
		</div>

		<div class="clear"></div>
	</form>
	
</div><!-- user-content end -->

<div class="clear"></div>

<script type="text/javascript">
$(document).ready(function(){
	$('#user-login-button').click(function(){
		$('#user-container').slideUp('fast')
			.load('<?php echo url_for('@login');?>', function(){
				$(this).slideDown('fast');
			});
	});

	$('.user-closer').click(function(){
		$('#user-container').slideUp('fast');
	});

	$('#register-submit-button').click(function(){
		$('#user-buttons').hide();
		$('#user-buttons-container').prepend('<div id="user-indicator"><img src="<?php echo image_path('indicator.gif');?>" /> Se creeaza contul ...</div>');

		$.ajax({
			url: '<?php echo url_for('@default?module=user&action=register');?>',
			type: 'post',
			data: {
				'sf_guard_user[id]': $('#sf_guard_user_id').val(),
				'sf_guard_user[_csrf_token]': $('#sf_guard_user__csrf_token').val(),
				'sf_guard_user[first_name]': $('#sf_guard_user_first_name').val(),
				'sf_guard_user[last_name]': $('#sf_guard_user_last_name').val(),
				'sf_guard_user[location]': $('#sf_guard_user_location').val(),
				'sf_guard_user[location_id]': $('#sf_guard_user_location_id').val(),
				'sf_guard_user[dob][day]': $('#sf_guard_user_dob_day').val(),
				'sf_guard_user[dob][month]': $('#sf_guard_user_dob_month').val(),
				'sf_guard_user[dob][year]': $('#sf_guard_user_dob_year').val(),
				'sf_guard_user[gender]': $('#sf_guard_user_gender').val(),
				'sf_guard_user[email_address]': $('#sf_guard_user_email_address').val(),
				'sf_guard_user[username]': $('#sf_guard_user_username').val(),
				'sf_guard_user[password]': $('#sf_guard_user_password').val(),
				'sf_guard_user[password_again]': $('#sf_guard_user_password_again').val()
			},
			dataType: 'json',
			success: function(response){
				if (response.status == true){
					$('#user-register-form').remove();
					$('<h5>Contul dumneavoastra a fost creat cu succes</h5><br /><p>Click <a href="javascript: void(0)" id="goto-login">AICI</a> pentru a intra in cont.</p><br /><br /><br /><br />').appendTo('#user-content');
					$('#goto-login').click(function(){
						$('#user-container').slideUp('fast')
							.load('<?php echo url_for('@login');?>', function(){
								$(this).slideDown('fast');
							});
					});
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



	/* Field autocomplete functionality */
		$("#<?php echo $form->getName();?>_location").autocomplete({
	      source: function(request, response) {
	        $.ajax({
	          url: "/backend.php/default/locations",
	          dataType: "json",
	          data: {
	            term: request.term
	          },
	          success: function(data) {
	            response(data);
	          }
	        })
	      },
		  select: function(event, ui){
			  $("#<?php echo $form->getName();?>_location" ).attr('value',ui.item.label);
			  $("#<?php echo $form->getName();?>_location_id" ).attr('value',ui.item.value);

			  return false;
		  },
		  focus: function(event, ui){
			  $("#<?php echo $form->getName();?>_location" ).attr('value',ui.item.label);
			  return false;
		  },
	      minLength: 2
	    });

});
</script>