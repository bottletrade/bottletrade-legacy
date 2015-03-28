<?php
class ModelTypeUtils
{
	public static function isBeer($beverage)
	{
		return $beverage->tableName() == Beer::model()->tableName();
	}
	
	public static function isWine($beverage)
	{
		return $beverage->tableName() == Wine::model()->tableName();
	}
	
	public static function isSpirit($beverage)
	{
		return $beverage->tableName() == Spirit::model()->tableName();
	}
	
	public static function isBrewery($beverage)
	{
		return $beverage->tableName() == Brewery::model()->tableName();
	}
	
	public static function isWinery($beverage)
	{
		return $beverage->tableName() == Winer::model()->tableName();
	}
	
	public static function isDistillery($beverage)
	{
		return $beverage->tableName() == Distillery::model()->tableName();
	}
	
	public static function isUser($user)
	{
		return $user->tableName() == User::model()->tableName();
	}
	
	public static function isBottle($bottle)
	{
		return $bottle->tableName() == Bottle::model()->tableName();
	}
	
	public static function isFeed($event)
	{
		return $event->tableName() == Feed::model()->tableName();
	}
}