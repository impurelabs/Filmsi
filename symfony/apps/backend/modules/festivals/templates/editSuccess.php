<?php slot('subMenu')?>
	<?php include_partial('cms/subMenu');?>
<?php end_slot();?>

<h4 class="mb-3">Editeaza festival</h4>

<form action="<?php echo url_for('@default?module=festivals&action=edit');?>?id=<?php echo $form->getObject()->getId();?>" method="post">

	<?php echo $form->renderHiddenFields();?>
    <?php echo $form->renderGlobalErrors();?>
    
    Nume:<br />
    <?php echo $form['name']->render(array('style' => 'width: 400px'));?><br />
    <?php echo $form['name']->renderError();?>
    <br /><br />

    IMDB Key:<br />
    <?php echo $form['imdb_key']->render(array('style' => 'width: 400px'));?><br />
    <?php echo $form['imdb_key']->renderError();?>
    <br /><br />
    
    <button type="submit" class="mr-2">Salveaza</button> <a href="<?php echo url_for('@default_index?module=festivals');?>">Anuleaza</a>

</form>