<h4 class="mb-3">Editeaza programul pentru cinema "<?php echo $cinemaSchedule->getCinema()->getName();?>"</h4>

<h6 class="mb-3"><?php echo $cinemaSchedule->getFilm()->getName();?> - <?php echo $cinemaSchedule->getDay();?></h6>

<form action="<?php echo url_for('@default?module=cinemas&action=editSchedule');?>?id=<?php echo $cinemaSchedule->getId();?>" method="post">

	<?php echo $form->renderHiddenFields();?>
    <?php echo $form->renderGlobalErrors();?>
    
    Program:<br />
    <?php echo $form['schedule']->render();?><br />
    <?php echo $form['schedule']->renderError();?>
    <br /><br />
    
    <button type="submit" class="mr-2">Salveaza</button> <a href="<?php echo url_for('@default?module=cinemas&action=schedule');?>?lid=<?php echo $cinemaSchedule->getCinema()->getLibraryId();?>">Anuleaza</a>

</form>