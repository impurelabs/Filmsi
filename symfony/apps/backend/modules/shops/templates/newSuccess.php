<h4 class="mb-3">Creeaza Magazin Nou</h4>

<form id="the-form" action="<?php echo url_for('@default?module=shops&action=new');?>" method="post" enctype="multipart/form-data">

<?php echo $form->renderHiddenFields();?>
<?php echo $form->renderGlobalErrors();?>

<table class="span-19">
	<tr>
    	<th>Nume</th>
        <td><?php echo $form['name']->render(array('class' => 'span-13'));?><br /><?php echo $form['name']->renderError();?></td>
    </tr>
	<tr>
    	<th>Email</th>
        <td><?php echo $form['email']->render(array('class' => 'span-13'));?><br /><?php echo $form['email']->renderError();?></td>
    </tr>
	<tr>
    	<th>Telefon</th>
        <td><?php echo $form['phone']->render(array('class' => 'span-13'));?><br /><?php echo $form['phone']->renderError();?></td>
    </tr>
	<tr>
    	<th>URL</th>
        <td><?php echo $form['url']->render(array('class' => 'span-13'));?><br /><?php echo $form['url']->renderError();?></td>
    </tr>
	<tr>
    	<th>Descriere</th>
        <td><?php echo $form['description']->render(array('class' => 'span-13'));?><br /><?php echo $form['description']->renderError();?></td>
    </tr>
	<tr>
    	<th>Logo</th>
        <td><?php echo $form['file']->render();?><br /><?php echo $form['file']->renderError();?></td>
    </tr>
</table>

<div class="clear"></div>

<div class="mt-3">
    <button type="button" onclick="$('#the-form').submit()"class="mr-2">Salveaza</button>
    <a href="<?php echo $sf_request->getReferer();?>">Anuleaza</a>
</div>

</form>

<script type="text/javascript">
	$(document).ready(function(){
	});
</script>