<div id="title_holder">
	<span class="white-title ti-medium">TRADE DETAILS</span>
</div>
<?php 
	$otherUser = Trade::getOtherUser($trade);
	$currentUser = Trade::getCurrentUser($trade);
	$ratingArray = array('zero','one','two','three','four','five');

	if ($trade->CompletedTime == null)
		$tradeTitle = "Pending Trade with ".$otherUser->Username;
	else
		$tradeTitle = "Completed Trade with ".$otherUser->Username;
?>
<div id="white-area">
	<?php $currUserTradeInfoFormWidget=$this->beginWidget('CActiveForm', array(
                                                    'id'=>'trade-info-form',
                                                    'enableAjaxValidation'=>true
                                                    )); ?>
    <?php echo $currUserTradeInfoFormWidget->hiddenField($currUserTradeInfoForm,'tradeId'); ?>
    <?php echo $currUserTradeInfoFormWidget->hiddenField($currUserTradeInfoForm,'delete', array('id'=>"DeleteTradeId")); ?>
	<div>
	<?php if ($currUserTradeInfoForm->canSaveForm()): ?>
		<?php echo CHtml::submitButton('SAVE CHANGES', array('class'=> 'small', 'onclick'=>'$("#tradeInfoSaveInProgress1").show(); return true;')); ?>
		<img id="tradeInfoSaveInProgress1" style="display: none;" class="loading small" src='<?php echo UrlUtils::generateImageUrl("ajax-loader.gif"); ?>'></img>
	<?php endif; ?>
	<?php if ($trade->CompletedTime == null): ?>
		<button class="small" type="submit" onclick="$('#tradeInfoSaveInProgress2').show(); if (confirm('Are you sure you want to cancel this trade?')) { $('#DeleteTradeId').val(1); return true; } else { $('#tradeInfoSaveInProgress2').hide(); return false; }">CANCEL TRADE</button>
	<?php endif; ?>
	<?php if ($currUserTradeInfoForm->canSaveForm() || $trade->CompletedTime == null): ?>
		<img id="tradeInfoSaveInProgress2" style="display: none;" class="loading small" src='<?php echo UrlUtils::generateImageUrl("ajax-loader.gif"); ?>'></img>
		<br/><br/>
	<?php endif; ?>
		<div class="center">
			<span class="black-large bold"><?php echo $tradeTitle; ?></span><br/>
		</div>
		<span class="black">Find the details of your recent trade below. Please communicate with your trade partner about shipping dates, tracking numbers, and any other information you wish to provide below.</span>
		<br />
		<table width="730px" class="black">
			<thead>
				<tr>
					<th width="33%">&nbsp;</th>
					<th width="33%" align="left">Your Settings</th>
					<th width="34%" align="left"><?php echo $otherUser->Username; ?>'s Settings</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td width="33%"><?php echo CHtml::activeLabel($currUserTradeInfoForm,'shipDate');?></td>
					<td width="33%"><?php 
						// don't allow current user to modify ship date if the following apply
						//	- ship date set AND
						//	- current user has already shipped the bottles OR other user has already recieved the bottles
						if ($currUserTradeInfoForm->shipDate != null &&
							($currUserTradeInfoForm->hasShipped || 
							$otherUserTradeInfo->hasReceived))
							echo $currUserTradeInfoForm->shipDate;
						else
							$this->widget('zii.widgets.jui.CJuiDatePicker', array(
									'model' => $currUserTradeInfoForm,
									'attribute' => 'shipDate',
									'options' => array(
											'showAnim'=>'fold',
											'changeMonth' => 'true',
											'changeYear' => 'true',
											'yearRange'=>'-1:+0',
											'dateFormat'=>'yy-mm-dd',
									),
									'htmlOptions' => array(
											'size' => '10',         // textField size
											'maxlength' => '10'    // textField maxlength
									)
							));
					?>
					<?php echo CHtml::error($currUserTradeInfoForm, 'shipDate');?>
					</td>
					<td width="34%"><?php echo $otherUserTradeInfo->shipDate == null ? 'Not Set' : $otherUserTradeInfo->shipDate;?></td>
				</tr>
				<tr>
					<td width="33%"><?php echo CHtml::activeLabel($currUserTradeInfoForm,'hasShipped');?></td>
					<td width="33%"><?php echo $currUserTradeInfoForm->hasShipped ? 'Yes' : $currUserTradeInfoFormWidget->checkBox($currUserTradeInfoForm,'hasShipped');?>
						<?php echo CHtml::error($currUserTradeInfoForm, 'hasShipped');?></td>
					<td width="34%"><?php echo $otherUserTradeInfo->hasShipped ? 'Yes' : 'No';?></td>
				</tr>
				<tr>
					<td width="33%"><?php echo CHtml::activeLabel($currUserTradeInfoForm,'hasReceived');?></td>
					<td width="33%"><?php echo $currUserTradeInfoForm->hasReceived ? 'Yes' : $currUserTradeInfoFormWidget->checkBox($currUserTradeInfoForm,'hasReceived');?>
						<?php echo CHtml::error($currUserTradeInfoForm, 'hasReceived');?></td>
					<td width="34%"><?php echo $otherUserTradeInfo->hasReceived ? 'Yes' : 'No';?></td>
				</tr>
			</tbody>
		</table>
	</div>
	<?php $this->endWidget(); ?>
	<div class="horizontal-divide"></div>
	<div class="center">
	<span class="black-large bold">Trade Summary</span>
	</div>
	<div class="TD-bottles-up-holder">
		<div class="TD-your-title">
			<span class="black bold">Your Bottles Up For Trade</span><br />
			<?php foreach($currUserBottleTrades as $currUserBottleTrade) { ?>
			<div class="TD-bottle-holder">
				<div class="TD-bottle-image-holder">
					<img src='<?php echo ImageManager::getImageUrlStatic($currUserBottleTrade->bottle); ?>' width='70' height='70'>
				</div>
				<div class="TD-info-holder">
					<span class="black-small">
						<?php echo Bottle::getBottledOnYear($currUserBottleTrade->bottle); ?> | <?php echo Bottle::getBeverageName($currUserBottleTrade->bottle); ?>
						<br/>
						<?php echo Bottle::getCompanyName($currUserBottleTrade->bottle); ?> <?php echo Bottle::getCompanyCityStateDisplay($currUserBottleTrade->bottle); ?>
						<br>
						Quantity: <?php echo $currUserBottleTrade->Quantity; ?>
						<br>
						Style: <?php echo Bottle::getStyleName($currUserBottleTrade->bottle); ?>
					</span>
				</div>
			</div>
			<?php } ?>
		</div>
		<div class="TD-their-title">
			<span class="black bold"><?php echo $otherUser->Username; ?>'s Bottles Up For Trade</span><br />
			<?php foreach($otherUserBottleTrades as $otherUserBottleTrade) {
			?>
			<div class="TD-bottle-holder">
				<div class="TD-bottle-image-holder">
					<img src='<?php echo ImageManager::getImageUrlStatic($otherUserBottleTrade->bottle); ?>' width='70' height='70'>
				</div>
				<div class="TD-info-holder">
					<span class="black-small">
						<?php echo Bottle::getBottledOnYear($otherUserBottleTrade->bottle); ?> | <?php echo Bottle::getBeverageName($otherUserBottleTrade->bottle); ?>
						<br/>
						<?php echo Bottle::getCompanyName($otherUserBottleTrade->bottle); ?> <?php echo Bottle::getCompanyCityStateDisplay($otherUserBottleTrade->bottle); ?>
						<br />
						Quantity: <?php echo $otherUserBottleTrade->Quantity; ?>
						<br />
						Style: <?php echo Bottle::getStyleName($otherUserBottleTrade->bottle); ?>
						</span>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
	<div class="horizontal-divide"></div>
		<div class="center">
		<span class="black-large bold">Trader Reviews</span>
		</div>
		<?php if (!Trade::canReview($trade)): ?>
		<span class="black">Trade must be completed before reviews can be made.  Once both parties have received their packages, mark all fields above and the trader review feature will be enabled.</span>
		<br /><br />
		<?php else: ?>
		<table>
			<tr>
				<td><span class="black bold">Your Review</span><br />
					<?php if ($currUserReview == null): ?>
					<span class="black">You have not left a review for this trade.</span><br/>
					<?php 
						// popup widgets
						$this->widget('application.components.widgets.popups.TraderReviewPopup', array(
								'trade' => $trade
						));
						echo CHtml::button('Review Now', array('class' => 'small', 'onclick' => "$('#".PopupConstants::TraderReviewPopupLinkID."').click();"));
					?>
					<?php else: ?>
					<div class="VST-review-container">
						<div class="VST-review-user-image">
							<img src='<?php echo ImageManager::getImageUrlStatic($currentUser); ?>' width='86' height='86'>
						</div>
							<div class="VST-review-rating">
								<img src='<?php echo UrlUtils::generateImageUrl('profile/'.$ratingArray[$currUserReview->Rating].'_bottle.png'); ?>'>
							</div>
							<div class="VST-review-message">
								<span class="black">
									<?php echo $currUserReview->Message; ?>
								</span>
							</div>
					</div>
					<?php endif; ?>
				</td>
			</tr>
			<tr>
				<td><span class="black bold">Their Review</span><br />
					<?php if ($otherUserReview == null):?>
					<span class="black">This person has not left a review yet, as soon as they do it will appear here and at the bottom of your profile page.</span>
				<?php else:?>
					<div class="VST-review-container">
						<div class="VST-review-user-image">
							<img src='<?php echo ImageManager::getImageUrlStatic($otherUser); ?>' width='86' height='86'><br/>
						</div>
							<div class="VST-review-rating">
								<img src='<?php echo UrlUtils::generateImageUrl('profile/'.$ratingArray[$otherUserReview->Rating].'_bottle.png'); ?>'>
							</div>
							<div class="VST-review-message">
								<span class="black">
								<?php echo $otherUserReview->Message; ?>
								</span>
							</div>
					</div>
				<?php endif; ?>
				</td>
			</tr>
		</table>
		<?php endif; ?>
	<div class="horizontal-divide"></div>
	<div data-bind="with: $root.TradeMessageManager()">
		<div class="center">
			<span class="black-large bold">Leave A Note</span><br />
		</div>
			<span class="black">Any notes you would like to attach for this trade can be left here. Items like tracking numbers, shipping date questions and notifications that 
			packages have arrived safely should be provided here. Remember it never hurts to ask a question!
			</span>

		<div class="VST-trade-message">
			<form data-bind='submit: sendMsg'>
		        <textarea data-bind="value: msgToSend, valueUpdate:'afterkeydown'"></textarea><br />
		        <button class="small" type='submit' data-bind='enable: msgToSendIsValid'>POST NOTE</button>
		        <img class="loading small" data-bind='visible: msgIsSending' src='<?php echo UrlUtils::generateImageUrl("ajax-loader.gif"); ?>'></img>
		    </form>
	    </div>
	    <span class="black">Find all posts from this trade below:</span><br /><br />
	    <div class="VST-message-posts" style="display: none;" data-bind="visible: messages().length > 0">
			<div data-bind='foreach: messages.slice(0).reverse()'>
				<div class="VST-post-holder">
				<div class="VST-post-user-image">
				<img data-bind="attr: { src: UserFromImgUrl }" width="60px" height="60px"/>
				</div>
				<div class="black" style="overflow: auto; display: block; width: 580px; height: auto; float: left; padding: 5px; word-wrap: break-word">
				<span class="bold"><!-- ko text: UserFrom --><!-- /ko --></span><br />
				<span class="black-small"><!-- ko text: TimeAgo --><!-- /ko --></span><br />
				<!-- ko text: Body --><!-- /ko -->
				</div>
			</div>
			<div class="horizontal-divide"></div>
			</div>
		</div>
	</div>
</div>
<script type='text/javascript'>
$(window).bind("load", function() {
	var MessagePost = function(message) {
		var self = this;

		self.UserFrom = message.userFrom;
		self.UserFromImgUrl = message.userFromImgUrl;
		self.SentTime = message.sentTime;
		self.Body = message.body;
		self.TimeAgo = ko.observable(localizeTimeAgo(message.sentTime));
	}
	
	var MessageModel = function() {
		var self = this;
		
		self.msgToSend = ko.observable("");
		self.msgIsSending = ko.observable(false);
		self.messages = ko.observableArray([
         								<?php foreach ($messages as $message) {
                                    	       	echo "new MessagePost(".json_encode(TradeMessage::MakePostDisplayWithMessage($message))."),";
                                    	} ?>
                                    	   ]);
		self.sendMsg = function() {
	        if (this.msgToSend() && this.msgToSendIsValid()) {
		        // send message to server
		        var latestTimestamp = this.messages().length > 0 ? this.messages()[this.messages().length-1].SentTime : null;
		        self.msgIsSending(true);
		        $.ajax({
		    	    type: 'post',
		    	    url: "<?php echo UrlUtils::generateUrl(UrlUtils::TradeSendMessageUri);?>",
		    	    data: {'tradeID': '<?php echo $trade->ID; ?>', 'message': this.msgToSend(), 'latestTimestamp': latestTimestamp },
		    	    dataType: 'json',
		    	    error: function(data) 
		    	    {
		    	    	for (var i=0;i<KnockoutManager.TradeMessageManager().messages().length;i++) {
				    	    KnockoutManager.TradeMessageManager().messages()[i].TimeAgo(localizeTimeAgo(KnockoutManager.TradeMessageManager().messages()[i].SentTime));
			    	    }
		    	    	KnockoutManager.TradeMessageManager().msgIsSending(false);
			    	},
		    	    success: function(data){
			    	    for (var i=0;i<KnockoutManager.TradeMessageManager().messages().length;i++) {
				    	    KnockoutManager.TradeMessageManager().messages()[i].TimeAgo(localizeTimeAgo(KnockoutManager.TradeMessageManager().messages()[i].SentTime));
			    	    }
			    	    for (var i=0;i<data.length;i++) {
			    	    	KnockoutManager.TradeMessageManager().messages.push(new MessagePost(data[i]));
			    	    }
		    	    	KnockoutManager.TradeMessageManager().msgToSend("");
		    	    	KnockoutManager.TradeMessageManager().msgIsSending(false);
		    	    }
		    	});
	        }
	    };

	    self.msgToSendIsValid = ko.computed(function() {
	        return this.msgToSend() != "";
	    }, this);
	};
	KnockoutManager.TradeMessageManager(new MessageModel());
});
</script>