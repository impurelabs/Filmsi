<h4>Editeaza Box Office Ro</h4>
<a class="mb-3" href="<?php echo url_for('@default_index?module=boxoffice');?>">intoarce-te inapoi</a>

<form action="<?php echo url_for('@default?module=boxoffice&action=editRo');?>" method="post">
<?php echo $form->renderHiddenFields();?>
<?php echo $form->renderGlobalErrors();?>

<ol>
	<li style="list-style:decimal inside" class="mb-1"><input type="text" value="<?php echo $boxofficeFilm->getFilm1()->getName();?>" class="film-selector" id="film-selector-1" style="width: 200px" /></li>
	<li style="list-style:decimal inside" class="mb-1"><input type="text" value="<?php echo $boxofficeFilm->getFilm2()->getName();?>" class="film-selector" id="film-selector-2" style="width: 200px" /></li>
	<li style="list-style:decimal inside" class="mb-1"><input type="text" value="<?php echo $boxofficeFilm->getFilm3()->getName();?>" class="film-selector" id="film-selector-3" style="width: 200px" /></li>
	<li style="list-style:decimal inside" class="mb-1"><input type="text" value="<?php echo $boxofficeFilm->getFilm4()->getName();?>" class="film-selector" id="film-selector-4" style="width: 200px" /></li>
	<li style="list-style:decimal inside" class="mb-1"><input type="text" value="<?php echo $boxofficeFilm->getFilm5()->getName();?>" class="film-selector" id="film-selector-5" style="width: 200px" /></li>
</ol> 

<button type="submit">Salveaza</button> <a href="<?php echo url_for('@default_index?module=boxoffice');?>">Anuleaza</a>

</form>

<script type="text/javascript">
	$(document).ready(function(){
		
		/* Field autocomplete functionality */
		$(".film-selector").autocomplete({
	      source: function(request, response) {
	        $.ajax({
	          url: "<?php echo url_for('@default?module=films&action=api')?>",
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
			  id = $(this).attr('id').substr(14);
			  
			  $('#boxoffice_film_film_' + id + '_id').val(ui.item.value);
			  $(this).attr('value', ui.item.label);  
				
				return false;
		  },
		  close: function(event, ui){
		  },
	      minLength: 2
	    });	
		
		$('form').submit(function(){
			if ($('#film-selector-1').val() == '') $('#boxoffice_film_film_1_id').remove();
			if ($('#film-selector-2').val() == '') $('#boxoffice_film_film_2_id').remove();
			if ($('#film-selector-3').val() == '') $('#boxoffice_film_film_3_id').remove();
			if ($('#film-selector-4').val() == '') $('#boxoffice_film_film_4_id').remove();
			if ($('#film-selector-5').val() == '') $('#boxoffice_film_film_5_id').remove();
				
		});
	});
</script>

