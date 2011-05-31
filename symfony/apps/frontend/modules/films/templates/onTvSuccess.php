<div style="position: relative">
	<span class="icon-tv"></span><h2 style="margin-left:70px">Filme <span class="black">la Tv</span></h2>
</div>

<div class="spacer-bottom-m">
	<a href="<?php echo url_for('@homepage');?>" class="black-link">Home</a> &raquo;
	<a href="<?php echo url_for('@film_on_tv');?>" class="black-link">La Tv</a>
</div>



<form action="<?php echo url_for('@film_on_tv?');?>" method="get" id="filter-form">
	<input type="hidden" name="d" value="<?php echo $selectedDay;?>" />
	<input type="hidden" name="h" value="<?php echo $selectedHour;?>" />
	<input type="hidden" name="c" value="<?php echo $selectedChannel;?>" />
	<input type="hidden" name="t" value="<?php echo $selectedType;?>" />
</form>


<div class="cell-container6"> <!-- left column start -->

	<div>
    	<button class="normalbutton mb-2 day-trigger align-left" style="width: 188px" day="<?php echo $today;?>">
			<span class="icon-buttonbullet-<?php if ($selectedDay == $today) echo 'green'; else echo "grey";?>"></span>
			<span class="bigstrong<?php if ($selectedDay == $today) echo 'green'; else echo "grey";?>">Filmele de azi</span>
		</button><br />
        <button class="normalbutton mb-2 day-trigger align-left" style="width: 188px" day="<?php echo $tomorrow;?>">
			<span class="icon-buttonbullet-<?php if ($selectedDay == $tomorrow) echo 'green'; else echo "grey";?>"></span>
			<span class="bigstrong<?php if ($selectedDay == $tomorrow) echo 'green'; else echo "grey";?>">Filmele de maine</span>
		</button>
    </div>

	<div class="normalcell" style="padding:0">
    	<h4 class="spacer-left-s spacer-top-s spacer-bottom">Alege <span class="black">o zi</span></h4>
    </div>

    <div class="spacer-bottom">
        <span class="daypicker-s-day<?php if ($selectedDay == $days[1]) echo '-active';?> day-trigger" day="<?php echo $days[1];?>">L</span>
        <span class="daypicker-s-day<?php if ($selectedDay == $days[2]) echo '-active';?> day-trigger" day="<?php echo $days[2];?>">M</span>
        <span class="daypicker-s-day<?php if ($selectedDay == $days[3]) echo '-active';?> day-trigger" day="<?php echo $days[3];?>">M</span>
        <span class="daypicker-s-day<?php if ($selectedDay == $days[4]) echo '-active';?> day-trigger" day="<?php echo $days[4];?>">J</span>
        <span class="daypicker-s-day<?php if ($selectedDay == $days[5]) echo '-active';?> day-trigger" day="<?php echo $days[5];?>">V</span>
        <span class="daypicker-s-day<?php if ($selectedDay == $days[6]) echo '-active';?> day-trigger" day="<?php echo $days[6];?>">S</span>
        <span class="daypicker-s-day<?php if ($selectedDay == $days[7]) echo '-active';?> day-trigger" day="<?php echo $days[7];?>">D</span>
        <div class="clear"></div>
    </div>



</div> <!-- left column end -->




