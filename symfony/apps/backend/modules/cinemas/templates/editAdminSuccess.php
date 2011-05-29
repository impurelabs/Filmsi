<h4>Cinematograf "<?php echo $cinema->getName();?>"</h4>

<a href="<?php echo url_for('@default?module=cinemas&action=view');?>?lid=<?php echo $form->getObject()->getLibraryId();?>">Detalii</a>
 | <a href="<?php echo url_for('@default?module=cinemas&action=schedule');?>?lid=<?php echo $form->getObject()->getLibraryId();?>">Program</a>
 | <a href="<?php echo url_for('@default?module=cinemas&action=admin');?>?lid=<?php echo $form->getObject()->getLibraryId();?>" class="selected">Administrator</a>
<?php if($sf_user->hasCredential('Moderator') && $form->getObject()->getState() == Library::STATE_PENDING): ?>
 | Acest obiect este Pending!  <button type="button" onclick="location.href='<?php echo url_for('@default?module=default&action=allow');?>?lid=<?php echo $form->getObject()->getLibraryId();?>'">Aproba</button>
<?php endif; ?>

 <div class="mt-2 mb-2 cell-separator-double"></div>

<h5>Editeaza administrator</h5>
<div class="clear"></div>

<div id="test"></div>
<form id="the-form" action="<?php echo url_for('@default?module=cinemas&action=editAdmin');?>?lid=<?php echo $form->getObject()->getLibraryId();?>" method="post">

<?php echo $form->renderHiddenFields();?>
<?php echo $form->renderGlobalErrors();?>



<table class="span-19">
    <tr>
    	<th>Username administrator</th>
        <td><input type="text" id="admin-user-selector" value="<?php echo $form->getObject()->getAdmin()->getUsername();?>" class="span-13" /> </td>
    </tr>
</table>


<div class="mt-2 mb-2 clear"></div>

<div class="mt-3">
    <button type="button" onclick="$('#the-form').submit()"class="mr-2">Salveaza</button>
    <a href="<?php echo $sf_request->getReferer();?>">Anuleaza</a>
</div>

</form>

<script type="text/javascript">
$(document).ready(function(){


	/* User selector functionality */
	$("#admin-user-selector").autocomplete({
	  source: function(request, response) {
		$.ajax({
		  url: "<?php echo url_for('@default?module=users&action=api')?>",
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
		  $('#cinema_admin_user_id').val(ui.item.value);
		  $('#admin-user-selector').val(ui.item.label);
		  return false;
	  },
	  minLength: 2
	});


		
		
});

</script>