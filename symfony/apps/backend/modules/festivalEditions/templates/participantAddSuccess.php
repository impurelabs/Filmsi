<h4 class="mb-2"><?php echo $festivalEdition->getFestival()->getName();?> - <?php echo $festivalEdition->getEdition();?></h4>


<a href="<?php echo url_for('@default?module=festivalEditions&action=view');?>?lid=<?php echo $festivalEdition->getLibraryId();?>">Detalii</a>
 | <a href="<?php echo url_for('@default?module=festivalEditions&action=section');?>?lid=<?php echo $festivalEdition->getLibraryId();?>" class="selected">Sectiuni</a>
 | <a href="<?php echo url_for('@default?module=festivalEditions&action=judges');?>?lid=<?php echo $festivalEdition->getLibraryId();?>">Juriu</a>
<?php if($sf_user->hasCredential('Moderator') && $festivalEdition->getState() == Library::STATE_PENDING): ?>
 | Acest obiect este Pending!  <button type="button" onclick="location.href='<?php echo url_for('@default?module=default&action=allow');?>?lid=<?php echo $festivalEdition->getLibraryId();?>'">Aproba</button>
<?php endif; ?>

<div class="mt-2 mb-2 cell-separator-double"></div>


<h5 class="mb-3">Adauga participant nou in sectiunea "<?php echo $section->getName();?>"</h5>

<form action="<?php echo url_for('@default?module=festivalEditions&action=participantAdd');?>?id=<?php echo $section->getId();?>" method="post">

	<?php echo $form->renderHiddenFields();?>
    <?php echo $form->renderGlobalErrors();?>

	<strong>Film</strong><br />
	<input type="text" id="film-add-field" style="width: 400px" /><br /><br />

	<strong>Person</strong><br />
	<input type="text" id="person-add-field" style="width: 400px" /><br /><br />

    <?php echo $form['is_winner']->render();?> castigator<br />
    <br /><br />

    <button type="submit" class="mr-2">Salveaza</button> 
	<a href="<?php echo url_for('@default?module=festivalEditions&action=section');?>?lid=<?php echo $festivalEdition->getLibraryId();?>">Anuleaza</a>

</form>

<script type="text/javascript">

	/* Field autocomplete functionality */
		$("#person-add-field").autocomplete({
	      source: function(request, response) {
	        $.ajax({
	          url: "<?php echo url_for('@default?module=persons&action=apiImdb')?>",
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
			  $('#festival_section_participant_person_imdb').val(ui.item.value);
			  $('#person-add-field').val(ui.item.label);

			  return false;
		  },
	      minLength: 2
	    });






		/* Field autocomplete functionality */
		$("#film-add-field").autocomplete({
	      source: function(request, response) {
	        $.ajax({
	          url: "<?php echo url_for('@default?module=films&action=apiImdb')?>",
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
			  $('#festival_section_participant_film_imdb').val(ui.item.value);
			  $('#film-add-field').val(ui.item.label);

			  return false;
		  },
	      minLength: 2
	    });

</script>