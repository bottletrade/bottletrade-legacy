<?php 
class TradeController extends Controller
{
	public $layout='main';
    
    public $defaultAction = 'home';
    
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
    					'actions'=>array('makeOffer',
    									 'counterOffer',
    									 'proposeTrade',
    									 'offerResponse',
    									 'sendMessage',
    									 'findTrader'),
    					'users'=>array('@'),
    			),
    			array('deny',  // deny all users
    					'users'=>array('*'),
    			),
    	);
    }
    
    public function actionSendMessage() {
    	$transaction = Yii::app()->db->beginTransaction();
    	try
    	{
	    	// verify input exists
	    	if(!isset($_POST['tradeID']) ||
	    	   !isset($_POST['message'])) {
	    		throw new CHttpException(404, 'Trade message info not set');
	    	}
	    	
	    	$latestTime = isset($_POST['latestTimestamp']) ? $_POST['latestTimestamp'] : null;
	    	$currentTime = DateTimeUtils::getCurrentDateTime();
	    	
	    	$trade = Trade::model()->findByPk($_POST['tradeID']);
	    	if ($trade == null) {
	    		throw new CHttpException(404, 'Cannot find the specified trade');
	    	} else if (!Trade::belongsToCurrentUser($trade)) {
	    		throw new CHttpException(404, 'You are not authorized send a message for this trade');
	    	}
	    	$otherUser = Trade::getOtherUser($trade);
	    	
	    	$trademessage = new TradeMessage();
	    	$trademessage->Body = $_POST['message'];
	    	$trademessage->UserFrom = Yii::app()->user->ID;
	    	$trademessage->UserTo = $otherUser->ID;
	    	$trademessage->TradeID = $trade->ID;
	    	$trademessage->SentTime = $currentTime;
	    	if (!$trademessage->save()) {
	    		throw ExceptionUtils::createVarException($trademessage);
	    	}
	    	$trade->LastUpdateTime = $currentTime;
	    	if (!$trade->save()) {
	    		throw ExceptionUtils::createVarException($trade);
	    	}
	    	
	    	if ($latestTime == null) {
	    		$timeObj = new DateTime($trademessage->SentTime);
	    		$timeObj->sub(new DateInterval('PT1S')); // substract a second so we retrieve the message we just sent
	    		$latestTime = DateTimeUtils::getUtcFormat($timeObj->getTimestamp());
	    	}
	    	
	    	$trademessages = TradeMessage::model()->findAll(
	    						array('condition'=>'SentTime > :time AND ((UserFrom = :currUser AND UserTo = :otherUser) OR
	    											(UserFrom = :otherUser AND UserTo = :currUser))', 
	    								'params'=>array(':time'=>$latestTime, ':currUser' => Yii::app()->user->ID, ':otherUser'=> $otherUser->ID), 'order' => 'SentTime'));
	    	$ret = array();
	    	foreach($trademessages as $trademessage) {
	    		$ret[] = TradeMessage::MakePostDisplayWithMessage($trademessage);
	    	}

	    	$transaction->commit();
	    	
	    	echo CJavaScript::jsonEncode($ret);
	    	Yii::app()->end();
    	}
    	catch (Exception $e) {
    		$transaction->rollback();
    		throw $e;
    	}
    }
    
    public function actionOfferResponse() {
    	// verify input exists
    	if(!isset($_POST['offerID']) || 
    	   !isset($_POST['response'])) {
        	throw new CHttpException(404, 'Offer info not set');
    	}
    	
    	$offerID = $_POST['offerID'];
    	$reponse = $_POST['response'];

    	// verify inputs
    	$offer = Offer::model()->findByPk($offerID);
    	if ($offer == null) {
    		throw new CHttpException(404, 'The specified offer cannot be found');
    	}
    	switch ($reponse) {
    		case OfferResponse::ACCEPT:
    		case OfferResponse::DECLINE:
    		case OfferResponse::COUNTER:
    			if ($offer->UserTo != Yii::app()->user->ID) {
        			throw new CHttpException(404, 'Unauthorized to respond to this offer');
    			}
    			break;
    		case OfferResponse::REMOVE:
    			if ($offer->UserFrom != Yii::app()->user->ID) {
        			throw new CHttpException(404, 'Unauthorized to respond to this offer');
    			}
    			break;
    	}
    	
    	// perform action
    	$retArray = array();
    	$transaction = Yii::app()->db->beginTransaction();
    	try
    	{
	    	switch ($_POST['response']) {
	    		case OfferResponse::ACCEPT:
	    			// save time
	    			$currentTime = DateTimeUtils::getCurrentDateTime();
	    			
	    			// convert offer to trade
	    			$trade = new Trade();
	    			$trade->Status = TradeStatus_Pending; 
		            $trade->CreatedTime = $currentTime;
		            $trade->LastUpdateTime = $currentTime;
		            if (!$trade->save()) {
	    				throw ExceptionUtils::createVarException($trade);
		            }
	    			
	    			$userTradeInfo1 = new UserTradeInfo();
	    			$userTradeInfo1->TradeID = $trade->ID;
	    			$userTradeInfo1->UserOwnerID = $offer->UserTo;
	    			$userTradeInfo1->UserOtherID = $offer->UserFrom;
	    			$userTradeInfo1->Status = TradeStatus_Pending;
		            if (!$userTradeInfo1->save()) {
	    				throw ExceptionUtils::createVarException($userTradeInfo1);
		            }
	    			
	    			$userTradeInfo2 = new UserTradeInfo();
	    			$userTradeInfo2->TradeID = $trade->ID;
	    			$userTradeInfo2->UserOwnerID = $offer->UserFrom;
	    			$userTradeInfo2->UserOtherID = $offer->UserTo;
	    			$userTradeInfo2->Status = TradeStatus_Pending;
		            if (!$userTradeInfo2->save()) {
	    				throw ExceptionUtils::createVarException($userTradeInfo2);
		            }
	    			
	    			$retArray["TradeID"] = $trade->ID;
	    			
	    			// convert bottles offered to bottles traded
	    			$bottleOffers = BottleOffer::model()->findAll(array('condition'=>'OfferID=:oid', 'params'=>array(':oid'=>$offerID)));
	    			foreach ($bottleOffers as $bottleOffer) {
	    				// create traded bottle
	    				$bottleTrade = new BottleTrade();
	    				$bottleTrade->Quantity = $bottleOffer->Quantity;
	    				$bottleTrade->BottleID = $bottleOffer->BottleID;
	    				$bottleTrade->TradeID = $trade->ID;
		    			if (!$bottleTrade->save()) {
	    					throw ExceptionUtils::createVarException($bottleTrade);
		    			}
	    			}
	    			
	    			Offer::deleteOffer($offerID);
	    			break;
	    		case OfferResponse::COUNTER:
	    			$this->redirect(UrlUtils::generateUrl(UrlUtils::TradeCounterUri, $offerID));
	    			break;
	    		case OfferResponse::DECLINE:
	    		case OfferResponse::REMOVE:
	    			Offer::deleteOffer($offerID);
	    			break;
	    	}
	    	
	    	$transaction->commit();
    	}
    	catch (Exception $e) 
    	{
	    	$transaction->rollback();
    		ExceptionUtils::logException($e);
    		Yii::app()->user->setFlash('error','Failed to respond to offer');
	    	Yii::app()->end();
    	}
    	
    	switch ($reponse) {
    		case OfferResponse::ACCEPT:
    			// send email
    			$emailSender = new EmailSender();
    			$emailSender->sendOfferAcceptedEmail($trade);
    			
    			Yii::app()->user->setFlash('success','Offer has been accepted');
    			break;
    		case OfferResponse::DECLINE:
    			// send email
    			$emailSender = new EmailSender();
    			$emailSender->sendOfferDeclinedEmail($offer);
    			
    			Yii::app()->user->setFlash('success','Offer has been declined');
    			break;
    		case OfferResponse::REMOVE:
    			Yii::app()->user->setFlash('success','Offer has been removed');
    			break;
    	}

    	echo CJavaScript::jsonEncode($retArray);
	    Yii::app()->end();
    }
    
    public function actionProposeTrade() {
    	if(!isset($_POST['currUserBottles']) || 
    	   !isset($_POST['otherUserBottles'])) {
        	throw new CHttpException(404, 'Trade info not set');
    	}

    	$currUserBottles = json_decode($_POST['currUserBottles']);
    	$otherUserBottles = json_decode($_POST['otherUserBottles']);
    	$message = isset($_POST['message']) ? $_POST['message'] : null;
    	$counterOfferID = isset($_POST['counterOfferID']) ? $_POST['counterOfferID'] : null;

    	foreach ($currUserBottles as $bottleInfo) {
    		$bottle = Bottle::model()->findByPk($bottleInfo->ID);
    		if ($bottle == null ||
    			$bottle->UserID != Yii::app()->user->ID ||
    			!$bottle->IsTradeable ||
    			$bottleInfo->Quantity <= 0) {
        		throw new CHttpException(404, 'The specified bottle cannot be included in the trade');
    		}
    	}

    	$otherUser = null;
    	foreach ($otherUserBottles as $bottleInfo) {
    		$bottle = Bottle::model()->findByPk($bottleInfo->ID);
    		if ($bottle != null && $otherUser == null) {
    			$otherUser = $bottle->user;
    		}
    		if ($bottle == null ||
    			$bottle->UserID != $otherUser->ID ||
    			!$bottle->IsTradeable ||
    			$bottleInfo->Quantity <= 0) {
        		throw new CHttpException(404, 'The specified bottle cannot be included in the trade');
    		}
    	}
    	
    	$retArray = array();
    	$transaction = Yii::app()->db->beginTransaction();
    	try
    	{
    		// delete previous offer
    		if ($counterOfferID != null) {
    			$offer = Offer::model()->findByPk($counterOfferID);
				if ($offer == null) {
					throw ExceptionUtils::createInvalidOperationException();
				} else if (!Offer::receivedByCurrentUser($offer)) {
					throw ExceptionUtils::createUnauthorizedException();
				}
				if (!$offer->delete()) {
					throw ExceptionUtils::createVarException($offer);
				}
    		}
    		
    		// create new offer
    		$offer = new Offer();
    		$offer->UserTo = $otherUser->ID;
    		$offer->UserFrom = Yii::app()->user->ID;
    		$offer->Message = $message;
    		$offer->SentTime = DateTimeUtils::getCurrentDateTime();
    		
    		if (!$offer->save()) {
					throw ExceptionUtils::createVarException($offer);
    		}
    		$retArray["OfferID"] = $offer->ID;
    		
    		foreach ($currUserBottles as $bottleInfo) {
    			$bottleOffer = new BottleOffer();
    			$bottleOffer->BottleID = $bottleInfo->ID;
    			$bottleOffer->OfferID = $offer->ID;
    			$bottleOffer->Quantity = $bottleInfo->Quantity;
    			if (!$bottleOffer->save()) {
					throw ExceptionUtils::createVarException($bottleOffer);
    			}
    		}
    		
    		foreach ($otherUserBottles as $bottleInfo) {
    			$bottleOffer = new BottleOffer();
    			$bottleOffer->BottleID = $bottleInfo->ID;
    			$bottleOffer->OfferID = $offer->ID;
    			$bottleOffer->Quantity = $bottleInfo->Quantity;
    			if (!$bottleOffer->save()) {
					throw ExceptionUtils::createVarException($bottleOffer);
    			}
    		}
    		
    		$transaction->commit();
    	}
    	catch (Exception $e)
    	{
    		$transaction->rollback();
    		ExceptionUtils::logException($e);
	    	Yii::app()->user->setFlash('error','Failed to propose trade');
		    Yii::app()->end();
    	}
    	
    	// send email
    	$emailSender = new EmailSender();
    	$emailSender->sendNewOfferEmail($offer);
    	
    	Yii::app()->user->setFlash('success','Trade successfully proposed');
    	echo CJavaScript::jsonEncode($retArray);
	    Yii::app()->end();
    }

    public function actionMakeOffer($id, $type='id') {
    	if ($type=='id') {
    		// $id is bottle id
    		$bottle = Bottle::model()->findByPk($id);
    		if ($bottle == null) {
    			throw new CHttpException(404, 'The specified bottle cannot be found');
    		}
    		if ($bottle->IsTradeable == false) {
    			throw new CHttpException(404, 'The specified bottle is not up for trade');
    		}
    		if (Bottle::isOwnedByCurrentUser($bottle)) {
    			throw new CHttpException(404, 'You cannot propose a trade with yourself');
    		}
    		$user = $bottle->user;
    	} else if ($type='un') {
    		// $id is username
    		if ($id == Yii::app()->user->ID) {
    			throw new CHttpException(404, 'You cannot propose a trade with yourself');
    		}
    		$user = User::findByUsername($id);
    		if (empty($user)) {
    			throw new CHttpException(404, 'The specified user cannot be found');
    		}
    	} else {
    			throw new CHttpException(400, 'Invalid request');
    	}
    	$currUserBottles = Bottle::model()->findAll(array('condition'=>'UserID=:uid AND IsTradeable=1 AND IsActive=1 AND Quantity > 0',
    	'params'=>array(':uid'=>Yii::app()->user->ID)));
    	
    	if (count($currUserBottles) <= 0) {
    		Yii::app()->user->setFlash('error','You have no tradeable bottles, please add bottles to your Cyber Cellar or make existing bottles tradeable and try again.');
    		$this->redirect(Yii::app()->request->urlReferrer);
    	}
    	
    	$otherUserBottles = Bottle::model()->findAll(array('condition'=>'UserID=:uid AND IsTradeable=1 AND IsActive=1 AND Quantity > 0',
    			'params'=>array(':uid'=>$user->ID)));
    	
    	$this->render('propose', array(	'selectedBottleId' => !empty($bottle) ? $id : null,
    									'otherUser' => $user,
    									'currUserBottles' => $currUserBottles,
    									'otherUserBottles' => $otherUserBottles,
    									'counterOfferID' => null ));
    }

    public function actionCounterOffer($id) {
    	$offer = Offer::model()->findByPk($id);
    	if ($offer == null) {
    		throw new CHttpException(404, 'The specified offer cannot be found');
    	} else if ($offer->UserTo != Yii::app()->user->ID) {
    		throw new CHttpException(404, 'The specified offer cannot be countered');
    	}
    	
    	$currUserBottles = Bottle::model()->findAll(array('condition'=>'UserID=:uid AND IsTradeable=1 AND IsActive=1 AND Quantity > 0',
    			'params'=>array(':uid'=> Yii::app()->user->ID)));
    	 
    	if (count($currUserBottles) <= 0) {
    		Yii::app()->user->setFlash('error','You have no tradeable bottles, please add bottles to your Cyber Cellar or make existing bottles tradeable and try again.');
    		$this->redirect(Yii::app()->request->urlReferrer);
    	}
    	 
    	$otherUserBottles = Bottle::model()->findAll(array('condition'=>'UserID=:uid AND IsTradeable=1 AND IsActive=1 AND Quantity > 0',
    			'params'=>array(':uid'=>$offer->UserFrom)));
    	 
    	$this->render('propose', array(	'selectedBottleId' => null,
    									'otherUser' => $offer->userFrom,
    									'currUserBottles' => $currUserBottles,
    									'otherUserBottles' => $otherUserBottles,
    									'counterOfferID' => $id));
    }
    
    public function actionFindTrader() {
    	$this->render('findTrader');
    }
}