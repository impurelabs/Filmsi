<?php slot('subMenu')?>
	<?php include_partial('promovare/subMenu');?>
<?php end_slot();?>

<h4 class="mb-2">Background Homepage</h4>

<div class="mb-3">
<button type="button" onclick="location.href='<?php echo url_for('@default?module=promovare&action=backgroundHomepageEdit');?>'">Editeaza</button>
<?php echo link_to('sterge', 'promovare/backgroundHomepageDelete', array('confirm' => 'Esti sigur ca vrei sa stergi background-ul?', 'post' => true, 'class' => 'small-link'));?>
</div>

<div class="clear"></div>

<img src="<?php echo filmsiHomepageBackground($homepage->getBackgroundFilename());?>" />

<div class="clear"></div>