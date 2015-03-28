<form>
	<table width="300px">
		<tr>
			<td>
				<img id="search-bar-loading" style="display: none;" src="<?php echo UrlUtils::generateImageUrl("/images/ajax-loader.gif"); ?>" width="20" height="20" border="0" />
			</td>
			<td>
				<input id="SearchTermID" type="text" placeholder="Users, Bottles, Breweries"></input>
			</td>
			<td align="left">
				<button class="medium" onclick="
					$(this).attr('disabled','disabled');
					$('#search-bar-loading').show();
					var searchQuery = '<?php echo UrlUtils::generateUrl(UrlUtils::SearchUri); ?>/' + $('#SearchTermID').val();
					window.location = searchQuery;
					return false;">SEARCH</button>
			</td>
		</tr>
	</table>	
</form>
