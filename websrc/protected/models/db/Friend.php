<?php

class Friend extends BaseFriend
{
	public static function areFriends($userId1, $userId2) {
		// you cannot be your own friend
		if ($userId1 == $userId2) return false;
		
		return Friend::model()->find(array('condition'=>'(User1=:uid1 AND User2=:uid2) OR (User1=:uid2 AND User2=:uid1)', 'params'=>array(':uid1'=>$userId1,':uid2'=>$userId2))) != null;
	}
	
	public static function isFriendWithCurrentUser($userId) {
		return self::areFriends(Yii::app()->user->ID, $userId);
	}
	/*
	public static function getFriendsOfFriends() {
		return Friend::model()->find(array('condition'=>'User1=:uid'))
	}*/
}