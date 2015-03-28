<?php
$this->pageTitle=Yii::app()->name . ' - Profile';

//popups
$this->widget('application.components.widgets.popups.MessagePopup');

// variables
$isCurrentUserProfile = User::isCurrentUser($user);
$ratingArray = array('zero','one','two','three','four','five');
$userImgMgr = new ImageManager($user);

?>

<!--PRELOAD THESE IMAGES-->
<img  class="hidden" src="<?php echo UrlUtils::generateImageUrl("/profile/upload_bottle_over.png"); ?>">
<!--END PRELOAD-->

<table class="under-menu-holder">
	<tr>
		<td>
			<img src="<?php echo UrlUtils::generateImageUrl("profile/whats_trading.png"); ?>" width="251" height="41" border="0"/>
		</td>
		<td>
			<button class="medium" onclick="window.location='<?php echo UrlUtils::generateUrl(UrlUtils::HashTagsUri); ?>'">
				#HASHTAGS
			</button>
			<button class="medium" onclick="window.location='<?php echo UrlUtils::generateUrl(UrlUtils::TradeFindUri); ?>'">
				FIND A TRADER
			</button>
		</td>
		<td>
			<?php $this->widget('application.components.widgets.inputs.SearchBar'); ?>
		</td>
	</tr>
</table>
<div id="profile-left-cont">
	<div class="user-image-holder">
		<img src='<?php echo $userImgMgr->getImageUrl(); ?>' width='256' height='256'>
	</div>
		<?php if (empty($user->DisplayCity) && empty($user->State)) : ?>
				<span class="username"><?php echo $user->Username;?></span>
		<?php else: ?>
				<span class="username"><?php echo $user->Username;?></span>
			<div style="height: 26px;">
				<span class="city-state">
					<?php if (!empty($user->DisplayCity)): ?>
						<?php echo $user->DisplayCity; ?><br>
					<?php endif; ?>
					<?php if (!empty($user->State)): ?>
						<?php echo $user->State; ?>
					<?php endif; ?>
				</span>
			</div>
		<?php endif; ?>
			<div class="user-info-holder">
				<span class="white">
					<span class="white-title-profile ti-mini">ABOUT:</span>
					<?php if (!empty($user->About)): ?>
						<br/><?php echo $user->About; ?>
					<?php else: // about not empty ?>
						<span>N/A</span>
					<?php endif; ?>
					<br/>
					<?php if ($user->Links != null && strlen($user->Links) > 0): ?>
						<span class="white-title-profile ti-mini">LINKS:</span>
						<br />
					<?php 
						foreach (explode(";", $user->Links) as $link) {
							$linkUrl = $link;
							if (substr($linkUrl, 0, 7) !== "http://" && substr($linkUrl, 0, 8) !== "https://") {
								$linkUrl = 'http://'.$linkUrl;
							}
					?>
						<a class='white' href='#' onclick="window.open('<?php echo $linkUrl; ?>');"><?php echo $link; ?></a>
						<br/>
					<?php } ?>
					<?php endif; ?>
					<span class="white-title-profile ti-mini">TRADER RATING:</span>
					<span class="white large">
					<?php 
						$rating = User::getTraderRating($user);
						$ratingDesc = $rating == 0 ? "N/A" : $rating;
					?>
					<?php echo $ratingDesc; ?>
					</span>
			</span>
		</div>
		<?php if ($isCurrentUserProfile): ?>
		<?php 
			$unreadMessageCount = HoverNotificationUtils::getUnreadMessageCount();
			$pendingFriendCount = HoverNotificationUtils::getPendingFriendRequestCount();
			$pendingTradeCount = HoverNotificationUtils::getPendingTradeCount() + HoverNotificationUtils::getIncomingOfferCount();
			
			$tableHasNotifications = ($unreadMessageCount + $pendingFriendCount) > 0;
		?>
			<div class="profile-button-holder">
			<div class="profile-ISO-button">
			<button class="medium" style="width: auto;" onclick="$('#<?php echo PopupConstants::ISOPopupLinkID; ?>').click();">
							ISO (IN SEARCH OF)
						</button>
			</div>
			<div class="profile-button-left-side">
			<button class="medium" onclick="
							KnockoutManager.MessageSenderManager().setUserTo('', '');
							$('<?php echo '#'.PopupConstants::MessagePopupLinkID; ?>').click();">
							MESSAGE USER
						</button>
			</div>
			<div class="profile-button-right-side">
			<button class="medium" onclick="$('#<?php echo PopupConstants::FriendListPopupLinkID; ?>').click();">
						VIEW FRIENDS
						</button>
			</div>
			<div class="profile-button-left-side">
			<button class="medium" onclick="$('#<?php echo PopupConstants::EditProfilePopupLinkID; ?>').click();">
						EDIT PROFILE
						</button>
						</div>
			<div class="profile-button-right-side">
			<button class="medium" onclick="window.location='<?php echo UrlUtils::generateUrl(UrlUtils::TraderFeedUri); ?>'">
						TRADER FEED
						</button>
						</div>
			<div class="profile-button-left-side">
			<button class="medium" onclick="window.location='<?php echo UrlUtils::generateUrl(UrlUtils::InboxUri); ?>'">
						INBOX
						</button>
						<?php 
							if ($unreadMessageCount > 0):
						?>
						<div class="HN single-high"><?php echo $unreadMessageCount; ?></div>
						<?php endif; ?>
						</div>
			<div class="profile-button-right-side">
			<button class="medium" onclick="window.location='<?php echo UrlUtils::generateUrl(UrlUtils::CyberCellarPendingTradesUri); ?>'">
						MY TRADES
						</button>
						<?php 
							if ($pendingTradeCount > 0):
						?>
						<div class="HN single-high"><?php echo $pendingTradeCount; ?></div>
						<?php endif; ?>
						</div>
			<div class="profile-button-left-side">
			<button class="medium" onclick="window.location='<?php echo UrlUtils::generateUrl(UrlUtils::InboxFriendRequestIncomingUri); ?>'">
						FRIEND &nbsp;&nbsp;REQUESTS
						</button>
						<?php 
							if ($pendingFriendCount > 0):
						?>
						<div class="HN double-high"><?php echo $pendingFriendCount; ?></div>
						<?php endif; ?>
						</div>
			<div class="profile-button-right-side">
			<button class="medium" onclick="window.location='<?php echo UrlUtils::generateUrl(UrlUtils::AccountSettingsUri); ?>'">
						ACCOUNT SETTINGS
						</button>
						</div>
			</div>
		<?php endif; ?>
		<?php if (!$isCurrentUserProfile): ?>
			<button class="large" onclick="
							KnockoutManager.MessageSenderManager().setUserTo('<?php echo $user->ID; ?>', '<?php echo User::getUserNameAndFormalName($user); ?>');
							$('<?php echo '#'.PopupConstants::MessagePopupLinkID; ?>').click();">MESSAGE</button>
			<?php if (!$areUsersFriends): ?>
				<?php
					if ($friendRequest == null) {
						// create friend request form
						$friendRequestFormWidget=$this->beginWidget('CActiveForm', array(
							'id'=>'friend-request-form',
							'enableAjaxValidation'=>true,
							'clientOptions'=>array(
									'validateOnSubmit'=>true
							),
							'htmlOptions'=>array(
									'class'=>'hidden'
							)
							));
						echo $friendRequestFormWidget->hiddenField($friendRequestForm,'userFromId');
						echo $friendRequestFormWidget->hiddenField($friendRequestForm,'userToId');
						echo CHtml::submitButton('Submit', array('id' => "SendFriendRequest"));
						$this->endWidget();
					}
				?>
				<?php if ($friendRequest == null): ?>
					<button id="friend-request-link" class="large" onclick="$('#SendFriendRequest').click(); return false;">ADD AS FRIEND</button>
				<?php else: ?>
					<button class="large disabled">FRIEND REQUEST PENDING</button>
				<?php endif; ?>
				<?php endif; ?>
				<button class="large" style="width: auto;" onclick="$('#<?php echo PopupConstants::ISOPopupLinkID; ?>').click();">
					ISO (IN SEARCH OF)
				</button>
		<?php endif; ?>
		</div>
<?php 
	$this->widget('application.components.widgets.popups.NewCompanyPopup');
	$this->widget('application.components.widgets.popups.NewBeveragePopup');
?>
<div>
	<?php 
		$this->widget('application.components.widgets.popups.IsoPopup', array('user'=>$user));
	?>
	<div id="profile-right-cont">
		<div class="upload-bottle-link">
		<?php if ($isCurrentUserProfile) : ?>
			<button class='upload-bottle-banner' data-bind='click: $root.BottleManager().addBottle' onclick="$('<?php echo '#'.PopupConstants::BottlePopupLinkID; ?>').click(); return false;" ></button>
		<?php endif; ?>
		</div>
		<div style="width: 100%; height: auto;">
			<a class="title" href='<?php echo UrlUtils::generateUrl(UrlUtils::CyberCellarBottlesUri, $user->Username); ?>'>CYBER CELLAR</a>
		</div>
		<?php
			// render popup
			$this->widget('application.components.widgets.popups.BottlePopup', array(
				'renderForm' => $isCurrentUserProfile // only render form if necessary
			));
		?>
		<div class="profile-cyber-cellar-holder">
			<div class="event-container" data-bind="foreach: $root.EventManager().bottles">
				<?php 
					// for each bottle loaded into KO, show info
					$this->widget('application.components.widgets.displays.ProfileBottleDisplayKO'); 
				?>
			</div>
			<div data-bind="visible: $root.CyberCellarManager().loadingData" class="center">
				<img src="<?php echo UrlUtils::generateImageUrl("ajax-loader.gif"); ?>" width="40px" height="40px"/>
			</div>
		</div>
	</div>
</div>
<div class="trader-review-container">
	<span class="white-title ti-medium">TRADER REVIEWS</span>
	<?php if (empty($reviews)): ?>
	<div class="profile-review-container">
		<span class="black bold">There are no reviews for this user at this time.</span>
	</div>
	<?php endif; // if (empty($reviews)) ?>
	
	<?php foreach($reviews as $review) { ?>
	<div class="profile-review-container">
		<div class="profile-review-image">
			<img src='<?php echo ImageManager::getImageUrlStatic($review->userFrom); ?>' width='86' height='86'><br/>
		</div>
			<div class="profile-review-rating">
				<?php 
					$imgFile = 'profile/'.$ratingArray[$review->Rating].'_bottle.png';
				?>
				<img src='<?php echo UrlUtils::generateImageUrl($imgFile); ?>'>
			</div>
			<div class="profile-review-copy">
				<span class="black bold">Review Written By: <a href="<?php echo UrlUtils::generateUrl(UrlUtils::ProfileUri, $review->userFrom->Username); ?>"><?php echo $review->userFrom->Username; ?></a></span>
				<span class="black"><br /><?php echo $review->Message; ?></span>
			</div>
	</div>
	<?php } ?>
</div>
<script>
$(window).load(function(){
	// do initial load of data
	KnockoutManager.CyberCellarManager().dataUrl(bottletrade.apis.cyberCellarBottles);
	KnockoutManager.CyberCellarManager().customUrlData('<?php echo "un=".$user->Username; ?>');
	KnockoutManager.CyberCellarManager().loadMore();

	// trigger auto update when two window views away from bottom for seamless loading of new data
	$('.profile-cyber-cellar-holder').scroll(function() {
		if($('.profile-cyber-cellar-holder').scrollTop() + $('.profile-cyber-cellar-holder').height() >= $('.event-container').height() - (2*$('.profile-cyber-cellar-holder').height())) {
			KnockoutManager.CyberCellarManager().loadMore();
	    }
	});
});
</script>
<?php
if ($isCurrentUserProfile) {
	// popup widgets
	$this->widget('application.components.widgets.popups.EditProfilePopup');
}
?>
	

