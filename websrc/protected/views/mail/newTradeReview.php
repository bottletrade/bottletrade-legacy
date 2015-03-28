<?php $this->beginContent('/layouts/mail'); ?>
<?php 
$otherUser = Trade::getOtherUser($trade);
$currUser = Trade::getCurrentUser($trade);
?>
Hey <?php echo $otherUser->Username; ?>,
<br/><br/>
<?php echo $currUser->Username; ?> just left a review for you. Click <a href="<?php echo UrlUtils::generateUrl(UrlUtils::CyberCellarTradesUri, $trade->ID);?>">here</a> to see your trader review.
<br/><br/>
Cheers!
<br/>
BottleTrade
<?php $this->endContent(); ?>