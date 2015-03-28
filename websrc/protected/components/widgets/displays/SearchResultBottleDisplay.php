<?php 

class SearchResultBottleDisplay extends CWidget
{
	// bottle to display
	public $bottle;
	
	// whether or not the bottle is editable
	protected $isEditable;
	
	public function init() {
		if (!empty($this->bottle)) {
			$this->isEditable = Bottle::isOwnedByCurrentUser($this->bottle);
		}
	}
	
	// function to run the widget
	public function run()
	{
        $this->render('SearchResultBottleDisplay');
	}
}
?>