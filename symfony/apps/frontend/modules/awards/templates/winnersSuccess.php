<?php slot('festivals_layout');?>
<style type="text/css">html{ background-color: #000000 }</style>
<?php end_slot();?>

<h2>Premii si <span class="white">si festivaluri</span></h2>

<div class="spacer-bottom-m" style="margin-top: 15px">
	<a href="<?php echo url_for('@homepage');?>" class="white-link">Home</a> <span class="white">&raquo;</span>
	<a href="<?php echo url_for('@festivals');?>" class="white-link">Festivaluri</a><span class="white">&raquo;</span>
	<a href="<?php echo url_for('@festival_edition?id=' . $edition->getId() . '&key=' . $edition->getUrlKey());?>" class="white-link"><?php echo $edition->getFestival()->getName() . ' - ' . $edition->getEdition();?></a> <span class="white">&raquo;</span>
	<a href="<?php echo url_for('@festival_edition_winners?id=' . $edition->getId() . '&key=' . $edition->getUrlKey());?>" class="white-link">Castigatori &amp; nominalizati</a>
</div>


<div class="cell-container8"> <!-- content column start -->



	<h2 class="spacer-bottom"><span class="white"><?php echo $edition->getFestival()->getName();?> - <?php echo $edition->getEdition();?></span></h2>


    <div class="cell-container6"> <!-- left column start -->

        <div class="cell spacer-bottom-m">
            <div class="cell-hd">
                <h4>Detalii</h4>
            </div>
            <div class="cell-bd" style="padding:0">
                <ul class="filterlist spacer-bottom-m">
                <li onclick="location.href='<?php echo url_for('@festival_edition_stiri?id=' . $edition->getId() . '&key=' . $edition->getUrlKey());?>'"><a href="<?php echo url_for('@festival_edition_stiri?id=' . $edition->getId() . '&key=' . $edition->getUrlKey());?>">Stiri<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@festival_edition_winners?id=' . $edition->getId() . '&key=' . $edition->getUrlKey());?>'" class="active"><a href="<?php echo url_for('@festival_edition_winners?id=' . $edition->getId() . '&key=' . $edition->getUrlKey());?>">Castigatori &amp; nominalizati<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@festival_edition_photos?id=' . $edition->getId() . '&key=' . $edition->getUrlKey());?>'"><a href="<?php echo url_for('@festival_edition_photos?id=' . $edition->getId() . '&key=' . $edition->getUrlKey());?>">Pe covorul rosu<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@festival_edition_videos?id=' . $edition->getId() . '&key=' . $edition->getUrlKey());?>'"><a href="<?php echo url_for('@festival_edition_videos?id=' . $edition->getId() . '&key=' . $edition->getUrlKey());?>">Trailere si clipuri<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@festival_edition_judges?id=' . $edition->getId() . '&key=' . $edition->getUrlKey());?>'"><a href="<?php echo url_for('@festival_edition_judges?id=' . $edition->getId() . '&key=' . $edition->getUrlKey());?>">Juriu<span class="filter-cioc"></span></a></li>
                </ul>
            </div>
        </div>

    </div> <!-- left column end -->


<div class="cell-container5 spacer-left"> <!-- content column start -->


    <div class="normalcell spacer-bottom">
        <h4 class="spacer-bottom-m">Castigatori &amp; nominalizati</h4>
		<br />

		<?php foreach($edition->getFestivalSections() as $section):?>
			<h5><?php echo $section->getName();?></h5>
			<table>
				<?php foreach ($section->getParticipants() as $winner):?>
					<tr>
						<td>
							<a href="<?php echo url_for('@film?id=' . $winner['film']['id'] . '&key=' . $winner['film']['url_key']);?>" class="important-link"><?php echo $winner['film']['name_ro'];?></a>
							<?php if (isset($winner['persons'])):?>
								<br />
								<?php foreach($winner['persons'] as $person):?>
									<a href="<?php echo url_for('@person?id=' . $person['id'] . '&key=' . $person['url_key']);?>" class="small-link"><?php echo $person['first_name'] . ' ' . $person['last_name'];?></a>,
								<?php endforeach;?>
							<?php endif;?>
						</td>
						<td align="right">
							<?php if($winner['is_winner'] == '1'):?>
								<span class="smalltext red">castigator</span>
							<?php else: ?>
								<span class="smalltext">nominalizat</span>
							<?php endif;?>
						</td>
					</tr>
				<?php endforeach;?>
			</table>
		<?php endforeach;?>
		<div class="clear"></div><br />
    </div>

</div> <!-- content column end -->

</div><!-- container 8 end -->





<div class="cell-container7 spacer-left"> <!-- right column start -->
	<?php include_component('default', 'rightColumn', array('page' => Page::AWARD));?>
</div> <!-- right column end -->