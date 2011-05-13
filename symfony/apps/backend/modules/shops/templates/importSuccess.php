<h4>Importa filme pentru magazinul "<?php echo $shop->getName();?>"</h4>
<a href="<?php echo url_for('@default?module=shops&action=films');?>?id=<?php echo $shop->getId();?>">Intoarce-te inapoi</a>
<br /><br />

<?php if ($preparedFilms > 0):?>
	<?php echo $preparedFilms;?> filme sunt pregatite pentru import.<br /><br />
	Urmeaza pasii de mai jos pentru a termina importul:<br />
	<strong>Pasul 1:</strong> Da click pe butonul de mai jos pentru a incepe importul, dupa care asteapta sa se faca importul.<br />
	<strong>Pasul 2:</strong> Repeta pasul 1 pana cand nu mai ramane nici un film pregatit pentru import. <br /><br />
	<form method="post" action="<?php echo url_for('@default?module=shops&action=makeImport');?>?sid=<?php echo $shop->getId();?>">
		<button type="button" class="submit-button">Importa urmatoarea runda de filme</button>
	</form>
<?php else: ?>
	Completeaza formularul de mai jos pentru a incepe procedura de pregatire a importului!!! <br /><br />
	<form method="post" action="<?php echo url_for('@default?module=shops&action=importBuffer');?>?sid=<?php echo $shop->getId();?>">
		URL Feed: <input type="text" name="import_url" style="width: 300px" /> <br /><br />
		<button type="button" class="submit-button">S T A R T</button>
	</form>
<?php endif;?>

<script type="text/javascript">
$(document).ready(function(){
	$('.submit-button').click(function(){
		$button = $(this);
		$('<img src="<?php echo image_path('indicator.gif');?>" />').insertBefore($button);
		
		$button.parent().submit();
		
		$button.hide();
	});
});
</script>