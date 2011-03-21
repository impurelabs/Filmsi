<h2><a href="<?php echo url_for('@person?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>"><?php echo $person->getName();?></a></h2>

<div class="spacer-bottom-m">
	<a href="<?php echo url_for('@homepage');?>" class="black-link">Home</a> &raquo;
	<a href="<?php echo url_for('@person?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>" class="black-link"><?php echo $person->getName();?></a>
</div>


<div class="cell-container6"> <!-- left column start -->
    <div class="cell spacer-bottom-m">
        <div class="cell-hd">
            <h5><a href="<?php echo url_for('@person?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>">Detalii</a></h5>
        </div>
        <div class="cell-bd" style="padding:0">
            <ul class="filterlist spacer-bottom-m">
                <li onclick="location.href='<?php echo url_for('@person_biography?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>'"><a href="<?php echo url_for('@person_biography?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>">Biografie<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@person_awards?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>'"><a href="<?php echo url_for('@person_awards?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>">Premii<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@person_films?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>'"><a href="<?php echo url_for('@person_films?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>">Filmografie<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@person_stiri?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>'"><a href="<?php echo url_for('@person_stiri?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>">Stiri<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@person_photos?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>'"><a href="<?php echo url_for('@person_photos?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>">Fotografii<span class="filter-cioc"></span></a></li>
            </ul>
        </div>
    </div>
</div> <!-- left column end -->




<div class="cell-container5 spacer-left"> <!-- content column start -->

    <?php if (count($person->getRelatedStires(3)) > 0):?>
	<div class="normalcell spacer-bottom">
            <div class="left" style="width: 40px"><h5>Buzz</h5></div>
            <ul class="list2 left spacer-left-m" style="width: 390px">
                <?php foreach($person->getRelatedStires(3) as $relatedStire):?>
                    <li><a href="<?php echo url_for('@stire?id=' . $relatedStire['id'] . '&key=' . $relatedStire['url_key']);?>" class="black-link"><?php echo $relatedStire['name'];?></a></li>
                <?php endforeach;?>
            </ul>
            <div class="clear"></div>
        </div>
    <?php endif;?>


	<div class="left" style="width:150px">
    	<div class="normalcell spacer-bottom-m align-center">
            <a href="<?php echo url_for('@person_photos?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>"><img src="<?php echo filmsiPersonPhoto($person->getFilename());?>" class="spacer-bottom" /></a>
            <div class="more-cell"><a href="<?php echo url_for('@person_photos?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>" class="smallwhite-link">mai multe poze &raquo;</a></div>
        </div>

        <?php include_partial('persons/alert', array('personId' => $person->getId()));?>
    </div>




    <div class="normalcell left spacer-left" style="width:305px; padding:10px 5px">
    	<h4 class="spacer-bottom-s"><?php echo $person->getName();?></h4>
    	<div class="cell-separator-double spacer-bottom"></div>

        <p class="explanation-small">Nascut: <?php echo format_date($person->getDateOfBirth(), 'D', 'ro');?>, <?php echo $person->getPlaceOfBirth();?></p>


        <div class="cell-separator-double spacer-bottom spacer-top"></div>
        <strong>Biografie</strong><br />
        <?php echo $person->getBiographyTeaser();?>

        <div class="more-cell"><a href="<?php echo url_for('@person_biography?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>" class="smallwhite-link">afla mai multe &raquo;</a></div>

    </div>





    <div class="clear"></div>




