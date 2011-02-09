<h4 class="mb-2"><?php echo $festivalEdition->getFestival()->getName();?> - <?php echo $festivalEdition->getEdition();?></h4>


<a href="<?php echo url_for('@default?module=festivalEditions&action=view');?>?lid=<?php echo $festivalEdition->getLibraryId();?>">Detalii</a>
 | <a href="<?php echo url_for('@default?module=festivalEditions&action=section');?>?lid=<?php echo $festivalEdition->getLibraryId();?>" class="selected">Sectiuni</a>
 | <a href="<?php echo url_for('@default?module=festivalEditions&action=judges');?>?lid=<?php echo $festivalEdition->getLibraryId();?>">Juriu</a>
<?php if($sf_user->hasCredential('Moderator') && $festivalEdition->getState() == Library::STATE_PENDING): ?>
 | Acest obiect este Pending!  <button type="button" onclick="location.href='<?php echo url_for('@default?module=default&action=allow');?>?lid=<?php echo $festivalEdition->getLibraryId();?>'">Aproba</button>
<?php endif; ?>

<div class="mt-2 mb-2 cell-separator-double"></div>

<h5 class="mb-3">Adauga o noua sectiune</h5>

<form action="<?php echo url_for('@default?module=festivalEditions&action=sectionAdd');?>?id=<?php echo $festivalEdition->getId();?>" method="post">

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
	<a href="<?php echo url_for('@default?module=festivalEditions&action=section');?>?lid=<?php echo $festivalEdition->getLibraryId();?>">Anuleaza</a>

</form>
