<h4>Importa program canal "<?php echo $channel->getName();?>"</h4>


<form method="post" action="<?php echo url_for('@default?module=channels&action=import');?>?id=<?php echo $channel->getId();?>">
	
	<input type="radio" name="day" value="1" /> Luni <?php if ($today == '1') echo '(azi)';?><br />
	<input type="radio" name="day" value="2" /> Marti <?php if ($today == '2') echo '(azi)';?> <br />
	<input type="radio" name="day" value="3" /> Miercuri <?php if ($today == '3') echo '(azi)';?> <br />
	<input type="radio" name="day" value="4" /> Joi <?php if ($today == '4') echo '(azi)';?> <br />
	<input type="radio" name="day" value="5" /> Vineri <?php if ($today == '5') echo '(azi)';?> <br />
	<input type="radio" name="day" value="6" /> Sambata <?php if ($today == '6') echo '(azi)';?> <br />
	<input type="radio" name="day" value="7" /> Duminica <?php if ($today == '7') echo '(azi)';?> <br />

	<br /><br />
	<button type="submit">Importa</button>
	<a href="<?php echo url_for('@default?module=channels&action=schedule&id=' . $channel->getId());?>">Anuleaza</a>
</form>