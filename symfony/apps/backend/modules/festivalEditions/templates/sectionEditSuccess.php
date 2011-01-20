<h4 class="mb-2"><?php echo $festivalEdition->getFestival()->getName();?> - <?php echo $festivalEdition->getEdition();?></h4>


<a href="<?php echo url_for('@default?module=festivalEditions&action=view');?>?lid=<?php echo $festivalEdition->getLibraryId();?>">Detalii</a>
 | <a href="<?php echo url_for('@default?module=festivalEditions&action=section');?>?lid=<?php echo $festivalEdition->getLibraryId();?>" class="selected">Sectiuni</a>
<?php if($sf_user->hasCredential('Moderator') && $festivalEdition->getState() == Library::STATE_PENDING): ?>
 | Acest obiect este Pending!  <button type="button" onclick="location.href='<?php echo url_for('@default?module=default&action=allow');?>?lid=<?php echo $festivalEdition->getLibraryId();?>'">Aproba</button>
<?php endif; ?>

<div class="mt-2 mb-2 cell-separator-double"></div>


<h5 class="mb-3">Editeaza sectiunea "<?php echo $form->getObject()->getName();?>"</h5>

<form action="<?php echo url_for('@default?module=festivalEditions&action=sectionEdit');?>?id=<?php echo $festivalSection->getId();?>" method="post">

	<?php echo $form->renderHiddenFields();?>
    <?php echo $form->renderGlobalErrors();?>
    
    Nume:<br />
    <?php echo $form['name']->render(array('style' => 'width:500px'));?><br />
    <?php echo $form['name']->renderError();?>
    <br /><br />

	IMDB Key:<br />
    <?php echo $form['imdb_key']->render(array('style' => 'width:500px'));?><br />
    <?php echo $form['imdb_key']->renderError();?>
    <br /><br />
    
    <button type="submit" class="mr-2">Salveaza</button> 
    <a href="<?php echo url_for('@default?module=festivalEditions&action=section');?>?lid=<?php echo $festivalSection->getFestivalEdition()->getLibraryId();?>">Anuleaza</a>
    

</form>