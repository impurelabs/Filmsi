<?php slot('subMenu')?>
	<?php include_partial('cms/subMenu');?>
<?php end_slot();?>

<h4>Categorii articole</h4>
<button type="button"
		onclick="location.href='<?php echo url_for('@default?module=categories&action=new');?>'"
		class="mb-3">Adauga categorie noua</button>

<div class="clear"></div>


<table class="span-12">
	<?php foreach($categorys as $category): ?>
	<tr>
    	<td><?php echo $category->getName();?></td>
        <td><a href="<?php echo url_for('@default?module=categories&action=edit');?>?id=<?php echo $category->getId();?>" class="small-link">editeaza</a></td>
        <td><?php echo link_to('sterge', 'categories/delete', array('confirm' => 'Esti sigur ca vrei sa stergi categoria?', 'query_string' => 'id='.$category->getId(), 'post' => true, 'class' => 'small-link'));?></td>
    </tr>
	<?php endforeach; ?>
</table>

<div class="clear"></div>
