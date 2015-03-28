<div class="feed-holder">
	<div class="feed-image-holder">
		<img data-bind='attr:{src: imgSrc }' width='80' height='80'>
	</div>

	<div class="feed-copy-holder">
		<span class="black">
			Trade has been completed between 
			<a data-bind="attr: { href: '<?php echo UrlUtils::generateUrl(UrlUtils::ProfileUri, "/"); ?>' + username }, text: username"></a> 
			and 
			<a data-bind="attr: { href: '<?php echo UrlUtils::generateUrl(UrlUtils::ProfileUri, "/"); ?>' + otherUsername }, text: otherUsername"></a>
			<br/>
			<span data-bind="text: localizeTimeAgo(time)"></span>
		</span>
	</div>
	
	<div class="feed-buttons-holder">
		<button style="margin-top: 4px !important;" class="medium" data-bind="click: $root.NavigationManager().goToTradeSummaryPage">
			VIEW TRADE
		</button>
	</div>
</div>