<?php

class TermsAndConditionsPopup extends PopupWidget
{
	public function init() {
		$this->linkID = PopupConstants::TermsAndConditionsPopupLinkID;
		return parent::init();
	}
	
	protected function renderContent()
	{
		$this->render('TermsAndConditionsPopup');
	}
}