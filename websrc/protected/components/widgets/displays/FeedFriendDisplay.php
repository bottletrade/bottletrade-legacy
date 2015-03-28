<?php 

class FeedFriendDisplay extends CWidget
{
	// bottle to display
	public $bottle;
	
	// whether or not the bottle is editable
	protected $isEditable;

	// whether bottle was provided
	protected $hasBottle;
	
	public function init() {
		if (!empty($this->bottle)) {
			$this->isEditable = Bottle::isOwnedByCurrentUser($this->bottle);
		}
	}
	
	// function to run the widget
	public function run()
	{
        $this->render('FeedFriendDisplay');
	}
}
?>