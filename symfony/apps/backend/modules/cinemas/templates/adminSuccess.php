<h4>Cinematograf</h4>

<a href="<?php echo url_for('@default?module=cinemas&action=view');?>?lid=<?php echo $cinema->getLibraryId();?>">Detalii</a>
 | <a href="<?php echo url_for('@default?module=cinemas&action=schedule');?>?lid=<?php echo $cinema->getLibraryId();?>">Program</a>
 | <a href="<?php echo url_for('@default?module=cinemas&action=admin');?>?lid=<?php echo $cinema->getLibraryId();?>" class="selected">Administrator</a>
<?php if($sf_user->hasCredential('Moderator') && $cinema->getState() == Library::STATE_PENDING): ?>
 | Acest obiect este Pending!  <button type="button" onclick="location.href='<?php echo url_for('@default?module=default&action=allow');?>?lid=<?php echo $cinema->getLibraryId();?>'">Aproba</button>
<?php endif; ?>

 <div class="mt-2 mb-2 cell-separator-double"></div>

<h5>Administrator</h5>
<div class="mb-3">
<button type="button" onclick="location.href='<?php echo url_for('@default?module=cinemas&action=editAdmin');?>?lid=<?php echo $cinema->getLibraryId();?>'">Editeaza administrator</button>
</div>
<div class="clear"></div>

<?php if ($cinema->getAdminUserId() != ''):?>
	<table class="span-19">
		<tr>
			<th>Nume</th>
			<td><?php echo $admin->getFirstName();?> <?php echo $admin->getLastName();?></td>
		</tr>
		<tr>
			<th>Email</th>
			<td><?php echo $admin->getEmailAddress();?></td>
		</tr>
		<tr>
			<th>Username</th>
			<td><?php echo $admin->getUsername();?></td>
		</tr>
	</table>
<?php else: ?>
Nu este selectat niciun administrator.
<?php endif; ?>

<div class="clear"></div>