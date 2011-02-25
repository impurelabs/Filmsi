<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <?php use_javascript('jquery-1.4.2.min.js') ?>
    <?php use_javascript('jquery.jcarousel.min.js') ?>
    <?php use_javascript('jquery-ui-1.8.5.custom.min.js') ?>
    <?php use_javascript('general.js') ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php use_stylesheet('jquery-ui-1.8.6.custom.css');?>
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
    <script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script><script type="text/javascript">stLight.options({publisher:'63eaa96b-48e9-4de4-bb58-61dc7a91b1ad'});</script>

	<?php if(has_slot('festivals_layout')):?>
		<?php include_slot('festivals_layout');?>
	<?php endif;?>

  </head>
<body>
	<div id="wrapper">
    	<div id="user-container"></div><!-- user container  end -->

		<div id="menu-container">
        	<div class="menu-top-spacer"></div>

            <div class="right" id="menu-userlinks">
				<?php if ($sf_user->isAuthenticated()):?>
				<span><a href="<?php echo url_for('@sf_guard_signout');?>" class="white-link">Iesi</a></span>
				<span class="last"><a href="javascript: void(0)" class="white-link user-opener" id="user-cover-link">Contul meu</a></span>
				<?php else: ?>
              	<span><a href="javascript: void(0)" class="white-link" id="user-login-link">Intra in cont</a></span>
                <span class="last"><a href="javascript: void(0)" class="white-link" id="user-register-link">Creeaza cont</a></span>
				<?php endif;?>
            </div><!-- menu-userlinks end -->

            <div class="menu">
  	            <span><a href="" class="menu-link-active">Home</a></span>
                <span><a href="<?php echo url_for('@film_now_in_cinema');?>" class="menu-link separated">In cinema</a></span>
                <span><a href="<?php echo url_for('@film_now_on_dvd');?>" class="menu-link">Pe DVD &amp; Bluray</a></span>
                <span><a href="<?php echo url_for('@film_on_tv');?>" class="menu-link">La TV</a></span>
                <span><a href="<?php echo url_for('@stires');?>" class="menu-link">Stiri</a></span>
                <span><a href="<?php echo url_for('@trailers');?>" class="menu-link">Trailere</a></span>
                <span><a href="<?php echo url_for('@festivals');?>" class="menu-link">Festivaluri</a></span>
                <span><a href="<?php echo url_for('@articles');?>" class="menu-link">Din filme</a></span>
                <span><a href="<?php echo url_for('@persons');?>" class="menu-link">Actori &amp; Regizori</a></span>
                <span class="last"><a href="<?php echo url_for('@cinemas');?>" class="menu-link">Cinematografe</a></span>
            </div> <!-- menu end -->

            <div class="clear"></div>
        </div><!-- menu-container end -->

        <div id="advertising1">
        	<img src="images/temp/advertising1.png" />
        </div><!-- advertising 1 end -->

        <div class="header">
        	<a href="http://www.filmsi.ro" class="header-logo"></a>

            <div class="mainsearch-container">
	            <?php include_partial('default/search', array('searchId' => '1'));?>
            </div> <!-- mainsearch-container end -->
			<div style="margin-top: 15px">
				<a href="" class="spacer-left-l">Program cinema &raquo;</a>
			</div>

			<div class="clear"></div>

        </div><!-- header end -->


    <?php echo $sf_content ?>


