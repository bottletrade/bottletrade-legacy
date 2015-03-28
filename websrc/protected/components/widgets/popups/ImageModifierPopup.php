<?php

class ImageModifierPopup extends PopupWidget
{
	// Configuration array for image modifer
	// - onComplete - function(filename, fileurl) (required)
	// 		- javascript callback when file modifications are complete
	// - onCancel - function() (required)
	//		- javascript callback when file modifications are canceled
	public $config;
	public $renderOnly;

	public function init() {
		if ($this->renderOnly) {
			$this->linkID = PopupConstants::ImageModifierPopupLinkID;
		} else {
			if (empty($this->config)) {
				return false;
			}
		}
		return parent::init();
	}

	protected function renderContent()
	{
		if (!$this->renderOnly) {
			if (!array_key_exists("imgPreviewId", $this->config)) {
				$this->config["imgPreviewId"] = HtmlUtils::generateUniqueId(20);
			}
			if (!array_key_exists("imgDataBind", $this->config)) {
				$this->config["imgDataBind"] = "";
			}
			if (!array_key_exists("defaultImageSrc", $this->config)) {
				$this->config["defaultImageSrc"] = "";
			}
		}
		$this->render('ImageModifierPopup',array('config'=>$this->config,'renderOnly'=>$this->renderOnly));
	}
}
?>