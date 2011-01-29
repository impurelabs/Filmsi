<h2><?php echo $person->getName();?></h2>

<div class="spacer-bottom-m">
	<a href="<?php echo url_for('@homepage');?>" class="black-link">Home</a> &raquo;
	<a href="<?php echo url_for('@person?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>" class="black-link"><?php echo $person->getName();?></a> &raquo;
        <a href="<?php echo url_for('@person_biography?id=' . $person->getId() . '&key=' . $person->getUrlKey() . ($sf_request->hasParameter('p') ? '&p=' . $sf_request->getParameter('p') : ''));?>" class="black-link">Stiri</a>
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
                <li onclick="location.href='<?php echo url_for('@person_stiri?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>'" class="active"><a href="<?php echo url_for('@person_stiri?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>">Stiri<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@person_photos?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>'"><a href="<?php echo url_for('@person_photos?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>">Fotografii<span class="filter-cioc"></span></a></li>
            </ul>
        </div>
    </div>
</div> <!-- left column end -->




<div class="cell-container5 spacer-left"> <!-- content column start -->
	<?php foreach ($stires as $stire):?>
            <div class="cell spacer-bottom">
                    <div class="cell-hd" style="padding: 7px;">
                            <p class="explanation-xs"><?php echo format_date($stire->getPublishDate(), 'D', 'ro');?></p>
                            <div class="cell-separator-dotted-bottom innerspacer-bottom-s">
                                    <a href="<?php echo url_for('@stire?id=' . $stire->getId() . '&key=' . $stire->getUrlKey());?>" class="bigblue-link"><?php echo $stire->getName();?></a>
                            </div>

                            <div class="inline-block spacer-bottom innerspacer-top-s spacer-right innerspacer-right cell-separator-dotted-right">
                                    <span class="explanation-xs">Autor: <?php echo $stire->getAuthor()->getName();?></span>
                            </div>
                    </div>

                    <div class="cell-bd" style="padding: 7px;">

                            <div class="innerspacer-bottom spacer-bottom">
                                    <?php echo $stire->getContentTeaser();?>
                            </div>

                            <div class="cell-separator-dotted-bottom innerspacer-bottom spacer-bottom">
                                    <?php foreach ($stire->getPerson() as $stirePerson): ?>
                                            <a href="<?php echo url_for('@person?id=' . $stirePerson->getId() . '&key=' . $stirePerson->getUrlKey());?>"
                                               class="xs-link"><?php echo $stirePerson->getName();?></a>,
                                    <?php endforeach;?>
                                    <?php foreach ($stire->getFilm() as $stireFilm): ?>
                                            <a href="<?php echo url_for('@film?id=' . $stireFilm->getId() . '&key=' . $stireFilm->getUrlKey());?>"
                                               class="xs-link"><?php echo $stireFilm->getNameRo();?></a>,
                                    <?php endforeach;?>
                                            <?php foreach ($stire->getCinema() as $stireCinema): ?>
                                                    <a href="<?php echo url_for('@cinema?id=' . $stireCinema->getId() . '&key=' . $stireCinema->getUrlKey());?>"
                                                       class="xs-link"><?php echo $stireCinema->getName();?></a>,
                                            <?php endforeach;?>
                                            <?php foreach ($stire->getFestivalEdition() as $stireFestivalEdition): ?>
                                                    <a href="<?php echo url_for('@festivaledition?id=' . $stireFestivalEdition->getId() . '&key=' . $stireFestivalEdition->getUrlKey());?>"
                                                       class="xs-link"><?php echo $stireFestivalEdition->getName();?></a>,
                                            <?php endforeach;?>
                            </div>

                            <div class="right"><span class="more-cell-static"><a href="<?php echo url_for('@stire?id=' . $stire->getId() . '&key=' . $stire->getUrlKey());?>" class="smallwhite-link">afla tot &raquo;</a></span></div>

                            <span class="st_email" st_title="<?php echo urlencode($stire->getName());?>" ></span>
                            <span class="st_facebook" st_title="<?php echo urlencode('testare mare');?>"></span>
                            <span class="st_twitter" st_title="<?php echo urlencode($stire->getName());?>"></span>
                            <div class="inline-block"><a href="<?php echo url_for('@stire?id=' . $stire->getId() . '&key=' . $stire->getUrlKey());?>#comments"><?php echo $stire->getCountComments();?> comentarii</a></div>

                            <div class="clear"></div>
                    </div>
            </div> <!-- stire item -->


	<?php endforeach;?>








    <div class="cell-separator-dotted-top cell-separator-dotted-bottom innerspacer-bottom innerspacer-top"> <!-- page navigator start -->
		<div class="inline-block spacer-left-m spacer-right-l">Stirile <?php echo $firstStireCount;?>-<?php echo $lastStireCount;?></div>

        <?php if($currentPage > 1):?>
			<a href="<?php echo url_for('@person_stiri?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>?p=<?php echo $currentPage - 1;?>"><span class="pagenav-back"></span></a>
		<?php endif;?>
		<?php for ($i = 1; $i <= $pageCount; $i++):?>
			<a href="<?php echo url_for('@person_stiri?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>?p=<?php echo $i;?>"><span class="<?php echo $i == $currentPage ? 'pagenav-active' : 'pagenav';?>"><?php echo $i;?></span></a>
		<?php endfor;?>
		<?php if($currentPage < $pageCount):?>
		<a href="<?php echo url_for('@person_stiri?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>?&p=<?php echo $currentPage + 1;?>"><span class="pagenav-forward"></span></a>
		<?php endif;?>


        <div class="inline-block spacer-left-l">din <?php echo $stireCount;?></div>
    </div><!-- page navigator end -->

</div> <!-- content column end -->





<div class="cell-container7 spacer-left"> <!-- right column start -->
	this is the right column
</div> <!-- right column end -->