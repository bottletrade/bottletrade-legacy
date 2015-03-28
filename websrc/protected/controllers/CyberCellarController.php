<?php 
class CyberCellarController extends Controller
{
	public $layout='cybercellar';
    
    public $defaultAction = 'displayCurrentUserBottles';
    
    /**
     * @return array action filters
     */
    public function filters()
    {
    	return array(
    			'accessControl', // perform access control
    	);
    }
    
    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    
    public function accessRules()
    {
    	return array(
    			array('allow', // allow authenticated user only
    					'actions'=>array('displayCurrentUserBottles',
    									 'displayBottles',
    									 'displayPendingTrades',
    									 'displayCompletedTrades',
    									 'viewTrade',
    									 'viewTradeSummary',
    									 'displayBottles',
    									 'deleteBottle',
    									 'viewOffer',
    									 'displayIncomingOffers',
    									 'displaySentOffers'),
    					'users'=>array('@'),
        			),
        		array('deny',  // deny all users
        				'users'=>array('*'),
        		),
		);
	}
	
	public function actionDisplayCurrentUserBottles()
	{
		return $this->actionDisplayBottles(Yii::app()->user->Username);
	}
	
	public function actionDisplayBottles($un)
	{
		$user = User::findByUsername($un);
		
		$this->render('bottles',
				array(	'user' => $user
				)
		);
	}
	
	private function displayTrades($complete) {
		if ($complete) {
			$tradeSettings = UserTradeInfo::model()->findAll(array('condition'=>'UserOwnerID=:uid AND CompletedTime IS NOT NULL', 'params'=>array(':uid'=>Yii::app()->user->ID)));
		} else {
			$tradeSettings = UserTradeInfo::model()->findAll(array('condition'=>'Status!=:stat AND UserOwnerID=:uid AND CompletedTime IS NULL', 'params'=>array(':stat'=>TradeStatus_Cancelled, ':uid'=>Yii::app()->user->ID)));
		}
		$tradeinfos = array();
		foreach ($tradeSettings as $tradeSetting) {
			$currUserBottleTrades = array();
			$otherUserBottleTrades = array();
			$bottleTrades = BottleTrade::model()->findAll(array('condition'=>'TradeID=:tid', 'params'=>array(':tid'=>$tradeSetting->trade->ID)));
			foreach($bottleTrades as $bottleTrade) {
				if (Bottle::isOwnedByCurrentUser($bottleTrade->bottle)) {
					$currUserBottleTrades[] = $bottleTrade;
				} else {
					$otherUserBottleTrades[] = $bottleTrade;
				}
			}
	
			$tradeinfos[] = array(	'trade' => $tradeSetting->trade,
					'currUserBottleTrades' => $currUserBottleTrades,
					'otherUserBottleTrades' => $otherUserBottleTrades );
		}
		 
		$this->render('viewMultipleTrades', array( 'completed' => $complete, 'tradeinfos' => $tradeinfos ));
	}
	
	public function actionDisplayPendingTrades() {
		return $this->displayTrades(false);
	}

	public function actionDisplayCompletedTrades() {
		return $this->displayTrades(true);
	}
	
