<h2><?php echo $film->getNameRo();?> <?php if ($film->getNameEn() != ''):?><span class="black">(<?php echo $film->getNameEn();?>)</span><?php endif;?></h2>

<div class="spacer-bottom-m">
	<a href="<?php echo url_for('@homepage');?>" class="black-link">Home</a> &raquo;
	<a href="<?php echo url_for('@film?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>" class="black-link"><?php echo $film->getName();?></a> &raquo;
    <a href="<?php echo url_for('@film_buy?id=' . $film->getId() . '&key=' . $film->getUrlKey() . ($sf_request->hasParameter('p') ? '&p=' . $sf_request->getParameter('p') : ''));?>" class="black-link">Cumpara pe DVD &amp; Bluray</a>
</div>


<div class="cell-container6"> <!-- left column start -->
    <div class="cell spacer-bottom-m">
        <div class="cell-hd">
            <h5>Detalii <span class="black">film</span></h5>
        </div>
        <div class="cell-bd" style="padding:0">
        	<ul class="filterlist spacer-bottom-m">
            	<li onclick="location.href='<?php echo url_for('@film_buy?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>'" class="active"><a href="<?php echo url_for('@film_buy?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>">Cumpara DVD & Bluray<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@film_cast?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>'"><a href="<?php echo url_for('@film_cast?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>">Actori & echipa<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@film_sinopsis?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>'"><a href="<?php echo url_for('@film_sinopsis?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>">Sinopsis<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@film_awards?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>'"><a href="<?php echo url_for('@film_awards?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>">Premii<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@film_articles?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>'"><a href="<?php echo url_for('@film_articles?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>">Articole despre film<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@film_comments?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>'"><a href="<?php echo url_for('@film_comments?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>">Comentariile publicului<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@film_photos?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>'"><a href="<?php echo url_for('@film_photos?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>">Fotografii din film<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@film_videos?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>'"><a href="<?php echo url_for('@film_videos?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>">Trailere si clipuri<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@film_stiri?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>'"><a href="<?php echo url_for('@film_stiri?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>">Stiri<span class="filter-cioc"></span></a></li>
            </ul>
        </div>
    </div>
</div> <!-- left column end -->




<div class="cell-container5 spacer-left"> <!-- content column start -->


    <div class="normalcell spacer-bottom">
        <h4 class="spacer-bottom-m">Cumpara pe DVD &amp Bluray</h4>
		<br />

		<?php if (count($shops['dvd']) > 0):?>
			<h6 class="mb-2">Pe DVD</h6>
			<?php foreach ($shops['dvd'] as $shop):?>
				<div class="left spacer-bottom-m align-center ml-2 mr-2" style="width: 100px">
					<div style="display: table-cell; height: 100px; width: 100px; vertical-align: middle">
						<a href="<?php echo $shop['film_url'];?>" target="_blank"><img src="<?php echo filmsiShopPhotoThumb($shop['filename']);?>"  /></a>
					</div>
				<a href="<?php echo $shop['film_url'];?>" target="_blank"><?php echo $shop['name'];?></a>
			</div>
			<?php endforeach;?>
			<div class="clear"></div><br />
		<?php endif;?>

		<?php if (count($shops['bluray']) > 0):?>
			<h6 class="mb-2">Pe DVD</h6>
			<?php foreach ($shops['dvd'] as $shop):?>
				<div class="left spacer-bottom-m align-center ml-2 mr-2" style="width: 100px">
					<div style="display: table-cell; height: 100px; width: 100px; vertical-align: middle">
						<a href="<?php echo $shop['film_url'];?>" target="_blank"><img src="<?php echo filmsiShopPhotoThumb($shop['filename']);?>"  /></a>
					</div>
				<a href="<?php echo $shop['film_url'];?>" target="_blank"><?php echo $shop['name'];?></a>
			</div>
			<?php endforeach;?>
			<div class="clear"></div><br />
		<?php endif;?>

		<?php if (count($shops['online']) > 0):?>
			<h6 class="mb-2">Pe DVD</h6>
			<?php foreach ($shops['online'] as $shop):?>
				<div class="left spacer-bottom-m align-center ml-2 mr-2" style="width: 100px">
					<div style="display: table-cell; height: 100px; width: 100px; vertical-align: middle">
						<a href="<?php echo $shop['film_url'];?>" target="_blank"><img src="<?php echo filmsiShopPhotoThumb($shop['filename']);?>"  /></a>
					</div>
				<a href="<?php echo $shop['film_url'];?>" target="_blank"><?php echo $shop['name'];?></a>
			</div>
			<?php endforeach;?>
			<div class="clear"></div><br />
		<?php endif;?>


        
    </div>

</div> <!-- content column end -->





<div class="cell-container7 spacer-left"> <!-- right column start -->
	this is the right column
</div> <!-- right column end -->