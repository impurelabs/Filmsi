<h4 class="mb-2"><?php echo $film->getNameRo();?> <?php if ($film->getNameEn() != '') echo '(' . $film->getNameEn() . ')';?></h4>


<a href="<?php echo url_for('@default?module=films&action=view');?>?lid=<?php echo $film->getLibraryId();?>" class="selected">Detalii</a>
 | <a href="<?php echo url_for('@default?module=films&action=status');?>?lid=<?php echo $film->getLibraryId();?>">Status</a>
 | <a href="<?php echo url_for('@default?module=films&action=person');?>?lid=<?php echo $film->getLibraryId();?>">Persoane</a>
<?php if ($film->getIsSeries()):?>
 | <a href="<?php echo url_for('@default?module=films&action=episode');?>?lid=<?php echo $film->getLibraryId();?>">Episoade</a>
<?php endif; ?>
<?php if ($sf_user->hasCredential('Promovare')):?>
 | <a href="<?php echo url_for('@default?module=films&action=background');?>?lid=<?php echo $film->getLibraryId();?>">Background</a>
 <?php endif;?>
<?php if($sf_user->hasCredential('Moderator') && $film->getState() == Library::STATE_PENDING): ?>
 | Acest obiect este Pending! <button type="button" onclick="location.href='<?php echo url_for('@default?module=default&action=allow');?>?lid=<?php echo $film->getLibraryId();?>'">Aproba</button>
<?php endif; ?>

<div class="mt-2 mb-2 cell-separator-double"></div>


<h5>Detalii Film</h5>
<div class="mb-3">
<button type="button" onclick="location.href='<?php echo url_for('@default?module=films&action=edit');?>?lid=<?php echo $film->getLibraryId();?>'">Editeaza detalii</button>
</div>
<div class="clear"></div>

<table class="span-19">
	<tr>
    	<th>Cod IMDB</th>
        <td><?php echo $film->getImdb();?></td>
    </tr>
	<tr>
    	<th>Este serial</th>
        <td><?php echo $film->getIsSeries() == '1' ? 'Da' : 'Nu';?></td>
    </tr>
	<tr>
    	<th>Nume romana</th>
        <td><?php echo $film->getNameRo();?></td>
    </tr>
	<tr>
    	<th>Nume engleza</th>
        <td><?php echo $film->getNameEn();?></td>
    </tr>
	<tr>
    	<th>An</th>
        <td><?php echo $film->getYear();?></td>
    </tr>
	<tr>
    	<th>Rating</th>
        <td><?php echo $film->getRating();?></td>
    </tr>
	<tr>
    	<th>Gen</th>
        <td>
			<?php foreach ($film->getGenres() as $genre):?>
            	<?php echo $genre->getName();?>, 
        	<?php endforeach;?>    
        </td>
    </tr>
	<tr>
    	<th>Durata</th>
        <td><?php echo $film->getDuration();?></td>
    </tr>
    <tr>
    	<th>Format</th>
        <td><?php echo ($film->getIsTypeFilm() ? 'pelicula, ' : '') . ($film->getIsTypeDigital() ? 'digital, ' : '') . ($film->getIsType_3d() ? '3D' : '');?></td>
    </tr>
	<tr>
    	<th>Distribuitor</th>
        <td><?php echo $film->getDistribuitor();?></td>
    </tr>
	<tr>
    	<th>Sinopsis - intro</th>
        <td><?php echo $film->getDescriptionTeaser();?></td>
    </tr>
	<tr>
    	<th>Sinopsis - continut</th>
        <td><?php echo $sf_data->getRaw('film')->getDescriptionContent();?></td>
    </tr>
	<tr>
    	<th>META Description</th>
        <td><?php echo $film->getMetaDescription();?></td>
    </tr>
	<tr>
    	<th>META Keywords</th>
        <td><?php echo $film->getMetaKeywords();?></td>
    </tr>
	<tr>
    	<th>URL Key</th>
        <td><?php echo $film->getUrlKey();?></td>
    </tr>
	<tr>
    	<th>Poza</th>
        <td><img src="<?php echo filmsiFilmPhotoThumb($film->getFilename());?>" /></td>
    </tr>
	<tr>
    	<th>Publicat la</th>
        <td><?php echo $film->getPublishDate();?></td>
    </tr>
    <tr>
    	<th>Album Foto</th>
        <td><?php echo $film->getPhotoAlbum();?></td>
    </tr>
    <tr>
    	<td colspan="2">
        <?php foreach ($film->getPhotoAlbum()->getPhotos() as $photo): ?>
        	<img src="<?php echo filmsiPhotoThumb($photo->getFilename());?>" />
        <?php endforeach;?>
        </td>
    </tr>
    <tr>
    	<th>Album Video</th>
        <td><?php echo $film->getVideoAlbum();?></td>
    </tr>
    <tr>
    	<td colspan="2">
        <?php foreach ($film->getVideoAlbum()->getVideos() as $video): ?>
        	<img src="<?php echo filmsiVideoThumb($video->getCode());?>" />
        <?php endforeach;?>
        </td>
    </tr>
</table>

<div class="clear"></div>



