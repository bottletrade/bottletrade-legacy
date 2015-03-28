<?php 

class StyleDisplay extends CWidget
{
	// style to display
	public $style;
	
	// function to run the widget
	public function run()
	{
        $this->render('StyleDisplay');
	}
}
?>