<h4 class="mb-3">Editeaza Articol</h4>

<div class="clear"></div>

<form action="<?php echo url_for('@default?module=articles&action=edit');?>?lid=<?php echo $form->getObject()->getLibraryId();?>" method="post" enctype="multipart/form-data">

<?php echo $form->renderHiddenFields();?>
<?php echo $form->renderGlobalErrors();?>

<table class="span-19">
	<tr>
    	<th>Titlu</th>
        <td><?php echo $form['name']->render(array('class' => 'span-13'));?><br /><?php echo $form['name']->renderError();?></td>
    </tr>
	<tr>
    	<th>Intro</th>
        <td><?php echo $form['content_teaser']->render(array('class' => 'span-13'));?><br /><?php echo $form['content_teaser']->renderError();?></td>
    </tr>
	<tr>
    	<th>Continut</th>
        <td><?php echo $form['content_content']->render(array('class' => 'mceEditor'));?><br /><?php echo $form['content_content']->renderError();?></td>
    </tr>
	<tr>
    	<th>META Description</th>
        <td><?php echo $form['meta_description']->render(array('class' => 'span-13'));?><br /><?php echo $form['meta_description']->renderError();?></td>
    </tr>
	<tr>
    	<th>META Keywords</th>
        <td><?php echo $form['meta_keywords']->render(array('class' => 'span-13'));?><br /><?php echo $form['meta_keywords']->renderError();?></td>
    </tr>
	<tr>
    	<th>URL Key</th>
        <td><?php echo $form['url_key']->render(array('class' => 'span-13'));?><br /><?php echo $form['url_key']->renderError();?></td>
    </tr>
	<tr>
    	<th>Despre vedete</th>
        <td><?php echo $form['about_stars']->render();?><br /><?php echo $form['about_stars']->renderError();?></td>
    </tr>
	<tr>
    	<th>Categorii</th>
        <td><?php echo $form['category_list']->render();?><br /><?php echo $form['category_list']->renderError();?></td>
    </tr>
	<tr>
    	<th>Poza</th>
        <td><img src="<?php echo filmsiArticlePhotoThumb($form->getObject()->getFilename());?>" /><br /><?php echo $form['file']->render();?><br /><?php echo $form['file']->renderError();?></td>
    </tr>
	<tr>
    	<th>Publicat la</th>
        <td><?php echo $form['publish_date']->render();?><br /><?php echo $form['publish_date']->renderError();?></td>
    </tr>
	<tr>
    	<th>Expira la</th>
        <td><?php echo $form['expiration_date']->render();?><br /><?php echo $form['expiration_date']->renderError();?></td>
    </tr>
    <tr>
    	<th>Album Foto</th>
        <td><input type="text" id="photo-album-selector" value="<?php echo $form->getObject()->getPhotoAlbum()->getName();?>" class="span-13" /> </td>
    </tr>
    <tr>
    	<th>Album Video</th>
        <td><input type="text" id="video-album-selector" value="<?php echo $form->getObject()->getVideoAlbum()->getName();?>" class="span-13" /> </td>
    </tr>
</table>


<div class="clear"></div>

<div class="mt-2 mb-2 cell-separator-double"></div>

<h6>Legaturi persoane</h6>

<div class="mt-3">
<input type="text" id="person-add-field" /> 
</div>

<table id="person-list" class="mt-3 span-12">
	<?php foreach($form->getObject()->getPerson() as $person): ?>
    	<tr>
        	<td><?php echo $person->getName();?> <input type="hidden" name="person_list[<?php echo $person->getId();?>]" value="<?php echo $person->getId();?>" /></td>
            <td><a href="javascript:void(0)" class="small-link person-delete-button">sterge</a></td>
        </tr>
    <?php endforeach; ?>
</table>

<div class="mt-2 mb-2 cell-separator-double clear"></div>

<h6>Legaturi filme</h6>

