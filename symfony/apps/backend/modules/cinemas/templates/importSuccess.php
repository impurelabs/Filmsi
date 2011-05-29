<h4>Cinematograf "<?php echo $cinema->getName();?>"</h4>

<a href="<?php echo url_for('@default?module=cinemas&action=view');?>?lid=<?php echo $cinema->getLibraryId();?>">Detalii</a>
 | <a href="<?php echo url_for('@default?module=cinemas&action=schedule');?>?lid=<?php echo $cinema->getLibraryId();?>" class="selected">Program</a>
 | <a href="<?php echo url_for('@default?module=cinemas&action=admin');?>?lid=<?php echo $cinema->getLibraryId();?>">Administrator</a>
<?php if($sf_user->hasCredential('Moderator') && $cinema->getState() == Library::STATE_PENDING): ?>
 | Acest obiect este Pending!  <button type="button" onclick="location.href='<?php echo url_for('@default?module=default&action=allow');?>?lid=<?php echo $cinema->getLibraryId();?>'">Aproba</button>
<?php endif; ?>

 <div class="mt-2 mb-2 cell-separator-double"></div>

<h5>Importa program</h5>

<form method="post" action="<?php echo url_for('@default?module=cinemas&action=import');?>?id=<?php echo $cinema->getId();?>">
	
	<input type="radio" name="day" value="1" /> Luni <?php if ($today == '1') echo '(azi)';?><br />
	<input type="radio" name="day" value="2" /> Marti <?php if ($today == '2') echo '(azi)';?> <br />
	<input type="radio" name="day" value="3" /> Miercuri <?php if ($today == '3') echo '(azi)';?> <br />
	<input type="radio" name="day" value="4" /> Joi <?php if ($today == '4') echo '(azi)';?> <br />
	<input type="radio" name="day" value="5" /> Vineri <?php if ($today == '5') echo '(azi)';?> <br />
	<input type="radio" name="day" value="6" /> Sambata <?php if ($today == '6') echo '(azi)';?> <br />
	<input type="radio" name="day" value="7" /> Duminica <?php if ($today == '7') echo '(azi)';?> <br />

	<br /><br />
	<button type="submit">Importa</button>
	<a href="<?php echo url_for('@default?module=cinemas&action=schedule&lid=' . $cinema->getLibraryId());?>">Anuleaza</a>
</form>