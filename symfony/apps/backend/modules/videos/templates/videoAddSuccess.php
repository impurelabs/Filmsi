<h4 class="mb-4">Adauga video in albumul "<?php echo $album->getName();?>"</h4>

<div class="span-16">

    <form method="post" id="video-form" action="<?php echo url_for('@default?module=videos&action=videoAdd');?>?aid=<?php echo $album->getId();?>">
    	<div class="mb-2 video-element">Cod: <input type="text" name="video_code[]" class="mr-3" /> Nume: <input type="text" name="video_name[]" /></div>
		<div class="mb-2 video-element">Cod: <input type="text" name="video_code[]" class="mr-3" /> Nume: <input type="text" name="video_name[]" /></div>
		<div class="mb-2 video-element">Cod: <input type="text" name="video_code[]" class="mr-3" /> Nume: <input type="text" name="video_name[]" /></div>
        <a href="javascript:void(0)" class="small-link" id="add-more">mai multe</a>
        <br /><br />
        <button type="submit" class="mr-2">Adauga</button> <a href="<?php echo url_for('@default?module=videos&action=view');?>?lid=<?php echo $album->getLibraryId();?>">Anuleaza</a>
    </form>


</div>
<div class="clear"></div>

<script type="text/javascript">
$(document).ready(function(){
	$('#add-more').click(function(){
		$('<div class="mb-2 video-element">Cod: <input type="text" name="video_code[]" class="mr-3" /> Nume: <input type="text" name="video_name[]" /></div>').insertAfter('.video-element:last');
	});
});

function addMore()
{
	
}
</script>