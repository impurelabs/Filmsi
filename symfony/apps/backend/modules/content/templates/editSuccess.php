<h4 class="mb-3">Editeaza continut "<?php echo filmsiContentLocationName($content->getId());?>"</h4>

<form action="<?php echo url_for('@default?module=content&action=edit');?>?id=<?php echo $content->getId();?>" method="post">
	<?php echo $form->renderHiddenFields();?>
    <?php echo $form->renderGlobalErrors();?>
    
    <?php echo $form['content']->render(array('class' => 'mceEditor'));?><br /><?php echo $form['content']->renderError();?>


	<button type="submit">Salveaza</button> <a href="<?php echo url_for('@default?module=content&action=view');?>?id=<?php echo $content->getId();?>">Anuleaza</a>
</form>

<?php include_partial('default/wysiwygEditor', array('width' => filmsiContentLocationWidth($content->getId()), 'height' => 400));?>