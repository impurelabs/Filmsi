<strong>Filtre</strong>

<form id="filter-form" action="<?php echo url_for('@default_index?module=filmStatus') ?>" method="get">
<input type="hidden" id="filter-page" name="filter_page" value="<?php echo $filterPage;?>" />
<table>
	<tr>
    	<td class="pr-2">cod IMDB <input type="text" name="filter_imdb" value="<?php echo $filterImdb;?>" /></td>
    	<td class="pr-2"><input type="checkbox" name="filter_in_production"<?php echo $filterInProduction ? 'checked="checked"' : '';?> /> in productie</td>
    	<td class="pr-2"><input type="checkbox" name="filter_in_cinema"<?php echo $filterInCinema ? 'checked="checked"' : '';?> /> in cinema</td>
    	<td class="pr-2"><input type="checkbox" name="filter_in_dvd"<?php echo $filterInDvd ? 'checked="checked"' : '';?> /> pe DVD</td>
    	<td class="pr-2"><input type="checkbox" name="filter_in_bluray"<?php echo $filterInBluray ? 'checked="checked"' : '';?> /> pe bluray</td>
    	<td class="pr-2"><input type="checkbox" name="filter_in_online"<?php echo $filterInOnline ? 'checked="checked"' : '';?> /> online</td>
    	<td class="pr-2"><input type="checkbox" name="filter_in_tv"<?php echo $filterInTv ? 'checked="checked"' : '';?> /> tv</td>
        <td class="pr-2"><button type="submit" id="button-filter">Filtreaza</button></td>
        <td class="pr-2"><button type="reset" onclick="location.href='<?php echo url_for('@default_index?module=filmStatus');?>'">Reseteaza filtre</button></td>
        <td class="pr-2"><button type="button" id="button-export">Exporta</button></td>
    </tr>
</table>
</form>

<hr class="cell-separator-double mt-1 mb-3" />

<div class="right">
Pagina 
<select id="page">
	<?php for($counter = 1; $counter <= $pageCount; $counter++): ?>
	<option value="<?php echo $counter;?>"<?php if ($counter == $filterPage) echo ' selected="selected"';?>><?php echo $counter;?></option>
	<?php endfor ;?>
</select>

</div>


<div class="clear"></div>
<br /><br />


<table>
    <tr>
        <th>ID</th>
        <th>Cod IMDB</th>
        <th>Nume</th>
        <th>In productie</th>
        <th>In cinema</th>
        <th>Pe DVD</th>
        <th>Pe Bluray</th>
        <th>Online</th>
        <th>Tv</th>
        <th></th>
    </tr>
<?php foreach($films as $film): ?>
	<tr>
        <td><?php echo $film->getLibraryId();?></td>
        <td><?php echo $film->getImdb();?></td>
        <td><?php echo $film->getName();?></td>
        <td><?php echo $film->getStatusInProduction() ? 'da' : 'nu'; ?></td>
        <td><?php echo filmsiStatusCinemaExplained($film); ?></td>
        <td><?php echo filmsiStatusDvdExplained($film); ?></td>
        <td><?php echo filmsiStatusBlurayExplained($film); ?></td>
        <td><?php echo filmsiStatusOnlineExplained($film); ?></td>
        <td><?php echo filmsiStatusTvExplained($film); ?></td>
        <td><a href="<?php echo url_for('@default?module=films&action=view');?>?lid=<?php echo $film->getLibraryId();?>" target="_blank" class="small-link">vezi</a></td>
    </tr>
<?php endforeach ?>
</table>
</form>

<div class="align-right">
	Gasite: <?php echo $totalCount;?>
</div>

<script type="text/javascript">
$(document).ready(function(){
		
	
	
	/* Change page functionality */
	$('#page').change(function(){
		$('#filter_page').val($('#page').val());
		
		$('#filter-form').submit();
	});
	
	
	/* Export functionality */
	$('#button-export').click(function(){
		$('#filter-form').attr('action', '<?php echo url_for('@default?module=filmStatus&action=export');?>')
			.attr('target', '_blank')
			.submit()
			.attr('action', '<?php echo url_for('@default_index?module=filmStatus') ?>')
			.attr('target', '_self');
	});
});
</script>