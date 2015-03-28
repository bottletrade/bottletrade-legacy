<?php 

class CompanyDisplay extends CWidget
{
	// company to display
	public $company;
	
	// function to run the widget
	public function run()
	{
        $this->render('CompanyDisplay');
	}
}
?>