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


<h5>Persoane</h5>
<div class="mb-3">
<button type="button" onclick="location.href='<?php echo url_for('@default?module=films&action=personAdd');?>?id=<?php echo $film->getId();?>'">Adauga persoana</button>
</div>

<table id="person-list" class="span-12">
	<?php foreach($persons as $person): ?>
    	<tr>
        	<td><?php echo $person->getPerson()->getName();?></td>
        	<td><?php if ($person->getIsActor()):?> actor <?php endif;?></td>
        	<td><?php if ($person->getIsDirector()):?> regizor <?php endif;?></td>
        	<td><?php if ($person->getIsScriptwriter()):?> scenarist <?php endif;?></td>
        	<td><?php if ($person->getIsProducer()):?> producator <?php endif;?></td>
			<td><a href="<?php echo url_for('@default?module=films&action=personEdit');?>?fid=<?php echo $person->getFilmId();?>&pid=<?php echo $person->getPersonId();?>" class="small-link">editeaza</a></td>
			<td><?php echo link_to('sterge', 'films/personDelete', array('confirm' => 'Esti sigur ca vrei sa stergi persoana?', 'query_string' => 'fid='.$person->getFilmId() . '&pid=' . $person->getPersonId(), 'post' => true, 'class' => 'small-link'));?></td>
        </tr>
    <?php endforeach; ?>
</table>

<div class="clear"></div>
