<h2><?php echo $person->getName();?></h2>

<div class="spacer-bottom-m">
	<a href="<?php echo url_for('@homepage');?>" class="black-link">Home</a> &raquo;
	<a href="<?php echo url_for('@person?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>" class="black-link"><?php echo $person->getName();?></a>
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
            <a href="#"><img src="<?php echo filmsiPersonPhoto($person->getFilename());?>" class="spacer-bottom" /></a>
            <div class="more-cell"><a href="" class="smallwhite-link">mai multe poze &raquo;</a></div>
        </div>

        <div class="normalcell">
        	<p class="spacer-bottom"><a href="" class="greenbutton-l-link"><span class="icon-bulletarrow-white"></span> Anunta-ma</a></p>
            <p class="spacer-bottom-s"><span class="icon-checkbox-checked"></span> <a href="" class="explanation-link">Cand apare pe DVD</a></p>
            <p><span class="icon-checkbox-checked"></span> <a href="" class="explanation-link">Cand apare pe Bluray</a></p>
        </div>
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






    <div class="normalcell spacer-top spacer-bottom">

    	<a href="" class="inline-block align-center" style="width: 112px; height:42px; border:1px solid #e7e7e7; border-bottom:0; position: absolute; background-color:#fff; top: -42px; left: 160px"><h3>Actor</h3></a>
        <a href="" class="inline-block align-center" style="width: 112px; height:40px; border:1px solid #e7e7e7; position: absolute; background-color:#fff; top: -42px; left: 290px"><h3 class="grey">Regizor</h3></a>

    	<table class="spacer-bottom">
        	<tr><td><h5 class="black spacer-right" style="white-space:nowrap">Premii</h5></td><td width="100%"><div class="cell-separator-double"></div></td></tr>
        </table>

        <p class="bigstronggreen spacer-bottom">Globurile de aur</p>


        <table>
        	<tr>
            	<td style="width:60px;"><p class="explanation-small cell-separator-dotted-bottom spacer-right spacer-bottom-s">Anul</p></td>
            	<td style="width:90px"><p class="explanation-small cell-separator-dotted-bottom spacer-right spacer-bottom-s">Status</p></td>
            	<td style="width:150px"><p class="explanation-small cell-separator-dotted-bottom spacer-right spacer-bottom-s">Premiu</p></td>
            	<td style="width:150px"><p class="explanation-small cell-separator-dotted-bottom spacer-right spacer-bottom-s">Nume film</p></td>
            </tr>

        	<tr>
            	<td style="width:60px;"><p class="smalltext spacer-right spacer-bottom-s spacer-top-s">2001</p></td>
            	<td style="width:90px"><p class="smalltext spacer-right spacer-bottom-s spacer-top-s">nominalizat</p></td>
            	<td style="width:150px"><p class="smalltext spacer-right spacer-bottom-s spacer-top-s">Best Performance</p></td>
            	<td style="width:150px"><a href="" class="important-link spacer-right spacer-bottom-s spacer-top-s">Meet the parents</a></td>
            </tr>

        	<tr class="odd-row">
            	<td style="width:60px;"><p class="smalltext spacer-right spacer-bottom-s spacer-top-s">1980</p></td>
            	<td style="width:90px"><p class="smalltext spacer-right spacer-bottom-s spacer-top-s red">a castigat</p></td>
            	<td style="width:150px"><p class="smalltext spacer-right spacer-bottom-s spacer-top-s">Best Performance</p></td>
            	<td style="width:150px"><a href="" class="important-link spacer-right spacer-bottom-s spacer-top-s">Meet the parents</a></td>
            </tr>

        	<tr>
            	<td style="width:60px;"><p class="smalltext spacer-right spacer-bottom-s spacer-top-s">1977</p></td>
            	<td style="width:90px"><p class="smalltext spacer-right spacer-bottom-s spacer-top-s red">a castigat</p></td>
            	<td style="width:150px"><p class="smalltext spacer-right spacer-bottom-s spacer-top-s">Best Performance</p></td>
            	<td style="width:150px"><a href="" class="important-link spacer-right spacer-bottom-s spacer-top-s">Meet the parents</a></td>
            </tr>
        </table>

        <br />
        <div class="align-right"><a href="<?php echo url_for('@person_awards?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>" class="small-link">vezi toate premiile &raquo;</a></div>











        <table class="spacer-bottom">
        	<tr><td><h5 class="black spacer-right" style="white-space:nowrap">Filme</h5></td><td width="100%"><div class="cell-separator-double"></div></td></tr>
        </table>

        <p class="bigstronggreen spacer-bottom">A jucat in</p>


        <table>
        	<tr>
            	<td style="width:60px;"><p class="explanation-small cell-separator-dotted-bottom spacer-right spacer-bottom-s">Anul</p></td>
            	<td style="width:270px"><p class="explanation-small cell-separator-dotted-bottom spacer-right spacer-bottom-s">Numele filmului</p></td>
            	<td style="width:70px"><p class="explanation-small cell-separator-dotted-bottom spacer-right spacer-bottom-s">Disponibil</p></td>
            </tr>
            <?php foreach($person->getMostViewedFilms(4) as $key => $film):?>
        	<tr<?php if ($key % 2 == 0) echo 'class="off-row"';?>>
            	<td style="width:60px;"><p class="smalltext spacer-right spacer-bottom-s spacer-top-s"><?php echo $film['year'];?></p></td>
            	<td style="width:270px"><p class="spacer-top-s spacer-bottom-s"><a href="<?php echo url_for('@film?id=' . $film['id'] . '&key=' . $film['url_key']);?>" class="important-link spacer-right spacer-bottom-s spacer-top-s"><?php echo $film['name_en'];?></a><br /><em>(<?php echo $film['name_ro'];?>)</em></p></td>
            	<td style="width:70px"><p class="spacer-bottom-s spacer-top-s"><a href="" class="small-link">Dvd</a>, <a href="" class="small-link">Bluray</a></p></td>
            </tr>
            <?php endforeach; ?>
        </table>

        <br />
        <div class="align-right"><a href="<?php echo url_for('@person_films?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>" class="small-link">vezi toate filmele &raquo;</a></div>

    </div>






</div> <!-- content column end -->





<div class="cell-container7 spacer-left"> <!-- right column start -->
	this is the right column
</div> <!-- right column end -->