<?php $this->beginContent('/layouts/mail'); ?>
Hello <?php echo $offer->userTo->Username; ?>,
<br/><br/>
You just received a trade offer from <?php echo $offer->userFrom->Username; ?> on your BottleTrade profile. Click <a href="<?php echo UrlUtils::generateUrl(UrlUtils::CyberCellarOffersUri, $offer->ID); ?>">here</a> to respond to their message.
<br/><br/>
Cheers,
<br/><br/>
BottleTrade
<?php $this->endContent(); ?>