<?php $this->beginContent('/layouts/main'); ?>
<div class="top-banner">
	<div class="top-banner-title">
		<span class="white-title ti-large">TRADER FEED</span>
	</div>
	<div class="top-banner-copy" style="width: 500px; margin-top: 15px;">
		<span class="white">
			Monitor friend and BottleTrade Community activities on your trader feed. Any bottles your 
					friends upload to their Cyber Cellars, as well as any recent trades, will appear in your trader feed.
		</span>
	</div>
</div>
<div class="single-page-content">
	<div class="trade-feed-shortcut-list">
		<a href='<?php echo UrlUtils::generateUrl(UrlUtils::ProfileUri); ?>'>Profile</a> | 
		<a href='<?php echo UrlUtils::generateUrl(UrlUtils::InboxUri); ?>'>Inbox</a> | 
		<a href='<?php echo UrlUtils::generateUrl(UrlUtils::CyberCellarUri); ?>'>Cyber Cellar</a> | 
		<a href='<?php echo UrlUtils::generateUrl(UrlUtils::CyberCellarPendingTradesUri); ?>'>My Trades</a>
	</div>
	<div class="trade-feed-shortcut-list">
		<?php
		if (UrlUtils::isPageAtUri(UrlUtils::TraderFeedUri, true)) {
			$buttonClass = 'medium disabled';
		} else {
			$buttonClass = 'medium';
		}
		?>
		<button class="<?php echo $buttonClass; ?>" onclick="window.location='<?php echo UrlUtils::generateUrl(UrlUtils::TraderFeedUri); ?>'">Global Feed</button> | 
		
		<?php
		if (UrlUtils::isPageAtUri(UrlUtils::FriendTraderFeedUri, false)) {
			$buttonClass = 'medium disabled';
		} else {
			$buttonClass = 'medium';
		}
		?>
		<button class="<?php echo $buttonClass; ?>" onclick="window.location='<?php echo UrlUtils::generateUrl(UrlUtils::FriendTraderFeedUri); ?>'">Friend Feed</button>
	
	</div>
	<?php echo $content; ?>
</div>	
<?php 
	$this->endContent(); 
?>