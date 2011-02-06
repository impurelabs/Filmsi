<h2>Trailere</h2>

<div class="spacer-bottom-m">
	<a href="<?php echo url_for('@homepage');?>" class="black-link">Home</a> &raquo;
	<a href="<?php echo url_for('@trailers');?>" class="black-link">Trailere</a>
	<?php if($sf_request->hasParameter('acum-in-cinema')):?>
		&raquo; <a href="<?php echo url_for('@trailers');?>?acum-in-cinema" class="black-link">Acum in cinema</a>
	<?php endif;?>
	<?php if($sf_request->hasParameter('in-curand-in-cinema')):?>
		&raquo; <a href="<?php echo url_for('@trailers');?>?in-curand-in-cinema" class="black-link">In curand in cinema</a>
	<?php endif;?>
	<?php if($sf_request->hasParameter('acum-pe-dvd-bluray')):?>
		&raquo; <a href="<?php echo url_for('@trailers');?>?acum-pe-dvd-bluray" class="black-link">Acum pe DVD & Bluray</a>
	<?php endif;?>
	<?php if($sf_request->hasParameter('la-tv')):?>
		&raquo; <a href="<?php echo url_for('@trailers');?>?la-tv" class="black-link">Acum La Tv</a>
	<?php endif;?>
	<?php if (isset($currentTrailer)):?>
	&raquo;
	<a href="<?php echo url_for('@trailer?id=' . $currentTrailer['video_id']);?>" class="black-link"><?php echo $currentTrailer['name_ro'];?></a>
	<?php endif;?>
</div>


