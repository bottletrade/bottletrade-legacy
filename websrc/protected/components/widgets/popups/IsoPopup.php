<?php 
class IsoPopup extends PopupWidget
{
	public $user;
	public $isCurrentUser;
	
	public function init() {
		$this->linkID = PopupConstants::ISOPopupLinkID;
		if (empty($this->user)) {
			$this->user = User::getCurrentUser();
		}
		$this->isCurrentUser = ($this->user->ID == Yii::app()->user->ID);
		return parent::init();
	}
	
	protected function renderContent()
	{
		$this->render('IsoPopup');
	}
}
?>