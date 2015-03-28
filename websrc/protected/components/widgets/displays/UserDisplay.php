<?php 

class UserDisplay extends CWidget
{
	// user to display
	public $user;
	
	public function init() {
	}
	
	// function to run the widget
	public function run()
	{
        $this->render('UserDisplay');
	}
}
?>