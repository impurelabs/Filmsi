<?php slot('subMenu')?>
	<?php include_partial('cms/subMenu');?>
<?php end_slot();?>

<h4>Boxoffice</h4>

<h6 class="mt-3">Ro</h6> 

<ol>
	<li style="list-style:decimal inside"><?php echo $boxofficeRoFilm->getFilm1()->getName();?></li>
	<li style="list-style:decimal inside"><?php echo $boxofficeRoFilm->getFilm2()->getName();?></li>
	<li style="list-style:decimal inside"><?php echo $boxofficeRoFilm->getFilm3()->getName();?></li>
	<li style="list-style:decimal inside"><?php echo $boxofficeRoFilm->getFilm4()->getName();?></li>
	<li style="list-style:decimal inside"><?php echo $boxofficeRoFilm->getFilm5()->getName();?></li>
</ol> 
<a href="<?php echo url_for('@default?module=boxoffice&action=editRo');?>" class="small-link">editeaza</a>


<h6 class="mt-3">Us</h6>

<ol>
	<li style="list-style:decimal inside"><?php echo $boxofficeUsFilm->getFilm1()->getName();?></li>
	<li style="list-style:decimal inside"><?php echo $boxofficeUsFilm->getFilm2()->getName();?></li>
	<li style="list-style:decimal inside"><?php echo $boxofficeUsFilm->getFilm3()->getName();?></li>
	<li style="list-style:decimal inside"><?php echo $boxofficeUsFilm->getFilm4()->getName();?></li>
	<li style="list-style:decimal inside"><?php echo $boxofficeUsFilm->getFilm5()->getName();?></li>
</ol>

 <a href="<?php echo url_for('@default?module=boxoffice&action=editUs');?>" class="small-link">editeaza</a>