<div class="cell-container2 ml-3"> <!-- content column start -->
	<div class="left">
		<div class="normalcell align-center" style="padding:0">
			<h4 class="spacer-left-s spacer-top-s spacer-bottom">Posturi <span class="black">Tv</span></h4>
		</div>
		<div>
			<div class="left picker<?php if ($selectedChannel == null) echo '-active';?>" id="all-channels" style="border-left: 1px solid #d5d5d5"><span class="picker-cioc"></span>Toate posturile</div>
			<div class="left picker<?php if ($selectedChannel != null) echo '-active';?>" style="border-right: 1px solid #d5d5d5">
				<span class="picker-cioc"></span>
				<select id="channel-picker">
					<option value="0">Postul favorit</option>
					<?php foreach($channels as $channel):?>
						<option value="<?php echo $channel->getId();?>"<?php if($selectedChannel == $channel->getId()) echo ' selected="selected"';?>><?php echo $channel->getName();?></option>
					<?php endforeach;?>
				</select>
			</div>
			<div class="clear"></div>
		</div>
	</div>
	<div class="left ml-2">
		<div class="normalcell align-center" style="padding:0">
			<h4 class="spacer-left-s spacer-top-s spacer-bottom">Ce vrei <span class="black">sa vezi?</span></h4>
		</div>
		<div>
			<div id="type-no-trigger" class="left picker<?php if ($selectedType == null) echo '-active';?>" style="border-left: 1px solid #d5d5d5"><span class="picker-cioc"></span>Tot programul</div>
			<div id="type-f-trigger" class="left picker<?php if ($selectedType == 'f') echo '-active';?> green" style="border-left: 1px solid #d5d5d5"><span class="picker-cioc"></span>Filme</div>
			<div id="type-s-trigger" class="left picker<?php if ($selectedType == 's') echo '-active';?> orange" style="border-left: 1px solid #d5d5d5; border-right: 1px solid #d5d5d5"><span class="picker-cioc"></span>Seriale</div>
			<div class="clear"></div>
		</div>
	</div>
	<div class="clear"></div>

	<div class="clear"></div>


	<div class="normalcell">
		<div class="align-center bigstrong red">Interval orar</div><br />

		<div class="left" style="width: 26px; height: 26px; margin-left: 25px">
			<?php if ($selectedHour > 1):?>
			<a href="javascript: void(0)" class="hour-trigger" hour="<?php echo $selectedHour - 1;?>"><span class="pagenav-back" style="margin-right: 0"></span></a>
			<?php endif;?>
		</div>
		
		<div class="left cell-separator-dotted-bottom" style="width: 65px; margin-left: 35px; margin-top: 12px"></div>
		
		<div class="left" style="font-size: 20px; margin-left: 10px"><?php if ($selectedHour - 1 >= 0) echo sprintf("%02s",$selectedHour - 1) . ':00';?></div>
		
		<div class="left cell-separator-dotted-bottom" style="width: 150px; margin-top: 12px; margin-left: 10px"></div>
		
		<div class="left" style="font-size: 20px; margin-left: 10px"><?php echo sprintf("%02s",$selectedHour) . ':00';?></div>
		
		<div class="left cell-separator-dotted-bottom" style="width: 150px; margin-top: 12px; margin-left: 10px"></div>
		
		<div class="left" style="font-size: 20px; margin-left: 10px"><?php if ($selectedHour + 1 <= 23) echo sprintf("%02s",$selectedHour + 1) . ':00';?></div>

		<div class="left cell-separator-dotted-bottom" style="width: 50px; margin-top: 12px; margin-left: 10px"></div>

		<div class="left" style="width: 26px; margin-left: 10px">
			<?php if ($selectedHour < 22):?>
			<a href="javascript: void(0)" class="hour-trigger" hour="<?php echo $selectedHour + 1;?>"><span class="pagenav-forward" style="margin-left: 0"></span></a>
			<?php endif;?>
		</div>

		<div class="clear"></div>
		<br />

		<?php foreach ($schedules as $schedule):?>
		<div class="cell-separator-dotted-bottom mb-2 pb-2">
			<div class="left" style="width: 75px"><img src="<?php echo filmsiChannelPhotoThumb($schedule['channel_filename']);?>" /></div>

			<div class="left ml-2" style="width: 210px; border: thin solid transparent">
				<?php if (isset($schedule['films'][$selectedHour - 1])):?>
				<ul>
				<?php foreach($schedule['films'][$selectedHour - 1] as $film):?>
					<li><?php echo sprintf("%02s", $selectedHour - 1) . ':' . sprintf('%02s', $film['time_min']);?> 
						<?php if ($film['film_id'] != ''):?>
						<a href="<?php echo url_for('@film?id=' . $film['film_id'] . '&key=' . $film['film_url_key']);?>" class="strong <?php echo $film['film_is_series'] == '1' ? 'orange' : 'green';?>"><?php echo $film['film_name'];?></a>
						<?php else:?>
						<?php echo $film['film_name'];?>
						<?php endif;?>
				<?php endforeach;?>
				</ul>
				<?php endif;?>
			</div>

			<div class="left ml-2" style="width: 210px; border: thin solid transparent;">
				<?php if (isset($schedule['films'][$selectedHour]) > 0):?>
				<ul>
				<?php foreach($schedule['films'][$selectedHour] as $film):?>
					<li><?php echo sprintf("%02s", $selectedHour) . ':' . sprintf('%02s', $film['time_min']);?>
						<?php if ($film['film_id'] != ''):?>
						<a href="<?php echo url_for('@film?id=' . $film['film_id'] . '&key=' . $film['film_url_key']);?>" class="strong <?php echo $film['film_is_series'] == '1' ? 'orange' : 'green';?>"><?php echo $film['film_name'];?></a>
						<?php else:?>
						<?php echo $film['film_name'];?>
						<?php endif;?>
				<?php endforeach;?>
				</ul>
				<?php endif;?>
			</div>

			<div class="left ml-2" style="width: 210px; border: thin solid transparent">
				<?php if (isset($schedule['films'][$selectedHour + 1])):?>
				<ul>
				<?php foreach($schedule['films'][$selectedHour + 1] as $film):?>
					<li><?php echo sprintf("%02s", $selectedHour + 1) . ':' . sprintf('%02s', $film['time_min']);?>
						<?php if ($film['film_id'] != ''):?>
						<a href="<?php echo url_for('@film?id=' . $film['film_id'] . '&key=' . $film['film_url_key']);?>" class="strong <?php echo $film['film_is_series'] == '1' ? 'orange' : 'green';?>"><?php echo $film['film_name'];?></a>
						<?php else:?>
						<?php echo $film['film_name'];?>
						<?php endif;?>
				<?php endforeach;?>
				</ul>
				<?php endif;?>
			</div>

			<div class="clear"></div>
		</div>
		<?php endforeach;?>
	</div>
    

</div> <!-- content column end -->




<script type="text/javascript">
	$(document).ready(function(){
		$('.day-trigger').click(function(){
			$('#filter-form > input[name=d]').val($(this).attr('day'));
			$('#filter-form').submit();
		});

		$('#all-channels').click(function(){
			$('#filter-form > input[name=c]').remove();
			$('#filter-form').submit();
		});

		$('#channel-picker').change(function(){
			channelId = $('#channel-picker option:selected').val();
			if (channelId != '0'){
				$('#filter-form > input[name=c]').val(channelId);
				$('#filter-form').submit();
			}
		});

		$('#type-no-trigger').click(function(){
			$('#filter-form > input[name=t]').remove();
			$('#filter-form').submit();
		});

		$('#type-f-trigger').click(function(){
			$('#filter-form > input[name=t]').val('f');
			$('#filter-form').submit();
		});

		$('#type-s-trigger').click(function(){
			$('#filter-form > input[name=t]').val('s');
			$('#filter-form').submit();
		});

		$('.hour-trigger').click(function(){
			$('#filter-form > input[name=h]').val($(this).attr('hour'));
			$('#filter-form').submit();
		});
	});
</script>