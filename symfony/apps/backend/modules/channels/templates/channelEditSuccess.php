<h4 class="mb-3">Editeaza Canal</h4>

<form id="the-form" action="<?php echo url_for('@default?module=channels&action=channelEdit&id=' . $channel->getId());?>" method="post" enctype="multipart/form-data">

<?php echo $form->renderHiddenFields();?>
<?php echo $form->renderGlobalErrors();?>

<table class="span-19">
	<tr>
    	<th>Nume</th>
        <td><?php echo $form['name']->render(array('class' => 'span-13'));?><br /><?php echo $form['name']->renderError();?></td>
    </tr>
	<tr>
    	<th>Pula Id</th>
        <td><?php echo $form['cinemagia_pull_aid']->render(array('class' => 'span-13'));?><br /><?php echo $form['cinemagia_pull_aid']->renderError();?></td>
    </tr>
	<tr>
    	<th>Poza</th>
        <td><?php echo $form['file']->render();?><br /><?php echo $form['file']->renderError();?></td>
    </tr>
</table>


<div class="mt-2 mb-2 clear"></div>

<div class="mt-3">
    <button type="button" onclick="$('#the-form').submit()"class="mr-2">Creeaza</button>
    <a href="<?php echo $sf_request->getReferer();?>">Anuleaza</a>
</div>

</form>