<br /><br />

    <div class="normalcell spacer-top spacer-bottom">
        <?php if($person->getIsActor() == '1'):?>
    	<a href="<?php echo url_for('@actor?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>"
           class="inline-block align-center"
           style="width: 80px; border:1px solid #e7e7e7; height:<?php echo $personRole == 'actor' ? '33px; border-bottom:0; ' : '32px;';?> position: absolute; background-color:#fff; top: -34px; left: 10px"><h5<?php if($personRole != 'actor') echo ' class="grey"';?>>Actor</h5></a>
        <?php endif;?>
        <?php if($person->getIsDirector() == '1'):?>
        <a href="<?php echo url_for('@director?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>"
           class="inline-block align-center"
           style="width: 100px; border:1px solid #e7e7e7; height:<?php echo $personRole == 'director' ? '33px; border-bottom:0; ' : '32px;';?>px; position: absolute; background-color:#fff; top: -34px; left: 110px"><h5<?php if($personRole != 'director') echo ' class="grey"';?>>Regizor</h5></a>
        <?php endif;?>
        <?php if($person->getIsScriptwriter() == '1'):?>
    	<a href="<?php echo url_for('@scriptwriter?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>"
           class="inline-block align-center"
           style="width: 112px; border:1px solid #e7e7e7; height:<?php echo $personRole == 'scriptwriter' ? '33px; border-bottom:0; ' : '32px;';?>px; border-bottom:0; position: absolute; background-color:#fff; top: -34px; left: 230px"><h5<?php if($personRole != 'scriptwriter') echo ' class="grey"';?>>Scenarist</h5></a>
        <?php endif;?>
        <?php if($person->getIsProducer() == '1'):?>
        <a href="<?php echo url_for('@producer?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>"
           class="inline-block align-center"
           style="width: 112px; border:1px solid #e7e7e7; height:<?php echo $personRole == 'producer' ? '33px; border-bottom:0; ' : '32px;';?>px; position: absolute; background-color:#fff; top: -34px; left: 355px"><h5<?php if($personRole != 'producer') echo ' class="grey"';?>>Producator</h5></a>
        <?php endif;?>

    	
        <table class="spacer-bottom">
        	<tr><td><h5 class="black spacer-right" style="white-space:nowrap">Filme</h5></td><td width="100%"><div class="cell-separator-double"></div></td></tr>
        </table>

        <?php if (isset($films[0])):?>
        <div class="left align-center">
            <a href="<?php echo url_for('@film?id=' . $films[0]['id'] . '&key=' . $films[0]['url_key']);?>" class="important-link">
                <img src="<?php echo filmsiFilmPhotoThumb($films[0]['filename']);?>" style="width: 100px" /><br /><?php echo $films[0]['name_en'];?>
            </a><br />
            <em>( <?php echo $films[0]['name_ro'];?>)</em>
        </div>
        <?php endif;?>

        <?php if (isset($films[1])):?>
        <div class="left ml-2 align-center">
            <a href="<?php echo url_for('@film?id=' . $films[1]['id'] . '&key=' . $films[1]['url_key']);?>" class="important-link">
                <img src="<?php echo filmsiFilmPhotoThumb($films[1]['filename']);?>" style="width: 100px" /><br /><?php echo $films[1]['name_en'];?>
            </a><br />
            <em>( <?php echo $films[1]['name_ro'];?>)</em>
        </div>
        <?php endif;?>

        <?php if (isset($films[2])):?>
        <div class="left ml-2 align-center">
            <a href="<?php echo url_for('@film?id=' . $films[2]['id'] . '&key=' . $films[2]['url_key']);?>" class="important-link">
                <img src="<?php echo filmsiFilmPhotoThumb($films[2]['filename']);?>" style="width: 100px" /><br /><?php echo $films[2]['name_en'];?>
            </a><br />
            <em>( <?php echo $films[2]['name_ro'];?>)</em>
        </div>
        <?php endif;?>

        <?php if (isset($films[3])):?>
        <div class="left ml-2 align-center">
            <a href="<?php echo url_for('@film?id=' . $films[3]['id'] . '&key=' . $films[3]['url_key']);?>" class="important-link">
                <img src="<?php echo filmsiFilmPhotoThumb($films[3]['filename']);?>" style="width: 100px" /><br /><?php echo $films[3]['name_en'];?>
            </a><br />
            <em>( <?php echo $films[3]['name_ro'];?>)</em>
        </div>
        <?php endif;?>

        <div class="clear"></div>

        <br /><br />

        <?php if (isset($films[4])):?>
            <p class="bigstronggreen spacer-bottom">A mai jucat in</p>
            <table>
                    <tr>
                    <td style="width:60px;"><p class="explanation-small cell-separator-dotted-bottom spacer-right spacer-bottom-s">Anul</p></td>
                    <td style="width:270px"><p class="explanation-small cell-separator-dotted-bottom spacer-right spacer-bottom-s">Numele filmului</p></td>
                    <td style="width:70px"><p class="explanation-small cell-separator-dotted-bottom spacer-right spacer-bottom-s">Disponibil</p></td>
                </tr>
                <?php for($i = 4; $i <= 7; $i++):?>
                    <?php if (isset($films[$i])):?>
                        <tr<?php if ($i % 2 == 0) echo 'class="off-row"';?>>
                        <td style="width:60px;"><p class="smalltext spacer-right spacer-bottom-s spacer-top-s"><?php echo $films[$i]['year'];?></p></td>
                        <td style="width:270px"><p class="spacer-top-s spacer-bottom-s"><a href="<?php echo url_for('@film?id=' . $films[$i]['id'] . '&key=' . $films[$i]['url_key']);?>" class="important-link spacer-right spacer-bottom-s spacer-top-s"><?php echo $films[$i]['name_en'];?></a><br /><em>(<?php echo $films[$i]['name_ro'];?>)</em></p></td>
                        <td style="width:70px"><p class="spacer-bottom-s spacer-top-s"><a href="<?php echo url_for('@film_buy?id=' . $films[$i]['id'] . '&key=' . $films[$i]['url_key']);?>#dvd" class="small-link">Dvd</a>, <a href="<?php echo url_for('@film_buy?id=' . $fim[$i]['id'] . '&key=' . $films[$i]['url_key']);?>#dvd" class="small-link">Bluray</a></p></td>
                    <?php endif;?>
                </tr>
                <?php endfor; ?>
            </table>

        <br />
        <div class="align-right"><a href="<?php echo url_for('@person_films?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>" class="small-link">vezi toate filmele &raquo;</a></div>
        <?php endif;?>

    </div>

    <?php if (count($awards) > 0):?>
        <div class="normalcell spacer-top spacer-bottom">

            <table class="spacer-bottom">
                    <tr><td><h5 class="black spacer-right" style="white-space:nowrap">Premii</h5></td><td width="100%"><div class="cell-separator-double"></div></td></tr>
            </table>


            <table>
                <tr>
                    <td><p class="explanation-small cell-separator-dotted-bottom spacer-right spacer-bottom-s">Festival</p></td>
                    <td><p class="explanation-small cell-separator-dotted-bottom spacer-right spacer-bottom-s">Status</p></td>
                    <td><p class="explanation-small cell-separator-dotted-bottom spacer-right spacer-bottom-s">Film</p></td>
                </tr>
                <?php foreach($awards as $award):?>
                <tr>
                    <td>
                        <p class="smalltext spacer-right spacer-bottom-s spacer-top-s">
                            <span class="strong"><?php echo $award['f_name'] . '-' . $award['fe_edition'];?></span><br /><?php echo $award['fs_name'];?>
                        </p>
                    </td>
                    <td>
                        <p class="smalltext spacer-right spacer-bottom-s spacer-top-s">
                            <?php echo $award['fsp_is_winner'] == '1' ? '<span class="red">castigator</span>' : 'nominalizat';?>
                        </p>
                    </td>
                    <td>
                        <a href="<?php echo url_for('@film?id=' . $award['film']['id'] . '&key=' . $award['film']['url_key']);?>" class="important-link spacer-right spacer-bottom-s spacer-top-s"><?php echo $award['film']['name_en'];?></a>
                    </td>
                </tr>
                <?php endforeach;?>
            </table>

            <br />
            <div class="align-right"><a href="<?php echo url_for('@person_awards?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>" class="small-link">vezi toate premiile &raquo;</a></div>

        </div>
        <?php endif;?>






</div> <!-- content column end -->





<div class="cell-container7 spacer-left"> <!-- right column start -->
	<?php include_component('default', 'rightColumn', array('page' => Page::PERSON));?>
</div> <!-- right column end -->

