<h4 class="mb-2"><?php echo $film->getNameRo();?> <?php if ($film->getNameEn() != '') echo '(' . $film->getNameEn() . ')';?></h4>


 <a href="<?php echo url_for('@default?module=films&action=view');?>?lid=<?php echo $film->getLibraryId();?>">Detalii</a>
 | <a href="<?php echo url_for('@default?module=films&action=status');?>?lid=<?php echo $film->getLibraryId();?>" class="selected">Status</a>
 | <a href="<?php echo url_for('@default?module=films&action=person');?>?lid=<?php echo $film->getLibraryId();?>">Persoane</a>
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


<h5>Status</h5>
<div class="mb-3">
<button type="button" onclick="location.href='<?php echo url_for('@default?module=films&action=statusEdit');?>?id=<?php echo $film->getId();?>'">Editeaza status</button>
</div>

<div class="clear"></div>

<table class="span-19">
	<tr>
    	<th>In productie</th>
        <td><?php echo $film->getStatusInProduction() ? 'da' : 'nu'; ?></td>
    </tr>
	<tr>
    	<th>In cinema</th>
        <td><?php echo filmsiStatusCinemaExplained($film); ?></td>
    </tr>
	<tr>
    	<th>Pe DVD</th>
        <td><?php echo filmsiStatusDvdExplained($film); ?></td>
    </tr>
	<tr>
    	<th>Bluray</th>
        <td><?php echo filmsiStatusBlurayExplained($film); ?></td>
    </tr>
	<tr>
    	<th>Online</th>
        <td><?php echo filmsiStatusOnlineExplained($film); ?></td>
    </tr>
	<tr>
    	<th>Tv</th>
        <td><?php echo filmsiStatusTvExplained($film); ?></td>
    </tr>
</table>

<div class="clear"></div>