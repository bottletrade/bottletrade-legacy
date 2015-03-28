<?php 

class MessageDisplay extends CWidget
{
	public $message; // message to display
	public $allowReply; // whether or not to show reply input
	
	// function to run the widget
	public function run()
	{
        $this->render('MessageDisplay');
	}
}
?>