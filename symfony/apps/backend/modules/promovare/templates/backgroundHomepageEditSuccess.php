<?php slot('subMenu')?>
	<?php include_partial('promovare/subMenu');?>
<?php end_slot();?>

<h4 class="mb-2">Background Homepage</h4>


<h5 class="mb-3">Editeaza Background</h5>

<form action="<?php echo url_for('@default?module=promovare&action=backgroundHomepageEdit');?>"
	  method="post"
	  enctype="multipart/form-data">

<?php echo $form->renderHiddenFields();?>
<?php echo $form->renderGlobalErrors();?>


<?php echo $form['background_filename']->render();?><br />
<?php echo $form['background_filename']->renderError();?>


<div class="mt-3">
    <button type="submit" class="mr-2">Salveaza</button>
    <a href="<?php echo url_for('@default?module=promovare&action=backgroundHomepage');?>">Anuleaza</a>
</div>

</form>
