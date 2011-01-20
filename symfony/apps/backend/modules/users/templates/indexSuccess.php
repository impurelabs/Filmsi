<h4>Webeditori</h4>
<div class="mb-3"><button type="button" onclick="location.href='<?php echo url_for('@default?module=users&action=newUser');?>'">Adauga User nou</button></div>

<strong>Filtre</strong>
<form id="filter-form" action="<?php echo url_for('@default_index?module=users') ?>" method="get">
<input type="hidden" id="filter-page" name="filter_page" value="<?php echo $filterPage;?>" />
<table>
	<tr>
    	<td class="pr-2">id<br /><input type="text" name="id" value="<?php echo $sf_params->get('id');?>" /></td>
    	<td class="pr-2">nume<br /><input type="text" name="name" value="<?php echo $sf_params->get('name');?>" /></td>
    	<td class="pr-2">email<br /><input type="text" name="email" value="<?php echo $sf_params->get('email');?>" /></td>
    	<td class="pr-2">username<br /><input type="text" name="username" value="<?php echo $sf_params->get('username');?>" /></td>
    	<td class="pr-2">
        	<input type="checkbox" name="clients" value="1" <?php if ($sf_params->has('clients') && $sf_params->get('clients') == '1') echo 'checked="checked"' ?> id="filter-clients" /> <label for="filter-clients">clienti</label><br />
            <input type="checkbox" name="webeditors" <?php if ($sf_params->has('webeditors') && $sf_params->get('webeditors') == '1') echo 'checked="checked"' ?> id="filter-webeditors" value="1" /> <label for="filter-webeditors">webeditori</label>
        </td>
    	<td class="pr-2">
        	<input type="checkbox" name="active" value="1" <?php if ($sf_params->has('active') && $sf_params->get('active') == '1') echo 'checked="checked"' ?> id="filter-active" /> <label for="filter-active">activi</label><br />
            <input type="checkbox" name="inactive" <?php if ($sf_params->has('inactive') && $sf_params->get('inactive') == '1') echo 'checked="checked"' ?> id="filter-inactive" value="1" /> <label for="filter-inactive">inactivi</label>
        </td>
        <td class="pr-2"><button type="submit" id="button-filter">Filtreaza</button></td>
        <td class="pr-2"><button type="button" onclick="location.href='<?php echo url_for('@default_index?module=users');?>'" id="button-reset">Reseteaza filtre</button></td>
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

<table>
    <tr>
        <th>ID</th>
        <th>Nume</th>
        <th>Email</th>
        <th>Username</th>
        <th>Permisiuni</th>
        <th>Status</th>
        <th></th>
        <th></th>
    </tr>
<?php foreach($users as $user): ?>
	<tr>
        <td><?php echo $user->getId();?></td>
        <td><?php echo $user->getName();?></td>
        <td><?php echo $user->getEmailAddress();?></td>
        <td><?php echo $user->getUsername();?></td>
        <td>
        	<?php foreach ($user->getPermissions() as $permission): ?>
            	<?php echo $permission->getName();?>, 
            <?php endforeach;?>
        </td>
        <td><img src="<?php echo image_path('state-' . ($user->getIsActive() == true ? '1' : '0') . '.png');?>" /></td>
        <td><a href="<?php echo url_for('@default?module=users&action=edit');?>?id=<?php echo $user->getId();?>" class="small-link">editeaza</a></td>
        <td><?php echo link_to('sterge', 'users/delete', array('confirm' => 'Esti sigur ca vrei sa-l stergi pe ' . $user->getName(), 'query_string' => 'id='.$user->getId(), 'post' => true, 'class' => 'small-link'));?></td>
    </tr>
<?php endforeach ?>
</table>

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
		$('#filter-form').attr('action', '<?php echo url_for('@default?module=users&action=export');?>')
			.attr('target', '_blank')
			.submit()
			.attr('action', '<?php echo url_for('@default_index?module=users') ?>')
			.attr('target', '_self');
	});
});
</script>