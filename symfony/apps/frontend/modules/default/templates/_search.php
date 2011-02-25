<form method="get" id="search-form-<?php echo $searchId;?>" action="<?php echo url_for('@default?module=default&action=searchResults');?>">
<input type="text" class="searchmain-field" id="search-field-<?php echo $searchId;?>" name="q" />
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
			$("#search-field-<?php echo $searchId;?>").attr('value', ui.item.label);
			return false;
		  },
		  select: function(event, ui){
			  $("#search-field-<?php echo $searchId;?>").attr('value', ui.item.label);
				return false;
		  },
	      minLength: 2
	    });
});
</script>