<div class="mt-2">
	<select id="cinema-location-selector" class="inpttxt0">
		<option value="0">Selecteaza un oras</option>
		<?php foreach($locations as $locationId => $location):?>
		<option value="<?php echo $locationId;?>"<?php if($currentLocationId == $locationId) echo ' selected="selected"';?>><?php echo $location;?></option>
		<?php endforeach;?>
	</select>
</div>
<br />
<form id="alert-cinema-items"></form>
<br />
<div id="alert-cinema-items-buttons">
	<button type="button" id="alert-cinema-save">Salveaza</button>
</div>

<script type="text/javascript">
$(document).ready(function(){
	var cinemasByLocation = new Array();
	<?php foreach($cinemaLocations as $locationId => $cinemaLocation):?>
		var cinemas = new Array();
		
		<?php foreach ($cinemaLocation['cinemas'] as $cinema):?>
			cinemas[<?php echo $cinema['id'];?>] = '<?php echo $cinema['name'];?>';
		<?php endforeach;?>
		cinemasByLocation[<?php echo $locationId;?>] = cinemas;
	<?php endforeach;?>


	var currentCinemaIds = new Array();
	<?php foreach($currentCinemaIds as $key => $currentCinemaId):?>
		currentCinemaIds[<?php echo $key;?>] = '<?php echo $currentCinemaId;?>';
	<?php endforeach;?>



	<?php if($currentLocationId != ''):?>
		/* Display the current cinamas for the current location */
		for (i in cinemasByLocation[<?php echo $currentLocationId;?>]){
			if ($.inArray( i, currentCinemaIds ) != -1){
				$('#alert-cinema-items').append('<input type="checkbox" class="ml-2" name="cid[]" value="' + i + '" checked="checked" /> ' + cinemasByLocation[<?php echo $currentLocationId;?>][i]);
			} else {
				$('#alert-cinema-items').append('<input type="checkbox" class="ml-2" name="cid[]" value="' + i + '" /> ' + cinemasByLocation[<?php echo $currentLocationId;?>][i]);
			}
		}
	<?php endif;?>


	$('#cinema-location-selector').change(function(){
		locationId = $('#cinema-location-selector > option:selected').val();
		$('#alert-cinema-items').html('');

		for(i in cinemasByLocation[locationId]){
			$('#alert-cinema-items').append('<input type="checkbox" class="ml-2" name="cid[]" value="' + i + '" /> ' + cinemasByLocation[locationId][i]);
		}
	});

	$('#alert-cinema-save').click(function(){
		$('#alert-cinema-items-buttons').html('<img src="<?php echo image_path('indicator.gif');?>" /> Se salveaza');
		$.ajax({
			'url': '<?php echo url_for('@default?module=user&action=alertCinemaEdit');?>',
			'type': 'post',
			data: $('#alert-cinema-items').serialize(),
			success: function(response){
				$('#alert-cinema-list').slideUp('fast', function(){
					$('#alert-cinema-list').html(response).slideDown('fast', function(){
						$('#alert-cinema-edit').show();
					});
				});
			}
		});
	});
});
</script>