<div class="cell spacer-bottom">
	<div class="cell-hd">
		<h4>Comenteaza <span class="black">subiectul </span></h4><a name="comments"></a>
	</div>
	<div class="cell-bd">
		<form method="post" action="<?php echo $action;?>">
			<?php echo $form->renderHiddenFields();?>
			<?php echo $form->renderGlobalErrors();?>
			<table class="normal-table">
				<tr>
					<td class="innerspacer-bottom" width="70"><strong>Nume</strong></td>
					<td class="innerspacer-bottom" width="370">
						<?php echo $form['name']->render(array('class' => 'inpttxt0', 'style' => 'width: 370px'));?><br />
						<?php echo $form['name']->renderError();?>
					</td>
				</tr>
				<tr>
					<td class="innerspacer-bottom" width="70"><strong>Email</strong></td>
					<td class="innerspacer-bottom" width="370">
						<?php echo $form['email']->render(array('class' => 'inpttxt0', 'style' => 'width: 370px'));?><br />
						<?php echo $form['email']->renderError();?>
					</td>
				</tr>
				<tr>
					<td class="innerspacer-bottom" width="70"><strong>Comentariu</strong></td>
					<td class="innerspacer-bottom" width="370">
						<?php echo $form['content']->render(array('class' => 'txtarea0', 'style' => 'width:370px; height: 109px'));?><br />
						<?php echo $form['content']->renderError();?>
					</td>
				</tr>

				<tr>
					<td class="innerspacer-bottom" width="70"></td>
					<td class="innerspacer-bottom" width="370">
						<div class="left" style="width: 170px">
						<button type="submit" class="normalbutton-s">Trimite comentariul tau</button>
						</div>
						<div class="left spacer-left explanation-small">Toate campurile sunt obligatorii.<br />Adresa ta de e-mail nu va aparea pe site </div>
						</td>
				</tr>

			</table>
		</form>
	</div>
</div> <!-- comment form -->



<?php if ($comments->count() > 0): ?>
    <div class="cell spacer-bottom">
        <div class="cell-hd">
            <h4>Parerea <span class="black">cititorului</span></h4>
        </div>

        <div class="cell-bd">
        	<ul class="spacer-bottom-m">
				<?php foreach($comments as $comment):?>
					<?php if($comment->getState() == 0):?>
						<?php if ($sf_user->isAuthenticated() && $comment->getUserId() == $sf_user->getGuardUser()->getId()):?>
							<li class="cell-separator-dotted-bottom innerspacer-bottom-s spacer-bottom-s">
								<p class="explanation spacer-bottom-s">
									<a href="" class="important-link"><?php echo $comment->getName();?></a>
									- <?php echo format_datetime($comment->getCreatedAt(), 'f', 'ro');?>
									<?php if($comment->getState() == 0):?><span style="color: #000">acest comentariu nu a fost inca aprobat</span><?php endif;?>
								</p>
								<p class="spacer-left-m">
									<?php echo $comment->getContent();?>
								</p>
							</li>
						<?php endif; ?>
					<?php else: ?>
                                            <li class="cell-separator-dotted-bottom innerspacer-bottom-s spacer-bottom-s">
                                                    <p class="explanation spacer-bottom-s">
                                                            <a href="" class="important-link"><?php echo $comment->getName();?></a>
                                                            - <?php echo format_datetime($comment->getCreatedAt(), 'f', 'ro');?>
                                                    </p>
                                                    <p class="spacer-left-m">
                                                            <?php echo $comment->getContent();?>
                                                    </p>
                                            </li>
                                        <?php endif;?>
				<?php endforeach;?>
            </ul>
        </div>

        <!--<div class="more-cell"><a href="" class="smallwhite-link">vezi toate comentariile</a></div>-->
    </div> <!-- latest comments -->
<?php endif;?>