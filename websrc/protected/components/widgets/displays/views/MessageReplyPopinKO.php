<div data-bind="with: msgToReply" class="hidden">
<?php $replyFormWidget=$this->beginWidget('CActiveForm', array(
	                                                'id'=>FormConstants::MessageReplyFormID,
                                                    'enableAjaxValidation'=>true,
                                                    'clientOptions'=>array(
                                                                           'validateOnSubmit'=>true
                                                                           ),
                                                    )); ?>
    <?php echo $replyFormWidget->hiddenField($replyForm,'userFromId',array('data-bind'=>'value: userFromReplyId')); ?>
    <?php echo $replyFormWidget->hiddenField($replyForm,'userToId',array('data-bind'=>'value: userToReplyId')); ?>
    <?php echo $replyFormWidget->hiddenField($replyForm,'parentMessageId',array('data-bind'=>'value: parentMessageId')); ?>
	<?php echo $replyFormWidget->hiddenField($replyForm,'subject',array('data-bind'=>'value: replySubject')); ?>
	<?php echo $replyFormWidget->hiddenField($replyForm,'body',array('data-bind'=>'value: replyBody')); ?>
<?php $this->endWidget(); ?>
</div>
<!-- Knockout UI code -->
<script type='text/javascript'>
$(window).bind("load", function() {
	var MessageSender = function () {
	    var self = this;
	    self.messagesArray = ko.observableArray();
	    self.msgToReply = ko.observable();

	    self.deleteMessage = function () {
	    	if (confirm('Are you sure you want to delete this thread')) {
	    	 	window.location='<?php echo UrlUtils::generateUrl(UrlUtils::InboxDeleteUri,"/"); ?>' + self.messagesArray()[0].parentMessageId;
	    	}
	    	return false;
	    }
	    
	    self.showReplyInput = function (msg) {
	        msg.showReply(true);
		}
		self.hideReplyInput = function (msg) {
	        msg.showReply(false);
		}
		self.sendReply = function (msg) {
			self.msgToReply(msg);
			$('#<?php echo FormConstants::MessageReplyFormID ?>').submit();
		}
	    self.addJsonMessage = function (msg, allowReply) {
		    msg.showReply = ko.observable(false);
		    msg.canReply = ko.observable(allowReply);
		    self.messagesArray.push(msg);
	    }
	};

	KnockoutManager.MessageReplyManager(new MessageSender());
});
</script>