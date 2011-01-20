<?php slot('subMenu')?>
	<?php include_partial('cms/subMenu');?>
<?php end_slot();?>

<h4 class="mb-3">Facilitati Cinema</h4>
<button type="button" onclick="location.href='<?php echo url_for('@default?module=services&action=new');?>'" class="mb-3">Adauga facilitate noua</button>

<div class="clear"></div>


<table class="span-12">
	<?php foreach($services as $service): ?>
	<tr>
    	<td><?php echo $service->getName();?></td>
        <td><a href="<?php echo url_for('@default?module=services&action=edit');?>?id=<?php echo $service->getId();?>" class="small-link">editeaza</a></td>
        <td><?php echo link_to('sterge', 'services/delete', array('confirm' => 'Esti sigur ca vrei sa stergi facilitatea?', 'query_string' => 'id='.$service->getId(), 'post' => true, 'class' => 'small-link'));?></td>
    </tr>
	<?php endforeach; ?>
</table>

<div class="clear"></div>
