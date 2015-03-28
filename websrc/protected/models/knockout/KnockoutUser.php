<?php

class KnockoutUser extends KnockoutModel
{
	public static function MakeFindTraderDataWithUser($user) {
		self::generateDataWithUser($user);
		return self::$data;
	}
	
	private static function generateEmptyData() {
		self::reset();
	}
	
	private static function generateDataWithUser($user) {
        self::generateEmptyData();
        self::$data["imgSrc"] = ImageManager::getImageUrlStatic($user);
        self::$data["username"] = $user->Username;
	}
}