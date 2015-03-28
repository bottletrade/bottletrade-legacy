<div class="feed-holder">
	<div class="feed-image-holder">
		<img data-bind='attr:{src: imgSrc }' width='80' height='80'>
	</div>
	<div class="feed-copy-holder">
		<span class="black">
			<a data-bind="attr: { href: '<?php echo UrlUtils::generateUrl(UrlUtils::ProfileUri, "/"); ?>' + username }, text: username"></a> 
			uploaded 
			<a data-bind="attr: { href: yii.urls.beerInfo + beerId}, text: beverageName"></a>
			from
			<a data-bind="attr: { href: yii.urls.breweryInfo + companyId}, text: companyName"></a>
			to their Cyber Cellar.
			<br>
			<span data-bind="html: hashtags"></span>
			<br>
			<span data-bind="text: localizeTimeAgo(time)"></span>
		</span>
	</div>
	<div class="feed-buttons-holder">
		<button data-bind="visible: (isEditable != true && isTradeable == 'Yes' && quantity > 0), click: $root.BottleManager().makeOffer" class="medium" onclick="return false;">
			MAKE AN OFFER
		</button>
		<button data-bind='click: $root.BottleManager().viewMoreInfo' class="medium" onclick="$('#<?php echo PopupConstants::BottleInfoPopupLinkID; ?>').click();">
			VIEW ALL INFO
		</button>
	</div>
</div>