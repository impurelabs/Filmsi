<h4>Gadget-uri</h4>

<div class="cell-separator-double mt-3 mb-3"></div>

<h5><?php echo Gadget::getNameById(Gadget::MOST_READ_ARTICLES);?></h5>
<div class="right" style="width: 400px">
	<strong>Cod embed:</strong><br />
	<textarea style="width: 400px; height: 50px"><iframe scrolling="no" frameborder="0" allowtransparency="true" style="width: 300px; height: <?php echo Gadget::getHeightById(Gadget::MOST_READ_ARTICLES);?>px;" class="mb-2" src="http://<?php echo $sf_request->getHost();?>/gadgets?gid=<?php echo Gadget::MOST_READ_ARTICLES;?>"></iframe></textarea>
</div>
<div>
	<strong>Pagini in care apare:</strong><br />
	<?php if (isset($pagesByGadget[Gadget::MOST_READ_ARTICLES])):?>
		<?php foreach($pagesByGadget[Gadget::MOST_READ_ARTICLES] as $page):?>
			<?php echo Page::getNameById($page);?>,
		<?php endforeach;?>
	<?php endif;?><br />
	<a href="<?php echo url_for('@default?module=gadgets&action=editPages');?>?gid=<?php echo Gadget::MOST_READ_ARTICLES;?>">editeaza</a>
</div>
<div class="clear"></div>

<div class="cell-separator-double mt-3 mb-3"></div>

<h5><?php echo Gadget::getNameById(Gadget::MOST_READ_STIRES);?></h5>
<div class="right" style="width: 400px">
	<strong>Cod embed:</strong><br />
	<textarea style="width: 400px; height: 50px"><iframe scrolling="no" frameborder="0" allowtransparency="true" style="width: 300px; height: <?php echo Gadget::getHeightById(Gadget::MOST_READ_STIRES);?>px;" class="mb-2" src="http://<?php echo $sf_request->getHost();?>/gadgets?gid=<?php echo Gadget::MOST_READ_STIRES;?>"></iframe></textarea>
</div>
<div>
	<strong>Pagini in care apare:</strong><br />
	<?php if (isset($pagesByGadget[Gadget::MOST_READ_STIRES])):?>
		<?php foreach($pagesByGadget[Gadget::MOST_READ_STIRES] as $page):?>
			<?php echo Page::getNameById($page);?>,
		<?php endforeach;?>
	<?php endif;?><br />
	<a href="<?php echo url_for('@default?module=gadgets&action=editPages');?>?gid=<?php echo Gadget::MOST_READ_STIRES;?>">editeaza</a>
</div>
<div class="clear"></div>

<div class="cell-separator-double mt-3 mb-3"></div>

<h5><?php echo Gadget::getNameById(Gadget::MOST_COMMENTED_ARTICLES);?></h5>
<div class="right" style="width: 400px">
	<strong>Cod embed:</strong><br />
	<textarea style="width: 400px; height: 50px"><iframe scrolling="no" frameborder="0" allowtransparency="true" style="width: 300px; height: <?php echo Gadget::getHeightById(Gadget::MOST_COMMENTED_ARTICLES);?>px;" class="mb-2" src="http://<?php echo $sf_request->getHost();?>/gadgets?gid=<?php echo Gadget::MOST_COMMENTED_ARTICLES;?>"></iframe></textarea>
</div>
<div>
	<strong>Pagini in care apare:</strong><br />
	<?php if (isset($pagesByGadget[Gadget::MOST_COMMENTED_ARTICLES])):?>
		<?php foreach($pagesByGadget[Gadget::MOST_COMMENTED_ARTICLES] as $page):?>
			<?php echo Page::getNameById($page);?>,
		<?php endforeach;?>
	<?php endif;?><br />
	<a href="<?php echo url_for('@default?module=gadgets&action=editPages');?>?gid=<?php echo Gadget::MOST_COMMENTED_ARTICLES;?>">editeaza</a>
</div>
<div class="clear"></div>

<div class="cell-separator-double mt-3 mb-3"></div>

<h5><?php echo Gadget::getNameById(Gadget::MOST_COMMENTED_STIRES);?></h5>
<div class="right" style="width: 400px">
	<strong>Cod embed:</strong><br />
	<textarea style="width: 400px; height: 50px"><iframe scrolling="no" frameborder="0" allowtransparency="true" style="width: 300px; height: <?php echo Gadget::getHeightById(Gadget::MOST_COMMENTED_STIRES);?>px;" class="mb-2" src="http://<?php echo $sf_request->getHost();?>/gadgets?gid=<?php echo Gadget::MOST_COMMENTED_STIRES;?>"></iframe></textarea>
