<?php if($visits->count() > 0):?>
<div class="align-center spacer-bottom spacer-top-m"><h2>Pana acum ai vazut pe FilmSi</h2></div>


 <div class="normalcell spacer-bottom-m">
	<?php foreach($visits as $visit): ?>
		<a href="<?php echo $visit->getUrl();?>" class="important-link"><?php echo $visit->getName();?></a> |
	<?php endforeach;?>
 </div>
<?php endif;?>