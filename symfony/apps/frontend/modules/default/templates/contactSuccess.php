<h2>Contact</h2>

<div class="spacer-bottom-m" style="margin-top: 15px">
	<a href="<?php echo url_for('@homepage');?>" class="black-link">Home</a> &raquo;
	<a href="<?php echo url_for('@default?module=default&action=contact');?>" class="black-link">Termeni si conditii</a>
</div>


<div class="cell-container8"> <!-- content column start -->

	<div class="normalcell tinyMce">
		<?php echo $sf_data->getRaw('content')->getContent();?>

		<div class="cell-separator-double mt-2 mb-2"></div>

		<?php if(isset($messageSentOk)):?>
		<br /><br /><br />
		<div class="align-center">
			<span class="big strong">Mesajul a fost trimis cu succes!</span><br />
			Click <a href="<?php echo url_for('@default?module=default&action=contact');?>" class="important-link">AICI</a> pentru a va intoarce.
		</div>
		<br /><br /><br />
		<?php else: ?>
			<form action="<?php echo url_for('@default?module=default&action=contact');?>" method="post">
			<?php echo $form->renderHiddenFields();?>
			<?php echo $form->renderGlobalErrors();?>
				<table>
					<tr>
						<td><span class="red">*</span> <strong>Nume</strong></td>
						<td><?php echo $form['last_name']->render(array('class' => 'inpttxt0', 'style' => 'width: 220px'));?><br /><?php echo $form['last_name']->renderError();?></td>
						<td><span class="red">*</span> <strong>Email</strong></td>
						<td><?php echo $form['email']->render(array('class' => 'inpttxt0', 'style' => 'width: 220px'));?><br /><?php echo $form['email']->renderError();?></td>
					</tr>
					<tr>
						<td style="background-color: #ffffff"><span class="red">*</span> <strong>Prenume</strong></td>
						<td style="background-color: #ffffff"><?php echo $form['first_name']->render(array('class' => 'inpttxt0', 'style' => 'width: 220px'));?><br /><?php echo $form['first_name']->renderError();?></td>
						<td style="background-color: #ffffff">&nbsp;&nbsp;<strong>Telefon</strong></td>
						<td style="background-color: #ffffff"><?php echo $form['phone']->render(array('class' => 'inpttxt0', 'style' => 'width: 220px'));?><br /><?php echo $form['phone']->renderError();?></td>
					</tr>
					<tr>
						<td><span class="red">*</span> <strong>Mesaj</strong></td>
						<td colspan="3"><?php echo $form['message']->render(array('class' => 'txtarea0', 'style' => 'width: 551px'));?><br /><?php echo $form['message']->renderError();?></td>
					</tr>
					<tr>
						<td style="background-color: #ffffff"></td>
						<td style="background-color: #ffffff" colspan="3"><div class="cell-separator-double mt-2 mb-2"></div></td>
					</tr>
					<tr>
						<td></td>
						<td colspan="3">
							<button type="submit" class="right normalbutton">Trimite mesajul tau</button>
							Campurile marcate cu <span class="red">*</span> sunt obligatorii
							<div class="clear"></div>
						</td>
					</tr>
				</table>
			</form>

		<?php endif;?>

	</div>

</div> <!-- content column end -->

<div class="cell-container7 spacer-left"> <!-- right column start -->
	this is the right column
</div> <!-- right column end -->