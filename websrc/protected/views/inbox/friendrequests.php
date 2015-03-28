<div id="title_holder">
	<span class="white-title ti-medium">FRIENDS</span>
</div>
<div id="white-area">
<?php if (count($friendRequests) == 0): ?>
<span class="black bold">No Friend Requests</span><br/>
<?php else: ?>
<?php 
		// create friend request response form
		$friendRequestResponseFormWidget=$this->beginWidget('CActiveForm', array(
				'id'=>'friend-request-response-form',
				'enableAjaxValidation'=>true,
				'clientOptions'=>array(
						'validateOnSubmit'=>true
				),
				'htmlOptions'=>array(
						'class'=>'hidden'
				)
		));
		echo $friendRequestResponseFormWidget->hiddenField($friendRequestResponseForm,'id', array ('id'=> 'FriendRequestResponse_Id'));
		echo $friendRequestResponseFormWidget->hiddenField($friendRequestResponseForm,'response', array ('id'=> 'FriendRequestResponse_Response'));
		echo CHtml::submitButton('Submit');
		$this->endWidget();
		
		foreach ($friendRequests as $friendRequest) {
			$this->widget('application.components.widgets.displays.FriendRequestDisplay', array(
					'friendRequest' => $friendRequest,
					'onAcceptClick' => sprintf("sendFriendRequestResponse('%s','%s','%s');", 'friend-request-response-form', $friendRequest->ID, FriendRequestResponseForm::ACCEPT),
					'onDeclineClick' => sprintf("sendFriendRequestResponse('%s','%s','%s');", 'friend-request-response-form', $friendRequest->ID, FriendRequestResponseForm::DENY),
					'onRemoveClick' => sprintf("sendFriendRequestResponse('%s','%s','%s');", 'friend-request-response-form', $friendRequest->ID, FriendRequestResponseForm::REMOVE)
			));
			echo "<br/>";
		}
?>
<?php endif; ?>
</div>