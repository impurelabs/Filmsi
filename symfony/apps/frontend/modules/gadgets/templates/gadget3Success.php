<?php use_helper('Text');?>
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo stylesheet_path('main.css', true);?>" />
<div class="cell greencell" style="height:110px; width: 285px">
	<span style="font-size: 24px; color: #000000; font-weight: bold">Vrei la cinematograf?</span><br />
	<span class="black" style="font-size: 14px; ">Afla ce filme sunt la cinema in orasul tau.</span><br /> <br />
	<select id="cinema-city-selector" class="cinema-city" style="width: 285px" onchange="window.parent.location.href='<?php echo url_for('@cinema_search');?>?l=' + this.options[this.selectedIndex].value">
	  <option value="0">Alege orasul</option>
	  <?php foreach($cinemaLocations as $locationId => $cinemaLocation):?>
		<option value="<?php echo $locationId;?>"><?php echo $cinemaLocation;?></option>
	  <?php endforeach;?>
	</select>
</div>