</div>
<div>
	<strong>Pagini in care apare:</strong><br />
	<?php if (isset($pagesByGadget[Gadget::MOST_COMMENTED_STIRES])):?>
		<?php foreach($pagesByGadget[Gadget::MOST_COMMENTED_STIRES] as $page):?>
			<?php echo Page::getNameById($page);?>,
		<?php endforeach;?>
	<?php endif;?><br />
	<a href="<?php echo url_for('@default?module=gadgets&action=editPages');?>?gid=<?php echo Gadget::MOST_COMMENTED_STIRES;?>">editeaza</a>
</div>
<div class="clear"></div>

<div class="cell-separator-double mt-3 mb-3"></div>

<h5><?php echo Gadget::getNameById(Gadget::NOW_ON_DBO);?></h5>
<div class="right" style="width: 400px">
	<strong>Cod embed:</strong><br />
	<textarea style="width: 400px; height: 50px"><iframe scrolling="no" frameborder="0" allowtransparency="true" style="width: 300px; height: <?php echo Gadget::getHeightById(Gadget::NOW_ON_DBO);?>px;" class="mb-2" src="http://<?php echo $sf_request->getHost();?>/gadgets?gid=<?php echo Gadget::NOW_ON_DBO;?>"></iframe></textarea>
</div>
<div>
	<strong>Pagini in care apare:</strong><br />
	<?php if (isset($pagesByGadget[Gadget::NOW_ON_DBO])):?>
		<?php foreach($pagesByGadget[Gadget::NOW_ON_DBO] as $page):?>
			<?php echo Page::getNameById($page);?>,
		<?php endforeach;?>
	<?php endif;?><br />
	<a href="<?php echo url_for('@default?module=gadgets&action=editPages');?>?gid=<?php echo Gadget::NOW_ON_DBO;?>">editeaza</a>
</div>
<div class="clear"></div>

<div class="cell-separator-double mt-3 mb-3"></div>

<h5><?php echo Gadget::getNameById(Gadget::CINEMA_RESERVATIONS);?></h5>
<div class="right" style="width: 400px">
	<strong>Cod embed:</strong><br />
	<textarea style="width: 400px; height: 50px"><iframe scrolling="no" frameborder="0" allowtransparency="true" style="width: 300px; height: <?php echo Gadget::getHeightById(Gadget::CINEMA_RESERVATIONS);?>px;" class="mb-2" src="http://<?php echo $sf_request->getHost();?>/gadgets?gid=<?php echo Gadget::CINEMA_RESERVATIONS;?>"></iframe></textarea>
</div>
<div>
	<strong>Pagini in care apare:</strong><br />
	<?php if (isset($pagesByGadget[Gadget::CINEMA_RESERVATIONS])):?>
		<?php foreach($pagesByGadget[Gadget::CINEMA_RESERVATIONS] as $page):?>
			<?php echo Page::getNameById($page);?>,
		<?php endforeach;?>
	<?php endif;?><br />
	<a href="<?php echo url_for('@default?module=gadgets&action=editPages');?>?gid=<?php echo Gadget::CINEMA_RESERVATIONS;?>">editeaza</a>
</div>
<div class="clear"></div>

<div class="cell-separator-double mt-3 mb-3"></div>

<h5><?php echo Gadget::getNameById(Gadget::BOX_OFFICE_RO);?></h5>
<div class="right" style="width: 400px">
	<strong>Cod embed:</strong><br />
	<textarea style="width: 400px; height: 50px"><iframe scrolling="no" frameborder="0" allowtransparency="true" style="width: 300px; height: <?php echo Gadget::getHeightById(Gadget::BOX_OFFICE_RO);?>px;" class="mb-2" src="http://<?php echo $sf_request->getHost();?>/gadgets?gid=<?php echo Gadget::BOX_OFFICE_RO;?>"></iframe></textarea>
</div>
<div>
	<strong>Pagini in care apare:</strong><br />
	<?php if (isset($pagesByGadget[Gadget::BOX_OFFICE_RO])):?>
		<?php foreach($pagesByGadget[Gadget::BOX_OFFICE_RO] as $page):?>
			<?php echo Page::getNameById($page);?>,
		<?php endforeach;?>
	<?php endif;?><br />
	<a href="<?php echo url_for('@default?module=gadgets&action=editPages');?>?gid=<?php echo Gadget::BOX_OFFICE_RO;?>">editeaza</a>
