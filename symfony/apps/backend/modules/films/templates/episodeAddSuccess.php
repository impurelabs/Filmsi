<h4 class="mb-2"><?php echo $film->getNameRo();?> <?php if ($film->getNameEn() != '') echo '(' . $film->getNameEn() . ')';?></h4>


 <a href="<?php echo url_for('@default?module=films&action=view');?>?lid=<?php echo $film->getLibraryId();?>">Detalii</a>
 | <a href="<?php echo url_for('@default?module=films&action=status');?>?lid=<?php echo $film->getLibraryId();?>">Status</a>
 | <a href="<?php echo url_for('@default?module=films&action=person');?>?lid=<?php echo $film->getLibraryId();?>">Persoane</a>
<?php if ($film->getIsSeries()):?>
 | <a href="<?php echo url_for('@default?module=films&action=episode');?>?lid=<?php echo $film->getLibraryId();?>" class="selected">Episoade</a>
<?php endif; ?>
<?php if ($sf_user->hasCredential('Promovare')):?>
 | <a href="<?php echo url_for('@default?module=films&action=background');?>?lid=<?php echo $film->getLibraryId();?>">Background</a>
 <?php endif;?>
<?php if($sf_user->hasCredential('Moderator') && $film->getState() == Library::STATE_PENDING): ?>
 | Acest obiect este Pending! <button type="button" onclick="location.href='<?php echo url_for('@default?module=default&action=allow');?>?lid=<?php echo $film->getLibraryId();?>'">Aproba</button>
<?php endif; ?>

<div class="mt-2 mb-2 cell-separator-double"></div>


<h5 class="mb-3">Adauga episod</h5>

<form action="<?php echo url_for('@default?module=films&action=episodeAdd');?>?id=<?php echo $film->getId();?>" method="post">
	<?php echo $form->renderHiddenFields();?>
	<?php echo $form->renderGlobalErrors();?>

	<strong>Cod IMDB</strong><br />
	<?php echo $form['imdb']->render(array('style' => 'width: 500px'));?><br />
	<?php echo $form['imdb']->renderError();?><br /><br />

	<strong>Nume</strong><br />
	<?php echo $form['name']->render(array('style' => 'width: 500px'));?><br />
	<?php echo $form['name']->renderError();?><br /><br />

	<strong>Sezon</strong><br />
	<?php echo $form['season']->render(array('style' => 'width: 500px'));?><br />
	<?php echo $form['season']->renderError();?><br /><br />

	<strong>Numar episod</strong><br />
	<?php echo $form['number']->render(array('style' => 'width: 500px'));?><br />
	<?php echo $form['number']->renderError();?><br /><br />

	<button type="submit">Salveaza</button>
	<a href="<?php echo url_for('@default?module=films&action=episode');?>?lid=<?php echo $film->getLibraryId();?>">Anuleaza</a>

</form>

<div class="clear"></div>