	public function actionViewTrade($id) {
		$currUserTradeInfoForm = new TradeInfoForm;
		 
		// if it is ajax validation request
		if(Yii::app()->getRequest()->getIsAjaxRequest()) {
			if ($_POST['ajax']==='trade-info-form') {
				echo CActiveForm::validate($currUserTradeInfoForm);
				Yii::app()->end();
			}
		}
		 
		if(isset($_POST['TradeInfoForm'])) {
			$currUserTradeInfoForm->attributes = $_POST['TradeInfoForm'];
			$currUserTradeInfoForm->scenario = $currUserTradeInfoForm->delete == 1 ? "delete" : "update";
			if($currUserTradeInfoForm->validate() && $currUserTradeInfoForm->save()) {
				if ($currUserTradeInfoForm->delete) {
					Yii::app()->user->setFlash('success','Trade has been cancelled');
					$this->redirect(UrlUtils::generateUrl(UrlUtils::CyberCellarPendingTradesUri));
				} else {
					Yii::app()->user->setFlash('success','Trade information successfully updated');
					$this->refresh();
				}
			}
		}
		 
		$trade = Trade::model()->findByPk($id);
		if ($trade == null) {
			throw new CHttpException(404, 'The specified trade cannot be found');
		} else if (!Trade::belongsToCurrentUser($trade)) {
			throw new CHttpException(404, 'You are not authorized to view this trade');
		}
		
		$currUserTradeInfo = Trade::getCurrentUserTradeInfo($trade);
		$currUserTradeInfoForm->tradeId = $currUserTradeInfo->TradeID;
		if ($currUserTradeInfo->ShipDate != null) {
			$dateTime = DateTime::createFromFormat('Y-m-d H:i:s', $currUserTradeInfo->ShipDate);
			$currUserTradeInfoForm->shipDate = date_format($dateTime, 'Y-m-d');
		}
		$currUserTradeInfoForm->hasShipped = TradeStatus::checkStatusEqual($currUserTradeInfo, TradeStatus_Shipped);
		$currUserTradeInfoForm->hasReceived = TradeStatus::checkStatusEqual($currUserTradeInfo, TradeStatus_Received);

		$otherUserTradeInfo = Trade::getOtherUserTradeInfo($trade);
		$otherUserTradeInfoForm = new TradeInfoForm;
		if ($otherUserTradeInfo->ShipDate != null) {
			$dateTime = DateTime::createFromFormat('Y-m-d H:i:s', $otherUserTradeInfo->ShipDate);
			$otherUserTradeInfoForm->shipDate = date_format($dateTime, 'Y-m-d');
		}
		$otherUserTradeInfoForm->hasShipped = TradeStatus::checkStatusEqual($otherUserTradeInfo, TradeStatus_Shipped);
		$otherUserTradeInfoForm->hasReceived = TradeStatus::checkStatusEqual($otherUserTradeInfo, TradeStatus_Received);
		
		$currUserBottleTrades = array();
		$otherUserBottleTrades = array();
		$bottleTrades = BottleTrade::model()->findAll(array('condition'=>'TradeID=:tid', 'params'=>array(':tid'=>$id)));
		foreach($bottleTrades as $bottleTrade) {
			if (Bottle::isOwnedByCurrentUser($bottleTrade->bottle)) {
				$currUserBottleTrades[] = $bottleTrade;
			} else {
				$otherUserBottleTrades[] = $bottleTrade;
			}
		}
		 
		$messages = TradeMessage::model()->findAll(array('condition'=>'TradeID=:tid',
				'params'=>array(':tid'=>$id),
				'order'=>'SentTime'));
		 
		$currUserReview = Review::model()->find(array( 'condition'=>'TradeID=:tid AND UserFrom=:un', 'params'=>array(':tid'=>$id, ':un'=>Yii::app()->user->ID)));
		$otherUserReview = Review::model()->find(array( 'condition'=>'TradeID=:tid AND UserTo=:un', 'params'=>array(':tid'=>$id, ':un'=>Yii::app()->user->ID)));
		 
		$this->render('viewSingleTrade', array(	'trade' => $trade,
				'currUserTradeInfoForm' => $currUserTradeInfoForm,
				'otherUserTradeInfo' => $otherUserTradeInfoForm,
				'currUserReview'=>$currUserReview,
				'otherUserReview'=>$otherUserReview,
				'currUserBottleTrades' => $currUserBottleTrades,
				'otherUserBottleTrades' => $otherUserBottleTrades,
				'messages' => $messages ));
	}
	

