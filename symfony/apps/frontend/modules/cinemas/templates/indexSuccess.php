<h2>Cinematografe din <span class="black">Romania</span></h2>

<div class="spacer-bottom-m">
	<a href="<?php echo url_for('@homepage');?>" class="black-link">Home</a> &raquo;
	<a href="<?php echo url_for('@cinemas');?>" class="black-link">Cinematografe din Romania</a>
	<?php if($sf_request->hasParameter('region')):?>
		&raquo;
		<a href="<?php echo url_for('@cinemas_by_region?region=' . $sf_request->getParameter('region'));?>" class="black-link"><?php echo $region;?></a>
	<?php endif;?>
</div>


<div class="cell-container8"> <!-- content column start -->
	<div class="normalcell spacer-bottom">
    	<h1>Selecteaza<br /><span class="black">orasul</span></h1>
        <img src="<?php echo image_path('map-arrow.png');?>" style="margin-left: 40px; margin-top: 20px" />
        <br /><br />
      <h2 class="spacer-top"><span id="cinema-region-container"></span>&nbsp;</h2>
	  <h5><span class="black display-none" id="cinema-count-container"><span id="cinema-count-number"></span> cinematografe</span>&nbsp</h5>

      <ul class="romania">
          <li class="romania-bucuresti"><a href="<?php echo url_for('@cinemas_by_region?region=bucuresti');?>"  cinema_count="<?php echo $cinemaCountByRegion['bucuresti'];?>" class="small-link">Bucuresti</a></li>
		  <li class="romania-alba"><a href="<?php echo url_for('@cinemas_by_region?region=alba');?>"  cinema_count="<?php echo $cinemaCountByRegion['alba'];?>" class="small-link">Alba Iulia</a></li>
       	  <li class="romania-arad"><a href="<?php echo url_for('@cinemas_by_region?region=arad');?>"  cinema_count="<?php echo $cinemaCountByRegion['arad'];?>" class="small-link">Arad</a></li>
       	  <li class="romania-arges"><a href="<?php echo url_for('@cinemas_by_region?region=arges');?>"  cinema_count="<?php echo $cinemaCountByRegion['arges'];?>" class="small-link">Arges</a></li>
       	  <li class="romania-bacau"><a href="<?php echo url_for('@cinemas_by_region?region=bacau');?>"  cinema_count="<?php echo $cinemaCountByRegion['bacau'];?>" class="small-link">Bacau</a></li>
       	  <li class="romania-bihor"><a href="<?php echo url_for('@cinemas_by_region?region=bihor');?>"  cinema_count="<?php echo $cinemaCountByRegion['bihor'];?>" class="small-link">Bihor</a></li>
       	  <li class="romania-bistritanasaud"><a href="<?php echo url_for('@cinemas_by_region?region=bistrita-nasaud');?>"  cinema_count="<?php echo $cinemaCountByRegion['bistritanasaud'];?>" class="small-link">Bistrita<br />Nasaud</a></li>
       	  <li class="romania-botosani"><a href="<?php echo url_for('@cinemas_by_region?region=botosani');?>"  cinema_count="<?php echo $cinemaCountByRegion['botosani'];?>" class="small-link">Botosani</a></li>
       	  <li class="romania-brasov"><a href="<?php echo url_for('@cinemas_by_region?region=brasov');?>"  cinema_count="<?php echo $cinemaCountByRegion['brasov'];?>" class="small-link">Brasov</a></li>
       	  <li class="romania-braila"><a href="<?php echo url_for('@cinemas_by_region?region=braila');?>"  cinema_count="<?php echo $cinemaCountByRegion['braila'];?>" class="small-link">Braila</a></li>
       	  <li class="romania-buzau"><a href="<?php echo url_for('@cinemas_by_region?region=buzau');?>"  cinema_count="<?php echo $cinemaCountByRegion['buzau'];?>" class="small-link">Buzau</a></li>
		  <li class="romania-carasseverin"><a href="<?php echo url_for('@cinemas_by_region?region=caras-severin');?>"  cinema_count="<?php echo $cinemaCountByRegion['carasseverin'];?>" class="small-link">Caras<br />Severin</a></li>
       	  <li class="romania-calarasi"><a href="<?php echo url_for('@cinemas_by_region?region=calarasi');?>"  cinema_count="<?php echo $cinemaCountByRegion['calarasi'];?>" class="small-link">Calarasi</a></li>
       	  <li class="romania-cluj"><a href="<?php echo url_for('@cinemas_by_region?region=cluj');?>"  cinema_count="<?php echo $cinemaCountByRegion['cluj'];?>" class="small-link">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cluj</a></li>
       	  <li class="romania-constanta"><a href="<?php echo url_for('@cinemas_by_region?region=constanta');?>"  cinema_count="<?php echo $cinemaCountByRegion['constanta'];?>" class="small-link">Constanta</a></li>
       	  <li class="romania-covasna"><a href="<?php echo url_for('@cinemas_by_region?region=covasna');?>"  cinema_count="<?php echo $cinemaCountByRegion['covasna'];?>" class="small-link">Covasna</a></li>
       	  <li class="romania-dambovita"><a href="<?php echo url_for('@cinemas_by_region?region=dambovita');?>"  cinema_count="<?php echo $cinemaCountByRegion['dambovita'];?>" class="small-link">Dambovita</a></li>
       	  <li class="romania-dolj"><a href="<?php echo url_for('@cinemas_by_region?region=dolj');?>"  cinema_count="<?php echo $cinemaCountByRegion['dolj'];?>" class="small-link">Dolj</a></li>
       	  <li class="romania-galati"><a href="<?php echo url_for('@cinemas_by_region?region=galati');?>"  cinema_count="<?php echo $cinemaCountByRegion['galati'];?>" class="small-link">Galati</a></li>
       	  <li class="romania-giurgiu"><a href="<?php echo url_for('@cinemas_by_region?region=giurgiu');?>"  cinema_count="<?php echo $cinemaCountByRegion['giurgiu'];?>" class="small-link">Giurgiu</a></li>
       	  <li class="romania-gorj"><a href="<?php echo url_for('@cinemas_by_region?region=gorj');?>"  cinema_count="<?php echo $cinemaCountByRegion['gorj'];?>" class="small-link">Gorj</a></li>
       	  <li class="romania-harghita"><a href="<?php echo url_for('@cinemas_by_region?region=harghita');?>"  cinema_count="<?php echo $cinemaCountByRegion['harghita'];?>" class="small-link">Harghita</a></li>
       	  <li class="romania-hunedoara"><a href="<?php echo url_for('@cinemas_by_region?region=hunedoara');?>"  cinema_count="<?php echo $cinemaCountByRegion['hunedoara'];?>" class="small-link">Hunedoara</a></li>
       	  <li class="romania-ialomita"><a href="<?php echo url_for('@cinemas_by_region?region=ialomita');?>"  cinema_count="<?php echo $cinemaCountByRegion['ialomita'];?>" class="small-link">Ialomita</a></li>
		  <li class="romania-iasi"><a href="<?php echo url_for('@cinemas_by_region?region=iasi');?>"  cinema_count="<?php echo $cinemaCountByRegion['iasi'];?>" class="small-link">Iasi</a></li>
       	  <li class="romania-ilfov"><a href="<?php echo url_for('@cinemas_by_region?region=ilfov');?>"  cinema_count="<?php echo $cinemaCountByRegion['ilfov'];?>" class="small-link">Ilfov</a></li>
       	  <li class="romania-maramures"><a href="<?php echo url_for('@cinemas_by_region?region=maramures');?>"  cinema_count="<?php echo $cinemaCountByRegion['maramures'];?>" class="small-link">Maramures</a></li>
          <li class="romania-mehedinti"><a href="<?php echo url_for('@cinemas_by_region?region=mehedinti');?>"  cinema_count="<?php echo $cinemaCountByRegion['mehedinti'];?>" class="small-link">Mehedinti</a></li>
          <li class="romania-mures"><a href="<?php echo url_for('@cinemas_by_region?region=mures');?>"  cinema_count="<?php echo $cinemaCountByRegion['mures'];?>" class="small-link">Mures</a></li>
       	  <li class="romania-neamt"><a href="<?php echo url_for('@cinemas_by_region?region=neamt');?>"  cinema_count="<?php echo $cinemaCountByRegion['neamt'];?>" class="small-link">Neamt</a></li>
       	  <li class="romania-olt"><a href="<?php echo url_for('@cinemas_by_region?region=olt');?>"  cinema_count="<?php echo $cinemaCountByRegion['olt'];?>" class="small-link">Olt</a></li>
       	  <li class="romania-prahova"><a href="<?php echo url_for('@cinemas_by_region?region=prahova');?>"  cinema_count="<?php echo $cinemaCountByRegion['prahova'];?>" class="small-link">Prahova</a></li>
       	  <li class="romania-satumare"><a href="<?php echo url_for('@cinemas_by_region?region=satumare');?>"  cinema_count="<?php echo $cinemaCountByRegion['satumare'];?>" class="small-link">Satu Mare</a></li>
       	  <li class="romania-salaj"><a href="<?php echo url_for('@cinemas_by_region?region=salaj');?>"  cinema_count="<?php echo $cinemaCountByRegion['salaj'];?>" class="small-link">Salaj</a></li>
       	  <li class="romania-sibiu"><a href="<?php echo url_for('@cinemas_by_region?region=sibiu');?>"  cinema_count="<?php echo $cinemaCountByRegion['sibiu'];?>" class="small-link">Sibiu</a></li>
       	  <li class="romania-suceava"><a href="<?php echo url_for('@cinemas_by_region?region=suceava');?>"  cinema_count="<?php echo $cinemaCountByRegion['suceava'];?>" class="small-link">Suceava</a></li>
       	  <li class="romania-teleorman"><a href="<?php echo url_for('@cinemas_by_region?region=teleorman');?>"  cinema_count="<?php echo $cinemaCountByRegion['teleorman'];?>" class="small-link">Teleorman</a></li>
       	  <li class="romania-timis"><a href="<?php echo url_for('@cinemas_by_region?region=timis');?>"  cinema_count="<?php echo $cinemaCountByRegion['timis'];?>" class="small-link">Timis</a></li>
       	  <li class="romania-tulcea"><a href="<?php echo url_for('@cinemas_by_region?region=tulcea');?>"  cinema_count="<?php echo $cinemaCountByRegion['tulcea'];?>" class="small-link">Tulcea</a></li>
       	  <li class="romania-vaslui"><a href="<?php echo url_for('@cinemas_by_region?region=vaslui');?>"  cinema_count="<?php echo $cinemaCountByRegion['vaslui'];?>" class="small-link">Vaslui</a></li>
       	  <li class="romania-valcea"><a href="<?php echo url_for('@cinemas_by_region?region=valcea');?>"  cinema_count="<?php echo $cinemaCountByRegion['valcea'];?>" class="small-link">Valcea</a></li>
          <li class="romania-vrancea"><a href="<?php echo url_for('@cinemas_by_region?region=vrancea');?>"  cinema_count="<?php echo $cinemaCountByRegion['vrancea'];?>" class="small-link">Vrancea</a></li>
        </ul>
    	<br /><br /><br /><br /><br /><br />


    </div> <!-- romania map cell -->


	<?php if (isset($cinemas) && count($cinemas) > 0):?>
	<div class="cell spacer-bottom">
        <div class="cell-hd">
            <h3><?php echo $region;?></h3>
        </div>

        <div class="cell-bd innerspacer-bottom-m">
        	<table>
            	<tr class="cell-separator-dotted-bottom"><td class="explanation-small" style="width: 200px">Nume cinema</td>
                    <td class="explanation-small" style="width: 80px">Nr locuri</td>
                    <td class="explanation-small" style="width: 195px">Facilitati</td>
                    <td class="explanation-small" style="width: 180px">Telefon</td>
                </tr>

				<?php foreach($cinemas as $key => $cinema):?>
                <tr >
                	<td style="padding:5px 10px"><a href="<?php echo url_for('@cinema?id=' . $cinema->getId() . '&key=' . $cinema->getUrlKey());?>" class="important-link"><?php echo $cinema->getName();?></a></td>
                    <td style="padding:5px 10px"><?php echo $cinema->getSeats();?></td>
                    <td style="padding:5px 10px">
						<?php foreach($cinema->getService() as $service):?>
							<?php echo $service->getName();?><br />
						<?php endforeach;?>
					</td>
                    <td style="padding:5px 10px">
						<?php echo $cinema->getPhone();?>
					</td>
                </tr>
				<?php endforeach;?>
            </table>
        </div>
    </div> <!-- article item -->
	<?php endif;?>

</div> <!-- content column end -->

<div class="cell-container7 spacer-left"> <!-- right column start -->
	<?php include_component('default', 'rightColumn', array('page' => Page::CINEMAS));?>
</div> <!-- right column end -->

<script type="text/javascript">
	$(document).ready(function(){
		$('ul.romania > li > a').mouseover(function(){
			$('#cinema-count-number').html($(this).attr('cinema_count'));
			$('#cinema-region-container').html($(this).html());
			$('#cinema-count-container').show();
			$('#cinema-region-container').show();
		});
		$('ul.romania > li > a').mouseout(function(){
			$('#cinema-count-container').hide();
			$('#cinema-region-container').hide();
		});
	});
</script>