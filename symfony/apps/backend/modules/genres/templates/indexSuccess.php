<?php slot('subMenu')?>
	<?php include_partial('cms/subMenu');?>
<?php end_slot();?>

<h4>Genuri Film</h4>
<button type="button" onclick="location.href='<?php echo url_for('@default?module=genres&action=new');?>'" class="mb-3">Adauga gen nou</button>

<div class="clear"></div>


<table class="span-12">
	<?php foreach($genres as $genre): ?>
	<tr>
    	<td><?php echo $genre->getName();?></td>
        <td><a href="<?php echo url_for('@default?module=genres&action=edit');?>?id=<?php echo $genre->getId();?>" class="small-link">editeaza</a></td>
        <td><?php echo link_to('sterge', 'genres/delete', array('confirm' => 'Esti sigur ca vrei sa stergi genul ge film?', 'query_string' => 'id='.$genre->getId(), 'post' => true, 'class' => 'small-link'));?></td>
    </tr>
	<?php endforeach; ?>
</table>

<div class="clear"></div>
