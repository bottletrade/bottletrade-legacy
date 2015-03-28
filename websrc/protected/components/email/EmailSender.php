<?php 
class EmailSender
{
	private $message;
	private $params;
	private static $emailMgr;
	
	private function getEmailManager() {
		if (self::$emailMgr == null) {
			self::$emailMgr = new EmailManager(User::getCurrentUser());
		}
		return self::$emailMgr;
	}
	
	public function __construct() {
		$this->message = new YiiMailMessage;
	}
	
	public function sendAddCompanyEmail($company) {
		$this->message->subject = 'New Company Added';
		$this->message->view = "newCompanyAdded";
		$this->params = array('company'=> $company);
		$this->message->addTo(Yii::app()->params['adminEmail']);
		return self::sendMail();
	}
	
	public function sendAddBeverageEmail($beverage) {
		$this->message->subject = 'New Beverage Added';
		$this->message->view = "newBeverageAdded";
		$this->params = array('beverage'=> $beverage);
		$this->message->addTo(Yii::app()->params['adminEmail']);
		return self::sendMail();
	}
	
	public function sendBetaSignupEmail($signup) {
		// Always send signup emails
		$this->message->subject = 'Welcome to BottleTrade Beta!';
		$this->message->view = "betaSignup";
		$this->message->addTo($signup->Email);
		return self::sendMail();
	}
	
	public function sendContactUsEmail($contactUsForm) {
		$this->message->setSubject($contactUsForm->topic);
		$this->message->view = "contactUs";
		$this->params = array('contactUsForm'=> $contactUsForm);
		$this->message->addTo(Yii::app()->params['adminEmail']);
		return self::sendMail();
	}
	
	public function sendNewUserEmail($newUser) {
		// Always send new user emails
		$this->message->subject    = 'Welcome to BottleTrade!';
		$this->message->view = "newUser";
		$this->params = array('user'=>$newUser);
		$this->message->addTo($newUser->Email);
		return self::sendMail();
	}
	
	public function sendForgotPasswordEmail($user) {
		// Always send new user emails
		$this->message->subject    = 'Forgot Password';
		$this->message->view = "forgotPassword";
		$this->params = array('user'=>$user);
		$this->message->addTo($user->Email);
		return self::sendMail();
	}
	
	public function sendNewFriendRequestEmail($friendRequest) {
		$emailMgr = self::getEmailManager();
		if (!$emailMgr->acceptsNewFriendRequestEmails()) {
			// user doesn't accept 
			return false;
		}
		
		$this->message->subject    = 'New BottleTrade Friend Request';
		$this->message->view = "newFriendRequest";
		$this->params = array('friendRequest'=>$friendRequest);
		$this->message->addTo($friendRequest->userTo->Email);
		return self::sendMail();
	}
	
	public function sendNewMailMessageEmail($message) {
		$emailMgr = self::getEmailManager();
		if (!$emailMgr->acceptsNewMailMessageEmails()) {
			// user doesn't accept
			return false;
		}
		
		$this->message->subject    = '[BottleTrade] Message - '.$message->Subject;
		$this->message->view = "newMailMessage";
		$this->params = array('message'=>$message);
		$this->message->addTo($message->userTo->Email);
		return self::sendMail();
	}
	
	public function sendTradeCompleteEmail($trade) {
		$emailMgr = self::getEmailManager();
		if (!$emailMgr->acceptsTradeClosedEmails()) {
			// user doesn't accept
			return false;
		}
		
		$this->message->subject    = '[BottleTrade] Trade Completed';
		$this->message->view = "tradeCompleted";
		$this->params = array('trade'=>$trade);
		$this->message->addTo(Trade::getOtherUser($trade)->Email);
		return self::sendMail();
	}
	
