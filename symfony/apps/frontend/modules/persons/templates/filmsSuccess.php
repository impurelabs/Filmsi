<h2><a href="<?php echo url_for('@person?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>"><?php echo $person->getName();?></a></h2>

<div class="spacer-bottom-m" style="margin-top: 15px">
	<a href="<?php echo url_for('@homepage');?>" class="black-link">Home</a> &raquo;
	<a href="<?php echo url_for('@person?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>" class="black-link"><?php echo $person->getName();?></a> &raquo;
        <a href="<?php echo url_for('@person_films?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>" class="black-link">Filmografie</a>
</div>


<div class="cell-container6"> <!-- left column start -->
    <div class="cell spacer-bottom-m">
        <div class="cell-hd">
            <h5><a href="<?php echo url_for('@person?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>">Detalii</a></h5>
        </div>
        <div class="cell-bd" style="padding:0">
            <ul class="filterlist spacer-bottom-m">
                <?php if ($person->getNoDisplay() != '1'):?>
                <li onclick="location.href='<?php echo url_for('@person_biography?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>'"><a href="<?php echo url_for('@person_biography?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>">Biografie<span class="filter-cioc"></span></a></li>
				<?php endif;?>
                <li onclick="location.href='<?php echo url_for('@person_awards?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>'"><a href="<?php echo url_for('@person_awards?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>">Premii<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@person_films?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>'" class="active"><a href="<?php echo url_for('@person_films?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>">Filmografie<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@person_stiri?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>'"><a href="<?php echo url_for('@person_stiri?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>">Stiri<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@person_photos?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>'"><a href="<?php echo url_for('@person_photos?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>">Fotografii<span class="filter-cioc"></span></a></li>
            </ul>
        </div>
    </div>
</div> <!-- left column end -->




<div class="cell-container5 spacer-left"> <!-- content column start -->

    
    <div class="normalcell spacer-bottom tinyMce">
        <h4 class="spacer-bottom-m">Filmografie</h4>

		<div style="display: inline-block; width: 110px" class="explanation-small"></div>
		<div class="ml-2 explanation-small" style="display: inline-block; width: 180px; vertical-align: top; text-align: right">Magazin</div>
		<div class="ml-2 explanation-small" style="display: inline-block; width: 130px; vertical-align: top; text-align: right">Vezi Online/Cumpara</div>
		
		<hr class="cell-separator-double mb-2 mt-1" />
		
        <?php foreach($sf_data->getRaw('films') as $film):?>
			<div class="align-center mb-3" style="display: inline-block; width: 110px">
				<a href="<?php echo url_for('@film?id=' . $film['id'] . '&key=' . $film['url_key']);?>" class="important-link">
					<img src="<?php echo filmsiFilmPhotoThumb($film['filename']);?>" style="width: 110px; border: 1px solid #d5d5d5; padding: 1px" /><br /><?php echo $film['name_en'];?>
				</a><br />
				<em>( <?php echo $film['name_ro'];?>)</em>
			</div>
			<div class="ml-2" style="display: inline-block; width: 330px; vertical-align: top">
				<?php foreach($film->getShops() as $shop):?>
					<div style="display: inline-block; width: 180px; vertical-align: top; text-align: right">
						<a href="<?php echo $shop['url'];?>"><?php echo $shop['name'];?></a>
					</div>
					<div style="display: inline-block; width: 130px; vertical-align: top; text-align: right; margin-left: 10px">
						<?php foreach($shop['ShopFilm'] as $shopFilm):?>
							<a href="<?php echo $shopFilm['url'];?>">
								<?php if ($shopFilm['format'] == 'dvd'):?>Cumpara DVD<?php endif;?>
								<?php if ($shopFilm['format'] == 'bluray'):?>Cumpara Bluray<?php endif;?>
								<?php if ($shopFilm['format'] == 'online'):?>Vezi Online<?php endif;?>
							</a>
							<div class="mb-1"></div>
						<?php endforeach;?>
					</div>
					<div class="mb-1"></div>
				<?php endforeach;?>
			</div>
        <?php endforeach;?>

        <div class="clear"></div>
    </div>
    


	






</div> <!-- content column end -->





<div class="cell-container7 spacer-left"> <!-- right column start -->
	<?php include_component('default', 'rightColumn', array('page' => Page::PERSON));?>
</div> <!-- right column end -->