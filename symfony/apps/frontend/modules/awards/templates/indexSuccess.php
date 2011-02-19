<?php slot('festivals_layout');?>
<style type="text/css">html{ background-color: #000000 }</style>
<?php end_slot();?>

<h2>Premii si <span class="white">si festivaluri</span></h2>

<div class="spacer-bottom-m">
	<a href="<?php echo url_for('@homepage');?>" class="white-link">Home</a> <span class="white">&raquo;</span>
	<a href="<?php echo url_for('@festivals');?>" class="white-link">Festivaluri</a>
	<?php if ($sf_request->hasParameter('id')):?>
		<span class="white">&raquo;</span>
		<a href="<?php echo url_for('@festival?id=' . $currentFestivalId);?>" class="white-link"><?php echo $currentFestival->getName();?></a>
	<?php endif;?>
</div>


<div class="cell-container6"> <!-- left column start -->
    <div class="cell spacer-bottom-m">
        <div class="cell-hd">
            <h5>Premii <span class="black">si festivaluri</span></h5>
        </div>
        <div class="cell-bd" style="padding:0">
            <ul class="filterlist spacer-bottom-m">
				<?php foreach ($festivals as $festival):?>
                <li onclick="location.href='<?php echo url_for('@festival?id=' . $festival->getId());?>'"<?php if($sf_request->getParameter('id', '') == $festival->getId()) echo ' class="active"';?>>
					<a href="<?php echo url_for('@festival?id=' . $festival->getId());?>"><?php echo $festival->getName();?><span class="filter-cioc"></span></a>
				</li>
				<?php endforeach;?>
            </ul>
        </div>
    </div>
</div> <!-- left column end -->




<div class="cell-container5 spacer-left"> <!-- content column start -->

    <?php if ($stires->count() > 0):?>
	<div class="normalcell spacer-bottom">
            <div class="left" style="width: 40px"><h5>Buzz</h5></div>
            <ul class="list2 left spacer-left-m" style="width: 390px">
                <?php foreach($stires as $stiretire):?>
                    <li><a href="<?php echo url_for('@stire?id=' . $stiretire->getId() . '&key=' . $stiretire->getUrlKey());?>" class="black-link"><?php echo $stiretire->getName();?></a></li>
                <?php endforeach;?>
            </ul>
            <div class="clear"></div>
        </div>
    <?php endif;?>


	<?php foreach ($editions as $edition):?>
	<div class="cell spacer-bottom">
        <div class="cell-hd">
            	<a href="<?php echo url_for('@festival_edition?id=' . $edition->getId() . '&key=' . $edition->getUrlKey());?>" class="bigblue-link"><?php echo $edition->getEdition();?> <?php echo $edition->getFestival()->getName();?></a>
        </div>

        <div class="cell-bd">
        	<div class="align-center spacer-bottom-s">
				<a href="<?php echo url_for('@festival_edition?id=' . $edition->getId() . '&key=' . $edition->getUrlKey());?>"><img src="<?php echo image_path(filmsiFestivalEditionPhotoThumb($edition->getFilename()));?>" /></a>
            </div>

            <div class="cell-separator-dotted-top innerspacer-top innerspacer-left spacer-top">
                <div class="right"><span class="more-cell-static"><a href="<?php echo url_for('@festival_edition?id=' . $edition->getId() . '&key=' . $edition->getUrlKey());?>" class="smallwhite-link">afla tot &raquo;</a></span></div>

                <span class="st_email" st_title="" ></span>
				<span class="st_facebook" st_title=""></span>
				<span class="st_twitter" st_title=""></span>
                <div class="inline-block"><a href="<?php echo url_for('@festival_edition?id=' . $edition->getId() . '&key=' . $edition->getUrlKey());?>#comments"><?php echo $edition->getCountComments();?> comentarii</a></div>

                <div class="clear"></div>
            </div>
        </div>
    </div> <!-- article item -->
	<?php endforeach;?>


	

	<div class="cell-separator-dotted-top cell-separator-dotted-bottom innerspacer-bottom innerspacer-top"> <!-- page navigator start -->
		<div class="inline-block spacer-left-m spacer-right-l white">Editiile <?php echo $firstEditionCount;?>-<?php echo $lastEditionCount;?></div>

        <?php if($currentPage > 1):?>
		<a href="<?php echo $sf_request->hasParameter('id') ? url_for('@festival?id=' . $sf_request->getParameter('id')) . '&p=' . $currentPage - 1 : url_for('@festivals') . '?p=' .$currentPage - 1;?>"><span class="pagenav-back"></span></a>
		<?php endif;?>
		<?php for ($i = 1; $i <= $pageCount; $i++):?>
			<a href="<?php echo $sf_request->hasParameter('id') ? url_for('@festival?id=' . $sf_request->getParameter('id')) . '&p=' . $currentPage - 1 : url_for('@festivals') . '?p=' . $i;?>"><span class="<?php echo $i == $currentPage ? 'pagenav-active' : 'pagenav';?>"><?php echo $i;?></span></a>
		<?php endfor;?>
		<?php if($currentPage < $pageCount):?>
		<a href="<?php echo $sf_request->hasParameter('id') ? url_for('@festival?id=' . $sf_request->getParameter('id')) . '&p=' . $currentPage + 1 : url_for('@festivals') . '?p=' . $currentPage + 1;?>"><span class="pagenav-forward"></span></a>
		<?php endif;?>


        <div class="inline-block spacer-left-l white">din <?php echo $editionCount;?></div>
    </div><!-- page navigator end -->



</div> <!-- content column end -->





<div class="cell-container7 spacer-left"> <!-- right column start -->
	this is the right column
</div> <!-- right column end -->