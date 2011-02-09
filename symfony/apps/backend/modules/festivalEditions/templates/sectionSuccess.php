<h4 class="mb-2"><?php echo $festivalEdition->getFestival()->getName();?> - <?php echo $festivalEdition->getEdition();?></h4>


<a href="<?php echo url_for('@default?module=festivalEditions&action=view');?>?lid=<?php echo $festivalEdition->getLibraryId();?>">Detalii</a>
 | <a href="<?php echo url_for('@default?module=festivalEditions&action=section');?>?lid=<?php echo $festivalEdition->getLibraryId();?>" class="selected">Sectiuni</a>
 | <a href="<?php echo url_for('@default?module=festivalEditions&action=judges');?>?lid=<?php echo $festivalEdition->getLibraryId();?>">Juriu</a>
<?php if($sf_user->hasCredential('Moderator') && $festivalEdition->getState() == Library::STATE_PENDING): ?>
 | Acest obiect este Pending!  <button type="button" onclick="location.href='<?php echo url_for('@default?module=default&action=allow');?>?lid=<?php echo $festivalEdition->getLibraryId();?>'">Aproba</button>
<?php endif; ?>

<div class="mt-2 mb-2 cell-separator-double"></div>


<h5>Sectiuni</h5>
<div class="mb-3">
<button type="button" class="mr-2" onclick="location.href='<?php echo url_for('@default?module=festivalEditions&action=sectionAdd');?>?id=<?php echo $festivalEdition->getId();?>'">Adauga sectiune</button>
</div>
<div class="clear"></div>

<?php foreach($sections as $section):?>
<h6><?php echo $section->getName();?></h6>
<div class="mb-2">
	<button type="button" onclick="location.href='<?php echo url_for('@default?module=festivalEditions&action=sectionEdit');?>?id=<?php echo $section->getId();?>'">Editeaza sectiunea</button>
	<button type="button" onclick="location.href='<?php echo url_for('@default?module=festivalEditions&action=sectionDelete');?>?id=<?php echo $section->getId();?>'">Sterge sectiunea</button>
	<button type="button" onclick="location.href='<?php echo url_for('@default?module=festivalEditions&action=participantAdd');?>?id=<?php echo $section->getId();?>'">Adauga participant</button>
</div>


<table class="span-24">
	<?php foreach($section->getFestivalSectionParticipant() as $participant): ?>
	<tr>
		<td><?php echo $participant->getIsWinner() ? 'castigator' : 'nominalizat';?></td>
		<td><?php echo $participant->getFilmImdb();?> - <?php if ($participant->getFilm()) echo $participant->getFilm()->getName();?></td>
		<td><?php echo $participant->getPersonImdb();?> - <?php if ($participant->getPerson()) echo $participant->getPerson()->getName();?></td>
		<td><?php echo link_to('sterge', 'festivalEditions/participantDelete', array('confirm' => 'Esti sigur ca vrei sa stergi participantul?', 'query_string' => 'id='.$participant->getId(), 'post' => true, 'class' => 'small-link'));?></td>
	</tr>
	<?php endforeach;?>

</table>

<div class="clear mb-3"></div>
<?php endforeach;?>