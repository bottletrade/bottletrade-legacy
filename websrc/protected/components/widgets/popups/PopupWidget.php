<?php 
class PopupWidget extends CWidget
{
	public $linkID;
	protected $popupID;
	protected $formID;
	
	public function init()
	{
		$this->popupID = $this->linkID."-popup";
		$this->formID = $this->popupID."-form";
		return parent::init();
	}
	
	public function run()
	{
		$this->init();
		$this->renderContent();
	}
	
	protected function renderContent()
	{
	}
}
?>