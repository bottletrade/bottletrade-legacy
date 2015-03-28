<?php $this->beginContent('/layouts/mail'); ?>
<div>
Hello <?php echo $message->userTo->Username; ?>,
<br/><br/>
You just received a message from <?php echo $message->userFrom->Username; ?> on your BottleTrade profile. Click <a href="<?php echo UrlUtils::generateUrl(UrlUtils::InboxUri); ?>">here</a> to respond to their message.
<br/><br/>
Cheers,
<br/><br/>
BottleTrade
</div>
<?php $this->endContent(); ?>