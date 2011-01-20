<h4 class="mb-2"><?php echo $festivalEdition->getFestival()->getName();?> - <?php echo $festivalEdition->getEdition();?></h4>


<a href="<?php echo url_for('@default?module=festivalEditions&action=view');?>?lid=<?php echo $festivalEdition->getLibraryId();?>" class="selected">Detalii</a>
 | <a href="<?php echo url_for('@default?module=festivalEditions&action=section');?>?lid=<?php echo $festivalEdition->getLibraryId();?>">Sectiuni</a>
<?php if($sf_user->hasCredential('Moderator') && $festivalEdition->getState() == Library::STATE_PENDING): ?>
 | Acest obiect este Pending!  <button type="button" onclick="location.href='<?php echo url_for('@default?module=default&action=allow');?>?lid=<?php echo $festivalEdition->getLibraryId();?>'">Aproba</button>
<?php endif; ?>

<div class="mt-2 mb-2 cell-separator-double"></div>


<h5>Detalii Editie Festival</h5>
<div class="mb-3">
<button type="button" class="mr-2" onclick="location.href='<?php echo url_for('@default?module=festivalEditions&action=edit');?>?lid=<?php echo $festivalEdition->getLibraryId();?>'">Editeaza detalii</button>
</div>
<div class="clear"></div>


<table class="span-19">
	<tr>
    	<th>Festival</th>
        <td><?php echo $festivalEdition->getFestival()->getName();?></td>
    </tr>
	<tr>
    	<th>Editie</th>
        <td><?php echo $festivalEdition->getEdition();?></td>
    </tr>
	<tr>
    	<th>Descriere - intro</th>
        <td><?php echo $festivalEdition->getDescriptionTeaser();?></td>
    </tr>
	<tr>
    	<th>Descriere - continut</th>
        <td><?php echo $sf_data->getRaw('festivalEdition')->getDescriptionContent();?></td>
    </tr>
	<tr>
    	<th>META Description</th>
        <td><?php echo $festivalEdition->getMetaDescription();?></td>
    </tr>
	<tr>
    	<th>META Keywords</th>
        <td><?php echo $festivalEdition->getMetaKeywords();?></td>
    </tr>
	<tr>
    	<th>URL Key</th>
        <td><?php echo $festivalEdition->getUrlKey();?></td>
    </tr>
	<tr>
    	<th>Poza</th>
        <td><img src="<?php echo filmsiFestivalEditionPhotoThumb($festivalEdition->getFilename());?>" /></td>
    </tr>
	<tr>
    	<th>Publicat la</th>
        <td><?php echo $festivalEdition->getPublishDate();?></td>
    </tr>
    <tr>
    	<th>Album Foto</th>
        <td><?php echo $festivalEdition->getPhotoAlbum();?></td>
    </tr>
    <tr>
    	<td colspan="2">
        <?php foreach ($festivalEdition->getPhotoAlbum()->getPhotos() as $photo): ?>
        	<img src="<?php echo filmsiPhotoThumb($photo->getFilename());?>" />
        <?php endforeach;?>
        </td>
    </tr>
    <tr>
    	<th>Album Video</th>
        <td><?php echo $festivalEdition->getVideoAlbum();?></td>
    </tr>
    <tr>
    	<td colspan="2">
        <?php foreach ($festivalEdition->getVideoAlbum()->getVideos() as $video): ?>
        	<img src="<?php echo filmsiVideoThumb($video->getCode());?>" />
        <?php endforeach;?>
        </td>
    </tr>
</table>


<div class="clear"></div>


<div class="mt-2 mb-2 cell-separator-double clear"></div>



<?php include_partial('default/wysiwygEditor', array('width' => 600, 'height' => 400));?>