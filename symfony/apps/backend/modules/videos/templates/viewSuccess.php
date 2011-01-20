<h4>Library: Album video "<?php echo $album->getName();?>"</h4>
<div class="mb-3">
<button type="button" onclick="location.href='<?php echo url_for('@default?module=videos&action=videoAdd');?>?aid=<?php echo $album->getId();?>'">Adauga video</button>
<button type="button" onclick="location.href='<?php echo url_for('@default?module=videos&action=editAlbum');?>?aid=<?php echo $album->getId();?>'">Editeaza detalii album</button>
<?php if($sf_user->hasCredential('Moderator') && $album->getState() == Library::STATE_PENDING): ?>
Acest obiect este Pending!  
<button type="button" class="right" onclick="location.href='<?php echo url_for('@default?module=default&action=allow');?>?lid=<?php echo $album->getLibraryId();?>'">Aproba</button>
<?php endif; ?>
</div>

<div class="span-16">
<table>
	<?php foreach ($videos as $video): ?>
	<tr>
    	<td><img src="<?php echo filmsiVideoThumb($video->getCode());?>" /></td>
        <td><?php echo $video->getName();?>
        <td><img src="<?php echo image_path('state-' . $video->getState() . '.png');?>" /></td>
        <td><a href="<?php echo url_for('@default?module=videos&action=editVideo');?>?id=<?php echo $video->getId();?>" class="small-link">editeaza</a></td>
        <td><?php echo link_to('sterge', 'videos/deleteVideo', array('confirm' => 'Esti sigur ca vrei sa poza?', 'query_string' => 'id='.$video->getId(), 'post' => true, 'class' => 'small-link'));?></td>
        <td><a href="<?php echo url_for('@default?module=videos&action=moveUp');?>?id=<?php echo $video->getId();?>" class="small-link">mai sus</a></td>
        <td><a href="<?php echo url_for('@default?module=videos&action=moveDown');?>?id=<?php echo $video->getId();?>" class="small-link">mai jos</a></td>
    </tr>
    <?php endforeach ?>
</table>
</div>

<div class="clear"></div>