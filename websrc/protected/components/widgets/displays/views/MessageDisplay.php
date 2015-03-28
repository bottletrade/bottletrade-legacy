<?php if (empty($this->message)): ?>
<div id="thread-holder">
	<div class="thread-image-holder">
		<img data-bind="attr:{src:userFromImgSrc}" width="50px" height="50px">
	</div>
	<div class="thread-from">
		<span class="black bold"><a data-bind='attr: { href: "<?php echo UrlUtils::generateUrl(UrlUtils::ProfileUri); ?>/" + userFromUsername }, text: userFromUsername'></a></span><br/>
		<span class="black-small" data-bind="text: localizeTime(sentTime)"></span>
	</div>
	<div class="thread-subject">
		<span class="black bold">Subject: <!-- ko text: subject --><!-- /ko --></span>
	</div>
	<div class="thread-message">
		<span class="black">Message: <!-- ko text: body --><!-- /ko --></span>
		<hr>
	</div>
	
	<div data-bind="visible: canReply()">
		<div class="reply-button-holder" data-bind="visible: !showReply()">
			<button data-bind='click: $root.MessageReplyManager().showReplyInput' class="medium">REPLY</button>
		</div>
		
		<div class="reply-holder" data-bind="visible: showReply()">
				<div class="reply-fields">
					<span class="black bold">Reply Subject: </span><br />
					<input data-bind="value: replySubject"></input>
					<textarea data-bind="value: replyBody" id="MailMessageForm_body" placeholder="Reply to message..."></textarea></span>
				</div>
			<button data-bind='click: $root.MessageReplyManager().sendReply' class="small">SEND</button>
			<button data-bind='click: $root.MessageReplyManager().hideReplyInput' class="small">HIDE</button>
		</div>
	</div>
</div>
<?php endif; // if (empty($this->message)) ?>

<?php if (!empty($this->message)): ?>
<!-- Knockout UI code -->
<script type='text/javascript'>
$(window).bind("load", function() {
	KnockoutManager.MessageReplyManager().addJsonMessage(<?php echo json_encode(MailMessageForm::MakeDisplayData($this->message)); ?>, <?php echo json_encode($this->allowReply);?>);
});
</script>
<?php endif; // if (!empty($this->message)) ?>