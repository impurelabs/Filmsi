<h2><?php echo $cinema->getName();?></h2>

<div class="spacer-bottom-m">
	<a href="<?php echo url_for('@homepage');?>" class="black-link">Home</a> &raquo;
	<a href="<?php echo url_for('@cinemas');?>" class="black-link">Cinematografe</a> &raquo;
	<a href="<?php echo url_for('@cinema?id=' . $cinema->getId() . '&key=' . $cinema->getUrlKey());?>" class="black-link"><?php echo $cinema->getName();?></a> &raquo;
	<a href="<?php echo url_for('@cinema_photos?id=' . $cinema->getId() . '&key=' . $cinema->getUrlKey());?>" class="black-link">Fotografii</a>
</div>




<div class="cell-container6"> <!-- left column start -->


    <div class="cell spacer-bottom-m">
        <div class="cell-hd">
            <h5>Detalii <span class="black">cinema</span></h5>
        </div>
        <div class="cell-bd" style="padding:0">
        	<ul class="filterlist spacer-bottom-m">
                <li onclick="location.href='<?php echo url_for('@cinema_description?id=' . $cinema->getId() . '&key=' . $cinema->getUrlKey());?>'"><a href="<?php echo url_for('@cinema_description?id=' . $cinema->getId() . '&key=' . $cinema->getUrlKey());?>">Prezentare<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@cinema_schedule?id=' . $cinema->getId() . '&key=' . $cinema->getUrlKey());?>'"><a href="<?php echo url_for('@cinema_schedule?id=' . $cinema->getId() . '&key=' . $cinema->getUrlKey());?>">Program<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@cinema_tickets?id=' . $cinema->getId() . '&key=' . $cinema->getUrlKey());?>'"><a href="<?php echo url_for('@cinema_tickets?id=' . $cinema->getId() . '&key=' . $cinema->getUrlKey());?>">Pret bilete<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@cinema_promotions?id=' . $cinema->getId() . '&key=' . $cinema->getUrlKey());?>'"><a href="<?php echo url_for('@cinema_promotions?id=' . $cinema->getId() . '&key=' . $cinema->getUrlKey());?>">Promotii<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@cinema_stiri?id=' . $cinema->getId() . '&key=' . $cinema->getUrlKey());?>'"><a href="<?php echo url_for('@cinema_stiri?id=' . $cinema->getId() . '&key=' . $cinema->getUrlKey());?>">Noutati<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@cinema_photos?id=' . $cinema->getId() . '&key=' . $cinema->getUrlKey());?>'" class="active"><a href="<?php echo url_for('@cinema_photos?id=' . $cinema->getId() . '&key=' . $cinema->getUrlKey());?>">Fotografii<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@cinema_comments?id=' . $cinema->getId() . '&key=' . $cinema->getUrlKey());?>'"><a href="<?php echo url_for('@cinema_comments?id=' . $cinema->getId() . '&key=' . $cinema->getUrlKey());?>">Parerea publicului<span class="filter-cioc"></span></a></li>
            </ul>
        </div>
    </div>


</div> <!-- left column end -->



<div class="cell-container5 spacer-left"> <!-- content column start -->


    <div class="spacer-bottom">
    	<?php if ($currentPhoto < $photoCount):?>
    	<a href="<?php echo url_for('@cinema_photos?id=' . $cinema->getId() . '&key=' . $cinema->getUrlKey());?>?pid=<?php echo $currentPhoto + 1;?>" class="right"><span class="pagenav-forward"></span></a>
        <?php endif;?>
        <?php if ($currentPhoto > 1):?>
	<a href="<?php echo url_for('@cinema_photos?id=' . $cinema->getId() . '&key=' . $cinema->getUrlKey());?>?pid=<?php echo $currentPhoto - 1;?>" class="left"><span class="pagenav-back"></span></a>
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
    	<a href="<?php echo url_for('@cinema_photos?id=' . $cinema->getId() . '&key=' . $cinema->getUrlKey());?>?pid=<?php echo $currentPhoto + 1;?>" class="right"><span class="pagenav-forward"></span></a>
        <?php endif;?>
        <?php if ($currentPhoto > 1):?>
	<a href="<?php echo url_for('@cinema_photos?id=' . $cinema->getId() . '&key=' . $cinema->getUrlKey());?>?pid=<?php echo $currentPhoto - 1;?>" class="left"><span class="pagenav-back"></span></a>
        <?php endif;?>
        <div class="align-center explanation-small"><?php echo $currentPhoto;?> din <?php echo $photoCount;?></div>
        <div class="clear"></div>
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
        <div class="cell-hd"><h4>Fotografii <span class="black">cu <?php echo $cinema->getName();?></span></h4></div>
        <div class="cell-bd">
            <?php foreach($photos as $photo):?>
            <div class="inline-block align-center spacer-bottom-m ml-3" style="width: 125px; vertical-align: middle">
                <a href="<?php echo url_for('@cinema_photos?id=' . $cinema->getId() . '&key=' . $cinema->getUrlKey());?>?pid=<?php echo $photo->getPosition();?>"><img src="<?php echo filmsiPhotoThumbS($photo->getFilename());?>" /></a> <br />
                <a href="<?php echo url_for('@cinema_photos?id=' . $cinema->getId() . '&key=' . $cinema->getUrlKey());?>?pid=<?php echo $photo->getPosition();?>" class="black-link"><?php echo $photo->getDescription();?></a> <br />
            </div>
            <?php endforeach;?>
        </div>
    </div>

</div> <!-- content column end -->









<div class="cell-container7 spacer-left"> <!-- right column start -->
	<?php include_component('default', 'rightColumn', array('page' => Page::CINEMA));?>
</div> <!-- right column end -->

