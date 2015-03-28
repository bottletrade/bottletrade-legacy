<div class="top-banner">
	<div style="position: relative; width: auto; height: 90px; float: left; margin-right: 10px; z-index: 100;">
		<span class="white-title ti-large">#HASHTAGS</span>
	</div>
	<div class="top-banner-copy" style="width: 500px; margin-top: 8px;">
		<span class="white">
			Explore our network by clicking on the most recent and popular hashtags 
			associated with user bottles. If you want to hashtag your bottle, make sure to do so 
			within the bottle description on the Upload Bottle page.
		</span>
	</div>
</div>
<div style="position: relative; width: 910px; min-height: 550px; text-align: center; z-index: 10; margin: -10px auto 0px auto; padding-top: 30px; background-color: #FFF; box-shadow: 5px 5px 3px #453B35;">
	<div style="width: 700px; height: 20px; text-align: center; padding-bottom: 5px; margin: 10px auto 5px auto; border-bottom: 1px solid #000;">
		<a href='<?php echo UrlUtils::generateUrl(UrlUtils::ProfileUri); ?>'>Profile</a> | 
		<a href='<?php echo UrlUtils::generateUrl(UrlUtils::InboxUri); ?>'>Inbox</a> | 
		<a href='<?php echo UrlUtils::generateUrl(UrlUtils::CyberCellarUri); ?>'>Cyber Cellar</a> | 
		<a href='<?php echo UrlUtils::generateUrl(UrlUtils::CyberCellarPendingTradesUri); ?>'>My Trades</a>
	</div>
	<span class="black large">These are the most recent hashtags:</span><br />
	<span class="black">
	<?php 
		foreach ($hashtagCounts as $hashtagCount) {
			echo HashTag::convertHashTagsToLinks("#".$hashtagCount["Tag"])." (".$hashtagCount["Count"]." Post";
			if ($hashtagCount["Count"] > 1) {
				echo "s";
			}
			echo ")<br/>";
		}
	?>
	</span>
</div> 
