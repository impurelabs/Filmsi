<h2>Stiri din filme</h2>

<div class="spacer-bottom-m">
	<a href="<?php echo url_for('@homepage');?>" class="black-link">Home</a> &raquo;
	<a href="<?php echo url_for('@stires');?>" class="black-link">Stiri din filme</a> &raquo;
	<?php echo $stire->getName();?>
</div>






<div class="cell-container8 spacer-top-m"> <!-- content column start -->

    <div class="cell">
        <div class="cell-hd">
            <p class="explanation-xs"><?php echo format_date($stire->getPublishDate(), 'D', 'ro');?></p>
            <div class="cell-separator-dotted-bottom innerspacer-bottom-s">
                    <a href="<?php echo url_for('@stire?id=' . $stire->getId() . '&key=' . $stire->getUrlKey());?>" class="bigblue-link"><?php echo $stire->getName();?></a>
            </div>

            <div class="inline-block spacer-bottom innerspacer-top-s spacer-right innerspacer-right cell-separator-dotted-right">
                    <span class="explanation-xs">Autor: <?php echo $stire->getAuthor()->getName();?></span>
            </div>
        </div>


        <div class="cell-bd" style="padding: 7px;">
                <div class="right spacer-left"><img src="<?php echo filmsiStirePhotoThumb($stire->getFilename());?>" /></div>


                <div class="innerspacer-bottom spacer-bottom">
                        <?php echo $sf_data->getRaw('stire')->getContentContent();?>

                </div>

                <div>
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

                <div class="clear"></div>

                <div class="cell-separator-dotted-top innerspacer-top spacer-top">
                        <span class="st_email" st_title="<?php echo urlencode($stire->getName());?>" ></span>
                        <span class="st_facebook" st_title="<?php echo urlencode('testare mare');?>"></span>
                        <span class="st_twitter" st_title="<?php echo urlencode($stire->getName());?>"></span>
                        <div class="inline-block"><a href="<?php echo url_for('@stire?id=' . $stire->getId() . '&key=' . $stire->getUrlKey());?>#comments"><?php echo $stire->getCountComments();?> comentarii</a></div>
                </div>
        </div>
    </div> <!-- stire item -->

    <br />

    <?php if (count($relatedStires) > 0):?>
    <div class="cell">
        <div class="cell-hd">
            <h4>Filmsi <span class="black">a gasit pentru tine</span></h4>
        </div>
        <div class="cell-bd">
                <?php foreach($relatedStires as $relatedStire):?>
                    <?php if ($relatedStire->getId() != $stire->getId()): ?>
                        <a href="<?php echo url_for('@stire?id=' . $relatedStire->getId() . '&key=' . $relatedStire->getUrlKey());?>" class="important-link"><?php echo $relatedStire->getName();?></a><br /><br />
                    <?php endif;?>
                <?php endforeach;?>
        </div>
    </div>

    <br />
    <?php endif;?>


	<?php include_partial('comments/formAndList', array(
		'form' => $commentForm,
		'comments' => $comments,
		'action' => url_for('@stire?id=' . $stire->getId() . '&key=' . $stire->getUrlKey())
	));?>



</div> <!-- content column end -->





<div class="cell-container7 spacer-left"> <!-- right column start -->
	this is the right column
</div> <!-- right column end -->