<h4 class="mb-2"><?php echo $festivalEdition->getFestival()->getName();?> - <?php echo $festivalEdition->getEdition();?></h4>


<a href="<?php echo url_for('@default?module=festivalEditions&action=view');?>?lid=<?php echo $festivalEdition->getLibraryId();?>">Detalii</a>
 | <a href="<?php echo url_for('@default?module=festivalEditions&action=section');?>?lid=<?php echo $festivalEdition->getLibraryId();?>">Sectiuni</a>
 | <a href="<?php echo url_for('@default?module=festivalEditions&action=judges');?>?lid=<?php echo $festivalEdition->getLibraryId();?>" class="selected">Juriu</a>
<?php if($sf_user->hasCredential('Moderator') && $festivalEdition->getState() == Library::STATE_PENDING): ?>
 | Acest obiect este Pending!  <button type="button" onclick="location.href='<?php echo url_for('@default?module=default&action=allow');?>?lid=<?php echo $festivalEdition->getLibraryId();?>'">Aproba</button>
<?php endif; ?>

<div class="mt-2 mb-2 cell-separator-double"></div>


<h5 class="mb-3">Adauga persoana in juriu</h5>
<div class="clear"></div>

<form action="<?php echo url_for('@default?module=festivalEditions&action=judgeAdd');?>?id=<?php echo $festivalEdition->getId();?>" method="post">
	<input type="hidden" name="person_id" id="person_id" />
	<input type="text" id="person-selector" style="width:300px" /><br/><br />
	<button type="submit">Salveaza</button>
	<a href="<?php echo url_for('@default?module=festivalEditions&action=judges');?>?lid=<?php echo $festivalEdition->getLibraryId();?>">Anuleaza</a>
</form>




<div class="clear mb-3"></div>




<script type="text/javascript">
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
			  $('#person_id').val(ui.item.value);
			  $('#person-selector').val(ui.item.label);
			  return false;
		  },
	      minLength: 2
	    });

</script>