<h4 class="mb-3">Editeaza Url-ul pentru filmul "<?php echo $shopFilm->getFilm()->getName();?>"</h4>

<div class="clear"></div>

<form action="<?php echo url_for('@default?module=shops&action=editFilm');?>?id=<?php echo $shopFilm->getId();?>" method="post" enctype="multipart/form-data">

<?php echo $form->renderHiddenFields();?>
<?php echo $form->renderGlobalErrors();?>

<table class="span-19">
	<tr>
    	<th>Url</th>
        <td><?php echo $form['url']->render(array('style' => 'width: 300px'));?><br /><?php echo $form['url']->renderError();?></td>
    </tr>
	<tr>
    	<th>Format</th>
        <td><?php echo $form['format']->render();?><br /><?php echo $form['format']->renderError();?></td>
    </tr>

</table>

<div class="clear"></div>


<div class="mt-3">
    <button type="submit" class="mr-2">Salveaza</button>
    <a href="<?php echo url_for('@default?module=shops&action=films');?>?id=<?php echo $shopFilm->getShopId();?>">Anuleaza</a>
</div>

</form>

