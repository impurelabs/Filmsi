<h4 class="mb-3">Editeaza Persoana</h4>

<div class="clear"></div>

<form action="<?php echo url_for('@default?module=persons&action=edit');?>?lid=<?php echo $form->getObject()->getLibraryId();?>" method="post" enctype="multipart/form-data">

<?php echo $form->renderHiddenFields();?>
<?php echo $form->renderGlobalErrors();?>

<table class="span-19">
	<tr>
    	<th>Cod IMDB</th>
        <td><?php echo $form['imdb']->render(array('class' => 'span-13'));?><br /><?php echo $form['imdb']->renderError();?></td>
    </tr>
	<tr>
    	<th>Prenume</th>
        <td><?php echo $form['first_name']->render(array('class' => 'span-13'));?><br /><?php echo $form['first_name']->renderError();?></td>
    </tr>
	<tr>
    	<th>Nume</th>
        <td><?php echo $form['last_name']->render(array('class' => 'span-13'));?><br /><?php echo $form['last_name']->renderError();?></td>
    </tr>
	<tr>
    	<th>Data nasterii</th>
        <td><?php echo $form['date_of_birth']->render(array('class' => 'span-13'));?><br /><?php echo $form['date_of_birth']->renderError();?></td>
    </tr>
	<tr>
    	<th>Data mortii</th>
        <td><?php echo $form['date_of_death']->render(array('class' => 'span-13'));?><br /><?php echo $form['date_of_death']->renderError();?></td>
    </tr>
	<tr>
    	<th>Locul nasterii</th>
        <td><?php echo $form['place_of_birth']->render(array('class' => 'span-13'));?><br /><?php echo $form['place_of_birth']->renderError();?></td>
    </tr>
	<tr>
    	<th>Intro biografie</th>
        <td><?php echo $form['biography_teaser']->render(array('class' => 'span-13'));?><br /><?php echo $form['biography_teaser']->renderError();?></td>
    </tr>
	<tr>
    	<th>Biografie</th>
        <td><?php echo $form['biography_content']->render(array('class' => 'mceEditor'));?><br /><?php echo $form['biography_content']->renderError();?></td>
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
    	<th>Actor</th>
        <td><?php echo $form['is_actor']->render();?><br /><?php echo $form['is_actor']->renderError();?></td>
    </tr>
	<tr>
    	<th>Regizor</th>
        <td><?php echo $form['is_director']->render();?><br /><?php echo $form['is_director']->renderError();?></td>
    </tr>
	<tr>
    	<th>Scenarist</th>
        <td><?php echo $form['is_scriptwriter']->render();?><br /><?php echo $form['is_scriptwriter']->renderError();?></td>
    </tr>
	<tr>
    	<th>Producator</th>
        <td><?php echo $form['is_producer']->render();?><br /><?php echo $form['is_producer']->renderError();?></td>
    </tr>
	<tr>
    	<th>Poza</th>
        <td><img src="<?php echo filmsiPersonPhotoThumb($form->getObject()->getFilename());?>" /><br /><?php echo $form['filename']->render();?><br /><?php echo $form['filename']->renderError();?></td>
    </tr>
	<tr>
    	<th>Publicat la</th>
        <td><?php echo $form['publish_date']->render();?><br /><?php echo $form['publish_date']->renderError();?></td>
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

<div class="mt-3">
    <button type="submit" class="mr-2">Salveaza</button>
    <a href="<?php echo url_for('@default?module=persons&action=view');?>?lid=<?php echo $form->getObject()->getLibraryId();?>">Anuleaza</a>
</div>

</form>

<script type="text/javascript">
	$(document).ready(function(){
		$('#person_date_of_birth').datepicker({dateFormat: 'yy-mm-dd'});
		$('#person_date_of_death').datepicker({dateFormat: 'yy-mm-dd'});
		$('#person_publish_date').datepicker({dateFormat: 'yy-mm-dd'});
		
		
		
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
			  $('#person_photo_album_id').val(ui.item.value);
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
			  $('#person_video_album_id').val(ui.item.value);
			  $('#video-album-selector').val(ui.item.label);
			  return false;
		  },
	      minLength: 2
	    });
	});
</script>

<?php include_partial('default/wysiwygEditor', array('width' => 600, 'height' => 400));?>