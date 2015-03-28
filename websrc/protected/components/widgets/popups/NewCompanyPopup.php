<?php 
class NewCompanyPopup extends PopupWidgetKO
{
	public function init()
	{
		$this->linkID = PopupConstants::NewCompanyPopupLinkID;
		return parent::init();
	}
	
	protected function renderContent()
	{
		$companyForm = new NewCompanyForm();
		
		/// if it is ajax validation request
		if(Yii::app()->getRequest()->getIsAjaxRequest()) {
			if ($_POST['ajax']===$this->formID) {
				echo CActiveForm::validate($companyForm);
				Yii::app()->end();
			}
		}

		// collect user input data
		if(isset($_POST['NewCompanyForm'])) {
			$companyForm->attributes=$_POST['NewCompanyForm'];
			if($companyForm->validate() && $companyForm->save()) {
				Yii::app()->user->setFlash('success','Brewery has been successfully added to the BottleTrade network');
				$this->controller->refresh();
			}
		}
		
		$this->render('NewCompanyPopup',array('companyForm'=>$companyForm));
	}
}
?>