<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>

<h4>Cinematograf</h4>

<a href="<?php echo url_for('@default?module=cinemas&action=view');?>?lid=<?php echo $form->getObject()->getLibraryId();?>" class="selected">Detalii</a>
 | <a href="<?php echo url_for('@default?module=cinemas&action=schedule');?>?lid=<?php echo $form->getObject()->getLibraryId();?>">Program</a>
 | <a href="<?php echo url_for('@default?module=cinemas&action=admin');?>?lid=<?php echo $form->getObject()->getLibraryId();?>">Administrator</a>
<?php if($sf_user->hasCredential('Moderator') && $form->getObject()->getState() == Library::STATE_PENDING): ?>
 | Acest obiect este Pending!  <button type="button" onclick="location.href='<?php echo url_for('@default?module=default&action=allow');?>?lid=<?php echo $form->getObject()->getLibraryId();?>'">Aproba</button>
<?php endif; ?>

 <div class="mt-2 mb-2 cell-separator-double"></div>

<h5>Editeaza detalii</h5>
<div class="clear"></div>

<div id="test"></div>
<form id="the-form" action="<?php echo url_for('@default?module=cinemas&action=edit');?>?lid=<?php echo $form->getObject()->getLibraryId();?>" method="post" enctype="multipart/form-data">

<?php echo $form->renderHiddenFields();?>
<?php echo $form->renderGlobalErrors();?>

<table class="span-19">
	<tr>
    	<th>Nume</th>
        <td><?php echo $form['name']->render(array('class' => 'span-13'));?><br /><?php echo $form['name']->renderError();?></td>
    </tr>
	<tr>
    	<th>Oras</th>
        <td><?php echo $form['location']->render(array('class' => 'span-13'));?><br /><?php echo $form['location']->renderError();?></td>
    </tr>
	<tr>
    	<th>Adresa</th>
        <td><?php echo $form['address']->render(array('class' => 'span-13'));?><br /><?php echo $form['address']->renderError();?></td>
    </tr>
	<tr>
    	<th>Pozitie harta</th>
        <td>
        	latitudine: <?php echo $form['lat']->render(array('class' => 'span-4 map-coord'));?>, longitudine: <?php echo $form['lng']->render(array('class' => 'span-4 map-coord'));?><br />
			<?php echo $form['lat']->renderError();?> <?php echo $form['lng']->renderError();?>
        </td>
    </tr>
</table>

<div class="clear"></div>

<br />
<input type="text" id="map-search" /> <button type="button" id="map-button">Cauta</button>
<div id="map_canvas" class="mb-4" style="width:600px; height: 300px"></div>


<table class="span-19">
	<tr>
    	<th>Telefon</th>
        <td><?php echo $form['phone']->render(array('class' => 'span-13'));?><br /><?php echo $form['phone']->renderError();?></td>
    </tr>
	<tr>
    	<th>Website</th>
        <td><?php echo $form['website']->render(array('class' => 'span-13'));?><br /><?php echo $form['website']->renderError();?></td>
    </tr>
	<tr>
    	<th>Numar sali</th>
        <td><?php echo $form['room_count']->render();?><br /><?php echo $form['room_count']->renderError();?></td>
    </tr>
	<tr>
    	<th>Locuri</th>
        <td><?php echo $form['seats']->render(array('class' => 'span-13'));?><br /><?php echo $form['seats']->renderError();?></td>
    </tr>
	<tr>
    	<th>Sunet</th>
        <td><?php echo $form['sound']->render(array('class' => 'span-13'));?><br /><?php echo $form['sound']->renderError();?></td>
    </tr>
	<tr>
    	<th>Facilitati</th>
        <td><?php echo $form['service_list']->render();?><br /><?php echo $form['service_list']->renderError();?></td>
    </tr>
	<tr>
    	<th>Pret bilete</th>
        <td><?php echo $form['ticket_price']->render(array('class' => 'mceEditor'));?><br /><?php echo $form['ticket_price']->renderError();?></td>
    </tr>
    <tr>
    	<th>Format film</th>
        <td><?php echo $form['is_type_film']->render();?> pelicula, <?php echo $form['is_type_digital']->render();?> digital, <?php echo $form['is_type_3d']->render();?> 3D <br />
			<?php echo $form['is_type_film']->renderError();?> <?php echo $form['is_type_digital']->renderError();?> <?php echo $form['is_type_3d']->renderError();?></td>
    </tr>
	<tr>
    	<th>Descriere - intro</th>
        <td><?php echo $form['description_teaser']->render(array('class' => 'span-13'));?><br /><?php echo $form['description_teaser']->renderError();?></td>
    </tr>
	<tr>
    	<th>Descriere - continut</th>
        <td><?php echo $form['description_content']->render(array('class' => 'span-13 mceEditor'));?><br /><?php echo $form['description_content']->renderError();?></td>
    </tr>
	<tr>
    	<th>META Description</th>
        <td><?php echo $form['meta_description']->render(array('class' => 'span-13'));?><br /><?php echo $form['meta_description']->renderError();?></td>
    </tr>
	<tr>
    	<th>META Keywords</th>
        <td><?php echo $form['meta_keywords']->render(array('class' => 'span-13'));?><br /><?php echo $form['meta_keywords']->renderError();?></td>
    </tr>
	<tr>
    	<th>URL Key</th>
        <td><?php echo $form['url_key']->render(array('class' => 'span-13'));?><br /><?php echo $form['url_key']->renderError();?></td>
    </tr>
	<tr>
    	<th>Poza</th>
        <td><img src="<?php echo filmsiCinemaPhotoThumb($form->getObject()->getFilename());?>" /><br /><?php echo $form['filename']->render();?><br /><?php echo $form['filename']->renderError();?></td>
    </tr>
	<tr>
    	<th>Publicat la</th>
        <td><?php echo $form['publish_date']->render();?><br /><?php echo $form['publish_date']->renderError();?></td>
    </tr>
	<tr>
    	<th>URL Rezervari</th>
        <td><?php echo $form['reservation_url']->render(array('class' => 'span-13'));?><br /><?php echo $form['reservation_url']->renderError();?></td>
    </tr>
    <tr>
    	<th>Album Foto</th>
        <td><input type="text" id="photo-album-selector" value="<?php echo $form->getObject()->getPhotoAlbum()->getName();?>" class="span-13" /> </td>
    </tr>
