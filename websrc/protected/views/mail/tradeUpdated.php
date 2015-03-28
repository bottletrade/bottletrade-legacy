<?php $this->beginContent('/layouts/mail'); ?>
<?php 
$otherUser = Trade::getOtherUser($trade);
$currUser = Trade::getCurrentUser($trade);
?>
Hello <?php echo $otherUser->Username; ?>,
<br/><br/>
<?php echo $currUser->Username; ?> has updated information on a pending trade. The following items have been updated in the trade:
<br/><br/>
<ul>
<?php if (in_array(TradeStatus_ShipDateSet, $updates)):?>
<li>Shipping Dates</li>
<?php endif; ?>
<?php if (in_array(TradeStatus_Shipped, $updates)):?>
<li>Bottles Shipped</li>
<?php endif; ?>
<?php if (in_array(TradeStatus_Received, $updates)):?>
<li>Bottles Received</li>
<?php endif; ?>
</ul>
<br/><br/>
Click <a href="<?php echo UrlUtils::generateUrl(UrlUtils::CyberCellarTradesUri, $trade->ID);?>">here</a> to view your trade details.
<br/><br/>
Cheers,
<br/><br/>
BottleTrade
<?php $this->endContent(); ?>