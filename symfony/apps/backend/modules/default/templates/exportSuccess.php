id,Cod IMDB,Nume,Publicat la,Tip,Categorie,Autor
<?php foreach($objects as $object): ?>
"<?php echo $object->getId();?>","<?php echo $object->getImdb();?>","<?php echo $object->getName();?>","<?php echo $object->getPublishDate();?>","<?php echo $object->getTypeName();?>","<?php echo $object->getCategory();?>","<?php echo $object->getAuthor()->getName();?>"
<?php endforeach ?>