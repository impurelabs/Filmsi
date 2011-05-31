<div style="position: relative">
	<span class="icon-dvd"></span><h2 class="spacer-left-xxl">Filme <span class="black">pe Dvd & Bluray</span></h2>
</div>

<div class="spacer-bottom-m">
	<a href="<?php echo url_for('@homepage');?>" class="black-link">Home</a> &raquo;
	<a href="<?php echo url_for('@film_now_on_dvd');?>" class="black-link">Filme in cinema</a>
</div>



<div class="cell-container6"> <!-- left column start -->
	<form action="<?php echo url_for('@film_now_on_dvd?');?>" method="get" id="filter-form">


    <div class="cell mb-2">
        <div class="cell-hd">
            <h5>Alege <span class="black">tipul filmului</span></h5>
        </div>
        <div class="cell-bd" style="padding:0">
        	<ul class="filterlist spacer-bottom-s">
				<li class="format-trigger<?php if($sf_request->getParameter('format') == 'dvd') echo ' active';?>" id="format-trigger-dvd">
					Pe Dvd<span class="filter-cioc"></span>
				</li>
				<li class="format-trigger<?php if($sf_request->getParameter('format') == 'bluray') echo ' active';?>" id="format-trigger-bluray">
					Pe Bluray<span class="filter-cioc"></span>
				</li>
            </ul>
			<input type="hidden" id="format-field" name="format" value="<?php echo $sf_request->getParameter('format');?>" />
        </div>
    </div>
		
    <div class="cell mb-2">
        <div class="cell-hd">
            <h5>Alege <span class="black">genul filmului</span></h5>
        </div>
        <div class="cell-bd" style="padding:0">
        	<ul class="filterlist spacer-bottom-m">
				<?php foreach($genres as $genre):?>
					<li class="genre-trigger<?php if(in_array($genre->getId(), $sf_data->getRaw('selectedGenres'))) echo ' active';?>" id="genre-trigger-<?php echo $genre->getId();?>">
						<?php echo $genre->getName();?><span class="filter-cioc"></span>
						<input type="checkbox" id="genre-field-<?php echo $genre->getId();?>" class="display-none" name="genres[]"<?php if(in_array($genre->getId(), $sf_data->getRaw('selectedGenres'))) echo ' checked="checked"';?> value="<?php echo $genre->getId();?>" />
					</li>
				<?php endforeach;?>
            </ul>
        </div>
    </div>



    <div class="cell mb-2">
        <div class="cell-hd">
            <h5>Film <span class="black">pentru</span></h5>
        </div>
        <div class="cell-bd" style="padding:0">
        	<ul class="filterlist spacer-bottom-m">
				<?php foreach($ratings as $key => $rating):?>
					<li class="rating-trigger<?php if(in_array($key, $sf_data->getRaw('selectedRatings'))) echo ' active';?>" id="rating-trigger-<?php echo $key;?>">
						<?php echo $rating;?><span class="filter-cioc"></span>
						<input type="checkbox" class="display-none" id="rating-field-<?php echo $key;?>" name="ratings[]"<?php if(in_array($key, $sf_data->getRaw('selectedRatings'))) echo ' checked="checked"';?> value="<?php echo $key;?>" />
					</li>
				<?php endforeach;?>
            </ul>
        </div>
    </div>



    <div class="cell spacer-bottom-m">
        <div class="cell-hd">
            <h5>Premii</h5>
        </div>
        <div class="cell-bd" style="padding:0">
        	<ul class="filterlist spacer-bottom-m">
				<?php foreach($awards as $award):?>
					<li class="award-trigger<?php if(in_array($award->getId(), $sf_data->getRaw('selectedAwards'))) echo ' active';?>" id="award-trigger-<?php echo $award->getId();?>">
						<?php echo $award->getName();?><span class="filter-cioc"></span>
						<input type="checkbox" class="display-none" id="award-field-<?php echo $award->getId();?>" name="awards[]"<?php if(in_array($award->getId(), $sf_data->getRaw('selectedAwards'))) echo ' checked="checked"';?> value="<?php echo $award->getId();?>" />
					</li>
				<?php endforeach;?>
            </ul>
        </div>
    </div>
</form>
</div> <!-- left column end -->




