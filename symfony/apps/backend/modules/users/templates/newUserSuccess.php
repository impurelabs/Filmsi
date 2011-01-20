<h4 class="mb-3">User Nou</h4>

<form action="<?php echo url_for('@default?module=users&action=newUser');?>" method="post">

<?php echo $form->renderHiddenFields();?>
<?php echo $form->renderGlobalErrors();?>

<table>
	<tr>
    	<td class="pb-2">Prenume</td>
        <td class="pl-2 pb-2"><?php echo $form['first_name']->render();?><br />
        	<?php echo $form['first_name']->renderError();?></td>
	</tr>
	<tr>
    	<td class="pb-2">Nume</td>
        <td class="pl-2 pb-2"><?php echo $form['last_name']->render();?><br />
        	<?php echo $form['last_name']->renderError();?></td>
	</tr>
	<tr>
    	<td class="pb-2">Oras</td>
        <td class="pl-2 pb-2"><?php echo $form['location']->render();?></td>
	</tr>
	<tr>
    	<td class="pb-2">Sex</td>
        <td class="pl-2 pb-2"><?php echo $form['gender']->render();?><br />
        	<?php echo $form['gender']->renderError();?></td>
	</tr>
	<tr>
    	<td class="pb-2">Data nasterii</td>
        <td class="pl-2 pb-2"><?php echo $form['dob']->render();?><br />
        	<?php echo $form['dob']->renderError();?></td>
	</tr>
	<tr>
    	<td class="pb-2">Email</td>
        <td class="pl-2 pb-2"><?php echo $form['email_address']->render();?><br />
        	<?php echo $form['email_address']->renderError();?></td>
	</tr>
	<tr>
    	<td class="pb-2">Username</td>
        <td class="pl-2 pb-2"><?php echo $form['username']->render();?><br />
        	<?php echo $form['username']->renderError();?></td>
	</tr>
	<tr>
    	<td class="pb-2">Parola</td>
        <td class="pl-2 pb-2"><?php echo $form['password']->render();?><br />
        	<?php echo $form['password']->renderError();?></td>
	</tr>
	<tr>
    	<td class="pb-2">Confirma parola</td>
        <td class="pl-2 pb-2"><?php echo $form['password_again']->render();?><br />
        	<?php echo $form['password_again']->renderError();?></td>
	</tr>
	<tr>
    	<td class="pb-2">E activ</td>
        <td class="pl-2 pb-2"><?php echo $form['is_active']->render();?><br />
        	<?php echo $form['is_active']->renderError();?></td>
	</tr>
	<tr>
    	<td class="pb-2">E super admin</td>
        <td class="pl-2 pb-2"><?php echo $form['is_super_admin']->render();?><br />
        	<?php echo $form['is_super_admin']->renderError();?></td>
	</tr>
	<tr>
    	<td class="pb-2">Lista permisiuni</td>
        <td class="pl-2 pb-2"><?php echo $form['permissions_list']->render();?><br />
        	<?php echo $form['permissions_list']->renderError();?></td>
	</tr>
    
</table>
        	<button type="submit">Salveaza</button> 
        	<a href="<?php echo url_for('@default_index?module=users');?>">Anuleaza</a>

</form>

<script type="text/javascript">
	$(document).ready(function(){
		$('#<?php echo $form->getName();?>_dob').datepicker({dateFormat: 'yy-mm-dd'});


		/* Field autocomplete functionality */
		$("#<?php echo $form->getName();?>_location").autocomplete({
	      source: function(request, response) {
	        $.ajax({
	          url: "<?php echo url_for('@default?module=default&action=locations')?>",
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