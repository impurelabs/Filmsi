<h4>Continut "<?php echo filmsiContentLocationName($content->getId());?>"</h4>
<div class="mb-3">
	<button type="button" onclick="location.href='<?php echo url_for('@default?module=content&action=edit');?>?id=<?php echo $content->getId();?>'">Editeaza</button>
    <a href="<?php echo url_for('@default?module=content&action=index');?>">Intoarce-te inapoi</a>
</div>

<div class="tinyMce" style="width:<?php echo filmsiContentLocationWidth($content->getId());?>px">
<?php echo $sf_data->getRaw('content')->getContent(); ?>
</div>