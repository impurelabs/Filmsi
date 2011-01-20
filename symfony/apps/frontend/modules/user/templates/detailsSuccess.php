<div class="left" style="width: 200px">
	<p style="color: #ffffff">Bun venit, <br /> <span style="font-size: 18px"><?php echo $sf_user->getName();?></span></p>
	<br />
	<button class="user-menubutton-selected"><span class="icon-user-personal"></span> Detalii personale</button>
	<br />
	<button class="user-menubutton" id="user-alerts-button"><span class="icon-user-alerts"></span> Alerte informative</button>
</div> <!-- user menu -->
<div id="user-content" style=" background: url('../images/user-bg.png') #f4f4f4  right bottom no-repeat;">
	<div class="right"><button id="user-closer"></button></div>
	<p style="font-size: 40px; color:#4db35b; margin-bottom: 10px">Detalii personale</p>

	<div class="left" style="width: 350px">
		<span class="bigstronggreen">Nume</span><br />
		<span class="bigstrong"><?php echo $sf_user->getName();?></span><br /><br />

		<span class="bigstronggreen">Email</span><br />
		<span class="bigstrong"><?php echo $sf_user->getGuardUser()->getEmailAddress();?></span><br /><br />

		<span class="bigstronggreen">Oras</span><br />
		<span class="bigstrong"><?php echo $sf_user->getGuardUser()->getLocation()->getCity();?></span><br /><br />

		<span class="bigstronggreen">Data nasterii</span><br />
		<span class="bigstrong"><?php echo format_date($sf_user->getGuardUser()->getDob(), 'D', 'ro');?></span><br /><br />

		<span class="bigstronggreen">Sex</span><br />
		<span class="bigstrong"><?php echo $sf_user->getGuardUser()->getGenderName();?></span><br /><br />

		<a href="javascript:void(0)" id="user-editdetails-link">Editeaza</a>
		<br /><br />
	</div>

	<div class="left ml-3" style="width:350px">
		<span class="bigstronggreen">Email</span><br />
		<span class="bigstrong"><?php echo $sf_user->getGuardUser()->getEmailAddress();?></span><br /><br />
		
		<span class="bigstronggreen">Username</span><br />
		<span class="bigstrong"><?php echo $sf_user->getUsername();?></span><br /><br />

		<span class="bigstronggreen">Parola</span><br />
		<span class="bigstrong">******</span>
	</div>
</div><!-- user-content end -->

<div class="clear"></div>

<script type="text/javascript">
$(document).ready(function(){
	$('#user-alerts-button').click(function(){
		$('#user-container').slideUp('fast')
			.load('<?php echo url_for('@default?module=user&action=alerts');?>', function(){
				$(this).slideDown('fast');
			});
	});

	$('#user-closer').click(function(){
		$('#user-container').slideUp('fast');
	});

	$('#user-editdetails-link').click(function(){
		$('#user-container').slideUp('fast')
			.load('<?php echo url_for('@default?module=user&action=edit');?>', function(){
				$(this).slideDown('fast');
			});
	});

});
</script>