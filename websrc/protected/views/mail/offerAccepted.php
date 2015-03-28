<?php $this->beginContent('/layouts/mail'); ?>
<?php 
$otherUser = Trade::getOtherUser($trade);
$currUser = Trade::getCurrentUser($trade);
?>
Hello <?php echo $otherUser->Username; ?>,
<br/><br/>
<?php echo $currUser->Username; ?> just approved your pending trade offer. Click <a href="<?php echo UrlUtils::generateUrl(UrlUtils::CyberCellarTradesUri, $trade->ID);?>">here</a> to view your trade details.
<br/><br/>
Cheers,
<br/><br/>
BottleTrade
<?php $this->endContent(); ?>