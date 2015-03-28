<?php

class FriendRequest extends BaseFriendRequest
{
	public static function findByUsers($user1, $user2) {
		$existingRequests = FriendRequest::model()->findAll(array(	'condition'=>'(UserTo=:u1 AND UserFrom=:u2) OR (UserTo=:u2 AND UserFrom=:u1)',
				'params'=>array(':u1'=>$user1, ':u2'=>$user2)));
	
		if (count($existingRequests) == 0) {
			return null;
		} else {
			return $existingRequests[0];
		}
	}
}