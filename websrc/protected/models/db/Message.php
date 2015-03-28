<?php

class Message extends BaseMessage
{
	public static function getOtherUser($message) {
		if (self::isCurrentUserSender($message)) {
			return $message->userTo;
		} else {
			return $message->userFrom;
		}
	}
	
	public static function isCurrentUserSender($message) {
		return $message->UserFrom == Yii::app()->user->ID;
	}
	
	public static function isCurrentUserReceiver($message) {
		return $message->UserTo == Yii::app()->user->ID;
	}
	
	public static function isOwnedByCurrentUser($message)
	{
		if (!self::isCurrentUserSender($message) && !self::isCurrentUserReceiver($message)) {
			// message doesn't belog to current user
			return false;
		}
		return true;
	}
	
	public static function canViewMessage($message) {
		if (!self::isOwnedByCurrentUser($message)) {
			return false;
		}
		if ((self::isCurrentUserSender($message) && $message->DeletedBySender==1) ||
			(self::isCurrentUserReceiver($message) && $message->DeletedByReceiver==1)) {
			// user deleted message
			return false;
		}
		return true;
	}
}