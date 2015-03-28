<?php 
class MessagePopup extends PopupWidgetKO
{
	public function init() {
		$this->linkID = PopupConstants::MessagePopupLinkID;
		return parent::init();
	}
	
	protected function renderContent()
	{
		$messageForm = new MailMessageForm();
		
		/// if it is ajax validation request
		if(Yii::app()->getRequest()->getIsAjaxRequest()) {
			if ($_POST['ajax']===$this->formID) {
				echo CActiveForm::validate($messageForm);
				Yii::app()->end();
			}
		}

		// collect user input data
		if(isset($_POST['MailMessageForm'])) {
			$messageForm->attributes=$_POST['MailMessageForm'];
			$newMsgId = 0;
			if($messageForm->validate() && $messageForm->sendMessage($newMsgId)) {
				$messageUrl = UrlUtils::generateSentMessageUrl($newMsgId);
				Yii::app()->user->setFlash('success','Message sent successfully. Click <a href="'.$messageUrl.'">here</a> to view message.');
				$this->controller->refresh();
			}
		}
			
		$messageForm->userFromId = Yii::app()->user->ID;
		
		$this->render('MessagePopup',array('messageForm'=>$messageForm));
	}
}
?>