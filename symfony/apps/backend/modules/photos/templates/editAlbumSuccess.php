<h4 class="mb-3">Library: Editeaza numele albumului foto "<?php echo $album->getName();?>"</h4>

<form action="<?php echo url_for('@default?module=photos&action=editAlbum')?>?aid=<?php echo $album->getId();?>" method="post">

<?php echo $form->renderHiddenFields()?>
<?php echo $form->renderGlobalErrors();?>

<div class="mt-2"></div>

Nume<br />
<?php echo $form['name']->render(array('class' => 'span-10'))?>
<?php echo $form['name']->renderError()?>

<br /><br />

Publicat la<br />
<?php echo $form['publish_date']->render(array('class' => 'span-10'))?>
<?php echo $form['publish_date']->renderError()?>


<div class="mt-3" id="photo-description-button-container">
<button type="submit" class="mr-2">Salveaza</button>
<a href="<?php echo url_for('@default?module=photos&action=view');?>?lid=<?php echo $album->getLibraryId();?>">Anuleaza</a></div>
<!-- photo-description-button-container end --></form>

<script type="text/javascript">
$(document).ready(function(){
	$('#photo_album_publish_date').datepicker({dateFormat: 'yy-mm-dd'});
});
</script>