<h2>Publica stirea ta <span class="black">pe Filmsi</span></h2>



<div class="cell-container8 spacer-top-m"> <!-- content column start -->



	<div class="spacer-bottom-m">
    	<a href="<?php echo url_for('@stires');?>" class="whitebutton-l-link"><span class="icon-buttonbullet-green"></span> Arata toate stirile</a>
    </div>


    <div class="greencell innerspacer">
    	<div class="left normalcell" style="width:450px; height:100px">
        	<p class="spacer-bottom-s">Ai aflat ceva interesant despre un film</p>
            <p class="spacer-bottom-s">Ai aflat ceva ce crezi ca ar trebui sa stie toata lumea despre o vedeta</p>
            <p class="spacer-bottom-s">Ai fost la lansarea unui film si simti ca ar trebui sa afle toti cum a fost acolo</p>
            <p class="spacer-bottom-s">Ai un actor sau regizor preferat si vrei sa ii faci cunoscute ultimele proiecte</p>
            <p class="spacer-bottom-s">S-a deschis un cinemtograf nou la tine in oras si vrei sa afle toata lumea</p>
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
            <?php echo $form['file']->render();?><br >

            <?php echo $form['file']->renderError();?><br /><br />

            <button type="submit" class="normalbutton">Sunt de acord cu conditiile si vreau sa public stirea</button>
            <br /><br />
        </form>
    </div>



    <div class="normalcell left spacer-left" style="width: 220px; height: 400px">
    Consideram ca fiecare are ceva de spus despre un fapt cu care ia contact la un moment dat in viata. De asemenea stim ca fiecare dintre noi are o viziune proprie asupra evenimentelor in care este imlicat sau la care asista.
<br /><br />
FilmSi iti permite sa publici in timp real informatii pe care le cunosti si le crezi ca sunt importante pentru cei ca tine.
<br /><br />
Completeaza formularul alaturat, apasa butonul "Publica pe FilmSi.ro", iar stirea va fi online in catvea minute.
<br /><br />
Bonus! - iti facem un cont pe site si te anuntam constant despre cele mai importante evenimente.
    </div>



</div>


    <div class="cell-container7 spacer-left"> <!-- right column start -->
	this is the right column
</div> <!-- right column end -->