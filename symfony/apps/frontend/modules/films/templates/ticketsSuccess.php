<?php slot('backgroundTag');?>
<div style="width: <?php echo $backgroundWidth;?>px; margin: 0 auto; background: url('<?php echo filmsiFilmBackground($film->getBackgroundFilename());?>') top no-repeat">
<?php end_slot();?>

<h2><a href="<?php echo url_for('@film?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>"><?php echo $film->getNameRo();?> <?php if ($film->getNameEn() != ''):?><span class="black">(<?php echo $film->getNameEn();?>)</span><?php endif;?></a></h2>

<div class="spacer-bottom-m">
	<a href="<?php echo url_for('@homepage');?>" class="black-link">Home</a> &raquo;
	<a href="<?php echo url_for('@film?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>" class="black-link"><?php echo $film->getName();?></a> &raquo;
    <a href="<?php echo url_for('@film_tickets?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>" class="black-link">Rezerva bilete</a>
</div>


<div class="cell-container6"> <!-- left column start -->
    <div class="cell spacer-bottom-m">
        <div class="cell-hd">
            <h5><a href="<?php echo url_for('@film?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>">Detalii <span class="black">film</span></a></h5>
        </div>
        <div class="cell-bd" style="padding:0">
        	<?php include_component('films', 'menu', array('film' => $film, 'current' => 'tickets')); ?>
        </div>
    </div>
</div> <!-- left column end -->




<div class="cell-container5 spacer-left"> <!-- content column start -->


    <div class="normalcell spacer-bottom">
        <h4 class="spacer-bottom-m">Rezerva bilete</h4>
		<br />

		<select id="city-selector" class="cinema-city spacer-left" name="l" style="width: 350px">
			<option>Selecteaza orasul tau</option>
			<?php foreach ($film->getLocationsWhereIsInCinema() as $location):?>
			<option value="<?php echo $location['id'];?>"><?php echo $location['city'];?></option>
			<?php endforeach;?>
		</select>
		
		<div id="cinemas-container"></div>
<br /><br /><br /><br /><br /><br />
    </div>

</div> <!-- content column end -->

<div class="cell-container7 spacer-left"> <!-- right column start -->
	<?php include_component('default', 'rightColumn', array('page' => Page::FILM));?>
</div> <!-- right column end -->

<script type="text/javascript">
$(document).ready(function(){
	$('#city-selector').change(function(){
		locationId = $('#city-selector option:selected').val();
		
		$('#cinemas-container').html('<img src="<?php echo image_path('indicator.gif');?>" />');
		
		$.ajax({
			url: '<?php echo url_for('@film_get_cinemas_by_location?id=' . $film->getId());?>',
			type: 'get',
			data: {
				location_id: locationId
			},
			success: function(data){
				$('#cinemas-container').html(response);
			}
		});
	});
});
</script>