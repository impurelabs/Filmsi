<h4>Library: Album foto "<?php echo $album->getName();?>"</h4>
<div class="mb-3">
<button type="button" onclick="location.href='<?php echo url_for('@default?module=photos&action=photoAdd');?>?aid=<?php echo $album->getId();?>'">Adauga poze</button>
<button type="button" onclick="location.href='<?php echo url_for('@default?module=photos&action=editAlbum');?>?aid=<?php echo $album->getId();?>'">Editeaza detalii album</button>
<?php if($sf_user->hasCredential('Moderator') && $album->getState() == Library::STATE_PENDING): ?>
Acest obiect este Pending! <button type="button" onclick="location.href='<?php echo url_for('@default?module=default&action=allow');?>?lid=<?php echo $album->getLibraryId();?>'">Aproba</button>
<?php endif; ?>
</div>

<div class="span-16">
<table>
	<tr>
		<td></td>
		<td></td>
		<td>Homepage</td>
		<td>De la<br />premiera</td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	<?php foreach ($photos as $photo): ?>
	<tr>
    	<td><a href="<?php echo filmsiPhoto($photo->getFilename());?>" target="_blank"><img src="<?php echo filmsiPhotoThumb($photo->getFilename());?>" /></a></td>
        <td><?php echo $photo->getDescription();?>
		<td><?php if($photo->getOnHome()) echo 'DA';?></td>
		<td><?php if($photo->getIsRedcarpet()) echo 'DA';?></td>
        <td><img src="<?php echo image_path('state-' . $photo->getState() . '.png');?>" /></td>
        <td><a href="<?php echo url_for('@default?module=photos&action=editPhoto');?>?pid=<?php echo $photo->getId();?>" class="small-link">editeaza</a></td>
        <td><?php echo link_to('sterge', 'photos/deletePhoto', array('confirm' => 'Esti sigur ca vrei sa stergi poza?', 'query_string' => 'pid='.$photo->getId(), 'post' => true, 'class' => 'small-link'));?></td>
        <td><a href="<?php echo url_for('@default?module=photos&action=moveUp');?>?pid=<?php echo $photo->getId();?>" class="small-link">mai sus</a></td>
        <td><a href="<?php echo url_for('@default?module=photos&action=moveDown');?>?pid=<?php echo $photo->getId();?>" class="small-link">mai jos</a></td>
    </tr>
    <?php endforeach ?>
</table>
</div>

<div class="clear"></div>