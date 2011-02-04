<h2><?php echo $film->getNameRo();?> <?php if ($film->getNameEn() != ''):?><span class="black">(<?php echo $film->getNameEn();?>)</span><?php endif;?></h2>

<div class="spacer-bottom-m">
	<a href="<?php echo url_for('@homepage');?>" class="black-link">Home</a> &raquo;
	<a href="<?php echo url_for('@film?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>" class="black-link"><?php echo $film->getName();?></a> &raquo;
    <a href="<?php echo url_for('@film_awards?id=' . $film->getId() . '&key=' . $film->getUrlKey() . ($sf_request->hasParameter('p') ? '&p=' . $sf_request->getParameter('p') : ''));?>" class="black-link">Premii</a>
</div>


<div class="cell-container6"> <!-- left column start -->
    <div class="cell spacer-bottom-m">
        <div class="cell-hd">
            <h5>Detalii <span class="black">film</span></h5>
        </div>
        <div class="cell-bd" style="padding:0">
        	<ul class="filterlist spacer-bottom-m">
            	<li onclick="location.href='<?php echo url_for('@film_buy?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>'"><a href="<?php echo url_for('@film_buy?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>">Cumpara DVD & Bluray<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@film_cast?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>'"><a href="<?php echo url_for('@film_cast?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>">Actori & echipa<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@film_sinopsis?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>'"><a href="<?php echo url_for('@film_sinopsis?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>">Sinopsis<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@film_awards?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>'" class="active"><a href="<?php echo url_for('@film_awards?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>">Premii<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@film_articles?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>'"><a href="<?php echo url_for('@film_articles?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>">Articole despre film<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@film_comments?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>'"><a href="<?php echo url_for('@film_comments?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>">Comentariile publicului<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@film_photos?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>'"><a href="<?php echo url_for('@film_photos?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>">Fotografii din film<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@film_videos?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>'"><a href="<?php echo url_for('@film_videos?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>">Trailere si clipuri<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@film_stiri?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>'"><a href="<?php echo url_for('@film_stiri?id=' . $film->getId() . '&key=' . $film->getUrlKey());?>">Stiri<span class="filter-cioc"></span></a></li>
            </ul>
        </div>
    </div>
</div> <!-- left column end -->




<div class="cell-container5 spacer-left"> <!-- content column start -->


    <div class="normalcell spacer-bottom">
        <h4 class="spacer-bottom-m">Premii</h4>

        <table>
                <tr>
                    <td><p class="explanation-small cell-separator-dotted-bottom spacer-right spacer-bottom-s">Festival</p></td>
                    <td><p class="explanation-small cell-separator-dotted-bottom spacer-right spacer-bottom-s">Status</p></td>
                    <td><p class="explanation-small cell-separator-dotted-bottom spacer-right spacer-bottom-s">Persoane</p></td>
                </tr>
                <?php foreach($awards as $award):?>
                <tr>
                    <td>
                        <p class="smalltext spacer-right spacer-bottom-s spacer-top-s">
                            <span class="strong"><?php echo $award['FestivalSection']['FestivalEdition']['Festival']['name'] . '-' . $award['FestivalSection']['FestivalEdition']['edition'];?></span><br /><?php echo $award['FestivalSection']['name'];?>
                        </p>
                    </td>
                    <td>
                        <p class="smalltext spacer-right spacer-bottom-s spacer-top-s">
                            <?php echo $award['is_winner'] == '1' ? '<span class="red">castigator</span>' : 'nominalizat';?>
                        </p>
                    </td>
                    <td>
						<?php if (isset($award['persons'])):?>
							<?php foreach ($award['persons'] as $person):?>
							<a href="<?php echo url_for('@person?id=' . $person['id'] . '&key=' . $person['url_key']);?>" class="important-link spacer-right spacer-bottom-s spacer-top-s"><?php echo $person['first_name'] . ' ' . $person['last_name'];?></a>
							<?php endforeach;?>
						<?php endif;?>
                    </td>
                </tr>
                <?php endforeach;?>
            </table>
    </div>

</div> <!-- content column end -->





<div class="cell-container7 spacer-left"> <!-- right column start -->
	this is the right column
</div> <!-- right column end -->