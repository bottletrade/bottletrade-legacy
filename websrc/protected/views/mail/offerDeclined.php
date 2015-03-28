<?php $this->beginContent('/layouts/mail'); ?>
<?php 
$otherUser = Offer::getOtherUser($offer);
$currUser = Offer::getCurrentUser($offer);
?>
Hello <?php echo $otherUser->Username; ?>,
<br/><br/>
<?php echo $currUser->Username; ?> has declined your trade.
<br/><br/>
Cheers,
<br/><br/>
BottleTrade
<?php $this->endContent(); ?>