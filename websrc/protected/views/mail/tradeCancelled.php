<?php $this->beginContent('/layouts/mail'); ?>
<?php 
$otherUser = Trade::getOtherUser($trade);
$currUser = Trade::getCurrentUser($trade);
?>
Hello <?php echo $otherUser->Username; ?>,
<br/><br/>
<?php echo $currUser->Username; ?> has cancelled a pending trade. Click <a href="<?php echo UrlUtils::generateUrl(UrlUtils::ProfileUri, $currUser->Username); ?>">here</a> to message this user.
<br/><br/>
Cheers,
<br/><br/>
BottleTrade
<?php $this->endContent(); ?>