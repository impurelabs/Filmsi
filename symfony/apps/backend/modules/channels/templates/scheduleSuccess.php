<h4>Canal "<?php echo $channel->getName();?>"</h4>

<a href="<?php echo url_for('@default?module=channels&action=index');?>?lid=<?php echo $channel->getId();?>">Intoarce-te inapoi</a>
 
 <div class="mt-2 mb-2 cell-separator-double"></div>

<h5>Program</h5>

<div id="test"></div>
<form id="the-form" action="<?php echo url_for('@default?module=channels&action=schedule');?>?id=<?php echo $channel->getId();?>" method="post">

<?php echo $form->renderHiddenFields();?>
<?php echo $form->renderGlobalErrors();?>

<table>
	<tr>
    	<td>Film: <input type="text" id="film-finder" class="span-10" /></td>
        <td>Data: <?php echo $form['day']->render();?></td>
        <td>Ora: <?php echo $form['time_hour']->render();?></td>
        <td>Minutul: <?php echo $form['time_min']->render();?></td>
        <td><button type="submit">Adauga</button></td>
    </tr>
	<tr>
    	<td></td>
        <td><?php echo $form['day']->renderError();?></td>
        <td><?php echo $form['time_hour']->renderError();?></td>
        <td><?php echo $form['time_min']->renderError();?></td>
        <td></td>
    </tr>
</table>

</form>

<div class="mt-2 mb-2 cell-separator-double clear"></div>

<table id="film-list" class="mt-3">
	<?php foreach($schedules as $day => $schedule): ?>
    	<tr>
        	<td colspan="5"><h6><?php echo $day;?></h6></td>
        </tr>
        <?php foreach ($schedule as $scheduleDetail):?>
    	<tr>
        	<td><?php echo $scheduleDetail['film'];?></td>
        	<td><?php echo sprintf("%02s",$scheduleDetail['time_hour']) . ':' . sprintf("%02s",$scheduleDetail['time_min']);?></td>
            <td><a href="<?php echo url_for('@default?module=channels&action=scheduleDelete');?>?id=<?php echo $scheduleDetail['id'];?>" class="small-link">sterge</a></td>
        </tr>
        <?php endforeach;?>
    <?php endforeach; ?>
</table>

<div class="clear"></div>

<script type="text/javascript">
	$('#channel_schedule_day').datepicker({dateFormat: 'yy-mm-dd'});

	
	$('.film-delete-button').click(function(){
		$(this).parent().parent().remove();
	});
		
	/* Field autocomplete functionality */
	$("#film-finder").autocomplete({
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
			$('#channel_schedule_film_id').val(ui.item.value);
			$("#film-finder").attr('value', ui.item.label);  
				
			return false;
	  },
      minLength: 2
    });
</script>