<div class="clear"></div>

		<div class="bottom-widgets">

             <div class="align-center spacer-bottom spacer-top-m"><h2>Cele mai populare</h2></div>


             <div class="normalcell">
             	<div class="inline-block align-center spacer-bottom spacer-left-m" style="width: 83px">
                    <a href="javascript:void(0)"><img src="images/temp/home-thumb4.png" /></a> <br />
                    <a href="javascript:void(0)" class="black-link">Tom Hanks</a> <br />
                </div>
                <div class="inline-block align-center spacer-bottom spacer-left" style="width: 83px">
                    <a href="javascript:void(0)"><img src="images/temp/home-thumb4.png" /></a> <br />
                    <a href="javascript:void(0)" class="black-link">Tom Hanks</a> <br />
                </div>
                <div class="inline-block spacer-left" style="width: 250px">
                	<h5 class="spacer-bottom">Buzz</h5>
                    <ul class="list4">
                    	<li><a href="javascript void(0)" class="black-link">Len Wiseman ar putea regiza remake-ul Total Recall</a></li>
                        <li><a href="javascript void(0)" class="black-link">Len Wiseman ar putea regiza remake-ul Total Recall</a></li>
                        <li><a href="javascript void(0)" class="black-link">Len Wiseman ar putea regiza remake-ul Total Recall</a></li>
                    </ul>
                </div>
                <div class="inline-block align-center spacer-bottom spacer-left" style="width: 83px">
                    <a href="javascript:void(0)"><img src="images/temp/home-thumb4.png" /></a> <br />
                    <a href="javascript:void(0)" class="black-link">Tom Hanks</a> <br />
                </div>
                <div class="inline-block align-center spacer-bottom spacer-left" style="width: 83px">
                    <a href="javascript:void(0)"><img src="images/temp/home-thumb4.png" /></a> <br />
                    <a href="javascript:void(0)" class="black-link">Tom Hanks</a> <br />
                </div>
                <div class="inline-block align-center spacer-bottom spacer-left" style="width: 83px">
                    <a href="javascript:void(0)"><img src="images/temp/home-thumb4.png" /></a> <br />
                    <a href="javascript:void(0)" class="black-link">Tom Hanks</a> <br />
                </div>
                <div class="inline-block align-center spacer-bottom spacer-left" style="width: 83px">
                    <a href="javascript:void(0)"><img src="images/temp/home-thumb4.png" /></a> <br />
                    <a href="javascript:void(0)" class="black-link">Tom Hanks</a> <br />
                </div>
                <div class="inline-block align-center spacer-bottom spacer-left" style="width: 83px">
                    <a href="javascript:void(0)"><img src="images/temp/home-thumb4.png" /></a> <br />
                    <a href="javascript:void(0)" class="black-link">Tom Hanks</a> <br />
                </div>

             </div>









             <?php include_component('default', 'visitHistory');?>

        </div><!-- bottom widgets end -->












        <div class="footer">

        	<div class="header spacer-bottom-m">
                <a href="http://www.filmsi.ro" class="header-logo"></a>

                <div class="mainsearch-container">
                    <input type="text" class="searchmain-field" /><button class="searchmain-button" /></button><a href="" class="spacer-left-l">Program cinema &raquo;</a>
                </div> <!-- mainsearch-container end -->

                <div class="clear"></div>

            </div>


             <div class="footermenu">
  	            <span><a href="" class="menu-link-active">Home</a></span>
                <span><a href="" class="menu-link separated">In cinema</a></span>
                <span><a href="" class="menu-link">Pe DVD &amp; Bluray</a></span>
                <span><a href="" class="menu-link">La TV</a></span>
                <span><a href="" class="menu-link">Stiri</a></span>
                <stpan><a href="" class="menu-link">Trailere</a></span>
                <span><a href="" class="menu-link">Din filme</a></span>
                <span><a href="" class="menu-link">Actori &amp; Regizori</a></span>
                <span class="last"><a href="" class="menu-link">Cinematografe</a></span>
            </div> <!-- menu end -->



            <div class="greencell white spacer-bottom-m">
            	<div class="right">
                	<a href="" class="white-link">Termeni si conditii</a> |
                    <a href="" class="white-link">Publicitate</a> |
                    <a href="" class="white-link">Contact</a>
                </div>

                FilmSi - Toate drepturile rezervate
            </div>




            <div>
            	<div class="inline-block spacer-bottom-l spacer-left" style="width: 235px; height: 90px">
                	<p class="bigstrong spacer-bottom">La cinema</p>
                    <a href="">Amor la distanta</a><br />
                    <a href="">Amor la distanta</a><br />
                    <a href="">Amor la distanta</a><br />
                    <a href="">Amor la distanta</a><br />
                    <a href="">Amor la distanta</a>
                </div>
            	<div class="inline-block spacer-bottom-l spacer-left" style="width: 235px; height: 90px">
                	<p class="bigstrong spacer-bottom">In curand la cinema</p>
                    <a href="">Amor la distanta</a><br />
                    <a href="">Amor la distanta</a><br />
                    <a href="">Amor la distanta</a><br />
                    <a href="">Amor la distanta</a><br />
                    <a href="">Amor la distanta</a>
                </div>
            	<div class="inline-block spacer-bottom-l spacer-left" style="width: 235px; height: 90px">
                	<p class="bigstrong spacer-bottom">Pe DVD & Bluray</p>
                    <a href="">Amor la distanta</a><br />
                    <a href="">Amor la distanta</a><br />
                    <a href="">Amor la distanta</a><br />
                    <a href="">Amor la distanta</a><br />
                    <a href="">Amor la distanta</a>
                </div>
            	<div class="inline-block spacer-bottom-l spacer-left" style="width: 235px; height: 90px">
                	<p class="bigstrong spacer-bottom">In curand pe DVD & Bluray</p>
                    <a href="">Amor la distanta</a><br />
                    <a href="">Amor la distanta</a><br />
                    <a href="">Amor la distanta</a><br />
                    <a href="">Amor la distanta</a><br />
                    <a href="">Amor la distanta</a>
                </div>
            	<div class="inline-block spacer-bottom-l spacer-left" style="width: 235px; height: 90px">
                	<p class="bigstrong spacer-bottom">La Tv Azi</p>
                    <a href="">Amor la distanta</a><br />
                    <a href="">Amor la distanta</a><br />
                    <a href="">Amor la distanta</a><br />
                    <a href="">Amor la distanta</a><br />
                    <a href="">Amor la distanta</a>
                </div>
            	<div class="inline-block spacer-bottom-l spacer-left" style="width: 235px; height: 90px">
                	<p class="bigstrong spacer-bottom">La Tv Maine</p>
                    <a href="">Amor la distanta</a><br />
                    <a href="">Amor la distanta</a><br />
                    <a href="">Amor la distanta</a><br />
                    <a href="">Amor la distanta</a><br />
                    <a href="">Amor la distanta</a>
                </div>
            	<div class="inline-block spacer-bottom-l spacer-left" style="width: 235px; height: 90px">
                	<p class="bigstrong spacer-bottom">Actori</p>
                    <a href="">Amor la distanta</a><br />
                    <a href="">Amor la distanta</a><br />
                    <a href="">Amor la distanta</a><br />
                    <a href="">Amor la distanta</a><br />
                    <a href="">Amor la distanta</a>
                </div>
            	<div class="inline-block spacer-bottom-l spacer-left" style="width: 235px; height: 90px">
                	<p class="bigstrong spacer-bottom">Stiri</p>
                    <a href="">Amor la distanta</a><br />
                    <a href="">Amor la distanta</a><br />
                    <a href="">Amor la distanta</a><br />
                    <a href="">Amor la distanta</a><br />
                    <a href="">Amor la distanta</a>
                </div>

            </div>



        </div><!-- footer end -->
    </div><!--wrapper end-->

    <div class="feedback-container">
    	<div style="position: relative">
    	<div class="feedback-content" id="feedback-form-container">
        	<p class="white spacer-bottom">Ce parere ai despre FilmSi?</p>
            <input type="input" id="feedback-name" class="inpttxt0" value="numele tau" onclick="$(this).val('')" /><br /><br />
            <input type="input" id="feedback-email" class="inpttxt0" value="email-ul tau" onclick="$(this).val('')" /><br /><br />
            <textarea class="txtarea0" id="feedback-content" onclick="$(this).html('')">comentariul tau</textarea><br /><br />
            <button type="button" id="feedback-send" class="normalbutton">TRIMITE</button>
        </div>
        <div class="feedback-trigger"></div>
        </div>
    </div>
