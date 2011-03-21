<div class="right">
Pagina
<form id="filter-form" action="<?php echo url_for('@default?module=default&action=moderate') ?>" method="get">
<select id="page" name="filter_page" onchange="getElementById('filter-form').submit();">
	<?php for($counter = 1; $counter <= $pageCount; $counter++): ?>
	<option value="<?php echo $counter;?>"<?php if ($counter == $filterPage) echo ' selected="selected"';?>><?php echo $counter;?></option>
	<?php endfor ;?>
</select>
</form>

</div>

<table class="listhighlight">
    <tr>
        <th>ID</th>
        <th>Cod IMDB</th>
        <th>Nume</th>
        <th>Publicat la</th>
        <th>Tip</th>
        <th>Categorie</th>
        <th>Autor</th>
    </tr>
<?php foreach($objects as $object): ?>
	<tr>
        <td><?php echo $object->getId();?></td>
        <td><?php echo $object->getImdb();?></td>
        <td><?php echo $object->getName();?></td>
        <td><?php echo $object->getPublishDate();?></td>
        <td><?php echo $object->getType();?></td>
        <td><?php echo $object->getCategory();?></td>
        <td><?php echo $object->getAuthor()->getName();?></td>
        <td><a href="<?php echo url_for('@' . $object->getType() . '_view');?>?lid=<?php echo $object->getId();?>" target="_blank" class="small-link">vezi</a></td>
    </tr>
<?php endforeach ?>
</table>

<div class="align-right">
	Gasite: <?php echo $totalCount;?>
</div>