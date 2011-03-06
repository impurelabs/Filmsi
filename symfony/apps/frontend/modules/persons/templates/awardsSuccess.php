<h2><a href="<?php echo url_for('@person?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>"><?php echo $person->getName();?></a></h2>

<div class="spacer-bottom-m">
	<a href="<?php echo url_for('@homepage');?>" class="black-link">Home</a> &raquo;
	<a href="<?php echo url_for('@person?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>" class="black-link"><?php echo $person->getName();?></a> &raquo;
        <a href="<?php echo url_for('@person_awards?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>" class="black-link">Premii</a>
</div>


<div class="cell-container6"> <!-- left column start -->
    <div class="cell spacer-bottom-m">
        <div class="cell-hd">
            <h5><a href="<?php echo url_for('@person?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>">Detalii</a></h5>
        </div>
        <div class="cell-bd" style="padding:0">
            <ul class="filterlist spacer-bottom-m">
                <li onclick="location.href='<?php echo url_for('@person_biography?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>'"><a href="<?php echo url_for('@person_biography?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>">Biografie<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@person_awards?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>'" class="active"><a href="<?php echo url_for('@person_awards?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>">Premii<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@person_films?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>'"><a href="<?php echo url_for('@person_films?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>">Filmografie<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@person_stiri?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>'"><a href="<?php echo url_for('@person_stiri?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>">Stiri<span class="filter-cioc"></span></a></li>
                <li onclick="location.href='<?php echo url_for('@person_photos?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>'"><a href="<?php echo url_for('@person_photos?id=' . $person->getId() . '&key=' . $person->getUrlKey());?>">Fotografii<span class="filter-cioc"></span></a></li>
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
                    <td><p class="explanation-small cell-separator-dotted-bottom spacer-right spacer-bottom-s">Film</p></td>
                </tr>
                <?php foreach($awards as $award):?>
                <tr>
                    <td>
                        <p class="smalltext spacer-right spacer-bottom-s spacer-top-s">
                            <span class="strong"><?php echo $award['f_name'] . '-' . $award['fe_edition'];?></span><br /><?php echo $award['fs_name'];?>
                        </p>
                    </td>
                    <td>
                        <p class="smalltext spacer-right spacer-bottom-s spacer-top-s">
                            <?php echo $award['fsp_is_winner'] == '1' ? '<span class="red">castigator</span>' : 'nominalizat';?>
                        </p>
                    </td>
                    <td>
                        <a href="<?php echo url_for('@film?id=' . $award['film']['id'] . '&key=' . $award['film']['url_key']);?>" class="important-link spacer-right spacer-bottom-s spacer-top-s"><?php echo $award['film']['name_en'];?></a>
                    </td>
                </tr>
                <?php endforeach;?>
            </table>
    </div>

</div> <!-- content column end -->





<div class="cell-container7 spacer-left"> <!-- right column start -->
	<?php include_component('default', 'rightColumn', array('page' => Page::PERSON));?>
</div> <!-- right column end -->