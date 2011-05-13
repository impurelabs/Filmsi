<h4 class="mb-2">Magazin <?php echo $shop->getName();?></h4>


<a href="<?php echo url_for('@default?module=shops&action=view');?>?id=<?php echo $shop->getId();?>" class="selected">Detalii</a>
 | <a href="<?php echo url_for('@default?module=shops&action=films');?>?id=<?php echo $shop->getId();?>">Lista filme</a>

<div class="mt-2 mb-2 cell-separator-double"></div>


<h5>Detalii</h5>
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
