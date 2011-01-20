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


<h5>Episoade</h5>
<div class="mb-3">
<button type="button" onclick="location.href='<?php echo url_for('@default?module=films&action=episodeAdd');?>?id=<?php echo $film->getId();?>'">Adauga episod</button>
</div>

<table class="span-15">
	<tr>
		<th>IMDB</th>
		<th>Sezon</th>
		<th>Nr</th>
		<th>Nume</th>
		<th></th>
		<th></th>
	</tr>
	<?php foreach($episodes as $episode): ?>
    	<tr>
        	<td><?php echo $episode->getImdb();?></td>
        	<td><?php echo $episode->getSeason();?></td>
        	<td><?php echo $episode->getNumber();?></td>
        	<td><?php echo $episode->getName();?></td>
			<td><a href="<?php echo url_for('@default?module=films&action=episodeEdit');?>?id=<?php echo $episode->getId();?>" class="small-link">editeaza</a></td>
			<td><?php echo link_to('sterge', 'films/episodeDelete', array('confirm' => 'Esti sigur ca vrei sa stergi episodul?', 'query_string' => 'id='.$episode->getId(), 'post' => true, 'class' => 'small-link'));?></td>
        </tr>
    <?php endforeach; ?>
</table>

<div class="clear"></div>