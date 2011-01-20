<?php slot('subMenu')?>
	<?php include_partial('cms/subMenu');?>
<?php end_slot();?>

<h4 class="mb-3">Adauga o categorie noua</h4>

<form action="<?php echo url_for('@default?module=categories&action=new');?>" method="post">

	<?php echo $form->renderHiddenFields();?>
    <?php echo $form->renderGlobalErrors();?>
    
    Nume:<br />
    <?php echo $form['name']->render();?><br />
    <?php echo $form['name']->renderError();?>
    <br /><br />
    
    <button type="submit" class="mr-2">Salveaza</button> <a href="<?php echo url_for('@default_index?module=categories');?>">Anuleaza</a>

</form>