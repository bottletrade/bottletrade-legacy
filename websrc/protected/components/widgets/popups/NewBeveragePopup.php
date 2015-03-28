<?php 
class NewBeveragePopup extends PopupWidgetKO
{
	public function init()
	{
		$this->linkID = PopupConstants::NewBeveragePopupLinkID;
		return parent::init();
	}
	
	protected function renderContent()
	{
		$beverageForm = new NewBeverageForm();
		
		/// if it is ajax validation request
		if(Yii::app()->getRequest()->getIsAjaxRequest()) {
			if ($_POST['ajax']===$this->formID) {
				echo CActiveForm::validate($beverageForm);
				Yii::app()->end();
			}
		}

		// collect user input data
		if(isset($_POST['NewBeverageForm'])) {
			$beverageForm->attributes=$_POST['NewBeverageForm'];
			if($beverageForm->validate() && $beverageForm->save()) {
				Yii::app()->user->setFlash('success','Beer has been successfully added to the BottleTrade network');
				$this->controller->refresh();
			}
		}
		
		$this->render('NewBeveragePopup',array('beverageForm'=>$beverageForm));
	}
}
?>