<h4 class="mb-2"><?php echo $festivalEdition->getFestival()->getName();?> - <?php echo $festivalEdition->getEdition();?></h4>


<a href="<?php echo url_for('@default?module=festivalEditions&action=view');?>?lid=<?php echo $festivalEdition->getLibraryId();?>">Detalii</a>
 | <a href="<?php echo url_for('@default?module=festivalEditions&action=section');?>?lid=<?php echo $festivalEdition->getLibraryId();?>">Sectiuni</a>
 | <a href="<?php echo url_for('@default?module=festivalEditions&action=judges');?>?lid=<?php echo $festivalEdition->getLibraryId();?>" class="selected">Juriu</a>
<?php if($sf_user->hasCredential('Moderator') && $festivalEdition->getState() == Library::STATE_PENDING): ?>
 | Acest obiect este Pending!  <button type="button" onclick="location.href='<?php echo url_for('@default?module=default&action=allow');?>?lid=<?php echo $festivalEdition->getLibraryId();?>'">Aproba</button>
<?php endif; ?>

<div class="mt-2 mb-2 cell-separator-double"></div>


<h5>Juriu</h5>
<div class="mb-3">
<button type="button" class="mr-2" onclick="location.href='<?php echo url_for('@default?module=festivalEditions&action=judgeAdd');?>?id=<?php echo $festivalEdition->getId();?>'">Adauga persoana</button>
</div>
<div class="clear"></div>


<table class="span-24">
	<?php foreach($judges as $judge):?>
	<tr>
		<td><?php echo $judge->getName();?></td>
		<td><?php echo link_to('sterge', 'festivalEditions/judgeDelete', array('confirm' => 'Esti sigur ca vrei sa stergi persoana?', 'query_string' => 'id=' . $festivalEdition->getId() . '&person_id='.$judge->getId(), 'post' => true, 'class' => 'small-link'));?></td>
	</tr>
	<?php endforeach;?>

</table>

<div class="clear mb-3"></div>