<h4>Magazine</h4>
<button type="button" class="mb-3" onclick="location.href='<?php echo url_for('@default?module=shops&action=new');?>'">Adauga magazin nou</button>

<div class="clear mb-4"></div>

<table>
	<tr>
    	<th>Logo</th>
        <th>Nume</th>
        <th>Email</th>
        <th>Telefon</th>
        <th>Url</th>
        <th>Numar Filme</th>
        <th></th>
    </tr>
	<?php foreach ($shops as $shop):?>
    <tr>
    	<td><img src="<?php echo filmsiShopPhotoThumb($shop['filename']);?>" /></td>
    	<td><?php echo $shop['name'];?></td>
    	<td><?php echo $shop['email'];?></td>
    	<td><?php echo $shop['phone'];?></td>
    	<td><?php echo $shop['url'];?></td>
    	<td><?php echo $shop['film_counter'];?></td>
        <td><a href="<?php echo url_for('@default?module=shops&action=view');?>?id=<?php echo $shop['id'];?>" target="_blank" class="small-link">vezi</a>
    </tr>
    <?php endforeach;?>
</table>