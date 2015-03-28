<?php
$this->pageTitle=Yii::app()->name . ' - Cyber Cellar';
?>
<?php $this->beginContent('/layouts/main'); ?>
<table class="under-menu-holder">
	<tr>
		<td>
			<img src="<?php echo UrlUtils::generateImageUrl("profile/whats_trading.png"); ?>" width="251" height="41" border="0"/>
		</td>
		<td>
			<button class="medium" onclick="window.location='<?php echo UrlUtils::generateUrl(UrlUtils::HashTagsUri); ?>'">
				#HASHTAGS
			</button>
		</td>
		<td>
			<?php $this->widget('application.components.widgets.inputs.SearchBar'); ?>
		</td>
	</tr>
</table>
<div id="left-menu-no-white">
	<table class="left-menu">
		<tr>
			<td>
				<span class="white-title ti-small">BOTTLES</span>
			</td>
		</tr>
		<tr>
			<td>
				<?php
		$myBottlesByUsernameUri = UrlUtils::CyberCellarBottlesUri.Yii::app()->user->Username;
		if (UrlUtils::isPageAtUri(UrlUtils::CyberCellarBottlesUri) || UrlUtils::isPageAtUri($myBottlesByUsernameUri)) {
			$buttonClass = 'medium disabled';
		} else {
			$buttonClass = 'medium';
		}
	?>
	<button class="<?php echo $buttonClass; ?>" onclick="window.location='<?php echo UrlUtils::generateUrl(UrlUtils::CyberCellarBottlesUri); ?>'">
	MY BOTTLES
	</button>
			</td>
		</tr>
		<tr>
			<td>
				<span class="white-title ti-small">TRADES</span>
			</td>
		</tr>
		<tr>
			<td>
				<?php
	if (UrlUtils::isPageAtUri(UrlUtils::CyberCellarPendingTradesUri)) {
			$buttonClass = 'medium disabled';
		} else {
			$buttonClass = 'medium';
		}
	?>
	<button class="<?php echo $buttonClass; ?>" onclick="window.location='<?php echo UrlUtils::generateUrl(UrlUtils::CyberCellarPendingTradesUri); ?>'">
	PENDING
	</button>
	<?php 
		$notificationCount = HoverNotificationUtils::getPendingTradeCount(); 
		if ($notificationCount > 0):
	?>
	<div class="HN ICC-single-high"><?php echo $notificationCount; ?></div>
	<?php endif; ?>
			</td>
		</tr>
		<tr>
			<td>		
	<?php
	if (UrlUtils::isPageAtUri(UrlUtils::CyberCellarCompletedTradesUri, false)) {
			$buttonClass = 'medium disabled';
		} else {
			$buttonClass = 'medium';
		}
	?>
	<button class="<?php echo $buttonClass; ?>" onclick="window.location='<?php echo UrlUtils::generateUrl(UrlUtils::CyberCellarCompletedTradesUri); ?>'">
	COMPELETED
	</button>
			</td>
		</tr>
		<tr>
			<td>
				<span class="white-title ti-small">OFFERS</span>
			</td>
		</tr>
		<tr>
			<td>
				<?php
		if (UrlUtils::isPageAtUri(UrlUtils::CyberCellarOffersIncomingUri)) {
			$buttonClass = 'medium disabled';
		} else {
			$buttonClass = 'medium';
		}
	?>
	<button class="<?php echo $buttonClass; ?>" onclick="window.location='<?php echo UrlUtils::generateUrl(UrlUtils::CyberCellarOffersIncomingUri); ?>'">
	INCOMING</button>
	<?php 
		$notificationCount = HoverNotificationUtils::getIncomingOfferCount(); 
		if ($notificationCount > 0):
	?>
	<div class="HN ICC-single-high"><?php echo $notificationCount; ?></div>
	<?php endif; ?>
			</td>
		</tr>
		<tr>
			<td>	
	<?php
		if (UrlUtils::isPageAtUri(UrlUtils::CyberCellarOffersSentUri)) {
			$buttonClass = 'medium disabled';
		} else {
			$buttonClass = 'medium';
		}
	?>
	<button class="<?php echo $buttonClass; ?>" onclick="window.location='<?php echo UrlUtils::generateUrl(UrlUtils::CyberCellarOffersSentUri); ?>'">
	SENT</button>
			</td>
		</tr>	
	</table>
</div>
<?php 
	$this->widget('application.components.widgets.popups.NewCompanyPopup');
	$this->widget('application.components.widgets.popups.NewBeveragePopup');
?>
<div>
	<?php
		// render popup, only needed when viewing bottles
		if (UrlUtils::isPageAtUri(UrlUtils::CyberCellarBottlesUri, FALSE)) {
			$this->widget('application.components.widgets.popups.BottlePopup', array(
					'renderForm' => true
			));
		}
	?>
	<div id="right-with-white">
		<div style="position: relative; width: 130px; height: 0px; float: right; z-index: 499; text-align: left;">
			<button id="upload-bottle-banner-button" class="upload-bottle-banner" style="display: none;" data-bind="click: $root.addBottle" onclick="$('<?php echo '#'.PopupConstants::BottlePopupLinkID; ?>').click();"></button>
		</div>
		<?php echo $content; ?>
	</div>
</div>

<?php 
	$this->endContent(); 
?>