<div class="mt-3">
<input type="text" id="film-add-field" /> 
</div>

<table id="film-list" class="mt-3 span-12">
	<?php foreach($form->getObject()->getFilm() as $film): ?>
    	<tr>
        	<td><?php echo $film->getName();?> <input type="hidden" name="film_list[<?php echo $film->getId();?>]" value="<?php echo $film->getId();?>" /></td>
            <td><a href="javascript:void(0)" class="small-link film-delete-button">sterge</a></td>
        </tr>
    <?php endforeach; ?>
</table>

<div class="mt-2 mb-2 cell-separator-double clear"></div>

<h6>Legaturi cinema</h6>

<div class="mt-3">
<input type="text" id="cinema-add-field" /> 
</div>

<table id="cinema-list" class="mt-3 span-12">
	<?php foreach($form->getObject()->getCinema() as $cinema): ?>
    	<tr>
        	<td><?php echo $cinema->getName();?> <input type="hidden" name="cinema_list[<?php echo $cinema->getId();?>]" value="<?php echo $cinema->getId();?>" /></td>
            <td><a href="javascript:void(0)" class="small-link cinema-delete-button">sterge</a></td>
        </tr>
    <?php endforeach; ?>
</table>

<div class="mt-2 mb-2 cell-separator-double clear"></div>

<h6>Legaturi festivaluri</h6>

<div class="mt-3">
<input type="text" id="festival-edition-add-field" /> 
</div>

<table id="festival-edition-list" class="mt-3 span-12">
	<?php foreach($form->getObject()->getFestivalEdition() as $festivalEdition): ?>
    	<tr>
        	<td><?php echo $festivalEdition->getName();?> <input type="hidden" name="festival_edition_list[<?php echo $festivalEdition->getId();?>]" value="<?php echo $festivalEdition->getId();?>" /></td>
            <td><a href="javascript:void(0)" class="small-link festival-edition-delete-button">sterge</a></td>
        </tr>
    <?php endforeach; ?>
</table>

<div class="mt-2 mb-2 cell-separator-double clear"></div>

<div class="mt-3">
    <button type="submit" class="mr-2">Salveaza</button>
    <a href="<?php echo $sf_request->getReferer();?>">Anuleaza</a>
</div>

</form>

