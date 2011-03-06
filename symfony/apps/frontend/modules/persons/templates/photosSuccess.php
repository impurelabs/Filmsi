<h2><?php echo $person->getName();?></h2>

<div class="spacer-bottom-m">
	<a href="<?php echo url_for('@homepage');?>" class="black-link">Home</a> &raquo;
	<a href="<?php echo url_for('@person?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>" class="black-link"><?php echo $person->getName();?></a> &raquo;
        <a href="<?php echo url_for('@person_biography?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>" class="black-link">Fotografii</a>
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
                <li onclick="location.href='<?php echo url_for('@person_photos?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>'" class="active"><a href="<?php echo url_for('@person_photos?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>">Fotografii<span class="filter-cioc"></span></a></li>
            </ul>
        </div>
    </div>
</div> <!-- left column end -->




<div class="cell-container5 spacer-left"> <!-- content column start -->


    <div class="spacer-bottom">
    	<?php if ($currentPhoto < $photoCount):?>
    	<a href="<?php echo url_for('@person_photos?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>?pid=<?php echo $currentPhoto + 1;?>" class="right"><span class="pagenav-forward"></span></a>
        <?php endif;?>
        <?php if ($currentPhoto > 1):?>
	<a href="<?php echo url_for('@person_photos?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>?pid=<?php echo $currentPhoto - 1;?>" class="left"><span class="pagenav-back"></span></a>
        <?php endif;?>
        <div class="align-center explanation-small"><?php echo $currentPhoto;?> din <?php echo $photoCount;?></div>
        <div class="clear"></div>
    </div>

    <div class="align-center">
        <img src="<?php echo filmsiPhoto($photos[$currentPhoto - 1]->getFilename());?>" />
    </div>

    <?php if ($photos[$currentPhoto - 1]->getDescription() != ''):?>
		<div class="normalcell"><?php echo $photos[$currentPhoto - 1]->getDescription();?></div>
	<?php endif;?>

    <div class="spacer-bottom spacer-top">
    	<?php if ($currentPhoto < $photoCount):?>
    	<a href="<?php echo url_for('@person_photos?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>?pid=<?php echo $currentPhoto + 1;?>" class="right"><span class="pagenav-forward"></span></a>
        <?php endif;?>
        <?php if ($currentPhoto > 1):?>
	<a href="<?php echo url_for('@person_photos?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>?pid=<?php echo $currentPhoto - 1;?>" class="left"><span class="pagenav-back"></span></a>
        <?php endif;?>
        <div class="align-center explanation-small"><?php echo $currentPhoto;?> din <?php echo $photoCount;?></div>
        <div class="clear"></div>
    </div>

    <div class="normalcell">
        <button class="announcement spacer-bottom left spacer-right-l"></button>
        <p><span class="icon-checkbox-checked"></span> <a href="" class="explanation-link">Cand se lanseaza in cinema</a></p>
        <p><span class="icon-checkbox-checked"></span> <a href="" class="explanation-link">Cand se lanseaza pe DVD</a></p>
    </div>



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
        <div class="cell-hd"><h4>Fotografii <span class="black">cu <?php echo $person->getName();?></span></h4></div>
        <div class="cell-bd">
            <?php foreach($photos as $photo):?>
            <div class="inline-block align-center spacer-bottom-m ml-3" style="width: 125px; vertical-align: middle">
                <a href="<?php echo url_for('@person_photos?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>?pid=<?php echo $photo->getPosition();?>"><img src="<?php echo filmsiPhotoThumbS($photo->getFilename());?>" /></a> <br />
                <a href="<?php echo url_for('@person_photos?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>?pid=<?php echo $photo->getPosition();?>" class="black-link"><?php echo $photo->getDescription();?></a> <br />
            </div>
            <?php endforeach;?>
        </div>
    </div>

</div> <!-- content column end -->





<div class="cell-container7 spacer-left"> <!-- right column start -->
	<?php include_component('default', 'rightColumn', array('page' => Page::PERSON));?>
</div> <!-- right column end -->