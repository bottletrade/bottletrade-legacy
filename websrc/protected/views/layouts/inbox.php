<?php
$this->pageTitle=Yii::app()->name . ' - Inbox';
?>
<?php $this->beginContent('/layouts/main'); ?>
<?php 
//popups
$this->widget('application.components.widgets.popups.MessagePopup');
?>
<table class="under-menu-holder">
	<tr>
		<td>
			<img src="<?php echo UrlUtils::generateImageUrl("profile/whats_trading.png"); ?>" width="251" height="41" border="0"/>
		</td>
		<td>
			<button class="medium" onclick="window.location='<?php echo UrlUtils::generateUrl(UrlUtils::HashTagsUri); ?>'">
				#HASHTAGS
			</button>		</td>
		<td>
			<?php $this->widget('application.components.widgets.inputs.SearchBar'); ?>
		</td>
	</tr>
</table>
<div id="left-menu-no-white">
	<table class="left-menu">
		<tr>
			<td>
				<span class="white-title ti-small">MESSAGES</span>
			</td>
		</tr>
		<tr>
			<td>
				<button class="medium" onclick="
				KnockoutManager.MessageSenderManager().setUserTo('', '');
				$('<?php echo '#'.PopupConstants::MessagePopupLinkID; ?>').click();">COMPOSE</button>
				<?php
					$atSentMsgUri = UrlUtils::isPageAtUri(UrlUtils::InboxMessagesSentUri, false);
					if (!$atSentMsgUri && UrlUtils::isPageAtUri(UrlUtils::InboxMessagesAllUri, false)) {
						$buttonClass = 'medium disabled';
					} else {
						$buttonClass = 'medium';
					}
				?>
			</td>
		</tr>
		<tr>
			<td>
				<button class="<?php echo $buttonClass; ?>" onclick="window.location='<?php echo UrlUtils::generateUrl(UrlUtils::InboxMessagesAllUri); ?>'">INCOMING</button>
	<?php 
		$notificationCount = HoverNotificationUtils::getUnreadMessageCount(); 
		if ($notificationCount > 0):
	?>
	<div class="HN ICC-single-high"><?php echo $notificationCount; ?></div>
	<?php endif; ?>
	<?php
		if (UrlUtils::isPageAtUri(UrlUtils::InboxMessagesSentUri, false)) {
			$buttonClass = 'medium disabled';
		} else {
			$buttonClass = 'medium';
		}
	?>
			</td>
		</tr>
		<tr>
			<td>
				<button class="<?php echo $buttonClass; ?>" onclick="window.location='<?php echo UrlUtils::generateUrl(UrlUtils::InboxMessagesSentUri); ?>'">SENT</button>
			</td>
		</tr>
		<tr>
			<td>
		<span class="white-title ti-small">FRIENDS</span>
			</td>
		</tr>
		<tr>
			<td class="big-button">
				<?php
		if (UrlUtils::isPageAtUri(UrlUtils::InboxFriendRequestIncomingUri)) {
			$buttonClass = 'medium disabled';
		} else {
			$buttonClass = 'medium';
		}
	?>
				<button class="<?php echo $buttonClass; ?>" onclick="window.location='<?php echo UrlUtils::generateUrl(UrlUtils::InboxFriendRequestIncomingUri); ?>'">AWAITING APPROVAL</button>
	<?php 
		$notificationCount = HoverNotificationUtils::getPendingFriendRequestCount(); 
		if ($notificationCount > 0):
	?>
	<div class="HN ICC-double-high"><?php echo $notificationCount; ?></div>
	<?php endif; ?>
	<?php
		if (UrlUtils::isPageAtUri(UrlUtils::InboxFriendRequestSentUri)) {
			$buttonClass = 'medium disabled';
		} else {
			$buttonClass = 'medium';
		}
	?>
			</td>
		</tr>
		<tr>
			<td class="big-button">
				<button class="<?php echo $buttonClass; ?>" onclick="window.location='<?php echo UrlUtils::generateUrl(UrlUtils::InboxFriendRequestSentUri); ?>'">PENDING REQUESTS</button>
			</td>
		</tr>	
	</table>
</div>
<div id="right-with-white">
		<?php echo $content; ?>
</div>
<?php $this->endContent(); ?>