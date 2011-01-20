<h4 class="mb-2"><?php echo $film->getNameRo();?> <?php if ($film->getNameEn() != '') echo '(' . $film->getNameEn() . ')';?></h4>


 <a href="<?php echo url_for('@default?module=films&action=view');?>?lid=<?php echo $film->getLibraryId();?>">Detalii</a>
 | <a href="<?php echo url_for('@default?module=films&action=status');?>?lid=<?php echo $film->getLibraryId();?>">Status</a>
 | <a href="<?php echo url_for('@default?module=films&action=person');?>?lid=<?php echo $film->getLibraryId();?>" class="selected">Persoane</a>
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


<h5>Persoane</h5>
<div class="mb-3"></div>

<form action="<?php echo url_for('@default?module=films&action=personAdd');?>?id=<?php echo $film->getId();?>" method="post">
	<input type="hidden" name="person_id" id="person-id" />
	<input type="text" id="person-selector" style="width:300px" /> <br /><br />
	<input type="checkbox" value="1" name="is_actor" /> actor 
	<input type="checkbox" value="1" name="is_director" class="ml-3" /> regizor
	<input type="checkbox" value="1" name="is_scriptwriter" class="ml-3" /> scenarist
	<input type="checkbox" value="1" name="is_producer" class="ml-3" /> producator

	<br /><br />
	<button type="submit">Salveaza</button>
	<a href="<?php echo url_for('@default?module=films&action=person');?>?lid=<?php echo $film->getLibraryId();?>">Anuleaza</a>
</form>

<script type="text/javascript">
	$(document).ready(function(){
		/* Field autocomplete functionality */
		$("#person-selector").autocomplete({
	      source: function(request, response) {
	        $.ajax({
	          url: "<?php echo url_for('@default?module=persons&action=api')?>",
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
			  $('#person-id').val(ui.item.value);
			  $("#person-selector").attr('value', ui.item.label);
			  return false;
		  },
	      minLength: 2
	    });

	});

</script>