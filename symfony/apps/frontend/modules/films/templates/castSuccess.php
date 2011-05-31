<?php slot('backgroundTag');?>
<div style="width: <?php echo $backgroundWidth;?>px; margin: 0 auto; background: url('<?php echo filmsiFilmBackground($film->getBackgroundFilename());?>') top no-repeat">
<?php end_slot();?>

<h2><a href="<?php echo url_for('@film?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>"><?php echo $film->getNameRo();?> <?php if ($film->getNameEn() != ''):?><span class="black">(<?php echo $film->getNameEn();?>)</span><?php endif;?></a></h2>

<div class="spacer-bottom-m">
	<a href="<?php echo url_for('@homepage');?>" class="black-link">Home</a> &raquo;
	<a href="<?php echo url_for('@film?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>" class="black-link"><?php echo $film->getName();?></a> &raquo;
    <a href="<?php echo url_for('@film_cast?id=' . $film->getId() . '&key=' . $film->getUrlKey() . ($sf_request->hasParameter('p') ? '&p=' . $sf_request->getParameter('p') : ''));?>" class="black-link">Actori &amp; echipa</a>
</div>


<div class="cell-container6"> <!-- left column start -->
    <div class="cell spacer-bottom-m">
        <div class="cell-hd">
            <h5><a href="<?php echo url_for('@film?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>">Detalii <span class="black">film</span></a></h5>
        </div>
        <div class="cell-bd" style="padding:0">
        	<ul class="filterlist spacer-bottom-m">
            	<li onclick="location.href='<?php echo url_for('@film_buy?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>'"><a href="<?php echo url_for('@film_buy?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>">Cumpara DVD & Bluray<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@film_cast?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>'" class="active"><a href="<?php echo url_for('@film_cast?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>">Actori & echipa<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@film_sinopsis?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>'"><a href="<?php echo url_for('@film_sinopsis?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>">Sinopsis<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@film_awards?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>'"><a href="<?php echo url_for('@film_awards?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>">Premii<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@film_articles?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>'"><a href="<?php echo url_for('@film_articles?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>">Articole despre film<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@film_comments?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>'"><a href="<?php echo url_for('@film_comments?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>">Comentariile publicului<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@film_photos?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>'"><a href="<?php echo url_for('@film_photos?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>">Fotografii din film<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@film_redcarpet?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>'"><a href="<?php echo url_for('@film_redcarpet?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>">Fotografii de la premiera<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@film_videos?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>'"><a href="<?php echo url_for('@film_videos?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>">Trailere si clipuri<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@film_stiri?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>'"><a href="<?php echo url_for('@film_stiri?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>">Stiri<span class="filter-cioc"></span></a></li>
            </ul>
        </div>
    </div>
</div> <!-- left column end -->




<div class="cell-container5 spacer-left"> <!-- content column start -->


    <div class="normalcell spacer-bottom">
        <h4 class="spacer-bottom-m">Actori &amp; echipa</h4>
		<br />

		<?php if ($directors->count() > 0):?>
			<h6 class="mb-2">Regizori</h6>
			<?php foreach ($directors as $director):?>
				<div class="spacer-bottom-m" style="display: inline-block; vertical-align: top; width: 75px; margin-left: 15px; text-align: center; margin-right: 15px">
				<a href="<?php echo url_for('@person?id=' . $director->getId() . '&key=' . $director->getUrlKey());?>">
					<img src="<?php echo filmsiPersonPhotoThumb($director->getFilename());?>" style="border: 1px solid #d5d5d5; padding: 1px; width: 75px" /><br />
					<?php echo $director->getName();?>
				</a>
			</div>
			<?php endforeach;?>
			<div class="clear"></div><br />
		<?php endif;?>

		<?php if ($actors->count() > 0):?>
			<h6 class="mb-2">Actori</h6>
			<?php foreach ($actors as $actor):?>
				<div class="spacer-bottom-m" style="display: inline-block; vertical-align: top; width: 75px; margin-left: 15px; text-align: center; margin-right: 15px">
				<a href="<?php echo url_for('@person?id=' . $actor->getId() . '&key=' . $actor->getUrlKey());?>">
					<img src="<?php echo filmsiPersonPhotoThumb($actor->getFilename());?>" style="border: 1px solid #d5d5d5; padding: 1px; width: 75px" /><br />
					<?php echo $actor->getName();?>
				</a>
			</div>
			<?php endforeach;?>
			<div class="clear"></div><br />
		<?php endif;?>


		<?php if ($scriptwriters->count() > 0):?>
			<h6 class="mb-2">Scenaristi</h6>
			<?php foreach ($scriptwriters as $scriptwriter):?>
				<div class="spacer-bottom-m" style="display: inline-block; vertical-align: top; width: 75px; margin-left: 15px; text-align: center; margin-right: 15px">
				<a href="<?php echo url_for('@person?id=' . $scriptwriter->getId() . '&key=' . $scriptwriter->getUrlKey());?>">
					<img src="<?php echo filmsiPersonPhotoThumb($scriptwriter->getFilename());?>" style="border: 1px solid #d5d5d5; padding: 1px; width: 75px" /><br />
					<?php echo $scriptwriter->getName();?>
				</a>
			</div>
			<?php endforeach;?>
			<div class="clear"></div><br />
		<?php endif;?>


		<?php if ($producers->count() > 0):?>
			<h6 class="mb-2">Producatori</h6>
			<?php foreach ($producers as $producer):?>
				<div class="spacer-bottom-m" style="display: inline-block; vertical-align: top; width: 75px; margin-left: 15px; text-align: center; margin-right: 15px">
				<a href="<?php echo url_for('@person?id=' . $producer->getId() . '&key=' . $producer->getUrlKey());?>">
					<img src="<?php echo filmsiPersonPhotoThumb($producer->getFilename());?>" style="border: 1px solid #d5d5d5; padding: 1px; width: 75px" /><br />
					<?php echo $producer->getName();?>
				</a>
			</div>
			<?php endforeach;?>
			<div class="clear"></div><br />
		<?php endif;?>
        
    </div>

</div> <!-- content column end -->





<div class="cell-container7 spacer-left"> <!-- right column start -->
	<?php include_component('default', 'rightColumn', array('page' => Page::FILM));?>
</div> <!-- right column end -->