<div class="cell-container8"> <!-- content column start -->

	<?php if (isset($currentTrailer)):?>
		<?php echo filmsiVideoBig($currentTrailer['video_code']);?>

		<div class="normalcell spacer-bottom">
			<p class="bigstronggreen"><?php echo $currentTrailer['name_ro'];?> <span class="black"><?php echo $currentTrailer['year'];?></span></p>
			<?php if ($currentTrailer['name_en'] != ''):?><em>(<?php echo $currentTrailer['name_en'];?>)</em><?php endif;?>

			<hr class="cell-separator-double spacer-top spacer-bottom" />

			<div class="left" style="width: 325px">

				<span class="inline-block cell-separator-dotted-right innerspacer-right-s"><a href="<?php echo url_for('@film?id=' . $currentTrailer['id'] . '&key=' . $currentTrailer['url_key']);?>" class="small-link">Informatii despre film</a></span>
				<span class="inline-block cell-separator-dotted-right innerspacer-right-s innerspacer-left-s"><a href="<?php echo url_for('@film_photos?id=' . $currentTrailer['id'] . '&key=' . $currentTrailer['url_key']);?>" class="small-link">Fotografii</a></span>
				<span class="inline-block cell-separator-dotted-right innerspacer-right-s innerspacer-left-s"><a href="<?php echo url_for('@film_cast?id=' . $currentTrailer['id'] . '&key=' . $currentTrailer['url_key']);?>" class="small-link">Actori</a></span>
				<span class="inline-block  innerspacer-left-s"><a href="<?php echo url_for('@film_videos?id=' . $currentTrailer['id'] . '&key=' . $currentTrailer['url_key']);?>" class="small-link">Alte clipuri</a></span>
			</div>

			<div class="left" style="width: 325px">
				<table>
					<tr>
						<td class="smalltext innerspacer-bottom" style="width: 75px; vertical-align: top"><strong>Cu</strong></td>
						<td class="innerspacer-bottom">
							<?php foreach($actors as $actor):?>
							<a href="<?php echo url_for('@person?id=' . $actor->getId() . '&key=' . $actor->getUrlKey());?>" class="small-link"><?php echo $actor->getName();?></a>,
							<?php endforeach;?>
						</td>
					</tr>
					<tr>
						<td class="smalltext" style="width: 75px; vertical-align: top"><strong>Regia</strong></td>
						<td>
							<?php foreach($directors as $director):?>
							<a href="<?php echo url_for('@person?id=' . $director->getId() . '&key=' . $director->getUrlKey());?>" class="small-link"><?php echo $director->getName();?></a>,
							<?php endforeach;?>
						</td>
					</tr>
				</table>
			</div>


			<div class="clear"></div>

			<hr class="cell-separator-double spacer-top spacer-bottom" />

			<div class="normalcell spacer-top spacer-bottom">
				<div>
					<div class="right innerspacer-right spacer-right-m"><span class="st_email_large" st_title="" ></span></div>
					<div class="right innerspacer-right spacer-right-m"><span class="st_facebook_large" st_title=""></span></div>
					<div class="right innerspacer-right spacer-right-m"><span class="st_twitter_large" st_title=""></span></div>

					<div class="inline-block spacer-right-l">Spune si prietenilor tai pe</div>

					<div class="clear"></div>
				</div>
			</div>

			<div class="clear"></div>

		</div>
	<?php endif;?>











	<div class="cell innerspacer-bottom">
    	<div class="cell-hd">
        	<h4>
				<?php if ($sf_request->hasParameter('acum-in-cinema')):?>
				Acum <span class="black">in cinema</span>
				<?php elseif($sf_request->hasParameter('in-curand-in-cinema')):?>
				In curand <span class="black">in cinema</span>
				<?php elseif($sf_request->hasParameter('acum-pe-dvd-bluray')):?>
				Acum <span class="black">pe DVD &amp; Bluray</span>
				<?php elseif($sf_request->hasParameter('la-tv')):?>
				Acum <span class="black">la TV</span>
				<?php else:?>
				Toate <span class="black">trailerele</span>
				<?php endif;?>

			</h4>
        </div>
        <div class="cell-bd">
        	<ul class="left" style="width: 150px; background-color: #e9e9e9; padding: 5px;">
            	<li class="spacer-bottom"><a href="<?php echo url_for('@trailers');?>?acum-in-cinema" class="important-link">Acum in cinema</a></li>
                <li class="spacer-bottom"><a href="<?php echo url_for('@trailers');?>?in-curand-in-cinema" class="important-link">In curand in cinema</a></li>
                <li class="spacer-bottom"><a href="<?php echo url_for('@trailers');?>?acum-pe-dvd-bluray" class="important-link">Acum pe DVD&amp;Bluray</a></li>
                <li class="spacer-bottom"><a href="<?php echo url_for('@trailers');?>?la-tv" class="important-link">Acum la TV</a></li>
            </ul>

            <div class="left spacer-left" style="width: 490px">
				<div class="cell-bd innerspacer-bottom-m">
					<?php foreach($trailers as $trailer):?>
					<div class="inline-block align-center spacer-bottom-m ml-3" style="width: 125px; vertical-align: middle">
						<a href="<?php echo url_for('@trailer?id=' . $trailer['video_id']);?><?php if($sf_request->hasParameter('acum-in-cinema')) echo '?acum-in-cinema';?><?php if($sf_request->hasParameter('in-curand-in-cinema')) echo '?in-curand-in-cinema';?><?php if($sf_request->hasParameter('acum-pe-dvd-bluray')) echo '?acum-pe-dvd-bluray';?><?php if($sf_request->hasParameter('la-tv')) echo '?la-tv';?>">
							<img src="<?php echo filmsiVideoThumb($trailer['video_code']);?>" />
						</a> <br />
						<a href="<?php echo url_for('@trailer?id=' . $trailer['video_id']);?>" class="black-link">
							<?php echo $trailer['name_ro'];?>
						</a> <br />
					</div>
					<?php endforeach;?>
				</div>


                <hr class="cell-separator-double spacer-top spacer-bottom" />


            </div>


            <div class="clear"></div>
        </div>


    </div>


	

	<div class="cell-separator-dotted-top cell-separator-dotted-bottom innerspacer-bottom innerspacer-top"> <!-- page navigator start -->
		<div class="inline-block spacer-left-m spacer-right-l">Trailerele <?php echo $firstTrailerCount;?>-<?php echo $lastTrailerCount;?></div>

        <?php if($currentPage > 1):?>
			<a href="<?php echo url_for('@trailers');?>?p=<?php echo $currentPage - 1;?><?php if($sf_request->hasParameter('acum-in-cinema')) echo '&acum-in-cinema';?><?php if($sf_request->hasParameter('in-curand-in-cinema')) echo '&in-curand-in-cinema';?><?php if($sf_request->hasParameter('acum-pe-dvd-bluray')) echo '&acum-pe-dvd-bluray';?><?php if($sf_request->hasParameter('la-tv')) echo '&la-tv';?>"><span class="pagenav-back"></span></a>
		<?php endif;?>
		<?php for ($i = 1; $i <= $pageCount; $i++):?>
			<a href="<?php echo url_for('@trailers');?>?p=<?php echo $i;?><?php if($sf_request->hasParameter('acum-in-cinema')) echo '&acum-in-cinema';?><?php if($sf_request->hasParameter('in-curand-in-cinema')) echo '&in-curand-in-cinema';?><?php if($sf_request->hasParameter('acum-pe-dvd-bluray')) echo '&acum-pe-dvd-bluray';?><?php if($sf_request->hasParameter('la-tv')) echo '&la-tv';?>"><span class="<?php echo $i == $currentPage ? 'pagenav-active' : 'pagenav';?>"><?php echo $i;?></span></a>
		<?php endfor;?>
		<?php if($currentPage < $pageCount):?>
		<a href="<?php echo url_for('@trailers');?>?p=<?php echo $currentPage + 1;?><?php if($sf_request->hasParameter('acum-in-cinema')) echo '&acum-in-cinema';?><?php if($sf_request->hasParameter('in-curand-in-cinema')) echo '&in-curand-in-cinema';?><?php if($sf_request->hasParameter('acum-pe-dvd-bluray')) echo '&acum-pe-dvd-bluray';?><?php if($sf_request->hasParameter('la-tv')) echo '&la-tv';?>"><span class="pagenav-forward"></span></a>
		<?php endif;?>


        <div class="inline-block spacer-left-l">din <?php echo $trailerCount['count'];?></div>
    </div><!-- page navigator end -->


</div> <!-- content column end -->





<div class="cell-container7 spacer-left"> <!-- right column start -->
	this is the right column
</div> <!-- right column end -->