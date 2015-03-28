<div>
	<?php
		// render popup
		$this->widget('application.components.widgets.popups.BottlePopup', 
				array('renderForm' => false // user will never see their own bottles on the trader feed
		));
	?>
	<div class="top-banner center" style="padding-top: 21px; height: 69px;">
		<span class="white-title ti-medium">#<?php echo $tag; ?></span>
	</div>
	<span class="black"></span>
	<div class="hash-main-container">
		<div class="event-container" data-bind="foreach: $root.EventManager().bottles">
			<div class="hash-holder">
				<div class="hash-image-holder">
					<img data-bind='attr:{src: imgSrc }' width='60' height='60'>
				</div>
				<div class="hash-copy-holder">
					<span class="black-small">
						<!-- ko text: year --><!-- /ko --> | <a data-bind="attr: { href: yii.urls.beerInfo + beerId}, text: beverageName"></a>
						<br/>
						<a data-bind="attr: { href: yii.urls.breweryInfo + companyId}, text: companyName"></a> (<!-- ko text: companyCity --><!-- /ko -->, <!-- ko text: companyState --><!-- /ko -->)
						<br/>
						<span data-bind="html: hashtags"></span>
						<br/>
						Posted by <a data-bind="attr: { href: '<?php echo UrlUtils::generateUrl(UrlUtils::ProfileUri, "/"); ?>' + username }, text: username"></a> 
					</span>
				</div>
				<div class="hash-button-holder">
					<button data-bind="visible: (isEditable != true && isTradeable == 'Yes' && quantity > 0), click: $root.BottleManager().makeOffer" class="small" onclick="return false;">
						MAKE AN OFFER
					</button>
				</div>
			</div>						<div class="horizontal-divide"></div>
		</div>
		<div data-bind="visible: $root.HashTagManager().loadingData" class="center">
			<img src="<?php echo UrlUtils::generateImageUrl("ajax-loader.gif"); ?>" width="40px" height="40px"/>
		</div>
	</div>
</div>
<script type="text/javascript">
$(window).bind("load", function() {
	// do initial load of data
	KnockoutManager.HashTagManager().dataUrl(bottletrade.apis.hashTagEvents);
	KnockoutManager.HashTagManager().customUrlData('<?php echo "tag=".$tag; ?>');
	KnockoutManager.HashTagManager().loadMore();

	// trigger auto feed update when hit bottom of page
	$(window).scroll(function() {
		if($(window).scrollTop() + $(window).height() >= $(document).height() - 200) {
    		KnockoutManager.HashTagManager().loadMore();
        }
    });
});
</script>