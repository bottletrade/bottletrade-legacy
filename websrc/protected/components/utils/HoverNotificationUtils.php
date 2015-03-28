<?php

class HoverNotificationUtils 
{    
    public static function getUnreadMessageCount() {
    	$criteria = new CDbCriteria();
    	$criteria->condition = 'UserTo=:un AND IsLeaf=1 AND IsRead=0';
    	$criteria->params = array(':un'=>Yii::app()->user->ID);
    	return Message::model()->count($criteria);
    }    
    
    public static function getPendingFriendRequestCount() {
    	$criteria = new CDbCriteria();
    	$criteria->condition = 'UserTo=:un';
    	$criteria->params = array(':un'=>Yii::app()->user->ID);
    	return FriendRequest::model()->count($criteria);
    }
    
    public static function getPendingTradeCount() {
    	$criteria = new CDbCriteria();
    	$criteria->condition = 'Status!=:stat AND UserOwnerID=:uid AND CompletedTime IS NULL';
    	$criteria->params =array(':stat'=>(int)TradeStatus_Cancelled, ':uid'=>Yii::app()->user->ID);
    	return UserTradeInfo::model()->count($criteria);
    }
    
    public static function getIncomingOfferCount() {
    	$criteria = new CDbCriteria();
    	$criteria->condition = 'UserTo=:un';
    	$criteria->params = array(':un'=>Yii::app()->user->ID);
    	return Offer::model()->count($criteria);
    }
}