	public function actionViewTradeSummary($id) {
		$trade = Trade::model()->findByPk($id);
		if ($trade == null) {
			throw new CHttpException(404, 'The specified trade cannot be found');
		} else if (!Trade::isComplete($trade)) {
			throw new CHttpException(404, 'You may not view the summary of a trade until it is completed');
		}
		
		$users = Trade::getUsers($trade);
		$user1 = $users[0];
		$user2 = $users[1];
	
		$user1BottleTrades = array();
		$user2BottleTrades = array();
		$bottleTrades = BottleTrade::model()->findAll(array('condition'=>'TradeID=:tid', 'params'=>array(':tid'=>$id)));
		foreach($bottleTrades as $bottleTrade) {
			if (Bottle::isOwnedByUser($bottleTrade->bottle, $user1)) {
				$user1BottleTrades[] = $bottleTrade;
			} else {
				$user2BottleTrades[] = $bottleTrade;
			}
		}
			
		$user1Review = Review::model()->find(array( 'condition'=>'TradeID=:tid AND UserFrom=:un', 'params'=>array(':tid'=>$id, ':un'=>$user1->ID)));
		$user2Review = Review::model()->find(array( 'condition'=>'TradeID=:tid AND UserFrom=:un', 'params'=>array(':tid'=>$id, ':un'=>$user2->ID)));
			
		$this->render('viewTradeSummary', array(	'trade' => $trade,
				'user1' => $user1,
				'user2' => $user2,
				'user1Review'=>$user1Review,
				'user2Review'=>$user2Review,
				'user1BottleTrades' => $user1BottleTrades,
				'user2BottleTrades' => $user2BottleTrades ));
	}    
	
	public function actionDisplayIncomingOffers() {
		$offers = Offer::model()->findAll(array('order'=>'SentTime DESC', 'condition'=>'UserTo=:un', 'params'=>array(':un'=>Yii::app()->user->ID)));
	
		$this->render('viewMultipleOffers', array(	'offers' => $offers, 'viewingSentOffers' => false ));
	}
	
	public function actionDisplaySentOffers() {
		$offers = Offer::model()->findAll(array('order'=>'SentTime DESC', 'condition'=>'UserFrom=:un', 'params'=>array(':un'=>Yii::app()->user->ID)));
	
		$this->render('viewMultipleOffers', array(	'offers' => $offers, 'viewingSentOffers' => true ));
	}
	
	public function actionViewOffer($id) {
		$offer = Offer::model()->findByPk($id);
		if ($offer == null) {
			throw new CHttpException(404, 'The specified offer cannot be found');
		}
		if ($offer->UserTo != Yii::app()->user->ID && $offer->UserFrom != Yii::app()->user->ID) {
			throw new CHttpException(404, 'You are not authorized to view this offer');
		}
		
		// mark offer as read if recevier is viewing
		if ($offer->UserTo == Yii::app()->user->ID) {
			$offer->IsRead = 1;
			if (!$offer->save()) {
				throw new CHttpException(500);
			}
		}
		 
		$currUserBottles = array();
		$otherUserBottles = array();
		$bottleOffers = BottleOffer::model()->findAll(array('condition'=>'OfferID=:oid', 'params'=>array(':oid'=>$id)));
		foreach($bottleOffers as $bottleOffer) {
			if ($bottleOffer->bottle->UserID == Yii::app()->user->ID) {
				$currUserBottles[] = $bottleOffer;
			} else {
				$otherUserBottles[] = $bottleOffer;
			}
		}
		 
		$this->render('viewSingleOffer', array(	'offer' => $offer,
				'currUserBottleOffers' => $currUserBottles,
				'otherUserBottleOffers' => $otherUserBottles ));
	}
	
	public function actionDeleteBottle($id) {
		$bottle = Bottle::model()->findByPk($id);
		if ($bottle == null) {
			throw new CHttpException(404,'The specified bottle cannot be found');
		}
		if (!Bottle::isOwnedByCurrentUser($bottle)) {
			throw new CHttpException(403,'You are not authorized to delete this bottle');
		}
		// check if bottle belongs to any pending trades
		$bottles = BottleTrade::model()->findAll(array('condition'=>'BottleID=:bid AND Status!=:stat AND CompletedTime IS NULL', 'join' => 'JOIN trade ON `t`.TradeID = trade.ID', 'params'=>array(':stat'=>(int)TradeStatus_Cancelled,':bid'=>$id)));
		if (count($bottles) > 0) {
			Yii::app()->user->setFlash('error','One or more pending trades contain this bottle and must be cancelled before the bottle can be deleted');
			$this->redirect(Yii::app()->request->urlReferrer);
		}
		
		$bottle->IsActive = 0;
		if (!$bottle->save()) {
			Yii::app()->user->setFlash('error','Failed to delete bottle');
		}
		else {
			Yii::app()->user->setFlash('success','Your bottle has been successfully deleted');
		}
		
		$this->redirect(Yii::app()->request->urlReferrer);
	}
}