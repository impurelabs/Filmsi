<h4 class="mb-2"><?php echo $film->getNameRo();?> <?php if ($film->getNameEn() != '') echo '(' . $film->getNameEn() . ')';?></h4>


 <a href="<?php echo url_for('@default?module=films&action=view');?>?lid=<?php echo $film->getLibraryId();?>">Detalii</a>
 | <a href="<?php echo url_for('@default?module=films&action=status');?>?lid=<?php echo $film->getLibraryId();?>">Status</a>
 | <a href="<?php echo url_for('@default?module=films&action=person');?>?lid=<?php echo $film->getLibraryId();?>" class="selected">Persoane</a>
<?php if ($film->getIsSeries()):?>
 | <a href="<?php echo url_for('@default?module=films&action=episode');?>?lid=<?php echo $film->getLibraryId();?>">Episoade</a>
<?php endif; ?>
<?php if ($sf_user->hasCredential('Promovare')):?>
 | <a href="<?php echo url_for('@default?module=films&action=background');?>?lid=<?php echo $film->getLibraryId();?>">Background</a>
 <?php endif;?>
<?php if($sf_user->hasCredential('Moderator') && $film->getState() == Library::STATE_PENDING): ?>
 | Acest obiect este Pending! <button type="button" onclick="location.href='<?php echo url_for('@default?module=default&action=allow');?>?lid=<?php echo $film->getLibraryId();?>'">Aproba</button>
<?php endif; ?>

<div class="mt-2 mb-2 cell-separator-double"></div>


<h5>Editeaza persoana "<?php echo $person->getName();?>"</h5>
<div class="mb-3"></div>

<form action="<?php echo url_for('@default?module=films&action=personEdit');?>?fid=<?php echo $film->getId();?>&pid=<?php echo $person->getId();?>" method="post">
	<input type="checkbox" value="1" name="is_actor"<?php if($filmPerson->getIsActor() == '1') echo 'checked="checked"';?> /> actor
	<input type="checkbox" value="1" name="is_director"<?php if($filmPerson->getIsDirector() == '1') echo 'checked="checked"';?> class="ml-3" /> regizor
	<input type="checkbox" value="1" name="is_scriptwriter"<?php if($filmPerson->getIsScriptwriter() == '1') echo 'checked="checked"';?> class="ml-3" /> scenarist
	<input type="checkbox" value="1" name="is_producer"<?php if($filmPerson->getIsProducer() == '1') echo 'checked="checked"';?> class="ml-3" /> producator

	<br /><br />
	<button type="submit">Salveaza</button>
	<a href="<?php echo url_for('@default?module=films&action=person');?>?lid=<?php echo $film->getLibraryId();?>">Anuleaza</a>
</form>