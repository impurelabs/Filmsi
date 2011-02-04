<h2><?php echo $person->getName();?></h2>

<div class="spacer-bottom-m">
	<a href="<?php echo url_for('@homepage');?>" class="black-link">Home</a> &raquo;
	<a href="<?php echo url_for('@person?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>" class="black-link"><?php echo $person->getName();?></a> &raquo;
        <a href="<?php echo url_for('@person_films?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>" class="black-link">Filmografie</a>
</div>


<div class="cell-container6"> <!-- left column start -->
    <div class="cell spacer-bottom-m">
        <div class="cell-hd">
            <h5>Detalii</h5>
        </div>
        <div class="cell-bd" style="padding:0">
            <ul class="filterlist spacer-bottom-m">
                <li onclick="location.href='<?php echo url_for('@person_biography?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>'"><a href="<?php echo url_for('@person_biography?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>">Biografie<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@person_awards?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>'"><a href="<?php echo url_for('@person_awards?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>">Premii<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@person_films?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>'" class="active"><a href="<?php echo url_for('@person_films?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>">Filmografie<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@person_stiri?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>'"><a href="<?php echo url_for('@person_stiri?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>">Stiri<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@person_photos?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>'"><a href="<?php echo url_for('@person_photos?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>">Fotografii<span class="filter-cioc"></span></a></li>
            </ul>
        </div>
    </div>
</div> <!-- left column end -->




<div class="cell-container5 spacer-left"> <!-- content column start -->

    
    <div class="normalcell spacer-bottom">
        <h4 class="spacer-bottom-m">Filmografie</h4>

        <?php foreach($films as $film):?>
        <div class="left align-center ml-4 mb-3">
            <a href="<?php echo url_for('@film?id=' . $film['id'] . '&key=' . $film['url_key']);?>" class="important-link">
                <img src="<?php echo filmsiFilmPhotoThumb($film['filename']);?>" style="width: 110px; border: 1px solid #d5d5d5; padding: 1px" /><br /><?php echo $film['name_en'];?>
            </a><br />
            <em>( <?php echo $film['name_ro'];?>)</em>
        </div>
        <?php endforeach;?>

        <div class="clear"></div>
    </div>
    


	






</div> <!-- content column end -->





<div class="cell-container7 spacer-left"> <!-- right column start -->
	this is the right column
</div> <!-- right column end -->