<script type="text/javascript">
	$(document).ready(function(){
		$('#article_publish_date').datepicker({dateFormat: 'yy-mm-dd'});
		$('#article_expiration_date').datepicker({dateFormat: 'yy-mm-dd'});
		
		/////////////////////////////////
		// PERSON FUNCTIONALITY
		
		$('.person-delete-button').click(function(){
			$(this).parent().parent().remove();
		});
		
		/* Field autocomplete functionality */
		$("#person-add-field").autocomplete({
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
			  $('#person-list').append('<tr>' +
			  '<td>' + ui.item.label + '<input type="hidden" name="person_list[' + ui.item.value + ']" value="' + ui.item.value + '" /></td>' +
			  '<td id="person-delete-container-' + ui.item.value + '"></td></tr>');
			  
			  $('#person-delete-container-' + ui.item.value)
				.append(
					$(document.createElement('a'))
						.attr('href', 'javascript: void(0)')
						.attr('class', 'small-link')
						.text('sterge')
						.click(function(){
							$(this).parent().parent().remove();	
						})
				);
				
				return false;
		  },
		  close: function(event, ui){
			  $("#person-add-field").attr('value', '');  
		  },
	      minLength: 2
	    });
		
		
		
		
		
		
		
		
		/////////////////////////////////
		// FILM FUNCTIONALITY
		
		$('.film-delete-button').click(function(){
			$(this).parent().parent().remove();
		});
		
		/* Field autocomplete functionality */
		$("#film-add-field").autocomplete({
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
			  $('#film-list').append('<tr>' +
			  '<td>' + ui.item.label + '<input type="hidden" name="film_list[' + ui.item.value + ']" value="' + ui.item.value + '" /></td>' +
			  '<td id="film-delete-container-' + ui.item.value + '"></td></tr>');
			  
			  $('#film-delete-container-' + ui.item.value)
				.append(
					$(document.createElement('a'))
						.attr('href', 'javascript: void(0)')
						.attr('class', 'small-link')
						.text('sterge')
						.click(function(){
							$(this).parent().parent().remove();	
						})
				);
				
				return false;
		  },
		  close: function(event, ui){
			  $("#film-add-field").attr('value', '');  
		  },
	      minLength: 2
	    });
		
		
		
		
		
		
		/////////////////////////////////
		// CINEMA FUNCTIONALITY
		
		$('.cinema-delete-button').click(function(){
			$(this).parent().parent().remove();
		});
		
		/* Field autocomplete functionality */
		$("#cinema-add-field").autocomplete({
	      source: function(request, response) {
	        $.ajax({
	          url: "<?php echo url_for('@default?module=cinemas&action=api')?>",
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
			  $('#cinema-list').append('<tr>' +
			  '<td>' + ui.item.label + '<input type="hidden" name="cinema_list[' + ui.item.value + ']" value="' + ui.item.value + '" /></td>' +
			  '<td id="cinema-delete-container-' + ui.item.value + '"></td></tr>');
			  
			  $('#cinema-delete-container-' + ui.item.value)
				.append(
					$(document.createElement('a'))
						.attr('href', 'javascript: void(0)')
						.attr('class', 'small-link')
						.text('sterge')
						.click(function(){
							$(this).parent().parent().remove();	
						})
				);
				
				return false;
		  },
		  close: function(event, ui){
			  $("#cinema-add-field").attr('value', '');  
		  },
	      minLength: 2
	    });
		
		
		
		
		
		
		/////////////////////////////////
		// FESTIVAL EDITION FUNCTIONALITY
		
		$('.festival-edition-delete-button').click(function(){
			$(this).parent().parent().remove();
		});
		
		/* Field autocomplete functionality */
		$("#festival-edition-add-field").autocomplete({
	      source: function(request, response) {
	        $.ajax({
	          url: "<?php echo url_for('@default?module=festivalEditions&action=api')?>",
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
			  $('#festival-edition-list').append('<tr>' +
			  '<td>' + ui.item.label + '<input type="hidden" name="festival_edition_list[' + ui.item.value + ']" value="' + ui.item.value + '" /></td>' +
			  '<td id="festival-edition-delete-container-' + ui.item.value + '"></td></tr>');
			  
			  $('#festival-edition-delete-container-' + ui.item.value)
				.append(
					$(document.createElement('a'))
						.attr('href', 'javascript: void(0)')
						.attr('class', 'small-link')
						.text('sterge')
						.click(function(){
							$(this).parent().parent().remove();	
						})
				);
				
				return false;
		  },
		  close: function(event, ui){
			  $("#festival-edition-add-field").attr('value', '');  
		  },
	      minLength: 2
	    });
		
		
		
		
		
		
		
		/* Photo album selector functionality */
		$("#photo-album-selector").autocomplete({
	      source: function(request, response) {
	        $.ajax({
	          url: "<?php echo url_for('@default?module=photos&action=api')?>",
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
			  $('#article_photo_album_id').val(ui.item.value);
			  $('#photo-album-selector').val(ui.item.label);
			  return false;
		  },
	      minLength: 2
	    });
		
		/* Video album selector functionality */
		$("#video-album-selector").autocomplete({
	      source: function(request, response) {
	        $.ajax({
	          url: "<?php echo url_for('@default?module=videos&action=api')?>",
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
			  $('#article_video_album_id').val(ui.item.value);
			  $('#video-album-selector').val(ui.item.label);
			  return false;
		  },
	      minLength: 2
	    });
	});
</script>























<?php include_partial('default/wysiwygEditor', array('width' => 600, 'height' => 400));?>