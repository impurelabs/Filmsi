<br /><br />
<?php if ($imported):?>
<h4>Detaliile au fost importate cu succes!</h4>
<?php else: ?>
<h4>Filmul nu a fost gasit in baza de date a Provideo.</h4>
<?php endif;?>
<br/>
Click <a href="<?php echo url_for('@default?module=films&action=edit');?>?lid=<?php echo $film->getLibraryId();?>">AICI</a> pentru a continua.

<br /><br />