</table>


<div class="mt-2 mb-2 clear"></div>

<div class="mt-3">
    <button type="button" onclick="$('#the-form').submit()"class="mr-2">Salveaza</button>
    <a href="<?php echo $sf_request->getReferer();?>">Anuleaza</a>
</div>

</form>

<script type="text/javascript">
	var map;
	var geocoder;
	var marker;

	$(document).ready(function(){
		$('#cinema_publish_date').datepicker({dateFormat: 'yy-mm-dd'});


		/* Photo album selector functionality */
		$("#photo-album-selector").autocomplete({
	      source: function(request, response) {
	        $.ajax({
	          url: "<?php echo url_for('@default?module=photos&action=api')?>",
	          dataType: "json",
	          data: {
	            term: request.term
	          },
	          success: function(data) {
	            response(data);
	          }
	        })
	      },
		  select: function(event, ui){
			  $('#cinema_photo_album_id').val(ui.item.value);
			  $('#photo-album-selector').val(ui.item.label);
			  return false;
		  },
	      minLength: 2
	    });


		
		/* Field autocomplete functionality */
		$("#cinema_location").autocomplete({
	      source: function(request, response) {
	        $.ajax({
	          url: "<?php echo url_for('@default?module=default&action=locations')?>",
	          dataType: "json",
	          data: {
	            term: request.term
	          },
	          success: function(data) {				  
	            response(data);
	          }
	        })
	      },
		  select: function(event, ui){
			  $("#cinema_location" ).attr('value',ui.item.label);
			  $("#cinema_location_id" ).attr('value',ui.item.value);
			  
			  return false;
		  },
		  focus: function(event, ui){
			  $("#cinema_location" ).attr('value',ui.item.label);
			  return false;
		  },
	      minLength: 2
	    });
		
		$('.map-coord').change(function(){
			moveMarker($('#cinema_lat').val(), $('#cinema_lng').val());
		});
		
		
		/* Search on map functionality */
		$('#map-button').click(function(){
			geocode($('#map-search').val());
		});
	
		initializeMap();	
	});
	
function initializeMap()
{
    geocoder = new google.maps.Geocoder();
    var latlng = new google.maps.LatLng(<?php echo $form->getObject()->getLat();?>, <?php echo $form->getObject()->getLng();?>);
    var myOptions = {
      zoom: <?php echo $form->getObject()->getMapZoom();?>,
      center: latlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
	
	marker = new google.maps.Marker({
		map: map, 
		position: latlng,
		draggable: true
	});
	
	google.maps.event.addListener(marker, 'drag', function() {
		$('#cinema_lat').attr('value',marker.getPosition().lat());
		$('#cinema_lng').attr('value', marker.getPosition().lng());
	});

	google.maps.event.addListener(map, 'zoom_changed', function() {
		$('#cinema_map_zoom').attr('value',map.getZoom());
	});
}

function geocode(searchCode) 
{
    geocoder.geocode( { 'address': searchCode}, function(results, status) {		

      if (status == google.maps.GeocoderStatus.OK) {
		  
		$('#cinema_lat').attr('value',results[0].geometry.location.lat());
		$('#cinema_lng').attr('value', results[0].geometry.location.lng());
		moveMarker(results[0].geometry.location.lat(), results[0].geometry.location.lng(), results[0].geometry.viewport);
		
      } else {
        alert("Geocode was not successful for the following reason: " + status);
      }
    });
}

function moveMarker(lat, lng, bounds)
{
	var newLatlng = new google.maps.LatLng(lat, lng);
	
	map.setCenter(newLatlng);
	map.fitBounds(bounds);
	marker.setPosition(newLatlng);	
}

</script>

<?php include_partial('default/wysiwygEditor', array('width' => 600, 'height' => 400));?>