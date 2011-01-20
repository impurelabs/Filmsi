<h4>Detalii Stire</h4>
<div class="mb-3">
<?php if($sf_user->hasCredential('Moderator') && $stire->getState() == Library::STATE_PENDING): ?>
Acest obiect este Pending!  <button type="button" onclick="location.href='<?php echo url_for('@default?module=default&action=allow');?>?lid=<?php echo $stire->getLibraryId();?>'">Aproba</button>
<?php endif; ?>
<button type="button" onclick="location.href='<?php echo url_for('@default?module=stires&action=edit');?>?lid=<?php echo $stire->getLibraryId();?>'">Editeaza detalii</button>
</div>

<div class="clear"></div>

<table class="span-19">
	<tr>
    	<th>Nume</th>
        <td><?php echo $stire->getName();?></td>
    </tr>
	<tr>
    	<th>Intro</th>
        <td><?php echo $stire->getContentTeaser();?></td>
    </tr>
	<tr>
    	<th>Continut</th>
        <td><?php echo $sf_data->getRaw('stire')->getContentContent();?></td>
    </tr>
	<tr>
    	<th>META Description</th>
        <td><?php echo $stire->getMetaDescription();?></td>
    </tr>
	<tr>
    	<th>META Keywords</th>
        <td><?php echo $stire->getMetaKeywords();?></td>
    </tr>
	<tr>
    	<th>URL Key</th>
        <td><?php echo $stire->getUrlKey();?></td>
    </tr>
    <tr>
    	<th>Despre vedete</th>
        <td><?php echo ($stire->getAboutStars() ? 'da' : 'nu');?></td>
    </tr>
	<tr>
    	<th>Poza</th>
        <td><img src="<?php echo filmsiStirePhotoThumb($stire->getFilename());?>" /></td>
    </tr>
	<tr>
    	<th>Publicat la</th>
        <td><?php echo $stire->getPublishDate();?></td>
    </tr>
	<tr>
    	<th>Expira la la</th>
        <td><?php echo $stire->getExpirationDate();?></td>
    </tr>
    <tr>
    	<th>Album Foto</th>
        <td><?php echo $stire->getPhotoAlbum();?></td>
    </tr>
    <tr>
    	<td colspan="2">
        <?php foreach ($stire->getPhotoAlbum()->getPhotos() as $photo): ?>
        	<img src="<?php echo filmsiPhotoThumb($photo->getFilename());?>" />
        <?php endforeach;?>
        </td>
    </tr>
    <tr>
    	<th>Album Video</th>
        <td><?php echo $stire->getVideoAlbum();?></td>
    </tr>
    <tr>
    	<td colspan="2">
        <?php foreach ($stire->getVideoAlbum()->getVideos() as $video): ?>
        	<img src="<?php echo filmsiVideoThumb($video->getCode());?>" />
        <?php endforeach;?>
        </td>
    </tr>
</table>

<div class="clear"></div>

<div class="mt-2 mb-2 cell-separator-double"></div>

<h6 class="mb-1">Legaturi persoane</h6>

<?php foreach($stire->getPerson() as $person): ?>
	<?php echo $person->getName();?>, 
<?php endforeach; ?>

<div class="mb-3"></div>
<h6 class="mb-1">Legaturi filme</h6>

<?php foreach($stire->getFilm() as $film): ?>
	<?php echo $film->getName();?>, 
<?php endforeach; ?>

<div class="mb-3"></div>
<h6 class="mb-1">Legaturi cinema</h6>

<?php foreach($stire->getCinema() as $cinema): ?>
	<?php echo $cinema->getName();?>, 
<?php endforeach; ?>

<div class="mb-3"></div>
<h6 class="mb-1">Legaturi festivaluri</h6>

<?php foreach($stire->getFestivalEdition() as $festivalEdition): ?>
	<?php echo $festivalEdition->getName();?>, 
<?php endforeach; ?>

<div class="mb-3"></div>
