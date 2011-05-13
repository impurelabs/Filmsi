<h4>Importa filme pentru magazinul "<?php echo $shop->getName();?>"</h4>
<a href="<?php echo url_for('@default?module=shops&action=films');?>?id=<?php echo $shop->getId();?>">Intoarce-te inapoi</a>
<br /><br />

<?php if ($shop->getImportTotal() > 0):?>
	Au fost importate <?php echo $shop->getImportPointer();?> din <?php echo $shop->getImportTotal();?> filme.<br /><br />
	Urmeaza pasii de mai jos pentru a termina importul:<br />
	<strong>Pasul 1:</strong> Da click pe butonul de mai jos pentru a incepe importul, dupa care asteapta sa se faca importul.<br />
	<strong>Pasul 2:</strong> Repeta pasul 1 pana cand se termina toate filmele de importat. <br /><br />
	<form method="post" action="<?php echo url_for('@default?module=shops&action=importBatch');?>?sid=<?php echo $shop->getId();?>">
		<button type="button" class="submit-button">Importa urmatoarea runda de filme</button>
	</form>
<?php else: ?>
	Completeaza formularul de mai jos pentru a incepe procedura de pregatire a importului!!! <br /><br />
	<form method="post" action="<?php echo url_for('@default?module=shops&action=prepareImport');?>?sid=<?php echo $shop->getId();?>">
		URL Feed: <input type="text" name="import_url" style="width: 300px" /> <br /><br />
		<button type="button" class="submit-button">P R E G A T E S T E    I M P O R T U L</button>
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