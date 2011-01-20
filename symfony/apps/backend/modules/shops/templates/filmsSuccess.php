<h4>Lista filme pentru magazinul "<?php echo $shop->getName();?>"</h4>
<button type="button" onclick="location.href='<?php echo url_for('@default?module=shops&action=import');?>?sid=<?php echo $shop->getId();?>'">Importa feed</button>
<a class="mb-3" href="<?php echo url_for('@default?module=shops&action=view');?>?id=<?php echo $shop->getId();?>">Intoarce-te inapoi</a>


<div class="mt-3">
<form id="film-add-form" action="<?php echo url_for('@default?module=shops&action=films');?>?id=<?php echo $shop->getId();?>" method="post">

<?php echo $form->renderHiddenFields();?>

	Film: <input type="text" id="film-add-field" style="width: 300px" /> 
    Url: <?php echo $form['url']->render(array('style' => 'width: 300px'));?>  
	Format: <?php echo $form['format']->render();?> 

    
    <button type="submit" class="ml-3">Adauga film</button>
    <?php echo $form['url']->renderError();?> 
    <br />
    <?php echo $form->renderGlobalErrors();?>
</form>
</div>

<div class="mt-2 mb-2 cell-separator-double clear"></div>


<div class="clear mb-4"></div>

<table id="film-list" class="span-15">
	<?php foreach ($shopFilms as $shopFilm):?>
    <tr>
    	<td><?php echo $shopFilm->getFilm()->getName();?></td>
    	<td><?php echo $shopFilm->getFormat();?></td>
    	<td><a href="<?php echo $shopFilm->getUrl();?>" target="_blank"><?php echo $shopFilm->getUrl();?></a></td>
        <td><a href="<?php echo url_for('@default?module=shops&action=editFilm');?>?id=<?php echo $shopFilm->getId();?>" class="small-link">editeaza</a></td>
        <td><?php echo link_to('sterge', 'shops/deleteFilm', array('confirm' => 'Esti sigur ca vrei sa stergi filmul?', 'query_string' => 'id=' . $shopFilm->getId(), 'post' => true, 'class' => 'small-link'));?></td>
    </tr>
    <?php endforeach;?>
</table>

<div class="clear"></div>

<script type="text/javascript">
	$(document).ready(function(){
		
		$('.film-delete-button').click(function(){
			$(this).parent().parent().remove();
		});
		
		/* Field autocomplete functionality */
		$("#film-add-field").autocomplete({
	      source: function(request, response) {
	        $.ajax({
	          url: "<?php echo url_for('@default?module=films&action=api')?>",
	          dataType: "json",
	          data: {
	            term: request.term
	          },
	          success: function(data) {				  
	            response(data);
	          }
	        })
	      },
		  select: function(event, ui){
			  $('#shop_film_film_id').val(ui.item.value);
			  $('#film-add-field').attr('value', ui.item.label);
			  return false;

		  },
	      minLength: 2
	    });
		
		
	});
</script>