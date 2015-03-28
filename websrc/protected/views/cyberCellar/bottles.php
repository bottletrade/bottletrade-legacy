<?php 
$isCurrentUserCyberCellar = User::isCurrentUser($user);
?>
<?php 
	// check if should show upload bottle image
	if ($isCurrentUserCyberCellar):
?>
	<script type='text/javascript'>
		$(window).bind("load", function() {
			$("button.upload-bottle-banner").show();
		});
	</script>
<?php endif ;?>
<div id="title_holder">
	<span class="white-title ti-medium"><?php echo StringUtils::createSingularPossessionText($user->Username);?> BOTTLES</span>
</div>
<div id="white-area">
	<div class="event-container" data-bind="foreach: $root.EventManager().bottles">
		<?php 
			// for each bottle loaded into KO, show info
			$this->widget('application.components.widgets.displays.CyberCellarBottleDisplayKO'); 
		?>
	</div>
	<div data-bind="visible: $root.CyberCellarManager().loadingData" class="center">
		<img src="<?php echo UrlUtils::generateImageUrl("ajax-loader.gif"); ?>" width="40px" height="40px"/>
	</div>
</div>

<script>
$(window).load(function(){
	// do initial load of data
	KnockoutManager.CyberCellarManager().dataUrl(bottletrade.apis.cyberCellarBottles);
	KnockoutManager.CyberCellarManager().customUrlData('<?php echo "un=".$user->Username; ?>');
	KnockoutManager.CyberCellarManager().loadMore();

	// trigger auto update when two window views away from bottom for seamless loading of new data
	$(window).scroll(function() {
		if($(window).scrollTop() + $(window).height() >= $(document).height() - (2*$(window).height())) {
			KnockoutManager.CyberCellarManager().loadMore();
	    }
	});
});
</script>