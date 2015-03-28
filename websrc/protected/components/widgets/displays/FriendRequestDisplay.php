<?php 

class FriendRequestDisplay extends CWidget
{
	// bottle to display
	public $friendRequest;
	public $onAcceptClick;
	public $onDeclineClick;
	public $onRemoveClick;
	
	protected $isIncomingRequest;
	
	public function init() {
		$this->isIncomingRequest = $this->friendRequest->userTo->ID == Yii::app()->user->ID;
	}
	
	// function to run the widget
	public function run()
	{
        $this->render('FriendRequestDisplay');
	}
}
?>