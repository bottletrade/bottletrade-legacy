<?php 
class PopupWidgetKO extends PopupWidget
{
	public $bindingID;
	
	public function init()
	{
		$this->bindingID = KnockoutConstants::KnockoutManagerBindingID;
		return parent::init();
	}
}
?>