</div>
<div class="clear"></div>

<div class="cell-separator-double mt-3 mb-3"></div>

<h5><?php echo Gadget::getNameById(Gadget::BOX_OFFICE_US);?></h5>
<div class="right" style="width: 400px">
	<strong>Cod embed:</strong><br />
	<textarea style="width: 400px; height: 50px"><iframe scrolling="no" frameborder="0" allowtransparency="true" style="width: 300px; height: <?php echo Gadget::getHeightById(Gadget::BOX_OFFICE_US);?>px;" class="mb-2" src="http://<?php echo $sf_request->getHost();?>/gadgets?gid=<?php echo Gadget::BOX_OFFICE_US;?>"></iframe></textarea>
</div>
<div>
	<strong>Pagini in care apare:</strong><br />
	<?php if (isset($pagesByGadget[Gadget::BOX_OFFICE_US])):?>
		<?php foreach($pagesByGadget[Gadget::BOX_OFFICE_US] as $page):?>
			<?php echo Page::getNameById($page);?>,
		<?php endforeach;?>
	<?php endif;?><br />
	<a href="<?php echo url_for('@default?module=gadgets&action=editPages');?>?gid=<?php echo Gadget::BOX_OFFICE_US;?>">editeaza</a>
</div>
<div class="clear"></div>

<div class="cell-separator-double mt-3 mb-3"></div>

<h5><?php echo Gadget::getNameById(Gadget::NOW_ON_TV);?></h5>
<div class="right" style="width: 400px">
	<strong>Cod embed:</strong><br />
	<textarea style="width: 400px; height: 50px"><iframe scrolling="no" frameborder="0" allowtransparency="true" style="width: 300px; height: <?php echo Gadget::getHeightById(Gadget::NOW_ON_TV);?>px;" class="mb-2" src="http://<?php echo $sf_request->getHost();?>/gadgets?gid=<?php echo Gadget::NOW_ON_TV;?>"></iframe></textarea>
</div>
<div>
	<strong>Pagini in care apare:</strong><br />
	<?php if (isset($pagesByGadget[Gadget::NOW_ON_TV])):?>
		<?php foreach($pagesByGadget[Gadget::NOW_ON_TV] as $page):?>
			<?php echo Page::getNameById($page);?>,
		<?php endforeach;?>
	<?php endif;?><br />
	<a href="<?php echo url_for('@default?module=gadgets&action=editPages');?>?gid=<?php echo Gadget::NOW_ON_TV;?>">editeaza</a>
</div>
<div class="clear"></div>

<div class="cell-separator-double mt-3 mb-3"></div>

<h5><?php echo Gadget::getNameById(Gadget::SHOPS);?></h5>
<div class="right" style="width: 400px">
	<strong>Cod embed:</strong><br />
	<textarea style="width: 400px; height: 50px"><iframe scrolling="no" frameborder="0" allowtransparency="true" style="width: 300px; height: <?php echo Gadget::getHeightById(Gadget::SHOPS);?>px;" class="mb-2" src="http://<?php echo $sf_request->getHost();?>/gadgets?gid=<?php echo Gadget::SHOPS;?>"></iframe></textarea>
</div>
<div>
	<strong>Pagini in care apare:</strong><br />
	<?php if (isset($pagesByGadget[Gadget::SHOPS])):?>
		<?php foreach($pagesByGadget[Gadget::SHOPS] as $page):?>
			<?php echo Page::getNameById($page);?>,
		<?php endforeach;?>
	<?php endif;?><br />
	<a href="<?php echo url_for('@default?module=gadgets&action=editPages');?>?gid=<?php echo Gadget::SHOPS;?>">editeaza</a>
</div>
<div class="clear"></div>

<div class="cell-separator-double mt-3 mb-3"></div>

<h5><?php echo Gadget::getNameById(Gadget::NEWEST_TRAILERS);?></h5>
<div class="right" style="width: 400px">
	<strong>Cod embed:</strong><br />
	<textarea style="width: 400px; height: 50px"><iframe scrolling="no" frameborder="0" allowtransparency="true" style="width: 300px; height: <?php echo Gadget::getHeightById(Gadget::NEWEST_TRAILERS);?>px;" class="mb-2" src="http://<?php echo $sf_request->getHost();?>/gadgets?gid=<?php echo Gadget::NEWEST_TRAILERS;?>"></iframe></textarea>