</body>
</html>

<script type="text/javascript">
$(document).ready(function(){
        $('#feedback-send').click(function(){
            $('#feedback-send').replaceWith('<img src="<?php echo image_path('indicator.gif');?>" /> se trimite');

            $.ajax({
                url: '<?php echo url_for('@default?module=default&action=sendFeedback');?>',
                type: 'post',
                dataType: 'json',
                data: {
                    name: $('#feedback-name').val(),
                    email: $('#feedback-email').val(),
                    content: $('#feedback-content').val()
                },
                success: function(){
                    $('#feedback-form-container').html('<br /><br /><br /><p class="bigstrong">Mesajul a fost trimis cu succes.</p><br /><br /><br />');
                }
            });
        });

	$('#user-login-link').click(function(){
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
	
	$('#user-register-link').click(function(){
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

	$('#user-cover-link').click(function(){
		if ($("#user-container").is(':hidden')){
			$('#user-container').load('<?php echo url_for('@default?module=user&action=cover');?>')
				$('#user-container').slideDown('fast');
		} else {
			$('#user-container').slideUp('fast')
				.load('<?php echo url_for('@default?module=user&action=cover');?>', function(){
					$(this).slideDown('fast');
				});
		}
	});


	/* Feedback functionality */
	$('.feedback-trigger').click(function(){
		if ($('.feedback-container').css('left') == '-280px') {
			$('.feedback-container').animate({left: 0}, 300);
		} else {
			$('.feedback-container').animate({left: -280}, 300);
		}
	});

	$('.feedback-container').click(function(e) {
        e.stopPropagation();
    });



    $(document).click(function() {

    	// Hide the menu
    	if ($('.feedback-container').css('left') != '-280px') {
			$('.feedback-container').animate({left: -280}, 300);
		}
    });

	<?php if ($sf_request->hasParameter('sc') && $sf_user->isAuthenticated()):?>
		$('#user-container').slideUp('fast', function(){
			$(this).load('<?php echo url_for('@default?module=user&action=cover');?>', function(){
				$(this).slideDown('fast');
			});
		});
	<?php endif;?>

	<?php if ($sf_request->hasParameter('lo') && !$sf_user->isAuthenticated()):?>
		$('#user-container').slideUp('fast', function(){
			$(this).load('<?php echo url_for('@login');?>', function(){
				$(this).slideDown('fast');
			});
		});
	<?php endif;?>

	<?php if ($sf_request->hasParameter('unique_key')):?>
		$('#user-container').slideUp('fast', function(){
			$(this).load('<?php echo url_for('@default?module=user&action=changePassword');?>?unique_key=<?php echo $sf_request->getParameter('unique_key');?>', function(){
				$(this).slideDown('fast');
			});
		});
	<?php endif;?>

});
</script>