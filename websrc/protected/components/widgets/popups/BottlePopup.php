<?php 
class BottlePopup extends PopupWidgetKO
{
	public $imageSrc;
	public $renderForm;
	protected $editLinkID;
	protected $editPopupID;
	protected $moreInfoLinkID;
	protected $moreInfoPopupID;
	
	public function init()
	{
		if (empty($this->renderForm)) {
			$this->renderForm = false;
		}
		$this->linkID = PopupConstants::BottlePopupLinkID;
		$this->editLinkID = PopupConstants::BottlePopupLinkID;
		$this->editPopupID = PopupConstants::BottlePopupLinkID."-popup";
		$this->moreInfoLinkID = PopupConstants::BottleInfoPopupLinkID;
		$this->moreInfoPopupID = PopupConstants::BottleInfoPopupLinkID."-popup";
		
		return parent::init();
	}
	
	protected function renderContent()
	{
		$bottleForm = new BottleForm();
		
		/// if it is ajax validation request
		if(Yii::app()->getRequest()->getIsAjaxRequest()) {
			if ($_POST['ajax']===$this->formID) {
				echo CActiveForm::validate($bottleForm);
				Yii::app()->end();
			}
		}
		
		if(isset($_POST['BottleForm'])) {
			$bottleForm->attributes = $_POST['BottleForm'];
			// validate user input and redirect to the previous page if valid
			if($bottleForm->validate() && $bottleForm->commit()) {
				if ($bottleForm->bottleId != null && $bottleForm->bottleId != 0) {
					Yii::app()->user->setFlash('success','Bottle has been updated');
				} else {
					Yii::app()->user->setFlash('success','Bottle has been uploaded to your Cyber Cellar');
				}
				$this->controller->refresh();
			}
		}
		$this->render('BottlePopup',array('bottleForm'=>$bottleForm));
	}
}
?>