<table>
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
</form>