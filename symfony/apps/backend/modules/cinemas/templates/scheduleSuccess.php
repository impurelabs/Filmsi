<h4>Cinematograf "<?php echo $cinema->getName();?>"</h4>

<a href="<?php echo url_for('@default?module=cinemas&action=view');?>?lid=<?php echo $cinema->getLibraryId();?>">Detalii</a>
 | <a href="<?php echo url_for('@default?module=cinemas&action=schedule');?>?lid=<?php echo $cinema->getLibraryId();?>" class="selected">Program</a>
 | <a href="<?php echo url_for('@default?module=cinemas&action=admin');?>?lid=<?php echo $cinema->getLibraryId();?>">Administrator</a>
<?php if($sf_user->hasCredential('Moderator') && $cinema->getState() == Library::STATE_PENDING): ?>
 | Acest obiect este Pending!  <button type="button" onclick="location.href='<?php echo url_for('@default?module=default&action=allow');?>?lid=<?php echo $cinema->getLibraryId();?>'">Aproba</button>
<?php endif; ?>

 <div class="mt-2 mb-2 cell-separator-double"></div>

<h5>Program</h5>

<button onclick="location.href='<?php echo url_for('@default?module=cinemas&action=import&id=' . $cinema->getId());?>'">Importa</button>

<div id="test"></div>
<form id="the-form" action="<?php echo url_for('@default?module=cinemas&action=schedule');?>?lid=<?php echo $cinema->getLibraryId();?>" method="post">

<?php echo $form->renderHiddenFields();?>
<?php echo $form->renderGlobalErrors();?>

<table>
	<tr>
    	<td>Film: <input type="text" id="film-finder" class="span-10" /></td>
        <td>Format: <?php echo $form['format']->render();?></td>
        <td>Data: <?php echo $form['day']->render();?></td>
        <td>Program: <?php echo $form['schedule']->render(array('class' => 'span-10'));?></td>
        <td><button type="submit">Adauga</button></td>
    </tr>
	<tr>
    	<td></td>
    	<td></td>
        <td><?php echo $form['day']->renderError();?></td>
        <td><?php echo $form['schedule']->renderError();?></td>
        <td></td>
    </tr>
</table>

</form>

<div class="mt-2 mb-2 cell-separator-double clear"></div>

<table id="film-list" class="mt-3">
	<?php foreach($schedules as $day => $schedule): ?>
    	<tr>
        	<td colspan="6"><h6><?php echo $day;?></h6></td>
        </tr>
        <?php foreach ($schedule as $scheduleDetail):?>
    	<tr>
        	<td><?php echo $scheduleDetail['film'];?></td>
			<td><?php if ($scheduleDetail['film_not_in_bd'] == '1') echo 'nu e in bd';?></td>
        	<td><?php echo $scheduleDetail['format'];?></td>
        	<td><?php echo $scheduleDetail['schedule'];?></td>
            <td><a href="<?php echo url_for('@default?module=cinemas&action=editSchedule');?>?id=<?php echo $scheduleDetail['id'];?>" class="small-link">editeaza</a></td>
            <td><a href="<?php echo url_for('@default?module=cinemas&action=deleteSchedule');?>?id=<?php echo $scheduleDetail['id'];?>" class="small-link">sterge</a></td>
        </tr>
        <?php endforeach;?>
    <?php endforeach; ?>
</table>

<div class="clear"></div>

<script type="text/javascript">
	$('#cinema_schedule_day').datepicker({dateFormat: 'yy-mm-dd'});




		
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
			$('#cinema_schedule_film_id').val(ui.item.value);
			$("#film-finder").attr('value', ui.item.label);  
				
			return false;
	  },
      minLength: 2
    });
</script>