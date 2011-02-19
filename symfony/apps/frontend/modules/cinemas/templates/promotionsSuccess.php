<h2><?php echo $cinema->getName();?></h2>

<div class="spacer-bottom-m">
	<a href="<?php echo url_for('@homepage');?>" class="black-link">Home</a> &raquo;
	<a href="<?php echo url_for('@cinemas');?>" class="black-link">Cinematografe</a> &raquo;
	<a href="<?php echo url_for('@cinema?id=' . $cinema->getId() . '&key=' . $cinema->getUrlKey());?>" class="black-link"><?php echo $cinema->getName();?></a> &raquo;
	<a href="<?php echo url_for('@cinema_promotions?id=' . $cinema->getId() . '&key=' . $cinema->getUrlKey());?>" class="black-link">Promotii</a>
</div>




<div class="cell-container6"> <!-- left column start -->


    <div class="cell spacer-bottom-m">
        <div class="cell-hd">
            <h5>Detalii <span class="black">cinema</span></h5>
        </div>
        <div class="cell-bd" style="padding:0">
        	<ul class="filterlist spacer-bottom-m">
                <li onclick="location.href='<?php echo url_for('@cinema_description?id=' . $cinema->getId() . '&key=' . $cinema->getUrlKey());?>'"><a href="<?php echo url_for('@cinema_description?id=' . $cinema->getId() . '&key=' . $cinema->getUrlKey());?>">Prezentare<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@cinema_schedule?id=' . $cinema->getId() . '&key=' . $cinema->getUrlKey());?>'"><a href="<?php echo url_for('@cinema_schedule?id=' . $cinema->getId() . '&key=' . $cinema->getUrlKey());?>">Program<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@cinema_tickets?id=' . $cinema->getId() . '&key=' . $cinema->getUrlKey());?>'"><a href="<?php echo url_for('@cinema_tickets?id=' . $cinema->getId() . '&key=' . $cinema->getUrlKey());?>">Pret bilete<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@cinema_promotions?id=' . $cinema->getId() . '&key=' . $cinema->getUrlKey());?>'" class="active"><a href="<?php echo url_for('@cinema_promotions?id=' . $cinema->getId() . '&key=' . $cinema->getUrlKey());?>">Promotii<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@cinema_stiri?id=' . $cinema->getId() . '&key=' . $cinema->getUrlKey());?>'"><a href="<?php echo url_for('@cinema_stiri?id=' . $cinema->getId() . '&key=' . $cinema->getUrlKey());?>">Noutati<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@cinema_photos?id=' . $cinema->getId() . '&key=' . $cinema->getUrlKey());?>'"><a href="<?php echo url_for('@cinema_photos?id=' . $cinema->getId() . '&key=' . $cinema->getUrlKey());?>">Fotografii<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@cinema_comments?id=' . $cinema->getId() . '&key=' . $cinema->getUrlKey());?>'"><a href="<?php echo url_for('@cinema_comments?id=' . $cinema->getId() . '&key=' . $cinema->getUrlKey());?>">Parerea publicului<span class="filter-cioc"></span></a></li>
            </ul>
        </div>
    </div>


</div> <!-- left column end -->



<div class="cell-container5 spacer-left"> <!-- content column start -->

	
    <div class="cell spacer-bottom-m innerspacer-bottom-m">
        <div class="cell-hd">
            <h4>Promotii</h4>
        </div>

        <div class="cell-bd">
        	<?php foreach ($sf_data->getRaw('cinema')->getPromotions() as $promotion):?>
				<br />
				<?php if($sf_user->isAuthenticated() && $sf_user->getAttribute('user_id', null, 'sfGuardSecurityUser') == $cinema->getAdminUserId()):?>
					<a href="<?php echo url_for('@cinema_promotion_edit?id=' . $promotion->getId());?>" class="right">editeaza promotie</a>
				<?php endif;?>
				<h6><?php echo $promotion->getName();?></h6><br />
				<?php echo $promotion->getContent();?> <br /><br />
				<img src="<?php echo filmsiCinemaPromotionPhoto($promotion->getFilename());?>" />
				<hr class="cell-separator-double spacer-top spacer-bottom" />
			<?php endforeach;?>
        </div>
    </div>





</div> <!-- content column end -->









<div class="cell-container7 spacer-left"> <!-- right column start -->
	this is the right column
</div> <!-- right column end -->

