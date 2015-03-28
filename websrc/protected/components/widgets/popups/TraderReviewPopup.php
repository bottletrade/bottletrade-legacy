<?php 
class TraderReviewPopup extends PopupWidget
{
	public $trade;
	
	public function init() {
		$this->linkID = PopupConstants::TraderReviewPopupLinkID;
		return parent::init();
	}
	
	protected function renderContent()
	{
		$traderReviewForm = new TraderReviewForm;
		
		/// if it is ajax validation request
		if(Yii::app()->getRequest()->getIsAjaxRequest()) {
			if ($_POST['ajax']==='trader-review-form') {
				echo CActiveForm::validate($traderReviewForm);
				Yii::app()->end();
			}
		}

		if(isset($_POST['TraderReviewForm'])) {
			$traderReviewForm->attributes=$_POST['TraderReviewForm'];
			// validate user input and redirect to the previous page if valid
			if($traderReviewForm->validate() && $traderReviewForm->sendReview()) {
				Yii::app()->user->setFlash('success','Review completed successfully');
				$this->controller->refresh();
			}
		}
		
		// setup info for review
		$traderReviewForm->userTo = Trade::getOtherUser($this->trade)->ID;
		$traderReviewForm->tradeId = $this->trade->ID;
		$traderReviewForm->rating = '';
		$traderReviewForm->message = '';
		
		$this->render('TraderReviewPopup',array('traderReviewForm'=>$traderReviewForm));
	}
}
?>