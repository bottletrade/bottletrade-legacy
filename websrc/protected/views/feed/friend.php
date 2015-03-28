<div>
	<?php
		// render popup
		$this->widget('application.components.widgets.popups.BottlePopup', 
				array(	'renderForm' => false // user will never see their own bottles on the trader feed
		));
	?>
	<div class="event-container" data-bind="foreach: $root.EventManager().events">
		<div class="bottle_display" data-bind="visible: eventType == yii.knockout.eventTypeBottle">
		<?php 
			// for each bottle loaded into KO, show info
			$this->widget('application.components.widgets.displays.FeedBottleDisplay'); 
		?>
		</div>
		<div class="bottle_display" data-bind="visible: eventType == yii.knockout.eventTypeTrade">
		<?php 
			// for each bottle loaded into KO, show info
			$this->widget('application.components.widgets.displays.FeedTradeDisplay'); 
		?>
		</div>
		<div class="horizontal-divide"></div>
	</div>
	<div data-bind="visible: $root.FeedManager().loadingData" class="center">
		<img src="<?php echo UrlUtils::generateImageUrl("ajax-loader.gif"); ?>" width="40px" height="40px"/>
	</div>
</div>
<script type="text/javascript">
$(window).bind("load", function() {
	// do initial load of data
	KnockoutManager.FeedManager().dataUrl(yii.urls.feedFriendData);
	KnockoutManager.FeedManager().loadMore();
	
	// trigger auto feed update when two window views away from bottom for seamless loading of new data
	$(window).scroll(function() {
		if($(window).scrollTop() + $(window).height() >= $(document).height() - (2*$(window).height())) {
			KnockoutManager.FeedManager().loadMore();
		}
	});
});
</script>