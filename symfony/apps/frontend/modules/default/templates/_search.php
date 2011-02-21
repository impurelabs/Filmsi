<form method="get" action="<?php echo url_for('@default?module=default&action=searchResults');?>">
<input type="text" class="searchmain-field" id="search-field-<?php echo $searchId;?>" />
<input type="hidden" id="search-hidden-<?php echo $searchId;?>" name="lid" />
<button class="searchmain-button" type="submit"></button>
</form>

<script type="text/javascript">
$(document).ready(function(){
	/* Field autocomplete functionality */
		$("#search-field-<?php echo $searchId;?>").autocomplete({
	      source: function(request, response) {
	        $.ajax({
	          url: "<?php echo url_for('@default?module=default&action=search')?>",
	          dataType: "json",
	          data: {
	            term: request.term
	          },
	          success: function(data) {
	            response(data);
	          }
	        })
	      },
		  focus: function(event, ui){
			  return false;
		  },
		  select: function(event, ui){
			  $("#search-field-<?php echo $searchId;?>").attr('value', ui.item.label);
			  $("#search-hidden-<?php echo $searchId;?>").attr('value', ui.item.value);
				return false;
		  },
		  close: function(event, ui){
			  
		  },
	      minLength: 2
	    });
});
</script>