<div class="cell-container5 spacer-left"> <!-- content column start -->

    <div class="normalcell spacer-bottom">
    	<div class="left" style="width: 40px"><h5>Buzz</h5></div>
        <ul class="list2 left spacer-left-m" style="width: 390px">
        	<?php foreach($stires as $stire):?>
			<li><a href="<?php echo url_for('@stire?id=' . $stire['id'] . '&key=' . $stire['url_key']);?>" class="black-link"><?php echo $stire['name'];?></a></li>
			<?php endforeach;?>
        </ul>
        <div class="clear"></div>
    </div>


    <div class="spacer-bottom">
    	<button class="normalbutton spacer-left" onclick="location.href='<?php echo url_for('@film_now_on_dvd');?>'"><span class="icon-buttonbullet-green"></span> <span class="bigstronggreen">Filme lansate deja</span></button>
        <button class="normalbutton spacer-left-m" onclick="location.href='<?php echo url_for('@film_soon_on_dvd');?>'"><span class="icon-buttonbullet-grey"></span> <span class="bigstronggrey">Se lanseaza in curand</span></button>
    </div>



	<div class="normalcell pt-3" style="padding-left:15px">

		<?php foreach ($films as $film):?>
    	<div class="mb-3" style="display: inline-block; vertical-align: top; width: 131px; margin-left: 7px; margin-right: 7px">
        	<div class="innerspacer-bottom-s spacer-bottom-s cell-separator-dotted-bottom">
                <a href="<?php echo url_for('@film?id=' . $film['id'] . '&key=' . $film['url_key']);?>"><img src="<?php echo filmsiFilmPhotoThumb($film['filename']);?>" style="width: 131px" /></a><br />
                <a href="<?php echo url_for('@film?id=' . $film['id'] . '&key=' . $film['url_key']);?>" class="important-link"><?php echo $film['name_ro'];?></a>
        	</div>
            <div>
            	<span class="icon-bulletarrow spacer-right-s"></span> <a href="<?php echo url_for('@film_buy?id=' . $film['id'] . '&key=' . $film['url_key']);?>" class="small-link">Cumpara acum</a><br />
            	<span class="icon-bulletarrow spacer-right-s"></span> <a href="<?php echo url_for('@film_videos?id=' . $film['id'] . '&key=' . $film['url_key']);?>" class="small-link">Vezi trailer</a><br />
            </div>
        </div>
		<?php endforeach;?>

    	

        <div class="clear"></div>
    </div>







    <div class="cell-separator-dotted-top cell-separator-dotted-bottom innerspacer-bottom innerspacer-top"> <!-- page navigator start -->
		<div class="inline-block spacer-left-m spacer-right-l">Filmele <?php echo $firstFilmCount;?>-<?php echo $lastFilmCount;?></div>

        <?php if($currentPage > 1):?>
			<a href="<?php echo url_for('@film_now_on_dvd');?>?<?php if ($parameterQuery != '') echo $parameterQuery . '&';?>p=<?php echo $currentPage - 1;?>"><span class="pagenav-back"></span></a>
		<?php endif;?>
		<?php for ($i = 1; $i <= $pageCount; $i++):?>
			<a href="<?php echo url_for('@film_now_on_dvd');?>?<?php if ($parameterQuery != '') echo $parameterQuery . '&';?>p=<?php echo $i;?>"><span class="<?php echo $i == $currentPage ? 'pagenav-active' : 'pagenav';?>"><?php echo $i;?></span></a>
		<?php endfor;?>
		<?php if($currentPage < $pageCount):?>
		<a href="<?php echo url_for('@film_now_on_dvd');?>?<?php if ($parameterQuery != '') echo $parameterQuery . '&';?>p=<?php echo $currentPage + 1;?>"><span class="pagenav-forward"></span></a>
		<?php endif;?>


        <div class="inline-block spacer-left-l">din <?php echo $filmCount;?></div>
    </div><!-- page navigator end -->

</div> <!-- content column end -->





<div class="cell-container7 spacer-left"> <!-- right column start -->
	<?php include_component('default', 'rightColumn', array('page' => Page::ON_DVD));?>
</div> <!-- right column end -->


<script type="text/javascript">
	$(document).ready(function(){
		$('.day-trigger').click(function(){
			id = $(this).attr('id').substr()
		});

		$('.genre-trigger').click(function(){
			id = $(this).attr('id').substr(14);
			if ($('#genre-field-' + id).is(':checked')){
				$('#genre-trigger-' + id).removeClass('active');
				$('#genre-field-' + id).removeAttr('checked');
			} else {
				$('#genre-trigger-' + id).addClass('active');
				$('#genre-field-' + id).attr('checked', 'checked');
			}
			$('#filter-form').submit();
		});

		$('.rating-trigger').click(function(){
			id = $(this).attr('id').substr(15);
			if ($('#rating-field-' + id).is(':checked')){
				$('#rating-trigger-' + id).removeClass('active');
				$('#rating-field-' + id).removeAttr('checked');
			} else {
				$('#rating-trigger-' + id).addClass('active');
				$('#rating-field-' + id).attr('checked', 'checked');
			}
			$('#filter-form').submit();
		});

		$('.award-trigger').click(function(){
			id = $(this).attr('id').substr(14);
			if ($('#award-field-' + id).is(':checked')){
				$('#award-trigger-' + id).removeClass('active');
				$('#award-field-' + id).removeAttr('checked');
			} else {
				$('#award-trigger-' + id).addClass('active');
				$('#award-field-' + id).attr('checked', 'checked');
			}
			$('#filter-form').submit();
		});

		$('#format-trigger-dvd').click(function(){
			if ($('#format-field').val() == 'dvd'){
				$('#format-field').val('');
			} else {
				$('#format-field').val('dvd');
			}
			$('#filter-form').submit();
		});

		$('#format-trigger-bluray').click(function(){
			if ($('#format-field').val() == 'bluray'){
				$('#format-field').val('');
			} else {
				$('#format-field').val('bluray');
			}
			$('#filter-form').submit();
		});
	});
</script>