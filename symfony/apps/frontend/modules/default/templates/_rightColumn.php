<?php foreach($gadgets as $gadget):?>
<iframe scrolling="no"
		frameborder="0"
		allowtransparency="true"
		style="width: 300px; height: <?php echo Gadget::getHeightById($gadget->getGadget());?>px;"
		class="mb-2"
		src="<?php echo url_for('@default_index?module=gadgets', true);?>?gid=<?php echo $gadget->getGadget();?>"></iframe>
<?php endforeach;?>