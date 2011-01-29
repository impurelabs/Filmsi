<h2>Actori &amp; regizori</h2>
<div class="spacer-bottom-m"><a href="<?php echo url_for('@homepage');?>" class="black-link">Home</a> &raquo; Actori &amp; Regizori </div>


<div class="cell-container6"> <!-- left column start -->
	<div class="cell spacer-bottom-m">
        <div class="cell-hd">
            <h5>Alege <span class="black">genul filmului</span></h5>
        </div>
        <div class="cell-bd" style="padding:0">
        	<ul class="filterlist spacer-bottom-m">
            	<li onclick="location.href='<?php echo url_for('@directors');?>'" class="active">Regizori<span class="filter-cioc"></span></li>
                <li onclick="location.href='<?php echo url_for('@actors');?>'">Actori<span class="filter-cioc"></span></li>
            </ul>
        </div>
    </div>
</div> <!-- left column end -->




<div class="cell-container5 spacer-left"> <!-- content column start -->


     <div class="normalcell" style="padding-left: 5px; padding-right: 5px">
     	<ul class="letterpicker">
            <li <?php if ($sf_request->getParameter('letter') == 'a') echo 'class="active"';?>><a href="<?php echo url_for('@directors_by_letter?letter=a');?>" class="bigblack-link">A<span class="letterpicker-cioc"></span></a></li>
            <li <?php if ($sf_request->getParameter('letter') == 'b') echo 'class="active"';?>><a href="<?php echo url_for('@directors_by_letter?letter=b');?>" class="bigblack-link">B<span class="letterpicker-cioc"></span></a></li>
            <li <?php if ($sf_request->getParameter('letter') == 'c') echo 'class="active"';?>><a href="<?php echo url_for('@directors_by_letter?letter=c');?>" class="bigblack-link">C<span class="letterpicker-cioc"></span></a></li>
            <li <?php if ($sf_request->getParameter('letter') == 'd') echo 'class="active"';?>><a href="<?php echo url_for('@directors_by_letter?letter=d');?>" class="bigblack-link">D<span class="letterpicker-cioc"></span></a></li>
            <li <?php if ($sf_request->getParameter('letter') == 'e') echo 'class="active"';?>><a href="<?php echo url_for('@directors_by_letter?letter=e');?>" class="bigblack-link">E<span class="letterpicker-cioc"></span></a></li>
            <li <?php if ($sf_request->getParameter('letter') == 'f') echo 'class="active"';?>><a href="<?php echo url_for('@directors_by_letter?letter=f');?>" class="bigblack-link">F<span class="letterpicker-cioc"></span></a></li>
            <li <?php if ($sf_request->getParameter('letter') == 'g') echo 'class="active"';?>><a href="<?php echo url_for('@directors_by_letter?letter=g');?>" class="bigblack-link">G<span class="letterpicker-cioc"></span></a></li>
            <li <?php if ($sf_request->getParameter('letter') == 'h') echo 'class="active"';?>><a href="<?php echo url_for('@directors_by_letter?letter=h');?>" class="bigblack-link">H<span class="letterpicker-cioc"></span></a></li>
            <li <?php if ($sf_request->getParameter('letter') == 'i') echo 'class="active"';?>><a href="<?php echo url_for('@directors_by_letter?letter=i');?>" class="bigblack-link">I<span class="letterpicker-cioc"></span></a></li>
            <li <?php if ($sf_request->getParameter('letter') == 'j') echo 'class="active"';?>><a href="<?php echo url_for('@directors_by_letter?letter=j');?>" class="bigblack-link">J<span class="letterpicker-cioc"></span></a></li>
            <li <?php if ($sf_request->getParameter('letter') == 'k') echo 'class="active"';?>><a href="<?php echo url_for('@directors_by_letter?letter=k');?>" class="bigblack-link">K<span class="letterpicker-cioc"></span></a></li>
            <li <?php if ($sf_request->getParameter('letter') == 'l') echo 'class="active"';?>><a href="<?php echo url_for('@directors_by_letter?letter=l');?>" class="bigblack-link">L<span class="letterpicker-cioc"></span></a></li>
            <li <?php if ($sf_request->getParameter('letter') == 'm') echo 'class="active"';?>><a href="<?php echo url_for('@directors_by_letter?letter=m');?>" class="bigblack-link">M<span class="letterpicker-cioc"></span></a></li>
            <li <?php if ($sf_request->getParameter('letter') == 'n') echo 'class="active"';?>><a href="<?php echo url_for('@directors_by_letter?letter=n');?>" class="bigblack-link">N<span class="letterpicker-cioc"></span></a></li>
            <li <?php if ($sf_request->getParameter('letter') == 'o') echo 'class="active"';?>><a href="<?php echo url_for('@directors_by_letter?letter=o');?>" class="bigblack-link">O<span class="letterpicker-cioc"></span></a></li>
            <li <?php if ($sf_request->getParameter('letter') == 'p') echo 'class="active"';?>><a href="<?php echo url_for('@directors_by_letter?letter=p');?>" class="bigblack-link">P<span class="letterpicker-cioc"></span></a></li>
            <li <?php if ($sf_request->getParameter('letter') == 'q') echo 'class="active"';?>><a href="<?php echo url_for('@directors_by_letter?letter=q');?>" class="bigblack-link">Q<span class="letterpicker-cioc"></span></a></li>
            <li <?php if ($sf_request->getParameter('letter') == 'r') echo 'class="active"';?>><a href="<?php echo url_for('@directors_by_letter?letter=r');?>" class="bigblack-link">R<span class="letterpicker-cioc"></span></a></li>
            <li <?php if ($sf_request->getParameter('letter') == 's') echo 'class="active"';?>><a href="<?php echo url_for('@directors_by_letter?letter=s');?>" class="bigblack-link">S<span class="letterpicker-cioc"></span></a></li>
            <li <?php if ($sf_request->getParameter('letter') == 't') echo 'class="active"';?>><a href="<?php echo url_for('@directors_by_letter?letter=t');?>" class="bigblack-link">T<span class="letterpicker-cioc"></span></a></li>
            <li <?php if ($sf_request->getParameter('letter') == 'u') echo 'class="active"';?>><a href="<?php echo url_for('@directors_by_letter?letter=u');?>" class="bigblack-link">U<span class="letterpicker-cioc"></span></a></li>
            <li <?php if ($sf_request->getParameter('letter') == 'v') echo 'class="active"';?>><a href="<?php echo url_for('@directors_by_letter?letter=v');?>" class="bigblack-link">V<span class="letterpicker-cioc"></span></a></li>
            <li <?php if ($sf_request->getParameter('letter') == 'w') echo 'class="active"';?>><a href="<?php echo url_for('@directors_by_letter?letter=w');?>" class="bigblack-link">W<span class="letterpicker-cioc"></span></a></li>
            <li <?php if ($sf_request->getParameter('letter') == 'x') echo 'class="active"';?>><a href="<?php echo url_for('@directors_by_letter?letter=x');?>" class="bigblack-link">X<span class="letterpicker-cioc"></span></a></li>
            <li <?php if ($sf_request->getParameter('letter') == 'y') echo 'class="active"';?>><a href="<?php echo url_for('@directors_by_letter?letter=y');?>" class="bigblack-link">Y<span class="letterpicker-cioc"></span></a></li>
            <li <?php if ($sf_request->getParameter('letter') == 'z') echo 'class="active"';?>><a href="<?php echo url_for('@directors_by_letter?letter=x');?>" class="bigblack-link">Z<span class="letterpicker-cioc"></span></a></li>
        </ul>

        <div class="clear"></div>
     </div>

     <br />

     <div class="normalcell">
        <?php foreach ($persons as $person):?>
        <div class="left spacer-bottom-m" style="width: 75px; margin-left: 20px; text-align: center; margin-right: 20px">
            <a href="<?php echo url_for('@person?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>">
                <img src="<?php echo filmsiPersonPhotoThumb($person->getFilename());?>" style="border: 1px solid #d5d5d5; padding: 1px" /><br />
                <?php echo $person->getName();?>
            </a>
        </div>
        <?php endforeach;?>

         <div class="clear"></div>

     </div>

     

    <div class="clear"></div>


    <div class="cell-separator-dotted-top cell-separator-dotted-bottom innerspacer-bottom innerspacer-top"> <!-- page navigator start -->
		<div class="inline-block spacer-left-m spacer-right-l">Regizorii <?php echo $firstPersonCount;?>-<?php echo $lastPersonCount;?></div>

        <?php if($currentPage > 1):?>
			<a href="<?php echo url_for('@directors_by_letter?letter=' . $sf_request->getParameter('letter'));?>?p=<?php echo $currentPage - 1;?>"><span class="pagenav-back"></span></a>
		<?php endif;?>
		<?php for ($i = 1; $i <= $pageCount; $i++):?>
			<a href="<?php echo url_for('@directors_by_letter?letter=' . $sf_request->getParameter('letter'));?>?p=<?php echo $i;?>"><span class="<?php echo $i == $currentPage ? 'pagenav-active' : 'pagenav';?>"><?php echo $i;?></span></a>
		<?php endfor;?>
		<?php if($currentPage < $pageCount):?>
		<a href="<?php echo url_for('@directors_by_letter?letter=' . $sf_request->getParameter('letter'));?>?p=<?php echo $currentPage + 1;?>"><span class="pagenav-forward"></span></a>
		<?php endif;?>


        <div class="inline-block spacer-left-l">din <?php echo $personCount;?></div>
    </div><!-- page navigator end -->


</div> <!-- content column end -->




<div class="cell-container7 spacer-left"> <!-- right column start -->
	this is the right column
</div> <!-- right column end -->