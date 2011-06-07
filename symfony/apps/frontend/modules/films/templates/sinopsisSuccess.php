<?php slot('backgroundTag');?>
<div style="width: <?php echo $backgroundWidth;?>px; margin: 0 auto; background: url('<?php echo filmsiFilmBackground($film->getBackgroundFilename());?>') top no-repeat">
<?php end_slot();?>

<h2><a href="<?php echo url_for('@film?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>"><?php echo $film->getNameRo();?><span class="black"> - <?php echo $film->getYear();?> <?php if ($film->getNameEn() != ''):?>(<?php echo $film->getNameEn();?>)<?php endif;?></span></a></h2>

<div class="spacer-bottom-m">
	<a href="<?php echo url_for('@homepage');?>" class="black-link">Home</a> &raquo;
	<a href="<?php echo url_for('@film?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>" class="black-link"><?php echo $film->getName();?></a> &raquo;
    <a href="<?php echo url_for('@film_stiri?id=' . $film->getId() . '&key=' . $film->getUrlKey() . ($sf_request->hasParameter('p') ? '&p=' . $sf_request->getParameter('p') : ''));?>" class="black-link">Sinopsis</a>
</div>


<div class="cell-container6"> <!-- left column start -->
    <div class="cell spacer-bottom-m">
        <div class="cell-hd">
            <h5><a href="<?php echo url_for('@film?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>">Detalii <span class="black">film</span></a></h5>
        </div>
        <div class="cell-bd" style="padding:0">
        	<?php include_component('films', 'menu', array('film' => $film, 'current' => 'synopsis')); ?>
        </div>
    </div>
</div> <!-- left column end -->




<div class="cell-container5 spacer-left"> <!-- content column start -->


    <div class="normalcell spacer-bottom tinyMce">
        <h4 class="spacer-bottom-m">Sinopsis</h4>

        <?php echo $sf_data->getRaw('film')->getDescriptionContent();?>
    </div>

</div> <!-- content column end -->





<div class="cell-container7 spacer-left"> <!-- right column start -->
	<?php include_component('default', 'rightColumn', array('page' => Page::FILM));?>
</div> <!-- right column end -->