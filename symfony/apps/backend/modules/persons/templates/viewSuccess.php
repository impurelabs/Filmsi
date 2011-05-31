<h4 class="mb-2"><?php echo $person->getName();?></h4>

<div class="mb-3">
<?php if($sf_user->hasCredential('Moderator') && $person->getState() == Library::STATE_PENDING): ?>
Acest obiect este Pending!  <button type="button" onclick="location.href='<?php echo url_for('@default?module=default&action=allow');?>?lid=<?php echo $person->getLibraryId();?>'">Aproba</button>
<?php endif; ?>
<button type="button" onclick="location.href='<?php echo url_for('@default?module=persons&action=edit');?>?lid=<?php echo $person->getLibraryId();?>'">Editeaza detalii</button>
</div>


<h5>Import poze din IMDB</h5><br />
<strong>Pasul 1</strong> - Pregatirea importului: <br />
<?php if ($imdbPhotoKeys > 0):?>
Sunt pregatite <?php echo $imdbPhotoKeys;?> poze pentru a fi importate.
<?php else:?>
<button onclick="location.href='<?php echo url_for('@default?module=persons&action=importImdbPhotoKeys');?>?id=<?php echo $person->getId();?>'">Pregateste import-ul</button> (da click doar o singura data si pe urma asteapta)
<?php endif;?>
<br /><br />
<strong>Pasul 2</strong> - Importul propriu-zis: <br />
<br />
<?php if ($imdbPhotoKeys > 0):?>
<form class="mb-3" method="post" action="<?php echo url_for('@default?module=persons&action=importImdbPhotos');?>">
	<input type="hidden" name="id" value="<?php echo $person->getId();?>" />
    <button type="submit">Importa poze din Imdb</button>  (da click doar o singura data si pe urma asteapta)
</form>
<?php else:?>
Nu este nici o poza pregatita pentru import.
<?php endif;?>

<div class="cell-separator-double mb-3 mt-1"></div>

<h5>Detalii Persoana</h5>

<div class="clear"></div>

<table class="span-19">
	<tr>
    	<th>Cod IMDB</th>
        <td><?php echo $person->getImdb();?></td>
    </tr>
	<tr>
    	<th>Prenume</th>
        <td><?php echo $person->getFirstName();?></td>
    </tr>
	<tr>
    	<th>Nume</th>
        <td><?php echo $person->getLastName();?></td>
    </tr>
	<tr>
    	<th>Data nasterii</th>
        <td><?php echo $person->getDateOfBirth();?></td>
    </tr>
	<tr>
    	<th>Data mortii</th>
        <td><?php echo $person->getDateOfDeath();?></td>
    </tr>
	<tr>
    	<th>Locul nasterii</th>
        <td><?php echo $person->getPlaceOfBirth();?></td>
    </tr>
	<tr>
    	<th>Ascunde biografie</th>
        <td><?php echo $person->getNoDisplay() == '1' ? 'ascunsa' : 'afisata';?></td>
    </tr>
	<tr>
    	<th>Intro biografie</th>
        <td class="tinyMce"><?php echo $person->getBiographyTeaser();?></td>
    </tr>
	<tr>
    	<th>Biografie</th>
        <td class="tinyMce"><?php echo $sf_data->getRaw('person')->getBiographyContent();?></td>
    </tr>
	<tr>
    	<th>META Description</th>
        <td><?php echo $person->getMetaDescription();?></td>
    </tr>
	<tr>
    	<th>META Keywords</th>
        <td><?php echo $person->getMetaKeywords();?></td>
    </tr>
	<tr>
    	<th>URL Key</th>
        <td><?php echo $person->getUrlKey();?></td>
    </tr>
	<tr>
    	<th>Actor</th>
        <td><?php echo $person->getIsActor() ? 'Da' : 'Nu';?></td>
    </tr>
	<tr>
    	<th>Regizor</th>
        <td><?php echo $person->getIsDirector() ? 'Da' : 'Nu';?></td>
    </tr>
	<tr>
    	<th>Scenarist</th>
        <td><?php echo $person->getIsScriptwriter() ? 'Da' : 'Nu';?></td>
    </tr>
	<tr>
    	<th>Producator</th>
        <td><?php echo $person->getIsProducer() ? 'Da' : 'Nu';?></td>
    </tr>
	<tr>
    	<th>Poza</th>
        <td><img src="<?php echo filmsiPersonPhotoThumb($person->getFilename());?>" /></td>
    </tr>
	<tr>
    	<th>Publicat la</th>
        <td><?php echo $person->getPublishDate();?></td>
    </tr>
    <tr>
    	<th>Album Foto</th>
        <td><?php echo $person->getPhotoAlbum();?></td>
    </tr>
    <tr>
    	<td colspan="2">
        <?php foreach ($person->getPhotoAlbum()->getPhotos() as $photo): ?>
        	<img src="<?php echo filmsiPhotoThumb($photo->getFilename());?>" />
        <?php endforeach;?>
        </td>
    </tr>
    <tr>
    	<th>Album Video</th>
        <td><?php echo $person->getVideoAlbum();?></td>
    </tr>
    <tr>
    	<td colspan="2">
        <?php foreach ($person->getVideoAlbum()->getVideos() as $video): ?>
        	<img src="<?php echo filmsiVideoThumb($video->getCode());?>" />
        <?php endforeach;?>
        </td>
    </tr>
</table>

<div class="clear"></div>

