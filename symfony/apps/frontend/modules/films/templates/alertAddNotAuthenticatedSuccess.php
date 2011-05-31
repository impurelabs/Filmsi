<br /><br /><br />

<div class="normalcell ml-3 align-center"><br />
	<a href="javascript: void(0)" class="important-link alert-user-login-link">Intra in cont</a> | 
	<a href="javascript: void(0)" class="important-link alert-user-register-link">Creeaza cont</a>
	<br /><br />
</div>

<script type="text/javascript">
$(document).ready(function(){
	$('.alert-user-login-link').click(function(){
		$('#user-container').load('<?php echo url_for('@login');?>');
		$('#user-container').slideDown('fast');
		$('#film-alert-container').dialog('close');
	});
	
	$('.alert-user-register-link').click(function(){
		$('#user-container').load('<?php echo url_for('@default?module=user&action=register');?>');
		$('#user-container').slideDown('fast');
		$('#film-alert-container').dialog('close');
	});
});
</script>