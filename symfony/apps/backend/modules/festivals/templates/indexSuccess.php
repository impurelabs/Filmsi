<?php slot('subMenu')?>
	<?php include_partial('cms/subMenu');?>
<?php end_slot();?>

<h4>Festivaluri</h4>
<button type="button"
		onclick="location.href='<?php echo url_for('@default?module=festivals&action=new');?>'"
		class="mb-3">Adauga festival nou</button>

<div class="clear"></div>


<table class="span-12">
	<?php foreach($festivals as $festival): ?>
	<tr>
    	<td><?php echo $festival->getName();?></td>
        <td><a href="<?php echo url_for('@default?module=festivals&action=edit');?>?id=<?php echo $festival->getId();?>" class="small-link">editeaza</a></td>
        <td><?php echo link_to('sterge', 'festivals/delete', array('confirm' => 'Esti sigur ca vrei sa genul ge film?', 'query_string' => 'id='.$festival->getId(), 'post' => true, 'class' => 'small-link'));?></td>
    </tr>
	<?php endforeach; ?>
</table>

<div class="clear"></div>
