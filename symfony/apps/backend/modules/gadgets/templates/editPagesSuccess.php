<h4 class="mb-3">Editeaza lista pagini unde apare gadgetul "<?php echo Gadget::getNameById($gid);?>"</h4>

<form action="<?php echo url_for('@default?module=gadgets&action=editPages');?>?gid=<?php echo $gid;?>" method="post">

	<input type="checkbox" name="pages[]" value="<?php echo Page::FILM;?>"<?php if(in_array(Page::FILM, $sf_data->getRaw('pages'))) echo ' checked="checked"';?> /> <?php echo Page::getNameById(Page::FILM);?> <br />
	<input type="checkbox" name="pages[]" value="<?php echo Page::TRAILERS;?>"<?php if(in_array(Page::TRAILERS, $sf_data->getRaw('pages'))) echo ' checked="checked"';?> /> <?php echo Page::getNameById(Page::TRAILERS);?> <br />
	<input type="checkbox" name="pages[]" value="<?php echo Page::ARTICLE;?>"<?php if(in_array(Page::ARTICLE, $sf_data->getRaw('pages'))) echo ' checked="checked"';?> /> <?php echo Page::getNameById(Page::ARTICLE);?> <br />
	<input type="checkbox" name="pages[]" value="<?php echo Page::ARTICLES;?>"<?php if(in_array(Page::ARTICLES, $sf_data->getRaw('pages'))) echo ' checked="checked"';?> /> <?php echo Page::getNameById(Page::ARTICLES);?> <br />
	<input type="checkbox" name="pages[]" value="<?php echo Page::STIRE;?>"<?php if(in_array(Page::STIRE, $sf_data->getRaw('pages'))) echo ' checked="checked"';?> /> <?php echo Page::getNameById(Page::STIRE);?> <br />
	<input type="checkbox" name="pages[]" value="<?php echo Page::STIRES;?>"<?php if(in_array(Page::STIRES, $sf_data->getRaw('pages'))) echo ' checked="checked"';?> /> <?php echo Page::getNameById(Page::STIRES);?> <br />
	<input type="checkbox" name="pages[]" value="<?php echo Page::STIRE_PUBLISH;?>"<?php if(in_array(Page::STIRE_PUBLISH, $sf_data->getRaw('pages'))) echo ' checked="checked"';?> /> <?php echo Page::getNameById(Page::STIRE_PUBLISH);?> <br />
	<input type="checkbox" name="pages[]" value="<?php echo Page::CINEMA;?>"<?php if(in_array(Page::CINEMA, $sf_data->getRaw('pages'))) echo ' checked="checked"';?> /> <?php echo Page::getNameById(Page::CINEMA);?> <br />
	<input type="checkbox" name="pages[]" value="<?php echo Page::CINEMAS;?>"<?php if(in_array(Page::CINEMAS, $sf_data->getRaw('pages'))) echo ' checked="checked"';?> /> <?php echo Page::getNameById(Page::CINEMAS);?> <br />
	<input type="checkbox" name="pages[]" value="<?php echo Page::AWARD;?>"<?php if(in_array(Page::AWARD, $sf_data->getRaw('pages'))) echo ' checked="checked"';?> /> <?php echo Page::getNameById(Page::AWARD);?> <br />
	<input type="checkbox" name="pages[]" value="<?php echo Page::AWARDS;?>"<?php if(in_array(Page::AWARDS, $sf_data->getRaw('pages'))) echo ' checked="checked"';?> /> <?php echo Page::getNameById(Page::AWARDS);?> <br />
	<input type="checkbox" name="pages[]" value="<?php echo Page::IN_CINEMA;?>"<?php if(in_array(Page::IN_CINEMA, $sf_data->getRaw('pages'))) echo ' checked="checked"';?> /> <?php echo Page::getNameById(Page::IN_CINEMA);?> <br />
	<input type="checkbox" name="pages[]" value="<?php echo Page::ON_DVD;?>"<?php if(in_array(Page::ON_DVD, $sf_data->getRaw('pages'))) echo ' checked="checked"';?> /> <?php echo Page::getNameById(Page::ON_DVD);?> <br />
	<input type="checkbox" name="pages[]" value="<?php echo Page::PERSONS;?>"<?php if(in_array(Page::PERSONS, $sf_data->getRaw('pages'))) echo ' checked="checked"';?> /> <?php echo Page::getNameById(Page::PERSONS);?> <br />
	<input type="checkbox" name="pages[]" value="<?php echo Page::PERSON;?>"<?php if(in_array(Page::PERSON, $sf_data->getRaw('pages'))) echo ' checked="checked"';?> /> <?php echo Page::getNameById(Page::PERSON);?> <br />
	<input type="checkbox" name="pages[]" value="<?php echo Page::SEARCH_RESULTS;?>"<?php if(in_array(Page::SEARCH_RESULTS, $sf_data->getRaw('pages'))) echo ' checked="checked"';?> /> <?php echo Page::getNameById(Page::SEARCH_RESULTS);?> <br />
	<input type="checkbox" name="pages[]" value="<?php echo Page::OTHER;?>"<?php if(in_array(Page::OTHER, $sf_data->getRaw('pages'))) echo ' checked="checked"';?> /> <?php echo Page::getNameById(Page::OTHER);?> <br />
    <br />
	<button type="submit">Salveaza</button> <a href="<?php echo url_for('@default_index?module=gadgets');?>">Anuleaza</a>
</form>