<h4 class="mb-3">Editeaza video din albumul "<?php echo $video->getAlbum()->getName();?>"</h4>

<form action="<?php echo url_for('@default?module=videos&action=editVideo')?>?id=<?php echo $video->getId();?>" method="post">

<?php echo $form->renderHiddenFields()?>
<?php echo $form->renderGlobalErrors();?>

<div class="mt-2"></div>

<?php echo filmsiVideo($video->getCode());?>"<br /><br />
Nume<br />
<?php echo $form['name']->render(array('class' => 'span-10'))?>
<?php echo $form['name']->renderError()?>


<div class="mt-3" id="video-description-button-container">
<button type="submit" class="mr-2">Salveaza</button>
<a href="<?php echo url_for('@default?module=videos&action=view');?>?aid=<?php echo $video->getAlbum()->getId();?>">Anuleaza</a></div>
<!-- video-description-button-container end --></form>