<form method="get" id="search-form-<?php echo $searchId;?>" action="<?php echo url_for('@default?module=default&action=searchResults');?>" class="livesearch-form">
<input type="text" class="searchmain-field" id="search-field-<?php echo $searchId;?>" name="q" autocomplete="off" />
<button class="searchmain-button" type="submit"></button>

<div style="margin-top: 5px; color: #6c6c6c">
	Cautari frecvente: 
	<?php foreach ($mostSearchedItems as $mostSearchedItem):?>
		<a href="<?php echo $mostSearchedItem['url'];?>"><?php echo $mostSearchedItem['name'];?></a> | 
	<?php endforeach;?>
</div>

<div id="search-results-<?php echo $searchId;?>" class="livesearch-results innerspacer-bottom-m">
	<div class="livesearch-results-top"></div>
	<div class="left" style="width: 270px">
		<h5 class="spacer-bottom">Filme</h5>
		<ul id="search-results-films-<?php echo $searchId;?>"></ul>
	</div>
	<div class="left spacer-left innerspacer-left" style="width: 250px">
		<h5 class="spacer-bottom">Persoane</h5>
		<ul id="search-results-persons-<?php echo $searchId;?>"></ul>
	</div>
	<div class="clear"></div>
	
	<a href="javascript: void(0)" class="white-link" id="livesearch-more-<?php echo $searchId;?>"><span class="more-cell">vezi toate rezultatele &raquo;</span></a>
</div>
</form>

<script type="text/javascript">
$(document).ready(function(){
	$('#livesearch-more-<?php echo $searchId;?>').click(function(){
		$('#search-form-<?php echo $searchId;?>').submit();
	});
	
	
	$(document).click(function(){
		$('#search-results-<?php echo $searchId;?>').slideUp('fast');
	});
	
	$('#search-results-<?php echo $searchId;?>').click(function(e){
		e.stopPropagation();
	});
	
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
					if ($('#search-results-<?php echo $searchId;?>').is(':hidden') && (typeof data.films != 'undefined' || typeof data.persons != 'undefined')){
						$('#search-results-<?php echo $searchId;?>').slideDown('fast');
					}
					
					if ($('#search-results-<?php echo $searchId;?>').is(':visible') && (typeof data.films == 'undefined' && typeof data.persons == 'undefined')){
						$('#search-results-<?php echo $searchId;?>').slideUp('fast');
					}
					
					/* Remove the previous results */
					$('#search-results-films-<?php echo $searchId;?>').children().remove();
					$('#search-results-persons-<?php echo $searchId;?>').children().remove();

					/* Add the films */
					for (i in data.films) {
						
						var actors = '';
						for (j in data.films[i]['persons']){
							actors = actors + '<a href="' + data.films[i]['persons'][j]['url'] + '" class="smallblack-link">' + data.films[i]['persons'][j]['name'] + '</a>, ';
						}
						
						var nameEn;
						
						if (data.films[i]['name_en'] != ''){
							nameEn = '<a href="' + data.films[i]['url'] + '" class="smallblack-link">(' + data.films[i]['name_en'] + ')</a>'
						} else {
							nameEn = '';
						}
						
						$(document.createElement('li'))
							.attr('class', 'livesearch-result')
							.append(
								$(document.createElement('div'))
									.attr('class', 'left')
									.css('width', '50px')
									.html('<img src="' + data.films[i]['filename_url'] + '" width="50" />')
							)
							.append(
								$(document.createElement('div'))
									.attr('class', 'cell-separator-dotted-bottom innerspacer-left-s')
									.css('height', '74px')
									.css('margin-left', '55px')
									.append(
										'<a href="' + data.films[i]['url'] + '" class="importantblack-link">' + data.films[i]['name_ro'] + '</a><br />' + 
										nameEn + '<br /><br />' + actors
									)
							)
							.append('<div class="clear"></div>')
							.click(function(){ location.href = data.films[i]['url'] })
							.appendTo('#search-results-films-<?php echo $searchId;?>');
					}
					
					
					/* Add the persons */
					for (i in data.persons) {
						
						$(document.createElement('li'))
							.attr('class', 'livesearch-result')
							.append(
								$(document.createElement('div'))
									.attr('class', 'left')
									.css('width', '50px')
									.html('<img src="' + data.persons[i]['filename_url'] + '" width="50" />')
							)
							.append(
								$(document.createElement('div'))
									.attr('class', 'cell-separator-dotted-bottom innerspacer-left-s')
									.css('height', '74px')
									.css('margin-left', '55px')
									.append(
										'<a href="' + data.persons[i]['url'] + '" class="importantblack-link">' + data.persons[i]['name'] + '</a><br />' + 
										'<br /><br />' + 
										'<a href="' + data.persons[i]['film']['url'] + '" class="smallblack-link">' + data.persons[i]['film']['name'] + '</a>'
									)
							)
							.append('<div class="clear"></div>')
							.click(function(){ location.href = data.persons[i]['url'] })
							.appendTo('#search-results-persons-<?php echo $searchId;?>');
					}
				}
			});
		} else {
			$('#search-results-<?php echo $searchId;?>').slideUp('fast');
		}
	});
});
</script>