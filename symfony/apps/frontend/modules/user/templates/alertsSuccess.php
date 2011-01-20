<div class="left" style="width: 200px">
	<p style="color: #ffffff">Bun venit, <br /> <span style="font-size: 18px"><?php echo $sf_user->getName();?></span></p>
	<br />
	<button class="user-menubutton" id="user-details-button"><span class="icon-user-personal"></span> Detalii personale</button>
	<br />
	<button class="user-menubutton-selected"><span class="icon-user-alerts"></span> Alerte informative</button>
</div> <!-- user menu -->
<div id="user-content" style=" background: url('../images/user-bg.png') #f4f4f4  right bottom no-repeat;">
	<div class="right"><button id="user-closer"></button></div>
	<p style="font-size: 40px; color:#4db35b; margin-bottom: 10px">Ce poti face pe FilmSi?</p>
	<ul class="list1" style="margin-left: 20px;">
		<li><span>Pe FilmSi ai acces la cele mai noi informatii din lumea filmului.</span></li>
		<li><span>Esti informat din timp care sunt filmele ce ruleaza la cinematograful din orasul tau.</li></span>
		<li><span>Stii unde si cand apar cele mai noi filme.</li></span>
		<li><span>Stii unde si cand apar filmele preferate.</li></span>
		<li><span>Afli unde si in ce filme joaca actorii tai preferati.</li></span>
		<li><span>Afli ce premii au mai castigat filmele si actorii tai preferati.</li></span>
	</ul>
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

});
</script>