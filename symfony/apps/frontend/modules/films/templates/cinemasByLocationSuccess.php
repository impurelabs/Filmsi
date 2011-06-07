<?php foreach ($cinemaSchedules as $cinemaSchedule):?>
<a href="<?php echo url_for('@cinema?id=' . $cinemaSchedule['id'] . '&key=' . $cinemaSchedule['url_key']);?>" class="bigblue-link"><?php echo $cinemaSchedule['name'];?></a><br />

<table>
<?php foreach($cinemaSchedule['Schedule'] as $schedule):?>
	<tr>
		<td><?php echo $schedule['day'];?></td>
		<td><?php echo $schedule['schedule'];?></td>
		<td><?php if ($cinemaSchedule['reservation_url'] != ''):?><a href="<?php echo $cinemaSchedule['reservation_url'];?>" target="_blank" class="greenbutton-s-link">Rezerva</a><?php endif;?></td>
	</tr>
<?php endforeach; ?>
</table>

<hr class="cell-separator-double pb-2 mb-2" />
<?php endforeach; ?>