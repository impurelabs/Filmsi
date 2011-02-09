<?php slot('festivals_layout');?>
<style type="text/css">html{ background-color: #000000 }</style>
<?php end_slot();?>

<h2>Premii si <span class="white">si festivaluri</span></h2>

<div class="spacer-bottom-m">
	<a href="<?php echo url_for('@homepage');?>" class="white-link">Home</a> <span class="white">&raquo;</span>
	<a href="<?php echo url_for('@festivals');?>" class="white-link">Festivaluri</a><span class="white">&raquo;</span>
	<a href="<?php echo url_for('@festival_edition?id=' . $edition->getId() . '&key=' . $edition->getUrlKey());?>" class="white-link"><?php echo $edition->getFestival()->getName() . ' - ' . $edition->getEdition();?></a> <span class="white">&raquo;</span>
	<a href="<?php echo url_for('@festival_edition_judges?id=' . $edition->getId() . '&key=' . $edition->getUrlKey());?>" class="white-link">Juriu</a>
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
                <li onclick="location.href='<?php echo url_for('@festival_edition_winners?id=' . $edition->getId() . '&key=' . $edition->getUrlKey());?>'"><a href="<?php echo url_for('@festival_edition_winners?id=' . $edition->getId() . '&key=' . $edition->getUrlKey());?>">Castigatori &amp; nominalizati<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@festival_edition_photos?id=' . $edition->getId() . '&key=' . $edition->getUrlKey());?>'"><a href="<?php echo url_for('@festival_edition_photos?id=' . $edition->getId() . '&key=' . $edition->getUrlKey());?>">Pe covorul rosu<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@festival_edition_videos?id=' . $edition->getId() . '&key=' . $edition->getUrlKey());?>'"><a href="<?php echo url_for('@festival_edition_videos?id=' . $edition->getId() . '&key=' . $edition->getUrlKey());?>">Trailere si clipuri<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@festival_edition_judges?id=' . $edition->getId() . '&key=' . $edition->getUrlKey());?>'" class="active"><a href="<?php echo url_for('@festival_edition_judges?id=' . $edition->getId() . '&key=' . $edition->getUrlKey());?>">Juriu<span class="filter-cioc"></span></a></li>
                </ul>
            </div>
        </div>

    </div> <!-- left column end -->


<div class="cell-container5 spacer-left"> <!-- content column start -->


    <div class="normalcell spacer-bottom">
        <h4 class="spacer-bottom-m">Juriu</h4>
		<br />

		<?php foreach ($edition->getPersons() as $judge):?>
			<div class="left spacer-bottom-m" style="width: 75px; margin-left: 40px; text-align: center; margin-right: 30px">
			<a href="<?php echo url_for('@person?id=' . $judge->getId() . '&key=' . $judge->getUrlKey());?>">
				<img src="<?php echo filmsiPersonPhotoThumb($judge->getFilename());?>" style="border: 1px solid #d5d5d5; padding: 1px" /><br />
				<?php echo $judge->getName();?>
			</a>
		</div>
		<?php endforeach;?>
		<div class="clear"></div><br />
    </div>

</div> <!-- content column end -->

</div><!-- container 8 end -->





<div class="cell-container7 spacer-left"> <!-- right column start -->
	this is the right column
</div> <!-- right column end -->