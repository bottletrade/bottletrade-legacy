<?php $this->beginContent('/layouts/mail'); ?>
<?php 
$otherUser = Trade::getOtherUser($trade);
$currUser = Trade::getCurrentUser($trade);
?>
Hey <?php echo $otherUser->Username; ?>,
<br/><br/>
<?php echo $currUser->Username; ?> left a note on a pending trade for you.  Click <a href="<?php echo UrlUtils::generateUrl(UrlUtils::CyberCellarTradesUri, $trade->ID);?>">here</a> to view your trade details.
<br/><br/>
Cheers!
<br/>
BottleTrade
<?php $this->endContent(); ?>