<h4 class="mb-3">Program Tv</h4>
<button onclick="location.href='<?php echo url_for('@default?module=channels&action=channelAdd');?>'">Creeaza canal nou</button>
<br /><br />

<table>
	<tr>
		<th></th>
		<th>Nume Canal</th>
		<th>Pula ID</th>
		<th>Numar Filme</th>
		<th></th>
		<th></th>
		<th></th>
	</tr>
	<?php foreach($channels as $channel):?>
	<tr>
		<td><img src="<?php echo filmsiChannelPhotoThumb($channel->getFilename());?>" /></td>
		<td><?php echo $channel->getName();?></td>
		<td><?php echo $channel->getCinemagiaPullAid();?></td>
		<td><?php echo $channel->getFilmCount();?></td>
		<td><a href="<?php echo url_for('@default?module=channels&action=schedule');?>?id=<?php echo $channel->getId();?>">program</a></td>
		<td><a href="<?php echo url_for('@default?module=channels&action=channelEdit');?>?id=<?php echo $channel->getId();?>">editeaza</a></td>
		<td><a href="javascript: void(0)" class="delete-link" channel_id="<?php echo $channel->getId();?>">sterge</a></td>
	</tr>
	<?php endforeach;?>
</table>

<form id="channel-delete-form" action="<?php echo url_for('@default?module=channels&action=channelDelete');?>" method="post">
	<input type="hidden" name="id" value="" />
</form>

<script type="text/javascript">
	$(document).ready(function(){
		$('.delete-link').click(function(){
			value = $(this).attr('channel_id');
			
			$('#channel-delete-form > input[name=id]').val(value);
			$('#channel-delete-form').submit();
		});
	});
</script>