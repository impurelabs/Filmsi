<h4>Library: Album foto "<?php echo $album->getName();?>"</h4>
<div class="mb-3">
<button type="button" onclick="location.href='<?php echo url_for('@default?module=photos&action=photoAdd');?>?aid=<?php echo $album->getId();?>'">Adauga poze</button>
<button type="button" onclick="location.href='<?php echo url_for('@default?module=photos&action=editAlbum');?>?aid=<?php echo $album->getId();?>'">Editeaza detalii album</button>
<?php if($sf_user->hasCredential('Moderator') && $album->getState() == Library::STATE_PENDING): ?>
Acest obiect este Pending! <button type="button" onclick="location.href='<?php echo url_for('@default?module=default&action=allow');?>?lid=<?php echo $album->getLibraryId();?>'">Aproba</button>
<?php endif; ?>
</div>





<div class="span-16 mt-3">
<form method="get" id="list-form">
Cu cele selectate:
<button type="button" id="delete-selected">Sterge</button>
<button type="button" id="home-true-selected">Homepage DA</button>
<button type="button" id="home-false-selected">Homepage Nu</button>
<button type="button" id="redcarpet-true-selected">Premiera DA</button>
<button type="button" id="redcarpet-false-selected">Premiera NU</button>

<br /><br /><br />

<table>
	<tr>
    	<td><input type="checkbox" id="select-all" /></td>
		<td></td>
		<td></td>
		<td>Homepage</td>
		<td>De la<br />premiera</td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	<?php foreach ($photos as $photo): ?>
	<tr>
		<td><input type="checkbox" name="selected_objects[]" class="selected-object" value="<?php echo $photo->getId();?>" /></td>
    	<td><a href="<?php echo filmsiPhoto($photo->getFilename());?>" target="_blank"><img src="<?php echo filmsiPhotoThumb($photo->getFilename());?>" /></a></td>
        <td><?php echo $photo->getDescription();?>
		<td><?php if($photo->getOnHome()) echo 'DA';?></td>
		<td><?php if($photo->getIsRedcarpet()) echo 'DA';?></td>
        <td><img src="<?php echo image_path('state-' . $photo->getState() . '.png');?>" /></td>
        <td><a href="<?php echo url_for('@default?module=photos&action=editPhoto');?>?pid=<?php echo $photo->getId();?>" class="small-link">editeaza</a></td>
        <td><a href="<?php echo url_for('@default?module=photos&action=moveUp');?>?pid=<?php echo $photo->getId();?>" class="small-link">mai sus</a></td>
        <td><a href="<?php echo url_for('@default?module=photos&action=moveDown');?>?pid=<?php echo $photo->getId();?>" class="small-link">mai jos</a></td>
    </tr>
    <?php endforeach ?>
</table>
</form>
</div>

<div class="clear"></div>


<script type="text/javascript">
$(document).ready(function(){

	$('#select-all').click(function(){
		if ($('#select-all').is(':checked')){
			$('.selected-object').attr('checked', 'checked');
		} else {
			$('.selected-object').removeAttr('checked', 'checked');
		}
	});
	
	$('#delete-selected').click(function(){
		if (confirm('Esti sigur ca vrei sa stergi pozele selectate?')){
			$('#list-form').attr('action', '<?php echo url_for('@default?module=photos&action=deletePhotos');?>');
			$('#list-form').submit();
		}
	});

	$('#home-true-selected').click(function(){
		if (confirm('Esti sigur ca vrei sa apara pe homepage pozele selectate?')){
			$('#list-form').attr('action', '<?php echo url_for('@default?module=photos&action=makePhotosOnHomeTrue');?>');
			$('#list-form').submit();
		}
	});

	$('#home-false-selected').click(function(){
		if (confirm('Esti sigur ca vrei sa NU apara pe homepage pozele selectate?')){
			$('#list-form').attr('action', '<?php echo url_for('@default?module=photos&action=makePhotosOnHomeFalse');?>');
			$('#list-form').submit();
		}
	});

	$('#redcarpet-true-selected').click(function(){
		if (confirm('Esti sigur ca vrei sa apara la premiera pozele selectate?')){
			$('#list-form').attr('action', '<?php echo url_for('@default?module=photos&action=makePhotosIsRedcarpetTrue');?>');
			$('#list-form').submit();
		}
	});

	$('#redcarpet-false-selected').click(function(){
		if (confirm('Esti sigur ca vrei sa NU apara la premiera pozele selectate?')){
			$('#list-form').attr('action', '<?php echo url_for('@default?module=photos&action=makePhotosIsRedcarpetFalse');?>');
			$('#list-form').submit();
		}
	});
});
</script>