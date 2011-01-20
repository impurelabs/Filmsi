<h4 class="mb-3">Adauga o noua promotie pentru cinematograful "<?php echo $cinema->getName();?>"</h4>

<form action="<?php echo url_for('@default?module=cinemas&action=addPromotion');?>?id=<?php echo $cinema->getId();?>" method="post" enctype="multipart/form-data">

	<?php echo $form->renderHiddenFields();?>
    <?php echo $form->renderGlobalErrors();?>
    
    Nume:<br />
    <?php echo $form['name']->render();?><br />
    <?php echo $form['name']->renderError();?>
    <br /><br />
    
    Poza:<br />
    <?php echo $form['file']->render();?><br />
    <?php echo $form['file']->renderError();?>
    <br /><br />
    
    Descriere:<br />
    <?php echo $form['content']->render(array('class' => 'mceEditor'));?><br />
	<?php echo $form['content']->renderError();?>
    <br /><br />
    
    
    <button type="submit" class="mr-2">Salveaza</button> <a href="<?php echo url_for('@default?module=cinemas&action=view');?>?lid=<?php echo $cinema->getLibraryId();?>">Anuleaza</a>

</form>


<?php include_partial('default/wysiwygEditor', array('width' => 600, 'height' => 400));?>