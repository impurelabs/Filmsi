<h4 class="mb-3">Program Tv</h4>
<button onclick="location.href='<?php echo url_for('@default?module=channels&action=channelAdd');?>'">Creeaza canal nou</button>
<br /><br />

<table>
	<tr>
		<th></th>
		<th>Nume Canal</th>
		<th>Numar Filme</th>
		<th></th>
	</tr>
	<?php foreach($channels as $channel):?>
	<tr>
		<td><img src="<?php echo filmsiChannelPhotoThumb($channel->getFilename());?>" /></td>
		<td><?php echo $channel->getName();?></td>
		<td><?php echo $channel->getFilmCount();?></td>
		<td><a href="<?php echo url_for('@default?module=channels&action=schedule');?>?id=<?php echo $channel->getId();?>">program</a></td>
	</tr>
	<?php endforeach;?>
</table>