<?php slot('festivals_layout');?>
<style type="text/css">html{ background-color: #000000 }</style>
<?php end_slot();?>

<h2>Premii si <span class="white">si festivaluri</span></h2>

<div class="spacer-bottom-m">
	<a href="<?php echo url_for('@homepage');?>" class="white-link">Home</a> <span class="white">&raquo;</span>
	<a href="<?php echo url_for('@festivals');?>" class="white-link">Festivaluri</a><span class="white">&raquo;</span>
	<a href="<?php echo url_for('@festival_edition?id=' . $edition->getId() . '&key=' . $edition->getUrlKey());?>" class="white-link"><?php echo $edition->getFestival()->getName() . ' - ' . $edition->getEdition();?></a> <span class="white">&raquo;</span>
	<a href="<?php echo url_for('@festival_edition_stiri?id=' . $edition->getId() . '&key=' . $edition->getUrlKey());?>" class="white-link">Stiri</a>
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
                <li onclick="location.href='<?php echo url_for('@festival_edition_stiri?id=' . $edition->getId() . '&key=' . $edition->getUrlKey());?>'" class="active"><a href="<?php echo url_for('@festival_edition_stiri?id=' . $edition->getId() . '&key=' . $edition->getUrlKey());?>">Stiri<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@festival_edition_winners?id=' . $edition->getId() . '&key=' . $edition->getUrlKey());?>'"><a href="<?php echo url_for('@festival_edition_winners?id=' . $edition->getId() . '&key=' . $edition->getUrlKey());?>">Castigatori &amp; nominalizati<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@festival_edition_photos?id=' . $edition->getId() . '&key=' . $edition->getUrlKey());?>'"><a href="<?php echo url_for('@festival_edition_photos?id=' . $edition->getId() . '&key=' . $edition->getUrlKey());?>">Pe covorul rosu<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@festival_edition_videos?id=' . $edition->getId() . '&key=' . $edition->getUrlKey());?>'"><a href="<?php echo url_for('@festival_edition_videos?id=' . $edition->getId() . '&key=' . $edition->getUrlKey());?>">Trailere si clipuri<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@festival_edition_judges?id=' . $edition->getId() . '&key=' . $edition->getUrlKey());?>'"><a href="<?php echo url_for('@festival_edition_judges?id=' . $edition->getId() . '&key=' . $edition->getUrlKey());?>">Juriu<span class="filter-cioc"></span></a></li>
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
                                            <a href="<?php echo url_for('@film?id=' . $stirePerson->getId() . '&key=' . $stirePerson->getUrlKey());?>"
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
			<a href="<?php echo url_for('@festival_edition_stiri?id=' . $edition->getId() . '&key=' . $edition->getUrlKey());?>?p=<?php echo $currentPage - 1;?>"><span class="pagenav-back"></span></a>
		<?php endif;?>
		<?php for ($i = 1; $i <= $pageCount; $i++):?>
			<a href="<?php echo url_for('@festival_edition_stiri?id=' . $edition->getId() . '&key=' . $edition->getUrlKey());?>?p=<?php echo $i;?>"><span class="<?php echo $i == $currentPage ? 'pagenav-active' : 'pagenav';?>"><?php echo $i;?></span></a>
		<?php endfor;?>
		<?php if($currentPage < $pageCount):?>
		<a href="<?php echo url_for('@festival_edition_stiri?id=' . $edition->getId() . '&key=' . $edition->getUrlKey());?>?&p=<?php echo $currentPage + 1;?>"><span class="pagenav-forward"></span></a>
		<?php endif;?>


        <div class="inline-block spacer-left-l">din <?php echo $stireCount;?></div>
    </div><!-- page navigator end -->

</div> <!-- content column end -->

</div><!-- container 8 end -->





<div class="cell-container7 spacer-left"> <!-- right column start -->
	<?php include_component('default', 'rightColumn', array('page' => Page::AWARD));?>
</div> <!-- right column end -->