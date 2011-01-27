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

	<br /><br /><br />

        <h5>Link-ul dumneavoastra de schimbare de parola este invalid sau a expirat.</h5>

        <br /><br /><br /><br /><br />

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


});
</script>