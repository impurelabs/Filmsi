<h4 class="mb-2"><?php echo $film->getNameRo();?> <?php if ($film->getNameEn() != '') echo '(' . $film->getNameEn() . ')';?></h4>


 <a href="<?php echo url_for('@default?module=films&action=view');?>?lid=<?php echo $film->getLibraryId();?>">Detalii</a>
 | <a href="<?php echo url_for('@default?module=films&action=status');?>?lid=<?php echo $film->getLibraryId();?>" class="selected">Status</a>
 | <a href="<?php echo url_for('@default?module=films&action=person');?>?lid=<?php echo $film->getLibraryId();?>">Persoane</a>
<?php if ($film->getIsSeries()):?>
 | <a href="<?php echo url_for('@default?module=films&action=episode');?>?lid=<?php echo $film->getLibraryId();?>">Episoade</a>
<?php endif; ?>
<?php if ($sf_user->hasCredential('Promovare')):?>
 | <a href="<?php echo url_for('@default?module=films&action=background');?>?lid=<?php echo $film->getLibraryId();?>">Background</a>
 <?php endif;?>
<?php if($sf_user->hasCredential('Moderator') && $film->getState() == Library::STATE_PENDING): ?>
 | Acest obiect este Pending! <button type="button" onclick="location.href='<?php echo url_for('@default?module=default&action=allow');?>?lid=<?php echo $film->getLibraryId();?>'">Aproba</button>
<?php endif; ?>

<div class="mt-2 mb-2 cell-separator-double"></div>


<h5 class="mb-3">Editeaza Status</h5>

<div class="clear"></div>

<form action="<?php echo url_for('@default?module=films&action=statusEdit');?>?id=<?php echo $form->getObject()->getId();?>" method="post">

<?php echo $form->renderHiddenFields();?>
<?php echo $form->renderGlobalErrors();?>

<div>

<?php echo $form['status_in_production']->render();?> <strong>In productie</strong> <br />
<?php echo $form['status_in_production']->renderError();?>

<div class="mt-2 mb-2 cell-separator-double clear"></div>

<?php echo $form['status_cinema']->render();?> <strong>In cinema </strong><br />
<?php echo $form['status_cinema']->renderError();?>
<br />
<div id="cinema-details"<?php if (!$film->getStatusCinema()) echo 'class="display-none"';?>>
din 
anul <?php echo $form['status_cinema_year']->render();?> 
luna <?php echo $form['status_cinema_month']->render();?>
ziua <?php echo $form['status_cinema_day']->render();?>
</div>

<div class="mt-2 mb-2 cell-separator-double clear"></div>

<?php echo $form['status_dvd']->render();?> <strong>Pe DVD </strong><br />
<?php echo $form['status_dvd']->renderError();?>
<br />
<div id="dvd-details"<?php if (!$film->getStatusDvd()) echo 'class="display-none"';?>>
din 
anul <?php echo $form['status_dvd_year']->render();?> 
luna <?php echo $form['status_dvd_month']->render();?>
ziua <?php echo $form['status_dvd_day']->render();?>
</div>

<div class="mt-2 mb-2 cell-separator-double clear"></div>

<?php echo $form['status_bluray']->render();?> <strong>Pe Bluray </strong><br />
<?php echo $form['status_bluray']->renderError();?>
<br />
<div id="bluray-details"<?php if (!$film->getStatusBluray()) echo 'class="display-none"';?>>
din 
anul <?php echo $form['status_bluray_year']->render();?> 
luna <?php echo $form['status_bluray_month']->render();?>
ziua <?php echo $form['status_bluray_day']->render();?>
</div>

<div class="mt-2 mb-2 cell-separator-double clear"></div>

<?php echo $form['status_online']->render();?> <strong>Online </strong><br />
<?php echo $form['status_online']->renderError();?>
<br />
<div id="online-details"<?php if (!$film->getStatusOnline()) echo 'class="display-none"';?>>
din
anul <?php echo $form['status_online_year']->render();?>
luna <?php echo $form['status_online_month']->render();?>
ziua <?php echo $form['status_online_day']->render();?>
</div>

<div class="mt-2 mb-2 cell-separator-double clear"></div>

<?php echo $form['status_tv']->render();?> <strong>Tv </strong><br />
<?php echo $form['status_tv']->renderError();?>
<br />
<div id="tv-details"<?php if (!$film->getStatusTv()) echo 'class="display-none"';?>>
din
anul <?php echo $form['status_tv_year']->render();?>
luna <?php echo $form['status_tv_month']->render();?>
ziua <?php echo $form['status_tv_day']->render();?>
</div>


<div class="clear"></div>


<div class="mt-2 mb-2 cell-separator-double clear"></div>

<div class="mt-3">
    <button type="submit" class="mr-2">Salveaza</button>
    <a href="<?php echo url_for('@default?module=films&action=status');?>?lid=<?php echo $form->getObject()->getLibraryId();?>">Anuleaza</a>
</div>

</form>

<script type="text/javascript">
	$(document).ready(function(){
		$('#film_status_cinema').change(function(){
			if ($(this).is(':checked')){
				$('#cinema-details').slideDown();	
			} else {
				$('#cinema-details').slideUp();	
			}
		});
		
		
		$('#film_status_dvd').change(function(){
			if ($(this).is(':checked')){
				$('#dvd-details').slideDown();	
			} else {
				$('#dvd-details').slideUp();	
			}
		});
		
		
		$('#film_status_bluray').change(function(){
			if ($(this).is(':checked')){
				$('#bluray-details').slideDown();	
			} else {
				$('#bluray-details').slideUp();	
			}
		});


		$('#film_status_online').change(function(){
			if ($(this).is(':checked')){
				$('#online-details').slideDown();
			} else {
				$('#online-details').slideUp();
			}
		});


		$('#film_status_tv').change(function(){
			if ($(this).is(':checked')){
				$('#tv-details').slideDown();
			} else {
				$('#tv-details').slideUp();
			}
		});
	});
</script>
