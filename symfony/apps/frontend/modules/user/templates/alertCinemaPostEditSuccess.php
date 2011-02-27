<?php foreach ($newCinemas as $newCinema):?>
<a href="<?php echo url_for('@cinema?id=' . $newCinema['id'] . '&key=' . $newCinema['url_key']);?>" target="_blank" class="important-link"><?php echo $newCinema['name'];?></a>,
<?php endforeach;?>