<h4>Detalii Articol</h4>

<div class="mb-3">
<?php if($sf_user->hasCredential('Moderator') && $article->getState() == Library::STATE_PENDING): ?>
Acest obiect este Pending!  <button type="button" onclick="location.href='<?php echo url_for('@default?module=default&action=allow');?>?lid=<?php echo $article->getLibraryId();?>'">Aproba</button>
<?php endif; ?>
<button type="button" onclick="location.href='<?php echo url_for('@default?module=articles&action=edit');?>?lid=<?php echo $article->getLibraryId();?>'">Editeaza detalii</button>
</div>

<div class="clear"></div>

<table class="span-19">
	<tr>
    	<th>Nume</th>
        <td><?php echo $article->getName();?></td>
    </tr>
	<tr>
    	<th>Intro</th>
        <td><?php echo $article->getContentTeaser();?></td>
    </tr>
	<tr>
    	<th>Continut</th>
        <td><?php echo $sf_data->getRaw('article')->getContentContent();?></td>
    </tr>
	<tr>
    	<th>META Description</th>
        <td><?php echo $article->getMetaDescription();?></td>
    </tr>
	<tr>
    	<th>META Keywords</th>
        <td><?php echo $article->getMetaKeywords();?></td>
    </tr>
	<tr>
    	<th>URL Key</th>
        <td><?php echo $article->getUrlKey();?></td>
    </tr>
    <tr>
    	<th>Despre vedete</th>
        <td><?php echo ($article->getAboutStars() ? 'da' : 'nu');?></td>
    </tr>
    <tr>
    	<th>Category</th>
        <td>	
			<?php foreach($article->getCategory() as $category):?>
            	<?php echo $category->getName();?>, 
            <?php endforeach;?>
        </td>
    </tr>
	<tr>
    	<th>Poza</th>
        <td><img src="<?php echo filmsiArticlePhotoThumb($article->getFilename());?>" /></td>
    </tr>
	<tr>
    	<th>Publicat la</th>
        <td><?php echo $article->getPublishDate();?></td>
    </tr>
	<tr>
    	<th>Expira la la</th>
        <td><?php echo $article->getExpirationDate();?></td>
    </tr>
    <tr>
    	<th>Album Foto</th>
        <td><?php echo $article->getPhotoAlbum();?></td>
    </tr>
    <tr>
    	<td colspan="2">
        <?php foreach ($article->getPhotoAlbum()->getPhotos() as $photo): ?>
        	<img src="<?php echo filmsiPhotoThumb($photo->getFilename());?>" />
        <?php endforeach;?>
        </td>
    </tr>
    <tr>
    	<th>Album Video</th>
        <td><?php echo $article->getVideoAlbum();?></td>
    </tr>
    <tr>
    	<td colspan="2">
        <?php foreach ($article->getVideoAlbum()->getVideos() as $video): ?>
        	<img src="<?php echo filmsiVideoThumb($video->getCode());?>" />
        <?php endforeach;?>
        </td>
    </tr>
</table>

<div class="clear"></div>

<div class="mt-2 mb-2 cell-separator-double"></div>

<h6 class="mb-1">Legaturi persoane</h6>

<?php foreach($article->getPerson() as $person): ?>
	<?php echo $person->getName();?>, 
<?php endforeach; ?>

<div class="mb-3"></div>
<h6 class="mb-1">Legaturi filme</h6>

<?php foreach($article->getFilm() as $film): ?>
	<?php echo $film->getName();?>, 
<?php endforeach; ?>

<div class="mb-3"></div>
<h6 class="mb-1">Legaturi cinema</h6>

<?php foreach($article->getCinema() as $cinema): ?>
	<?php echo $cinema->getName();?>, 
<?php endforeach; ?>

<div class="mb-3"></div>
<h6 class="mb-1">Legaturi festivaluri</h6>

<?php foreach($article->getFestivalEdition() as $festivalEdition): ?>
	<?php echo $festivalEdition->getName();?>, 
<?php endforeach; ?>

<div class="mb-3"></div>
