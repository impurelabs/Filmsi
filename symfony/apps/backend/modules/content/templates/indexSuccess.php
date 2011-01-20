<h4 class="mb-3">Continut</h4>

<table class="span-15">
	<?php foreach($contents as $content):?>
	<tr>
    	<td><?php echo filmsiContentLocationName($content->getId());?></td>
        <td><a href="<?php echo url_for('@default?module=content&action=view');?>?id=<?php echo $content->getId();?>" class="small-link">vezi</a></td>
    </tr>
    <?php endforeach; ?>
</table>

<div class="clear"></div>