<h4 class="mb-2"><?php echo $form->getObject()->getNameRo();?> <?php if ($form->getObject()->getNameEn() != '') echo '(' . $form->getObject()->getNameEn() . ')';?></h4>


<a href="<?php echo url_for('@default?module=films&action=view');?>?lid=<?php echo $form->getObject()->getLibraryId();?>" class="selected">Detalii</a>
 | <a href="<?php echo url_for('@default?module=films&action=status');?>?lid=<?php echo $form->getObject()->getLibraryId();?>">Status</a>
 | <a href="<?php echo url_for('@default?module=films&action=person');?>?lid=<?php echo $form->getObject()->getLibraryId();?>">Persoane</a>
<?php if ($form->getObject()->getIsSeries()):?>
 | <a href="<?php echo url_for('@default?module=films&action=episode');?>?lid=<?php echo $form->getObject()->getLibraryId();?>">Episoade</a>
<?php endif; ?>
<?php if ($sf_user->hasCredential('Promovare')):?>
 | <a href="<?php echo url_for('@default?module=films&action=background');?>?lid=<?php echo $form->getObject()->getLibraryId();?>">Background</a>
 <?php endif;?>
<?php if($sf_user->hasCredential('Moderator') && $form->getObject()->getState() == Library::STATE_PENDING): ?>
 | Acest obiect este Pending! <button type="button" onclick="location.href='<?php echo url_for('@default?module=default&action=allow');?>?lid=<?php echo $form->getObject()->getLibraryId();?>'">Aproba</button>
<?php endif; ?>

<div class="mt-2 mb-2 cell-separator-double"></div>


<h5 class="mb-3">Editeaza Detalii Film</h5>
<form class="mb-3" method="post" action="<?php echo url_for('@default?module=films&action=importProvideoDetails');?>">
	<input type="hidden" name="id" value="<?php echo $form->getObject()->getId();?>" />
    <button type="submit">Importa detalii din Provideo - sinopsis, rating, nume romana(daca nu exista)</button>
</form>

<div class="clear"></div>

<form action="<?php echo url_for('@default?module=films&action=edit');?>?lid=<?php echo $form->getObject()->getLibraryId();?>" method="post" enctype="multipart/form-data">

<?php echo $form->renderHiddenFields();?>
<?php echo $form->renderGlobalErrors();?>

<table class="span-19">
	<tr>
    	<th>Cod IMDB</th>
        <td><?php echo $form['imdb']->render();?><br /><?php echo $form['imdb']->renderError();?></td>
    </tr>
	<tr>
    	<th>Este serial</th>
        <td><?php echo $form->getObject()->getIsSeries() == '1' ? 'Da' : 'Nu';?></td>
    </tr>
	<tr>
    	<th>Nume romana</th>
        <td><?php echo $form['name_ro']->render(array('class' => 'span-13'));?><br /><?php echo $form['name_ro']->renderError();?></td>
    </tr>
	<tr>
    	<th>Nume engleza</th>
        <td><?php echo $form['name_en']->render(array('class' => 'span-13'));?><br /><?php echo $form['name_en']->renderError();?></td>
    </tr>
	<tr>
    	<th>An</th>
        <td><?php echo $form['year']->render();?><br /><?php echo $form['year']->renderError();?></td>
    </tr>
	<tr>
    	<th>Rating</th>
        <td><?php echo $form['rating']->render();?><br /><?php echo $form['rating']->renderError();?></td>
    </tr>
	<tr>
    	<th>Gen</th>
        <td><?php echo $form['genres_list']->render();?><br /><?php echo $form['genres_list']->renderError();?></td>
    </tr>
	<tr>
    	<th>Durata</th>
        <td><?php echo $form['duration']->render();?><br /><?php echo $form['duration']->renderError();?></td>
    </tr>
    <tr>
    	<th>Format</th>
        <td><?php echo $form['is_type_film']->render();?> pelicula, <?php echo $form['is_type_digital']->render();?> digital, <?php echo $form['is_type_3d']->render();?> 3D <br />
			<?php echo $form['is_type_film']->renderError();?> <?php echo $form['is_type_digital']->renderError();?> <?php echo $form['is_type_3d']->renderError();?></td>
    </tr>
	<tr>
    	<th>Distribuitor</th>
        <td><?php echo $form['distribuitor']->render(array('class' => 'span-13'));?><br /><?php echo $form['distribuitor']->renderError();?></td>
    </tr>
	<tr>
    	<th>Sinopsis - intro</th>
        <td><?php echo $form['description_teaser']->render(array('class' => 'span-13'));?><br /><?php echo $form['description_teaser']->renderError();?></td>
    </tr>
	<tr>
    	<th>Sinopsis - continut</th>
        <td><?php echo $form['description_content']->render(array('class' => 'mceEditor'));?><br /><?php echo $form['description_content']->renderError();?></td>
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
    	<th>Poza</th>
        <td><img src="<?php echo filmsiFilmPhotoThumb($form->getObject()->getFilename());?>" /><br /><?php echo $form['filename']->render();?><br /><?php echo $form['filename']->renderError();?></td>
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
    <a href="<?php echo url_for('@default?module=films&action=view');?>?lid=<?php echo $form->getObject()->getLibraryId();?>">Anuleaza</a>
</div>

</form>

<script type="text/javascript">
	$(document).ready(function(){
		$('#film_publish_date').datepicker({dateFormat: 'yy-mm-dd'});
		
		
		
		
		
		
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
			  $('#film_photo_album_id').val(ui.item.value);
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
			  $('#film_video_album_id').val(ui.item.value);
			  $('#video-album-selector').val(ui.item.label);
			  return false;
		  },
	      minLength: 2
	    });
	});
</script>

<?php include_partial('default/wysiwygEditor', array('width' => 600, 'height' => 400));?>