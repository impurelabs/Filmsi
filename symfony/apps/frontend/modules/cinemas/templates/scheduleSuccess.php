<h2><a href="<?php echo url_for('@cinema?id=' . $cinema->getId() . '&key=' . $cinema->getUrlKey());?>"><?php echo $cinema->getName();?></a></h2>

<div class="spacer-bottom-m" style="margin-top: 15px">
	<a href="<?php echo url_for('@homepage');?>" class="black-link">Home</a> &raquo;
	<a href="<?php echo url_for('@cinemas');?>" class="black-link">Cinematografe</a> &raquo;
	<a href="<?php echo url_for('@cinema?id=' . $cinema->getId() . '&key=' . $cinema->getUrlKey());?>" class="black-link"><?php echo $cinema->getName();?></a> &raquo;
	<a href="<?php echo url_for('@cinema_schedule?id=' . $cinema->getId() . '&key=' . $cinema->getUrlKey());?>" class="black-link">Program</a>
</div>




<div class="cell-container6"> <!-- left column start -->


    <div class="cell spacer-bottom-m">
        <div class="cell-hd">
            <h5><a href="<?php echo url_for('@cinema?id=' . $cinema->getId() . '&key=' . $cinema->getUrlKey());?>">Detalii <span class="black">cinema</span></a></h5>
        </div>
        <div class="cell-bd" style="padding:0">
        	<ul class="filterlist spacer-bottom-m">
                <li onclick="location.href='<?php echo url_for('@cinema_description?id=' . $cinema->getId() . '&key=' . $cinema->getUrlKey());?>'"><a href="<?php echo url_for('@cinema_description?id=' . $cinema->getId() . '&key=' . $cinema->getUrlKey());?>">Prezentare<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@cinema_schedule?id=' . $cinema->getId() . '&key=' . $cinema->getUrlKey());?>'" class="active"><a href="<?php echo url_for('@cinema_schedule?id=' . $cinema->getId() . '&key=' . $cinema->getUrlKey());?>">Program<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@cinema_tickets?id=' . $cinema->getId() . '&key=' . $cinema->getUrlKey());?>'"><a href="<?php echo url_for('@cinema_tickets?id=' . $cinema->getId() . '&key=' . $cinema->getUrlKey());?>">Pret bilete<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@cinema_promotions?id=' . $cinema->getId() . '&key=' . $cinema->getUrlKey());?>'"><a href="<?php echo url_for('@cinema_promotions?id=' . $cinema->getId() . '&key=' . $cinema->getUrlKey());?>">Promotii<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@cinema_stiri?id=' . $cinema->getId() . '&key=' . $cinema->getUrlKey());?>'"><a href="<?php echo url_for('@cinema_stiri?id=' . $cinema->getId() . '&key=' . $cinema->getUrlKey());?>">Noutati<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@cinema_photos?id=' . $cinema->getId() . '&key=' . $cinema->getUrlKey());?>'"><a href="<?php echo url_for('@cinema_photos?id=' . $cinema->getId() . '&key=' . $cinema->getUrlKey());?>">Fotografii<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@cinema_comments?id=' . $cinema->getId() . '&key=' . $cinema->getUrlKey());?>'"><a href="<?php echo url_for('@cinema_comments?id=' . $cinema->getId() . '&key=' . $cinema->getUrlKey());?>">Parerea publicului<span class="filter-cioc"></span></a></li>
            </ul>
        </div>
    </div>


</div> <!-- left column end -->



<div class="cell-container5 spacer-left"> <!-- content column start -->

	
    <div class="cell spacer-bottom-m innerspacer-bottom-m">
        <div class="cell-hd">
            <h4>Program</h4>
        </div>

        <div class="cell-bd">
			<?php if(count($film) == 0):?>
			<br /><br /><br /><br />
			<h5>Ne cerem scuze ! <br />Chiar in aceste momente actualizam programul cinematografelor. <br />Reveniti pentru detalii.</h5>
			<br /><br /><br /><br />
			<?php endif;?>
			
        	<?php foreach ($films as $film):?>
				<div class="left" style="width: 220px">
					<a href="<?php echo url_for('@film?id=' . $film['film']['id'] . '&key=' . $film['film']['url_key']);?>">
						<img src="<?php echo filmsiFilmPhotoThumbS($film['film']['filename']);?>" class="left" />
					</a>
					<div class="left spacer-left">
						<a href="<?php echo url_for('@film?id=' . $film['film']['id'] . '&key=' . $film['film']['url_key']);?>" class="important-link"><?php echo $film['film']['name_ro'];?></a> <br />
						<?php if ($film['film']['name_en'] != ''): ?><em>(<?php echo $film['film']['name_en'];?>)</em><?php endif;?>
					</div>
				</div>

				<div class="left innerspacer-left cell-separator-dotted-left" style="width: 230px">
					<table>
						<tr>
							<td class="explanation-small" style="width: 70px">Zile</td>
							<td class="explanation-small" style="width: 70px">Ore</td>
							<td class="explanation-small" style="width: 50px">Rezerve bilete</td>
						</tr>
						<?php foreach ($film['schedules'] as $schedule):?>
							<tr>
								<td style="padding:5px 5px"><strong><?php echo format_date($schedule['day'], 'm', 'ro');?></strong></td>
								<td style="padding:5px 5px"><span class="smalltext"><?php echo $schedule['schedule'];?></span></td>
								<td style="padding:5px 10px"><a href="<?php echo $cinema->getReservationUrl();?>" class="greenbutton-s-link" target="_blank">Rezerva</a></td>
							</tr>
						<?php endforeach;?>

					</table>

				</div>

				<div class="clear"></div>

				<hr class="cell-separator-double spacer-top spacer-bottom" />
			<?php endforeach;?>
        </div>
    </div>





</div> <!-- content column end -->









<div class="cell-container7 spacer-left"> <!-- right column start -->
	<?php include_component('default', 'rightColumn', array('page' => Page::CINEMA));?>
</div> <!-- right column end -->

