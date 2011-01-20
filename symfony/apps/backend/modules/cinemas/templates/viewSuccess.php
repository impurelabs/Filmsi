<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>

<h4>Detalii Cinematograf</h4>
<div class="mb-3">
<?php if($sf_user->hasCredential('Moderator') && $cinema->getState() == Library::STATE_PENDING): ?>
Acest obiect este Pending!  <button type="button" onclick="location.href='<?php echo url_for('@default?module=default&action=allow');?>?lid=<?php echo $cinema->getLibraryId();?>'">Aproba</button>
<?php endif; ?>
<button type="button" onclick="location.href='<?php echo url_for('@default?module=cinemas&action=schedule');?>?lid=<?php echo $cinema->getLibraryId();?>'">Program cinema</button>
<button type="button" onclick="location.href='<?php echo url_for('@default?module=cinemas&action=edit');?>?lid=<?php echo $cinema->getLibraryId();?>'">Editeaza detalii</button>
</div>

<div class="clear"></div>

<table class="span-19">
	<tr>
    	<th>Nume</th>
        <td><?php echo $cinema->getName();?></td>
    </tr>
	<tr>
    	<th>Oras</th>
        <td><?php echo $cinema->getLocation()->getCity() . ', ' .$cinema->getLocation()->getRegion();?></td>
    </tr>
	<tr>
    	<th>Adresa</th>
        <td><?php echo $cinema->getAddress();?></td>
    </tr>
	<tr>
    	<th>Pozitie harta:</th>
        <td>latitudine: <?php echo $cinema->getLat();?>, longitudine: <?php echo $cinema->getLng();?>, </td>
    </tr>
</table>

<div class="clear"></div>

<br />
<div id="map_canvas" class="mb-4" style="width:600px; height: 300px"></div>


<table class="span-19">
	<tr>
    	<th>Telefon</th>
        <td><?php echo $cinema->getPhone();?></td>
    </tr>
	<tr>
    	<th>Website</th>
        <td><?php echo $cinema->getWebsite();?></td>
    </tr>
	<tr>
    	<th>Numar sali</th>
        <td><?php echo $cinema->getRoomCount();?></td>
    </tr>
	<tr>
    	<th>Locuri</th>
        <td><?php echo $cinema->getSeats();?></td>
    </tr>
	<tr>
    	<th>Sunet</th>
        <td><?php echo $cinema->getSound();?></td>
    </tr>
	<tr>
    	<th>Pret bilete</th>
        <td><?php echo $cinema->getTicketPrice();?></td>
    </tr>
	<tr>
    	<th>Facilitati</th>
        <td>
			<?php foreach ($cinema->getService() as $service):?>
            	<?php echo $service->getName();?>, 
        	<?php endforeach;?>    
        </td>
    </tr>
    <tr>
    	<th>Format</th>
        <td><?php echo ($cinema->getIsTypeFilm() ? 'pelicula, ' : '') . ($cinema->getIsTypeDigital() ? 'digital, ' : '') . ($cinema->getIsType_3d() ? '3D' : '');?></td>
    </tr>
	<tr>
    	<th>Descriere - intro</th>
        <td><?php echo $cinema->getDescriptionTeaser();?></td>
    </tr>
	<tr>
    	<th>Descriere - continut</th>
        <td><?php echo $sf_data->getRaw('cinema')->getDescriptionContent();?></td>
    </tr>
	<tr>
    	<th>META Description</th>
        <td><?php echo $cinema->getMetaDescription();?></td>
    </tr>
	<tr>
    	<th>META Keywords</th>
        <td><?php echo $cinema->getMetaKeywords();?></td>
    </tr>
	<tr>
    	<th>URL Key</th>
        <td><?php echo $cinema->getUrlKey();?></td>
    </tr>
	<tr>
    	<th>Poza</th>
        <td><img src="<?php echo filmsiCinemaPhotoThumb($cinema->getFilename());?>" /></td>
    </tr>
	<tr>
    	<th>Publicat la</th>
        <td><?php echo $cinema->getPublishDate();?></td>
    </tr>
</table>

<div class="clear"></div>

<div class="mt-2 mb-2 cell-separator-double"></div>

<h4 class="left">Promotii</h4>
<a class="ml-3" href="<?php echo url_for('@default?module=cinemas&action=addPromotion');?>?id=<?php echo $cinema->getId();?>">Adauga promotie</a>

<div class="clear mb-3"></div>

<?php foreach ($sf_data->getRaw('cinema')->getPromotions() as $promotion): ?>

<h6 class="mb-2"><?php echo $promotion->getName();?></h6> 

<img src="<?php echo filmsiCinemaPromotionPhotoThumb($promotion->getFilename());?>" /> <br />

<strong>Descriere</strong><br />
<?php echo $promotion->getContent();?> <br />

<a href="<?php echo url_for('@default?module=cinemas&action=editPromotion');?>?id=<?php echo $promotion->getId();?>">editeaza</a> |
<a href="<?php echo url_for('@default?module=cinemas&action=deletePromotion');?>?id=<?php echo $promotion->getId();?>">sterge</a>

<div class="cell-separator-double"></div>
<?php endforeach; ?>


<script type="text/javascript">
	var map;
	var marker;

	$(document).ready(function(){
		initializeMap();	
	});
	
function initializeMap()
{
    var latlng = new google.maps.LatLng(<?php echo $cinema->getLat();?>, <?php echo $cinema->getLng();?>);
    var myOptions = {
      zoom: <?php echo $cinema->getMapZoom();?>,
      center: latlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
	
	marker = new google.maps.Marker({
		map: map, 
		position: latlng
	});
	
	google.maps.event.addListener(marker, 'drag', function() {
		$('#cinema_lat').attr('value',marker.getPosition().lat());
		$('#cinema_lng').attr('value', marker.getPosition().lng());
	});
}
</script>

