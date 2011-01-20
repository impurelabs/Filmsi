<h4 class="mb-3">Editeaza poza din albumul "<?php echo $photo->getAlbum()->getName();?>"</h4>

<form action="<?php echo url_for('@default?module=photos&action=editPhoto')?>?pid=<?php echo $photo->getId();?>" method="post">

<?php echo $form->renderHiddenFields()?>
<?php echo $form->renderGlobalErrors();?>

<div class="mt-2"></div>

<img src="<?php echo filmsiPhotoThumb($photo->getFilename());?>" /><br /><br />
Nume<br />
<?php echo $form['description']->render(array('class' => 'span-10'))?>
<?php echo $form['description']->renderError()?>


<div class="mt-3" id="photo-description-button-container">
<button type="submit" class="mr-2">Salveaza</button>
<a href="<?php echo url_for('@default?module=photos&action=view');?>?lid=<?php echo $photo->getAlbum()->getLibraryId();?>">Anuleaza</a></div>
<!-- photo-description-button-container end --></form>