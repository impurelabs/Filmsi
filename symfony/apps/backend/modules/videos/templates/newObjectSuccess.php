<?php slot('subMenu')?>
	<?php include_partial('default/newObjectSubMenu');?>
<?php end_slot();?>

<h4 class="mb-3">Creeaza Album Video nou</h4>

<form action="<?php echo url_for('@default?module=videos&action=newObject');?>" method="post">
	<?php echo $form->renderHiddenFields()?> 
	<?php echo $form->renderGlobalErrors()?>

	Nume <br />
    <?php echo $form['name']->render(array('class' => 'span-11'))?> <br />
	<?php echo $form['name']->renderError()?> <br /><br />
    
    Data publicarii <br />
    <?php echo $form['publish_date']->render(array('class' => 'span-11'))?> <br />
	<?php echo $form['publish_date']->renderError()?>

<div class="mt-3">
    <button type="submit" class="mr-2">Creeaza</button>
    <a href="<?php echo $sf_request->getReferer();?>">Anuleaza</a>
</div>

</form>

<script type="text/javascript">
	$(document).ready(function(){
		$('#video_album_publish_date').datepicker({dateFormat: 'yy-mm-dd'});
	});
</script>