<?php 

class SearchResultBeverageDisplay extends CWidget
{
	// beverage to display
	public $beverage;
	
	// function to run the widget
	public function run()
	{
        $this->render('SearchResultBeverageDisplay');
	}
}
?>