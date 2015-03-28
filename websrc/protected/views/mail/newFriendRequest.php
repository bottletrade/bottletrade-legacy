<?php $this->beginContent('/layouts/mail'); ?>
Hello <?php echo $friendRequest->userTo->Username; ?>,
<br/><br/>
You just received a friend request from <?php echo $friendRequest->userFrom->Username; ?> on your BottleTrade profile. Click <a href="<?php echo UrlUtils::generateUrl(UrlUtils::InboxFriendRequestIncomingUri); ?>">here</a> to repsond their friend request.
<br/><br/>
Cheers,
<br/><br/>
BottleTrade
<?php $this->endContent(); ?>