</div>
<div>
	<strong>Pagini in care apare:</strong><br />
	<?php if (isset($pagesByGadget[Gadget::NEWEST_TRAILERS])):?>
		<?php foreach($pagesByGadget[Gadget::NEWEST_TRAILERS] as $page):?>
			<?php echo Page::getNameById($page);?>,
		<?php endforeach;?>
	<?php endif;?><br />
	<a href="<?php echo url_for('@default?module=gadgets&action=editPages');?>?gid=<?php echo Gadget::NEWEST_TRAILERS;?>">editeaza</a>
</div>
<div class="clear"></div>

<div class="cell-separator-double mt-3 mb-3"></div>

<h5><?php echo Gadget::getNameById(Gadget::NEWEST_PHOTOS);?></h5>
<div class="right" style="width: 400px">
	<strong>Cod embed:</strong><br />
	<textarea style="width: 400px; height: 50px"><iframe scrolling="no" frameborder="0" allowtransparency="true" style="width: 300px; height: <?php echo Gadget::getHeightById(Gadget::NEWEST_PHOTOS);?>px;" class="mb-2" src="http://<?php echo $sf_request->getHost();?>/gadgets?gid=<?php echo Gadget::NEWEST_PHOTOS;?>"></iframe></textarea>
</div>
<div>
	<strong>Pagini in care apare:</strong><br />
	<?php if (isset($pagesByGadget[Gadget::NEWEST_PHOTOS])):?>
		<?php foreach($pagesByGadget[Gadget::NEWEST_PHOTOS] as $page):?>
			<?php echo Page::getNameById($page);?>,
		<?php endforeach;?>
	<?php endif;?><br />
	<a href="<?php echo url_for('@default?module=gadgets&action=editPages');?>?gid=<?php echo Gadget::NEWEST_PHOTOS;?>">editeaza</a>
</div>
<div class="clear"></div>

<div class="cell-separator-double mt-3 mb-3"></div>

<h5><?php echo Gadget::getNameById(Gadget::NEWEST_ARTICLES);?></h5>
<div class="right" style="width: 400px">
	<strong>Cod embed:</strong><br />
	<textarea style="width: 400px; height: 50px"><iframe scrolling="no" frameborder="0" allowtransparency="true" style="width: 300px; height: <?php echo Gadget::getHeightById(Gadget::NEWEST_ARTICLES);?>px;" class="mb-2" src="http://<?php echo $sf_request->getHost();?>/gadgets?gid=<?php echo Gadget::NEWEST_ARTICLES;?>"></iframe></textarea>
</div>
<div>
	<strong>Pagini in care apare:</strong><br />
	<?php if (isset($pagesByGadget[Gadget::NEWEST_ARTICLES])):?>
		<?php foreach($pagesByGadget[Gadget::NEWEST_ARTICLES] as $page):?>
			<?php echo Page::getNameById($page);?>,
		<?php endforeach;?>
	<?php endif;?><br />
	<a href="<?php echo url_for('@default?module=gadgets&action=editPages');?>?gid=<?php echo Gadget::NEWEST_ARTICLES;?>">editeaza</a>
</div>
<div class="clear"></div>

<div class="cell-separator-double mt-3 mb-3"></div>

<h5><?php echo Gadget::getNameById(Gadget::NEWEST_STIRES);?></h5>
<div class="right" style="width: 400px">
	<strong>Cod embed:</strong><br />
	<textarea style="width: 400px; height: 50px"><iframe scrolling="no" frameborder="0" allowtransparency="true" style="width: 300px; height: <?php echo Gadget::getHeightById(Gadget::NEWEST_STIRES);?>px;" class="mb-2" src="http://<?php echo $sf_request->getHost();?>/gadgets?gid=<?php echo Gadget::NEWEST_STIRES;?>"></iframe></textarea>
</div>
<div>
	<strong>Pagini in care apare:</strong><br />
	<?php if (isset($pagesByGadget[Gadget::NEWEST_STIRES])):?>
		<?php foreach($pagesByGadget[Gadget::NEWEST_STIRES] as $page):?>
			<?php echo Page::getNameById($page);?>,
		<?php endforeach;?>
	<?php endif;?><br />
	<a href="<?php echo url_for('@default?module=gadgets&action=editPages');?>?gid=<?php echo Gadget::NEWEST_STIRES;?>">editeaza</a>
</div>
<div class="clear"></div>

<div class="cell-separator-double mt-3 mb-3"></div>