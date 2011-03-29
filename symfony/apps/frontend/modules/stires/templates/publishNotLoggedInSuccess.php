<h2>Publica stirea ta <span class="black">pe Filmsi</span></h2>



<div class="cell-container8 spacer-top-m"> <!-- content column start -->



	<div class="spacer-bottom-m">
    	<a href="<?php echo url_for('@stires');?>" class="whitebutton-l-link"><span class="icon-buttonbullet-green"></span> Arata toate stirile</a>
    </div>


    <div class="greencell innerspacer">
    	<div class="left normalcell tinyMce" style="width:450px; height:100px">
        	<?php echo $sf_data->getRaw('contentTop')->getContent();?>
        </div>
        <div class="left" style="color:#fff; font-size:135px; line-height:120px; font-weight:bold; margin-left:50px">?</div>

        <div class="clear"></div>
    </div>




    <h1 class="align-center spacer-bottom-m">Spune tuturor !</h1>

    <div class="normalcell left" style="width: 400px">
        <br /><br /><br /><br />
        <h6 class="align-center">Pentru a publica o stire, trebuie sa fii membru Filmsi</h6>

        <br /><br /><br /><br />
        <button id="enter-account-button" class="normalbutton" style="margin-left: 60px">Intra in cont</button>
        
        <button id="create-account-button" class="normalbutton" style="margin-left: 50px">Creeaza cont</button>

        <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
        <script type="text/javascript">
            $(document).ready(function(){
                $('#enter-account-button').click(function(){
                        
                        if ($("#user-container").is(':hidden')){
                                $('#user-container').load('<?php echo url_for('@login');?>')
                                        $('#user-container').slideDown('fast');
                        } else {
                                $('#user-container').slideUp('fast')
                                        .load('<?php echo url_for('@login');?>', function(){
                                                $(this).slideDown('fast');
                                        });
                        }
                });

                $('#create-account-button').click(function(){
                        if ($("#user-container").is(':hidden')){
                                $('#user-container').load('<?php echo url_for('@default?module=user&action=register');?>')
                                        $('#user-container').slideDown('fast');
                        } else {
                                $('#user-container').slideUp('fast')
                                        .load('<?php echo url_for('@default?module=user&action=register');?>', function(){
                                                $(this).slideDown('fast');
                                        });
                        }
                });
            });
        </script>
    </div>



    <div class="normalcell left spacer-left tinyMce" style="width: 220px; height: 400px">
		<?php echo $sf_data->getRaw('contentRight')->getContent();?>
    </div>

</div>





    <div class="cell-container7 spacer-left"> <!-- right column start -->
	<?php include_component('default', 'rightColumn', array('page' => Page::STIRE_PUBLISH));?>
</div> <!-- right column end -->