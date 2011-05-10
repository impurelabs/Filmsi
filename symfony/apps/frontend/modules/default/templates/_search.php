<form method="get" id="search-form-<?php echo $searchId;?>" action="<?php echo url_for('@default?module=default&action=searchResults');?>" class="livesearch-form">
<input type="text" class="searchmain-field" id="search-field-<?php echo $searchId;?>" name="q" autocomplete="off" />
<button class="searchmain-button" type="submit"></button>
<div id="search-results-<?php echo $searchId;?>" class="livesearch-results">
	<div class="livesearch-results-top"></div>
	<div class="left" style="width: 250px">
		<h5>Filme</h5>
		<ul id="search-results-films-<?php echo $searchId;?>"></ul>
	</div>
	<div class="left spacer-left innerspacer-left" style="width: 250px">
		<h5>Persoane</h5>
		<ul id="search-results-persons-<?php echo $searchId;?>"></ul>
	</div>
	<div class="clear"></div>
	
	<a href="javascript: void(0)" class="white-link"><span class="more-cell">vezi toate rezultatele &raquo;</span></a>
</div>
</form>

<script type="text/javascript">
$(document).ready(function(){
	/* Field autocomplete functionality */
	$("#search-field-<?php echo $searchId;?>").keyup(function(){
		var term = $(this).val();

		if (term.length > 2){
			$.ajax({
				url: "<?php echo url_for('@default?module=default&action=search')?>",
				dataType: "json",
				data: {
					term: term
				},
				success: function(data) {
					/* Remove the previous results */
					$('#search-results-films-<?php echo $searchId;?>').children().remove();
					$('#search-results-persons-<?php echo $searchId;?>').children().remove();

					for (i in data.films) {
						$(document.createElement('li'))
							.append(
								$(document.createElement('div'))
									.attr('class', 'left')
									.css('width', '50px')
									.html('<img src="' + data.films[i]['filename_url'] + '" width="50" />')
							)
							.append(
								$(document.createElement('div'))
									.attr('class', 'left cell-separator-dotted-bottom spacer-left-s innerspacer-left-s')
									.html('<a href="' + data.films[i]['name'] + '" class="importantblack-link">' + data.films[i]['name'] + '</a>')
							)
							.append('<div class="clear"></div>')
							.appendTo('#search-results-films-<?php echo $searchId;?>');
					}
				}
			});
		}
	});
});
</script>