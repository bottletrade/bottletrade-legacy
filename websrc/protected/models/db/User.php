<?php

class User extends BaseUser
{
	/**
	 * Suggests a list of existing values matching the specified keyword.
	 * @param string the keyword to be matched
	 * @param integer maximum number of names to be returned
	 * @return array list of matching lastnames
	 */
	public function suggest($keyword,$limit=20)
	{
		// only accept keywords larger than 3 letters
		$keywordLen = !is_string($keyword) ? 0 : strlen($keyword); 
		if ($keywordLen < 3)
		{
			return array();
		}
		
		$models=$this->findAll(array(
				'condition'=>'Username LIKE :keyword OR FirstName LIKE :keyword OR LastName LIKE :keyword',
				'order'=>'Username',
				'limit'=>$limit,
				'params'=>array(':keyword'=>"$keyword%")
		));
		$suggest=array();
		foreach($models as $model) {
			$suggest[] = array(
					'label'=>$model->FirstName." ".$model->LastName." (".$model->Username.")",  // label for dropdown list
					'value'=>$model->Username,  // label for dropdown list
			);
		}
		return $suggest;
	}
	
	public static function getFormalName($user, $firstNameFirst = true, $separator = " ") {
		$name = "";
		if ($firstNameFirst) {
			if (!empty($user->FirstName)) {
				$name .= $user->FirstName;
				
				if (!empty($user->LastName)) {
					$name .= $separator.$user->LastName;
				}
			} else {
				// handle case only last name
				$name .= $user->LastName;
			}
		} else {
			if (!empty($user->LastName)) {
				$name .= $user->LastName;
				
				if (!empty($user->FirstName)) {
					$name .= $separator.$user->FirstName;
				}
			} else {
				// handle case only first name
				$name .= $user->FirstName;
			}
		}
		return $name;
	}
	
	public static function getUserNameAndFormalName($user, $firstNameFirst = true, $separator = " ") {
		$ret = $user->Username;
		$formalName = self::getFormalName($user, $firstNameFirst, $separator);
		if (!empty($formalName)) {
			$ret .= " ($formalName)";
		}
		return $ret;
	}
	
	public static function findByUsername($userName) {
		return User::model()->find('LOWER(Username)=?', array(strtolower($userName)));
	}
	
	public static function findByEmail($email) {
		return User::model()->find('LOWER(Email)=?', array(strtolower($email)));
	}
	
	public static function getUser($id) {
		return User::model()->findByPk($id);
	}
	
	public static function getCurrentUser() {
		return User::model()->findByPk(Yii::app()->user->ID);
	}
	
	public static function isCurrentUser($user) {
		return $user->ID == Yii::app()->user->ID;
	}
	
	public static function getTraderRating($user) {
		$avg = Yii::app()->db->createCommand("SELECT SUM(`Rating`)/COUNT(`Rating`) as `avg` FROM `review` WHERE UserTo = ".$user->ID)->queryScalar();
		return round($avg, 2);
	}
	
	public static function deleteFriend($user) {
		// make sure current user isn't trying to remove themselves
		if ($user->ID != Yii::app()->user->ID) {
			// check if users are friends
			$friends = Friend::model()->deleteAll(array('condition'=>'(User1=:uid1 && User2=:uid2) || (User1=:uid2 && User2=:uid1)',
					'params'=>array(':uid1'=> $user->ID, ':uid2'=> Yii::app()->user->ID)));
			
			return $friends > 0;
		}
		return false;
	}
}