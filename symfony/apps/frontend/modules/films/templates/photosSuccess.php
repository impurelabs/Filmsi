<?php slot('backgroundTag');?>
<div style="width: <?php echo $backgroundWidth;?>px; margin: 0 auto; background: url('<?php echo filmsiFilmBackground($film->getBackgroundFilename());?>') top no-repeat">
<?php end_slot();?>

<h2><a href="<?php echo url_for('@film?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>"><?php echo $film->getNameRo();?><span class="black"> - <?php echo $film->getYear();?> <?php if ($film->getNameEn() != ''):?>(<?php echo $film->getNameEn();?>)<?php endif;?></span></a></h2>

<div class="spacer-bottom-m" style="margin-top: 15px">
	<a href="<?php echo url_for('@homepage');?>" class="black-link">Home</a> &raquo;
	<a href="<?php echo url_for('@film?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>" class="black-link"><?php echo $film->getName();?></a> &raquo;
        <a href="<?php echo url_for('@film_photos?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>" class="black-link">Fotografii din film</a>
</div>


<div class="cell-container6"> <!-- left column start -->
    <div class="cell spacer-bottom-m">
        <div class="cell-hd">
            <h5><a href="<?php echo url_for('@film?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>">Detalii <span class="black">film</span></a></h5>
        </div>
        <div class="cell-bd" style="padding:0">
        	<?php include_component('films', 'menu', array('film' => $film, 'current' => 'photos')); ?>
        </div>
    </div>
</div> <!-- left column end -->




<div class="cell-container5 spacer-left"> <!-- content column start -->


    <div class="spacer-bottom">
		<a name="scrolled"></a>
    	<?php if ($currentPhoto < $photoCount):?>
    	<a href="<?php echo url_for('@film_photos?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>?pid=<?php echo $currentPhoto + 1;?>#scrolled" class="right"><span class="pagenav-forward"></span></a>
        <?php endif;?>
        <?php if ($currentPhoto > 1):?>
	<a href="<?php echo url_for('@film_photos?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>?pid=<?php echo $currentPhoto - 1;?>#scrolled" class="left"><span class="pagenav-back"></span></a>
        <?php endif;?>
        <div class="align-center explanation-small"><?php echo $currentPhoto;?> din <?php echo $photoCount;?></div>
        <div class="clear"></div>
    </div>

    <div class="align-center">
        <img src="<?php echo filmsiPhoto($currentPhotoObject->getFilename());?>" />
    </div>

	<?php if ($photos[$currentPhoto - 1]->getDescription() != ''):?>
		<div class="normalcell"><?php echo $photos[$currentPhoto - 1]->getDescription();?></div>
	<?php endif;?>

    <div class="spacer-bottom spacer-top">
    	<?php if ($currentPhoto < $photoCount):?>
    	<a href="<?php echo url_for('@film_photos?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>?pid=<?php echo $currentPhoto + 1;?>#scrolled" class="right"><span class="pagenav-forward"></span></a>
        <?php endif;?>
        <?php if ($currentPhoto > 1):?>
	<a href="<?php echo url_for('@film_photos?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>?pid=<?php echo $currentPhoto - 1;?>#scrolled" class="left"><span class="pagenav-back"></span></a>
        <?php endif;?>
        <div class="align-center explanation-small"><?php echo $currentPhoto;?> din <?php echo $photoCount;?></div>
        <div class="clear"></div>
    </div>

    <?php include_partial('films/alert1', array('filmId' => $film->getId()));?>



    <div class="normalcell spacer-top spacer-bottom">
    	<div>
            <div class="right innerspacer-right spacer-right-m"><span class="st_email_large" st_title="" ></span></div>
            <div class="right innerspacer-right spacer-right-m"><span class="st_facebook_large" st_title=""></span></div>
            <div class="right innerspacer-right spacer-right-m"><span class="st_twitter_large" st_title=""></span></div>

            <div class="inline-block spacer-right-l">Spune si prietenilor tai pe</div>

            <div class="clear"></div>
        </div>
    </div>

    <div class="cell spacer-bottom-m">
        <div class="cell-hd"><h4>Fotografii <span class="black">cu <?php echo $film->getName();?></span></h4></div>
        <div class="cell-bd">
            <?php foreach($photos as $photo):?>
            <div class="inline-block align-center spacer-bottom-m ml-3" style="width: 125px; vertical-align: middle">
                <a href="<?php echo url_for('@film_photos?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>?pid=<?php echo $photo->getPosition();?>#scrolled"><img src="<?php echo filmsiPhotoThumbS($photo->getFilename());?>" /></a> <br />
                <a href="<?php echo url_for('@film_photos?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>?pid=<?php echo $photo->getPosition();?>#scrolled" class="black-link"><?php echo $photo->getDescription();?></a> <br />
            </div>
            <?php endforeach;?>
        </div>
    </div>

</div> <!-- content column end -->





<div class="cell-container7 spacer-left"> <!-- right column start -->
	<?php include_component('default', 'rightColumn', array('page' => Page::FILM));?>
</div> <!-- right column end -->