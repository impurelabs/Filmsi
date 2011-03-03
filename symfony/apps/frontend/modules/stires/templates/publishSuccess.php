<h2>Publica stirea ta <span class="black">pe Filmsi</span></h2>



<div class="cell-container8 spacer-top-m"> <!-- content column start -->



	<div class="spacer-bottom-m">
    	<a href="<?php echo url_for('@stires');?>" class="whitebutton-l-link"><span class="icon-buttonbullet-green"></span> Arata toate stirile</a>
    </div>


    <div class="greencell innerspacer">
    	<div class="left normalcell" style="width:450px; height:100px">
        	<?php echo $sf_data->getRaw('contentTop')->getContent();?>
        </div>
        <div class="left" style="color:#fff; font-size:135px; line-height:120px; font-weight:bold; margin-left:50px">?</div>

        <div class="clear"></div>
    </div>




    <h1 class="align-center spacer-bottom-m">Spune tuturor !</h1>

    <div class="normalcell left" style="width: 400px">
        <form action="<?php echo url_for('@stire_publish');?>" method="post" enctype="multipart/form-data">
            <?php echo $form->renderHiddenFields();?>
            <?php echo $form->renderGlobalErrors();?>

            <strong>Titlu stire</strong><br />
            <?php echo $form['name']->render(array('class' => 'inpttxt0', 'style' => 'width: 385px'));?><br >
            <?php echo $form['name']->renderError();?><br /><br />

            <strong>Text stire</strong><br />
            <?php echo $form['content_content']->render(array('class' => 'txtarea0', 'style' => 'width: 385px'));?><br >
            <?php echo $form['content_content']->renderError();?><br /><br />

            <strong>Upload imagine </strong> <span class="explanation">(maxim 1 MB)</span><br />
            <?php echo $form['filename']->render();?><br >

            <?php echo $form['filename']->renderError();?><br /><br />

            <button type="submit" class="normalbutton">Sunt de acord cu conditiile si vreau sa public stirea</button>
            <br /><br />
        </form>
    </div>



    <div class="normalcell left spacer-left" style="width: 220px; height: 400px">
		<?php echo $sf_data->getRaw('contentRight')->getContent();?>
    </div>



</div>


    <div class="cell-container7 spacer-left"> <!-- right column start -->
	this is the right column
</div> <!-- right column end -->