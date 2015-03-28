<?php

class Trade extends BaseTrade
{
	public static function getUsers($trade) {
		$userTradeInfos = UserTradeInfo::model()->findAll(array('condition'=>'TradeID=:tid', 'params'=>array(':tid'=>$trade->ID)));

		$ret = array();
		$ret[] = $userTradeInfos[0]->userOwner;
		$ret[] = $userTradeInfos[1]->userOwner;
		return $ret;
	}
	
	public static function getCurrentUserTradeInfo($trade) {
		return UserTradeInfo::model()->find(array('condition'=>'TradeID=:tid AND UserOwnerID=:uid', 'params'=>array(':tid'=>$trade->ID, ':uid'=>Yii::app()->user->ID)));
	}
	
	public static function getOtherUserTradeInfo($trade) {
		return UserTradeInfo::model()->find(array('condition'=>'TradeID=:tid AND UserOwnerID!=:uid', 'params'=>array(':tid'=>$trade->ID, ':uid'=>Yii::app()->user->ID)));
	}
	
	public static function belongsToCurrentUser($trade) {
		return self::getCurrentUserTradeInfo($trade) != null;
	}
	
	public static function getCurrentUser($trade) {
		$tradeInfo = self::getCurrentUserTradeInfo($trade);
		if ($tradeInfo == null) {
			throw ExceptionUtils::createInvalidOperationException();
		}
		return $tradeInfo->userOwner;
	}
	
	public static function getOtherUser($trade) {
		$tradeInfo = self::getOtherUserTradeInfo($trade);
		if ($tradeInfo == null) {
			throw ExceptionUtils::createInvalidOperationException();
		}
		return $tradeInfo->userOwner;
	}
	
	public function hasBeenReviewed($trade, $user)
	{
		return Trade::checkStatusEqual($trade, TradeStatus_Revieved);
	}
	
	public static function isComplete($trade) {
		return TradeStatus::checkStatusEqual($trade, TradeStatus_Received);
	}
	
	public static function canReview($trade) {
		return self::isComplete($trade);
	}
}