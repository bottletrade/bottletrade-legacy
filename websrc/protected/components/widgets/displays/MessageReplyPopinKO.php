<?php 
class MessageReplyPopinKO extends CWidget
{
	public function run()
	{
		$replyForm = new MailMessageForm("reply");
		
		/// if it is ajax validation request
		if(Yii::app()->getRequest()->getIsAjaxRequest()) {
			if ($_POST['ajax'] === FormConstants::MessageReplyFormID) {
				echo CActiveForm::validate($replyForm);
				Yii::app()->end();
			}
		}

		// collect user input data
		if(isset($_POST['MailMessageForm'])) {
			$replyForm->attributes=$_POST['MailMessageForm'];
			$newMsgId = 0;
			if($replyForm->validate() && $replyForm->sendMessage($newMsgId)) {
				Yii::app()->user->setFlash('success','Message sent successfully');
				$this->controller->redirect(UrlUtils::generateUrl(UrlUtils::InboxMessagesSentUri, $newMsgId));
			}
		}
		
		$this->render('MessageReplyPopinKO',array('replyForm'=>$replyForm));
	}
}
?>