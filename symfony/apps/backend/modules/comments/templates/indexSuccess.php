<h4>Comentarii</h4>

<strong>Filtre</strong>
<form id="filter-form" action="<?php echo url_for('@default_index?module=comments') ?>" method="get">
<input type="hidden" id="filter-page" name="filter_page" value="<?php echo $filterPage;?>" />
<table>
	<tr>
    	<td class="pr-2">email<br /><input type="text" name="email" value="<?php echo $sf_params->get('email');?>" /></td>
        <td class="pr-2">
        	data publicarii<br />
			<input type="text" name="date_from" id="date_from" value="<?php echo $sf_params->get('date_from');?>" /><br />
                        <input type="text" name="date_to" id="date_to" value="<?php echo $sf_params->get('date_to');?>" />
        </td>
    	<td class="pr-2">
            Tip<br />
            <select name="model">
                <option value="" <?php if ($sf_params->get('model') == '') echo ' selected="selected"';?>></option>
                <option value="Article" <?php if ($sf_params->get('model') == 'Article') echo ' selected="selected"';?>>Articol</option>
                <option value="Film" <?php if ($sf_params->get('model') == 'Film') echo ' selected="selected"';?>>Film</option>
                <option value="Person" <?php if ($sf_params->get('model') == 'Person') echo ' selected="selected"';?>>Persoana</option>
                <option value="ArCinematicle" <?php if ($sf_params->get('model') == 'Cinema') echo ' selected="selected"';?>>Cinema</option>
                <option value="PhotoAlbum" <?php if ($sf_params->get('model') == 'PhotoAlbum') echo ' selected="selected"';?>>Foto</option>
                <option value="VideoAlbum" <?php if ($sf_params->get('model') == 'VideoAlbum') echo ' selected="selected"';?>>Video</option>
                <option value="Stire" <?php if ($sf_params->get('model') == 'Stire') echo ' selected="selected"';?>>Stire</option>
                <option value="FestivalEdition" <?php if ($sf_params->get('model') == 'FestivalEdition') echo ' selected="selected"';?>>Festival</option>
            </select>
        </td>
    	<td class="pr-2">LibraryID<br /><input type="text" name="model_library_id" value="<?php echo $sf_params->get('model_library_id');?>" /></td>
        <td class="pr-2"><button type="submit" id="button-filter">Filtreaza</button></td>
        <td class="pr-2"><button type="button" onclick="location.href='<?php echo url_for('@default_index?module=comments');?>'" id="button-reset">Reseteaza filtre</button></td>
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

<form method="post" id="list-form">

Cu cele selectate: <button type="button" id="delete-selected">Sterge</button>

<div class="clear"></div>
<br /><br />

<table>
    <tr>
    	<th><input type="checkbox" id="select-all" /></th>
        <th>ID</th>
        <th>Nume</th>
        <th>Email</th>
        <th>UserID</th>
        <th>Data</th>
        <th>Tip</th>
        <th>Obiect comentat</th>
    </tr>
<?php foreach($comments as $comment): ?>
	<tr>
    	<td><input type="checkbox" name="selected_objects[]" class="selected-object" value="<?php echo $comment->getId();?>" /></td>
            <td><?php echo $comment->getId();?></td>
            <td><?php echo $comment->getName();?></td>
            <td><?php echo $comment->getEmail();?></td>
            <td><?php echo $comment->getUserId();?></td>
            <td><?php echo format_date($comment->getCreatedAt(), 'F', 'ro');?></td>
            <td><?php echo $comment->getModel();?></td>
            <td><a href="<?php echo url_for('@' . $comment->getModel() . '_view');?>?lid=<?php echo $comment->getModelLibraryId();?>" target="_blank"><?php echo $comment->getModelName();?></a></td>
        </tr>
        <tr>
            <td colspan="8"><?php echo $comment->getContent();?></td>
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

        $('#date_from').datepicker({dateFormat: 'yy-mm-dd'});
	$('#date_to').datepicker({dateFormat: 'yy-mm-dd'});

	$('#select-all').click(function(){
		if ($('#select-all').is(':checked')){
			$('.selected-object').attr('checked', 'checked');
		} else {
			$('.selected-object').removeAttr('checked', 'checked');
		}
	});

	$('#delete-selected').click(function(){
		if (confirm('Esti sigur ca vrei sa stergi obiectele selectate?')){
			$('#list-form').attr('action', '<?php echo url_for('@default?module=comments&action=delete');?>');
			$('#list-form').submit();
		}
	});
});
</script>