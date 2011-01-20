<?php slot('subMenu')?>
	<?php include_partial('default/newObjectSubMenu');?>
<?php end_slot();?>

<h4 class="mb-3">Creeaza Editie Noua de Festival</h4>

<form id="the-form" action="<?php echo url_for('@default?module=festivalEditions&action=newObject');?>" method="post" enctype="multipart/form-data">

<?php echo $form->renderHiddenFields();?>
<?php echo $form->renderGlobalErrors();?>

<table class="span-19">
	<tr>
    	<th>Festival</th>
        <td><?php echo $form['festival_id']->render(array('class' => 'span-13'));?><br /><?php echo $form['festival_id']->renderError();?></td>
    </tr>
	<tr>
    	<th>Editie</th>
        <td><?php echo $form['edition']->render(array('class' => 'span-13'));?><br /><?php echo $form['edition']->renderError();?></td>
    </tr>
	<tr>
    	<th>Descriere - intro</th>
        <td><?php echo $form['description_teaser']->render(array('class' => 'span-13'));?><br /><?php echo $form['description_teaser']->renderError();?></td>
    </tr>
	<tr>
    	<th>Descriere - continut</th>
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
        <td><?php echo $form['file']->render();?><br /><?php echo $form['file']->renderError();?></td>
    </tr>
	<tr>
    	<th>Publicat la</th>
        <td><?php echo $form['publish_date']->render();?><br /><?php echo $form['publish_date']->renderError();?></td>
    </tr>
    <tr>
    	<th>Album Foto</th>
        <td><input type="text" id="photo-album-selector" class="span-13" /> </td>
    </tr>
    <tr>
    	<th>Album Video</th>
        <td><input type="text" id="video-album-selector" class="span-13" /> </td>
    </tr>
</table>

<div class="clear"></div>

<div class="mt-3">
    <button type="button" onclick="$('#the-form').submit()"class="mr-2">Creeaza</button>
    <a href="<?php echo url_for('@default?module=festivalEditions&action=view');?>?lid=<?php echo $form->getObject()->getLibraryId();?>">Anuleaza</a>
</div>

</form>

<script type="text/javascript">
	$(document).ready(function(){
		$('#festival_edition_publish_date').datepicker({dateFormat: 'yy-mm-dd'});
		
		
		
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
			  $('#festival_edition_photo_album_id').val(ui.item.value);
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
			  $('#festival_edition_video_album_id').val(ui.item.value);
			  $('#video-album-selector').val(ui.item.label);
			  return false;
		  },
	      minLength: 2
	    });
	});
</script>
		

<?php include_partial('default/wysiwygEditor', array('width' => 600, 'height' => 400));?>