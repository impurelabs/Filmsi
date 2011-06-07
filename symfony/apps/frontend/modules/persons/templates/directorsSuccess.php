<h2>Actori &amp; regizori</h2>
<div class="spacer-bottom-m" style="margin-top: 15px"><a href="<?php echo url_for('@homepage');?>" class="black-link">Home</a> &raquo; Actori &amp; Regizori </div>


<div class="cell-container6"> <!-- left column start -->
	<div class="cell spacer-bottom-m">
        <div class="cell-hd">
            <h5>Alege</h5>
        </div>
        <div class="cell-bd" style="padding:0">
        	<ul class="filterlist spacer-bottom-m">
        	<ul class="filterlist spacer-bottom-m">
            	<li onclick="location.href='<?php echo url_for('@persons');?>'" class="active">Regizori<span class="filter-cioc"></span></li>
                <li onclick="location.href='<?php echo url_for('@actors');?>'">Actori<span class="filter-cioc"></span></li>
            </ul>
        </div>
    </div>
</div> <!-- left column end -->




<div class="cell-container5 spacer-left"> <!-- content column start -->


     <div class="normalcell" style="padding-left: 5px; padding-right: 5px">
     	<ul class="letterpicker">
            <li><a href="<?php echo url_for('@directors_by_letter?letter=a');?>" class="bigblack-link">A<span class="letterpicker-cioc"></span></a></li>
            <li><a href="<?php echo url_for('@directors_by_letter?letter=b');?>" class="bigblack-link">B<span class="letterpicker-cioc"></span></a></li>
            <li><a href="<?php echo url_for('@directors_by_letter?letter=c');?>" class="bigblack-link">C<span class="letterpicker-cioc"></span></a></li>
            <li><a href="<?php echo url_for('@directors_by_letter?letter=d');?>" class="bigblack-link">D<span class="letterpicker-cioc"></span></a></li>
            <li><a href="<?php echo url_for('@directors_by_letter?letter=e');?>" class="bigblack-link">E<span class="letterpicker-cioc"></span></a></li>
            <li><a href="<?php echo url_for('@directors_by_letter?letter=f');?>" class="bigblack-link">F<span class="letterpicker-cioc"></span></a></li>
            <li><a href="<?php echo url_for('@directors_by_letter?letter=g');?>" class="bigblack-link">G<span class="letterpicker-cioc"></span></a></li>
            <li><a href="<?php echo url_for('@directors_by_letter?letter=h');?>" class="bigblack-link">H<span class="letterpicker-cioc"></span></a></li>
            <li><a href="<?php echo url_for('@directors_by_letter?letter=i');?>" class="bigblack-link">I<span class="letterpicker-cioc"></span></a></li>
            <li><a href="<?php echo url_for('@directors_by_letter?letter=j');?>" class="bigblack-link">J<span class="letterpicker-cioc"></span></a></li>
            <li><a href="<?php echo url_for('@directors_by_letter?letter=k');?>" class="bigblack-link">K<span class="letterpicker-cioc"></span></a></li>
            <li><a href="<?php echo url_for('@directors_by_letter?letter=l');?>" class="bigblack-link">L<span class="letterpicker-cioc"></span></a></li>
            <li><a href="<?php echo url_for('@directors_by_letter?letter=m');?>" class="bigblack-link">M<span class="letterpicker-cioc"></span></a></li>
            <li><a href="<?php echo url_for('@directors_by_letter?letter=n');?>" class="bigblack-link">N<span class="letterpicker-cioc"></span></a></li>
            <li><a href="<?php echo url_for('@directors_by_letter?letter=o');?>" class="bigblack-link">O<span class="letterpicker-cioc"></span></a></li>
            <li><a href="<?php echo url_for('@directors_by_letter?letter=p');?>" class="bigblack-link">P<span class="letterpicker-cioc"></span></a></li>
            <li><a href="<?php echo url_for('@directors_by_letter?letter=q');?>" class="bigblack-link">Q<span class="letterpicker-cioc"></span></a></li>
            <li><a href="<?php echo url_for('@directors_by_letter?letter=r');?>" class="bigblack-link">R<span class="letterpicker-cioc"></span></a></li>
            <li><a href="<?php echo url_for('@directors_by_letter?letter=s');?>" class="bigblack-link">S<span class="letterpicker-cioc"></span></a></li>
            <li><a href="<?php echo url_for('@directors_by_letter?letter=t');?>" class="bigblack-link">T<span class="letterpicker-cioc"></span></a></li>
            <li><a href="<?php echo url_for('@directors_by_letter?letter=u');?>" class="bigblack-link">U<span class="letterpicker-cioc"></span></a></li>
            <li><a href="<?php echo url_for('@directors_by_letter?letter=v');?>" class="bigblack-link">V<span class="letterpicker-cioc"></span></a></li>
            <li><a href="<?php echo url_for('@directors_by_letter?letter=w');?>" class="bigblack-link">W<span class="letterpicker-cioc"></span></a></li>
            <li><a href="<?php echo url_for('@directors_by_letter?letter=x');?>" class="bigblack-link">X<span class="letterpicker-cioc"></span></a></li>
            <li><a href="<?php echo url_for('@directors_by_letter?letter=y');?>" class="bigblack-link">Y<span class="letterpicker-cioc"></span></a></li>
            <li><a href="<?php echo url_for('@directors_by_letter?letter=x');?>" class="bigblack-link">Z<span class="letterpicker-cioc"></span></a></li>
        </ul>
         <div class="clear"></div>
     </div>


    <?php foreach ($persons as $letter => $personsByLetter):?>
        <?php if(count($personsByLetter) > 0):?>
        <div class="left spacer-bottom-m" style="width:150px; margin-left:10px">
            <h1><?php echo $letter;?></h1>
            <div class="normalcell" style="height: 200px">
                <?php foreach ($personsByLetter as $personByLetter):?>
                    <p class="spacer-bottom-s"><a href="<?php echo url_for('@person?id=' . $personByLetter->getId() . '&key=' . $personByLetter->getUrlKey());?>" class="important-link"><?php echo $personByLetter->getName();?></a></p>
                <?php endforeach;?>
                <span class="more-cell"><a href="<?php echo url_for('@directors_by_letter?letter=' . $letter);?>" class="smallwhite-link">vezi mai multi &raquo;</a></span>
            </div>
        </div>
        <?php endif;?>
    <?php endforeach;?>

     

    <div class="clear"></div>




</div> <!-- content column end -->




<div class="cell-container7 spacer-left"> <!-- right column start -->
	<?php include_component('default', 'rightColumn', array('page' => Page::PERSONS));?>
</div> <!-- right column end -->