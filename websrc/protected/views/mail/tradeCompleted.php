<?php $this->beginContent('/layouts/mail'); ?>
<?php 
$otherUser = Trade::getOtherUser($trade);
$currUser = Trade::getCurrentUser($trade);
?>
Hey <?php echo $otherUser->Username; ?>,
<br/><br/>
Your trade with <?php echo $currUser->Username; ?> has officially closed!
<br/><br/>
After sampling some of your proof of closure, please head back to your profile and take a moment to rate your trade experience with <?php echo $currUser->Username; ?>. 
<br/><br/>
Click <a href="<?php echo UrlUtils::generateUrl(UrlUtils::CyberCellarTradesUri, $trade->ID);?>">here</a> to leave a trader review.
<br/><br/>
Cheers!
<br/>
BottleTrade
<?php $this->endContent(); ?>