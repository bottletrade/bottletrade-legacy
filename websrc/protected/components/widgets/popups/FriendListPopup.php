<?php 
class FriendListPopup extends PopupWidget
{
	public function init() {
		$this->linkID = PopupConstants::FriendListPopupLinkID;
		return parent::init();
	}
	
	protected function renderContent()
	{
		$this->render('FriendListPopup');
	}
}
?>