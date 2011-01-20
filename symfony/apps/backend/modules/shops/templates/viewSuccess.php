<h4>Detalii Magazin</h4>
<div class="mb-3">
<button type="button" onclick="location.href='<?php echo url_for('@default?module=shops&action=edit');?>?id=<?php echo $shop->getId();?>'">Editeaza detalii</button>
</div>

<div class="clear"></div>

<table class="span-19">
	<tr>
    	<th>Nume</th>
        <td><?php echo $shop->getName();?></td>
    </tr>
	<tr>
    	<th>Email</th>
        <td><?php echo $shop->getEmail();?></td>
    </tr>
	<tr>
    	<th>Telefon</th>
        <td><?php echo $shop->getPhone();?></td>
    </tr>
	<tr>
    	<th>Url</th>
        <td><?php echo $shop->getUrl();?></td>
    </tr>
	<tr>
    	<th>Descriere</th>
        <td>
        	<?php echo $shop->getDescription();?>
        </td>
    </tr>
	<tr>
    	<th>Logo</th>
        <td><img src="<?php echo filmsiShopPhotoThumb($shop->getFilename());?>" /></td>
    </tr>
</table>

<div class="clear"></div>

<div class="mt-2 mb-2 cell-separator-double"></div>

<h6 class="left">Lista filme</h6>
 <a href="<?php echo url_for('@default?module=shops&action=films');?>?id=<?php echo $shop->getId();?>" class="ml-3">editeaza</a>

<div class="clear mb-3"

<table class="mt-3 span-12">
	<?php foreach($films as $film): ?>
    	<tr>
        	<td><?php echo $film->getFilm()->getName();?></td>
        	<td><a href="<?php echo $film->getUrl();?>" target="_blank"><?php echo $film->getUrl();?></a></td>
        </tr>
    <?php endforeach; ?>
</table>

<div class="clear"></div>
