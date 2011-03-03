<h4>Abonati newsletter</h4>



<form method="post" id="list-form">
Cu cele selectate: <button type="button" id="delete-selected">Sterge</button>
<div class="clear"></div>
<br /><br />

<table>
    <tr>
    	<th><input type="checkbox" id="select-all" /></th>
        <th>ID</th>
        <th>Email</th>
    </tr>
<?php foreach($emails as $email): ?>
	<tr>
    	<td><input type="checkbox" name="selected_objects[]" class="selected-object" value="<?php echo $email->getId();?>" /></td>
            <td><?php echo $email->getId();?></td>
            <td><?php echo $email->getEmail();?></td>
        </tr>
<?php endforeach ?>
</table>

</form>

<div class="align-right">
	Gasite: <?php echo $emails->count();?>
</div>

<script type="text/javascript">
$(document).ready(function(){

	$('#select-all').click(function(){
		if ($('#select-all').is(':checked')){
			$('.selected-object').attr('checked', 'checked');
		} else {
			$('.selected-object').removeAttr('checked', 'checked');
		}
	});

	$('#delete-selected').click(function(){
		if (confirm('Esti sigur ca vrei sa stergi obiectele selectate?')){
			$('#list-form').attr('action', '<?php echo url_for('@default?module=newsletter&action=delete');?>');
			$('#list-form').submit();
		}
	});
});
</script>