<strong>Filtre</strong>

<form id="filter-form" action="<?php echo url_for('@default_index?module=default') ?>" method="get">
<?php echo $filterForm['offset']->render();?>
<table>
	<tr>
    	<td class="pr-2">id<br /><?php echo $filterForm['id']->render();?><br /><?php echo $filterForm['id']->renderError();?></td>
    	<td class="pr-2">cod IMDB<br /><?php echo $filterForm['imdb']->render();?><br /><?php echo $filterForm['imdb']->renderError();?></td>
    	<td class="pr-2">cuvant cheie<br /><?php echo $filterForm['keyword']->render();?><br /><?php echo $filterForm['keyword']->renderError();?></td>
    	<td class="pr-2">
        	data publicarii<br />
			<?php echo $filterForm['date_from']->render();?><br /><?php echo $filterForm['date_to']->render();?><br />
			<?php echo $filterForm['date_from']->renderError();?><?php echo $filterForm['date_to']->renderError();?>
        </td>
    	<td class="pr-2">tip<br /><?php echo $filterForm['type']->render();?><br /><?php echo $filterForm['type']->renderError();?></td>
    	<td class="pr-2">categorie<br /><?php echo $filterForm['category']->render();?><br /><?php echo $filterForm['category']->renderError();?></td>
    	<td class="pr-2">autor<br /><?php echo $filterForm['author']->render();?><br /><?php echo $filterForm['author']->renderError();?></td>
		<td class="pr-2">
			<?php echo $filterForm['with_photo']->render();?> cu foto<br />
			<?php echo $filterForm['with_video']->render();?> cu video
		</td>
        <td class="pr-2"><button type="submit" id="button-filter">Filtreaza</button></td>
        <td class="pr-2"><button type="button" onclick="location.href='<?php echo url_for('@default_index?module=default');?>'">Reseteaza filtre</button></td>
        <td class="pr-2"><button type="button" id="button-export">Exporta</button></td>
    </tr>
</table>
</form>

<hr class="cell-separator-double mt-1 mb-3" />

<div class="right">
Pagina 
<select id="page">
	<?php for($counter = 1; $counter <= $pageCount; $counter++): ?>
	<option value="<?php echo $counter;?>"<?php if ($counter == $page) echo ' selected="selected"';?>><?php echo $counter;?></option>
	<?php endfor ;?>
</select>

</div>

<form method="get" id="list-form">
Cu cele selectate: 
<?php if ($sf_user->hasCredential('Moderator')):?>
<button type="button" id="delete-selected">Sterge</button> 
<?php endif;?>
<button type="button" id="clone-selected">Cloneaza</button> 

<div class="clear"></div>
<br /><br />


<table class="listhighlight">
    <tr>
    	<th><input type="checkbox" id="select-all" /></th>
        <th>ID</th>
        <th></th>
        <th>Cod IMDB</th>
        <th>Nume</th>
        <th>Publicat la</th>
        <th>Tip</th>
        <th>Categorie</th>
        <th>Autor</th>
        <th></th>
        <th></th>
    </tr>
<?php foreach($objects as $object): ?>
	<tr>
    	<td><input type="checkbox" name="selected_objects[]" class="selected-object" value="<?php echo $object->getId();?>" /></td>
        <td><?php echo $object->getId();?></td>
        <td><img src="<?php echo image_path('state-' . $object->getState() . '.png');?>" /></td>
        <td><?php echo $object->getImdb();?></td>
        <td><?php echo $object->getName();?></td>
        <td><?php echo $object->getPublishDate();?></td>
        <td><?php echo $object->getTypeName();?></td>
        <td><?php echo $object->getCategory();?></td>
        <td><?php echo $object->getAuthor()->getName();?></td>
        <td><a href="<?php echo url_for('@' . $object->getType() . '_view');?>?lid=<?php echo $object->getId();?>" target="_blank" class="small-link">vezi</a></td>
        <td><a href="<?php echo url_for('@' . $object->getType() . '_edit');?>?lid=<?php echo $object->getId();?>" target="_blank" class="small-link">editeaza</a></td>
    </tr>
<?php endforeach ?>
</table>
</form>

<hr class="cell-separator-double mt-1 mb-3" />

<strong>Total:</strong> <?php echo $totalCount;?> |
<strong>Aprobate:</strong> <?php echo $statisticActive;?> |
<strong>Neaprobate:</strong> <?php echo $statisticInactive;?> |
<strong>Cu foto:</strong> <?php echo $statisticWithPhoto;?> |
<strong>Cu video:</strong> <?php echo $statisticWithVideo;?> |
<strong>Cu cod IMDB:</strong> <?php echo $statisticWithImdb;?>


<script type="text/javascript">
$(document).ready(function(){
	$('#filter_date_from').datepicker({dateFormat: 'yy-mm-dd'});
	$('#filter_date_to').datepicker({dateFormat: 'yy-mm-dd'});
	
	$('#select-all').click(function(){
		if ($('#select-all').is(':checked')){
			$('.selected-object').attr('checked', 'checked');	
		} else {
			$('.selected-object').removeAttr('checked', 'checked');	
		}
	});
	<?php if ($sf_user->hasCredential('Moderator')):?>
	$('#delete-selected').click(function(){
		if (confirm('Esti sigur ca vrei sa stergi obiectele selectate?')){
			$('#list-form').attr('action', '<?php echo url_for('@default?module=default&action=delete');?>');
			$('#list-form').submit();
		} 
	});
	<?php endif;?>
	$('#clone-selected').click(function(){
		if (confirm('Esti sigur ca vrei sa clonezi obiectele selectate?')){
			$('#list-form').attr('action', '<?php echo url_for('@default?module=default&action=cloneObjects');?>');
			$('#list-form').submit();
		} 
	});
	
	
	
	/* Change page functionality */
	$('#page').change(function(){
		$('#filter_offset').val($('#page').val());
		
		$('#filter-form').submit();
	});
	
	
	/* Export functionality */
	$('#button-export').click(function(){
		$('.export-objects').remove();
		$('.selected-object:checked').each(function(index){
			$('<input type="hidden" class="export-objects" name="export_objects[]" value="' + $(this).val() + '" />').appendTo('#filter-form');
		});

		$('#filter-form').attr('action', '<?php echo url_for('@default?module=default&action=export');?>')
			.attr('target', '_blank')
			.submit()
			.attr('action', '<?php echo url_for('@default_index?module=default') ?>')
			.attr('target', '_self');
	});
});
</script>