<h4>Importa filme pentru magazinul "<?php echo $shop->getName();?>"</h4>
<br /><br />
Atentie!!! Lista filmelor curente va fi stearsa, si inlocuita cu cea care va fi importata! <br />
<br />
<form method="post" action="<?php echo url_for('@default?module=shops&action=import');?>?sid=<?php echo $shop->getId();?>">
	URL Feed: <input type="text" name="import_url" style="width: 300px" /> <br /><br />
	<button type="submit">Importa</button> <a href="<?php echo url_for('@default?module=shops&action=films');?>?id=<?php echo $shop->getId();?>">Anuleaza</a>
</form>