	// $updates is array of 
	public function sendTradeUpdatedEmail($trade, $updates) {
		$emailMgr = self::getEmailManager();
		if (!$emailMgr->acceptsShipDatesUpdatedEmails()) {
			$arrIndex = array_search(TradeStatus_ShipDateSet, $updates);
			if ($arrIndex !== FALSE)  {
				unset($updates[$arrIndex]);
			}
		}
		if (!$emailMgr->acceptsBottlesShippedEmails()) {
			$arrIndex = array_search(TradeStatus_Shipped, $updates);
			if ($arrIndex !== FALSE)  {
				unset($updates[$arrIndex]);
			}
		}
		if (!$emailMgr->acceptsBottlesReceivedEmails()) {
			$arrIndex = array_search(TradeStatus_Received, $updates);
			if ($arrIndex !== FALSE)  {
				unset($updates[$arrIndex]);
			}
		}
		if (count($updates) == 0) {
			return false;
		}
		
		$this->message->subject    = '[BottleTrade] Trade Updated';
		$this->message->view = "tradeUpdated";
		$this->params = array('trade'=>$trade, 'updates'=>$updates);
		$this->message->addTo(Trade::getOtherUser($trade)->Email);
		return self::sendMail();
	}
	
	public function sendTradeCancelledEmail($trade) {
		$emailMgr = self::getEmailManager();
		if (!$emailMgr->acceptsTradeClosedEmails()) {
			// user doesn't accept
			return false;
		}
	
		$this->message->subject    = '[BottleTrade] Trade Cancelled';
		$this->message->view = "tradeCancelled";
		$this->params = array('trade'=>$trade);
		$this->message->addTo(Trade::getOtherUser($trade)->Email);
		return self::sendMail();
	}
	
	public function sendOfferAcceptedEmail($trade) {
		$emailMgr = self::getEmailManager();
		if (!$emailMgr->acceptsOfferAcceptedEmails()) {
			// user doesn't accept
			return false;
		}
		
		$this->message->subject    = '[BottleTrade] Offer Accepted';
		$this->message->view = "offerAccepted";
		$this->params = array('trade'=>$trade);
		$this->message->addTo(Trade::getOtherUser($trade)->Email);
		return self::sendMail();
	}
	
	public function sendOfferDeclinedEmail($offer) {
		$emailMgr = self::getEmailManager();
		if (!$emailMgr->acceptsOfferDeclinedEmails()) {
			// user doesn't accept
			return false;
		}
		
		$this->message->subject    = '[BottleTrade] Offer Declined';
		$this->message->view = "offerDeclined";
		$this->params = array('offer'=>$offer);
		$this->message->addTo(Offer::getOtherUser($offer)->Email);
		return self::sendMail();
	}
	
	public function sendNewOfferEmail($offer) {
		$emailMgr = self::getEmailManager();
		if (!$emailMgr->acceptsIncomingOfferEmails()) {
			// user doesn't accept
			return false;
		}
		
		$this->message->subject    = '[BottleTrade] New Offer';
		$this->message->view = "newOffer";
		$this->params = array('offer'=>$offer);
		$this->message->addTo($offer->userTo->Email);
		return self::sendMail();
	}
	
	public function sendNewTradeMessageEmail($trade) {
		$emailMgr = self::getEmailManager();
		if (!$emailMgr->acceptsTradeMessageEmails()) {
			// user doesn't accept
			return false;
		}
		
		$this->message->subject    = '[BottleTrade] New Trade Message';
		$this->message->view = "newTradeMessage";
		$this->params = array('trade'=>$trade);
		$this->message->addTo(Trade::getOtherUser($trade)->Email);
		return self::sendMail();
	}
	
	public function sendNewTraderReviewEmail($trade) {
		$emailMgr = self::getEmailManager();
		if (!$emailMgr->acceptsTraderReviewEmails()) {
			// user doesn't accept
			return false;
		}
		
		$this->message->subject    = '[BottleTrade] New Trade Review';
		$this->message->view = "newTradeReview";
		$this->params = array('trade'=>$trade);
		$this->message->addTo(Trade::getOtherUser($trade)->Email);
		return self::sendMail();
	}

	private function sendMail() {
		try {
			$this->message->from = Yii::app()->params['adminEmail'];
			$this->message->setBody($this->params, 'text/html');
		 	Yii::app()->mail->send($this->message);
			return true;
		}
		catch (Exception $e) {
			return false;
		}
	}
}
?>